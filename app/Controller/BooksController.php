<?php
    
    class BooksController extends AppController
    {
        public $uses = ['Book', 'Comment']; //khai báo sử dụng model

        public $paginate = array(
            'order' => array ('created' => 'desc'),
            'limit' => 5

        );

        
        //add to cart // them sach vao gio hang
        public function add_to_cart($id = null)
        {
            if ($this->request->is('post')) { //neu phuong thuc la post thi xu li tiep
                //lay thong tin ve san pham tim thong tin san pham 
                $book = $this->Book->find('first', array(
                    'recursive'  => -1,
                    'conditions' => array('Book.id' => $id),
                ));
                //nếu kich phát nữa thì nó lên sản phẩm đó + 1
                if ($this->Session->check('cart.'.$id)) {
                    $item = $this->Session->read('cart.'.$id); //doc thong tin o session
                    $item['quantity'] +=1; //cong them 1
                }else {
                    //thong tin cua quyen sach ma minh se dua vao gio hang
                    $item = array(
                        'id'    => $book['Book']['id'],
                        'title' => $book['Book']['title'],
                        'slug'  => $book['Book']['slug'],
                        'sale_price' => $book['Book']['sale_price'],
                        'quantity'  => 1,
                    );
                }
                

                //tao gio hang va luu thong tin san pham vao gio hang
                //để tạo giỏ hàng thì tạo session và lưu thông tin vào session đó.
                $this->Session->write('cart.'.$id, $item);
                //tổng giá trị cua giỏ hàng
                $cart = $this->Session->read('cart'); //doc no da
                $total = $this->Tool->array_sum($cart, 'quantity', 'sale_price');
                $this->Session->write('payment.total', $total); //tao session moi

                //kiem tra xem nguoi dung co add ma giam gia vao hay k
                if($this->Session->check('payment.coupon')) {
                    $pay = $total - $this->Session->read('payment.discount')/100 * $total;
                    $this->Session->write('payment.pay', $pay);
                }
                $this->Session->setFlash('da them sach vao gio hang !', 'default', array('class'=> 'alert alert-info'), 'cart'); //key cart
                $this->redirect($this->referer()); //tu dong reload lai trang hien tai
            }
        }
        //xem chi tiet gio hang

        public function view_cart()
        {
            $this->layout = 'cart';
            $cart = $this->Session->read('cart'); //doc session va gui session len tren view
            $payment = $this->Session->read('payment');
            $this->set(compact('cart','payment')); //gửi nhiều biến cùng 1 lúc lên view
            $this->set('title_for_layout', 'Giỏ hàng - ChickenRainShop');

        }
        //Làm rỗng giỏ hàng - xoa session di la xong
        public function empty_cart() 
        {
            if ($this->request->is('post')){
                $this->Session->delete('cart');
                $this->Session->delete('payment');
                $this->redirect($this->referer);

            }
        }

        //xoa tung quyen sach ra khoi gio hang
        public function remove($id = null)
        {
            if ($this->request->is('post')) {
                $this->Session->delete('cart.'.$id);
                $cart = $this->Session->read('cart'); //xóa rồi đọc lại xem còn sách nào ko
                if(empty($cart)){ //nếu k thì xóa hết mấy cái còn lại
                    $this->empty_cart();
                } else {
                    $total = $this->Tool->array_sum($cart, 'quantity', 'sale_price');
                    $this->Session->write('payment.total', $total);
                }
                $this->redirect($this->referer());
            }
        }
        //fix loi phan trang = cach chia form thanh 2 phan phan 1 get get_keyword 
        public function get_keyword()
        {
            if ($this->request->is('post')) {
                //kiem tra xac thuc du lieu
                $this->Book->set($this->request->data);
                if ($this->Book->validates()) {
                    $keyword = $this->request->data['Book']['keyword'];
                } else {
                    $errors = $this->Book->validationErrors;
                    $this->Session->write('search_validation' , $errors);
                }
                $this->redirect(array('action'=>'search','keyword' => $keyword)); //giup chuyen gia tri de luu vao param
            }
        }

        //chức năng search
        public function getSearch()
        {
            $keyword = $this->request->params['named']['keyword'];
            $this->set('keyword', $keyword);
            $this->paginate =  array(
                'fields' => array('title', 'image', 'sale_price', 'slug', 'id', 'price'),
                'contain'=> array('Writer.name', 'Writer.slug'),
                'order' => array('Book.created' => 'desc'),
                'limit' => 10,
                'conditions' => array(
                    'published' => 1,
                    'or' => array(
                        'Book.title like' => '%' .$keyword. '%',
                        'Writer.name like' => '%'.$keyword.'%'
                    ), 
                ),
                'joins' => array(
                    array(
                        'table'=> 'books_writers',
                        'alias'=> 'BookWriter',
                        'conditions'=> 'BookWriter.book_id = Book.id'
                    ),
                    array(  
                        'table'=> 'writers',
                        'alias'=> 'Writer',
                        'conditions'=> 'BookWriter.writer_id = Writer.id'
                    )
                )
            );
            $books = $this->paginate('Book');
            $this->set('results', $books);
            $notfound = false;
            $this->set('notfound', $notfound);

            return $this->render('/Books/search');
        }
        
        public function postSearch()
        {
            $this->autoRender = false;
            $keyword = $this->request->params['named']['keyword'];
            if ($keyword == '') {
                 return json_encode(['message' => 'ban can nhap tu khoa tim kiem']);
            }
            
            // $this->set('keyword', $keyword);
            $this->paginate =  array(
                'fields' => array('title', 'image', 'sale_price', 'slug'),
                'contain'=> array('Writer.name', 'Writer.slug'),
                'order' => array('Book.created' => 'desc'),
                'limit' => 10,
                'conditions' => array(
                    'published' => 1,
                    'or' => array(
                        'Book.title like' => '%' .$keyword. '%',
                        'Writer.name like' => '%'.$keyword.'%'
                    ), 
                ),
                'joins' => array(
                    array(
                        'table'=> 'books_writers',
                        'alias'=> 'BookWriter',
                        'conditions'=> 'BookWriter.book_id = Book.id'
                    ),
                    array(  
                        'table'=> 'writers',
                        'alias'=> 'Writer',
                        'conditions'=> 'BookWriter.writer_id = Writer.id'
                    )
                )
            );
            $books = $this->paginate('Book');
            return json_encode(['books' => $books]);
        }



        public function index()
        {
            $books = $this->Book->latest();
            $this->set('books', $books);
            $this->set('title_for_layout', 'Home_ Chiken');
        }

        /*
            Hien thi tat ca cac quen sach 
            tu moi den cu
            phan trang du lieu
            
        */
        public function latest_books()
        {
            //thiet lap rieng
            $this->paginate = array(
                'fields' => array('id', 'title', 'slug', 'image', 'sale_price'),
                'order'  => array('created' => 'desc'),
                'limit'  => 8,
                'contain'=> array(
                    'Writer' => array('name', 'slug')
                ),
                'conditions' => array('published'=>1),
                'paramType'=> 'querystring', //thay đổi đường dẫn xuất hiện
            );
            $books = $this->paginate(); //mac dinh la 20 quyen sach va k co thiet lap dieu kien muon thiet lap dieu kien thi dung bien public paginate
            
            $this->set('books', $books);
            $this->set('title_for_layout', 'Sach moi Chiken');
        }

        //viet lai link than thien
        public function view($slug = null)
        {
            $options = array(
                'conditions' => array('Book.slug' => $slug),
                'contain' => array(
                    'Writer' => array('name', 'slug')
                )
            );
            $book = $this->Book->find('first', $options);
            if (empty($book)) {
                throw new NotFoundException(__('Không tìm thấy quyển sách này .. !'));
            }

            $this->set('book', $book);

            //hiển thị các comment- muốn load model của controller khác thì phải load nó
            $comments = $this->Comment->find('all', array(
                'conditions'  => array(
                    'book_id' => $book['Book']['id']
                ),
                'order'  => array(
                    'Comment.created' => 'asc'
                ),
                'contain' => array(
                    'User' => array('username')
                )
            ));
            $this->set('comments' , $comments);

            //hiển thị sách liên quan
                /*
                    => cùng chủ đề với cuốn chi tiết => có cùng cate gory với book hiện tại
                    => không bao gồm dữ liệu cuốn sách mà người dùng đang xem nghĩa là book_id <> book_id hiện tại
                */
            $related_books = $this->Book->find('all', array(
                'fields' => array('title', 'image', 'sale_price', 'slug', 'price'),
                'conditions' => array(
                    'category_id' => $book['Book']['category_id'],
                    'Book.id <>' => $book['Book']['id'],
                    'published' => 1
                ),
                'limit' => 5,
                'order' => 'rand()', //lấy ngẫu nhiên sách 
                'contain' => array(
                    'Writer' => array('name', 'slug')
                )
            ));
            //pr($related_books);
            $this->set('related_books', $related_books);

            //hiển thị câu thông báo lỗi - xác thực dữ liệu
            if ($this->Session->check('comment_errors')) { //kiểm tra có k
                $errors = $this->Session->read('comment_errors');
                $this->set('errors', $errors);
                    
                $this->Session->delete('comment_errors');
            }

            //đếm số comment có 2 cách cách 1 là  thêm 1 trường trong bảng tên trường lầ tên model + với count
            $countComment = $this->Comment->find('all', array(
                'conditions' => array(
                    'book_id' => $book['Book']['id']
                ),
                'contain' => array(
                    'User'=> array('username')
                )
            ));
            
        }

        //update comment_count trong book
        // public function update_comment()
        // {
        //     $books = $this->Book->find('all', array(
        //         'fields' => array('id'),
        //         'contain' => 'Comment',
        //     ));
        //     foreach ($books as $key => $book) {
        //      echo count($book['Comment']) .'<br/>';
        //      if (count($book['Comment']) > 0 ) {
        //          $this->Book->updateAll(
        //              array(
        //                  'comment_count'=> count($book['Comment'])
        //              ),
        //              array(
        //                  'Book.id' => $book['Book']['id']
        //              )
        //          );
        //      }
        //     }
        // }

    }

?>