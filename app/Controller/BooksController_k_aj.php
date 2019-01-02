<?php
	
	class BooksController extends AppController
	{
		public $uses = ['Book', 'Comment']; //khai báo sử dụng model

		public $paginate = array(
			'order' => array ('created' => 'desc'),
			'limit' => 5

		);
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
		public function search()
		{
			$notfound = false;
			//print_r($this->request->params);
			//$keyword = $this->request->data['Book']['keyword'];
			if (!empty($this->request->params['named']['keyword'])) {
					$keyword = $this->request->params['named']['keyword'];
					$this->paginate =  array(
					'fields' => array('title', 'image', 'sale_price', 'slug'),
					'contain'=> array('Writer.name', 'Writer.slug'),
					'order' => array('Book.created' => 'desc'),
					'limit' => 2,
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
				if (!empty($books)) {
					$this->set('results', $books);
				} else {
					$notfound = true;
				}
				$this->set('keyword', $keyword);
			}
			$this->set('notfound', $notfound);
			//
			if ($this->Session->check('search_validation')) {
				$this->set('errors', $this->Session->read('search_validation'));
			}
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
				'order'	 => array('created' => 'desc'),
				'limit'	 => 8,
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
				'order'	 => array(
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
				'fields' => array('title', 'image', 'sale_price', 'slug'),
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
	    //     	echo count($book['Comment']) .'<br/>';
	    //     	if (count($book['Comment']) > 0 ) {
	    //     		$this->Book->updateAll(
	    //     			array(
	    //     				'comment_count'=> count($book['Comment'])
	    //     			),
	    //     			array(
	    //     				'Book.id' => $book['Book']['id']
	    //     			)
	    //     		);
	    //     	}
	    //     }
	    // }

	}

?>