<?php
	class WritersController extends AppController
	{
        public $paginate = array(
            'order' => array ('created' => 'desc'),
            'limit' => 5
        );
        
		public function index()
        {

            //thiet lap rieng
            $this->paginate = array(
                'fields' => array('name','slug'),
                'order'  => array('created' => 'desc'),
                'limit'  => 3,
                'paramType'=> 'querystring', //thay đổi đường dẫn xuất hiện
            );
            $witers = $this->paginate(); //mac dinh la 20 quyen sach va k co thiet lap dieu 
            $this->set('writers', $witers);
        }

        public function view($slug = null)
        {
            $options = array(
                'descriptions' => array('Writer.slug'=>$slug),
                'recursive' => -1,
            );

            $writer = $this->Writer->find('first', $options);
            if (empty($writer)) {
                throw new NotFoundException(__('Không tìm thấy quyển sách này .. !'));
            }
            $this->set('writer', $writer);

            // phân trang dữ liệu books
            $this->paginate = array(
                'fields' => array('id', 'title', 'Book.slug', 'image', 'sale_price'),
                'order'  => array('created' => 'desc'),
                'limit'  => 1,
                'contain'=> array(
                    'Writer' => array('name', 'slug')
                ),
                'joins'  => array(//quan hệ nhiều nhiều thì k được phép thêm vào contain mà phải thêm join vào
                    array(
                        'table' => 'books_writers', //kết nối với bảng phụ
                        'alias' => 'BookWriter', //đổi tên 
                        'conditions'=> 'BookWriter.book_id = Book.id' //điều kiện kết nối 
                    ),
                    array(
                        'table' => 'writers',
                        'alias' => 'Writer', //đổi tên 
                        'conditions'=> 'BookWriter.writer_id = Writer.id' //điều kiện kết nối 
                    )
                ), 
                'conditions' => array(
                    'published' => 1,
                    'Writer.slug' => "$slug"
                ),
                'paramType'=> 'querystring', //thay đổi đường dẫn xuất hiện
            );
            $books = $this->paginate('Book'); //mac dinh la 20 quyen sach va k co thiet lap dieu kien muon thiet lap dieu kien thi dung bien public paginate
            $this->set('books', $books);
            $this->set('title_for_layout', 'Tac Gia - ' . $writer['Writer']['name']);
        }
	}

?>