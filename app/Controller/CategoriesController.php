<?php
	class CategoriesController extends AppController
	{
        //danh sach cac category
		public function view($slug = null)
        {
            $options = array(
                'conditions' => array('Category.slug' => $slug),
                'recursive' => -1
            );

            $cate = $this->Category->find('first', $options);
            if (empty($cate)) {
                throw new NotFoundException(__('Không tìm thấy danh muc sách này .. !'));
            }
            $this->set('cate', $cate);


            //phân trang dữ liệu book
            $this->paginate = array(
                'fields' => array('id', 'title', 'slug', 'image', 'sale_price'),
                'order'  => array('created' => 'desc'),
                'limit'  => 2,
                'contain'=> array(
                    'Writer' => array('name', 'slug'),
                    'Category'  => array('slug')
                ),
                'conditions' => array(
                    'published'=>1,
                    'Category.slug'=> $slug
                ),
                'paramType'=> 'querystring', //thay đổi đường dẫn xuất hiện
            );
            $books = $this->paginate('Book'); //mac dinh la 20 quyen sach va k co thiet lap model cần sử dụng
            $this->set('books', $books);
        }
		
        //hiển thị Menu Categori
        public function menu()
        {
            var_dump($this->request->is('requested'));
            if ($this->request->is('requested')) {
                $categories = $this->Category->find('all', array(
                    'recursive'=>-1,
                    'order' => array('name' => 'asc')
                ));
                return $categories;
            }
            
        }
	}

?>