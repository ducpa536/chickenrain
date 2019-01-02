<?php
	class Book extends AppModel
	{
		public $actsAs = array('Containable');

		public $validate = array(
			'keyword' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'ban phai co du lieu khi tim kiem'
				)
			)
		);

		public $belongsTo = array(
			'Category' => array(
				'className' => 'Category',
				'foreignKey'=> 'category_id'
			)
		);


		public $hasMany = array(
			'Comment' => array(
				'className' => 'Comment',
				'foreignKey' => 'book_id',
			)
		);

		public $hasAndBelongsToMany  = array(
			'Writer' => array(
				'className' => 'Writer',
				'joinTable' => 'books_writers',
				'foreignKey'=> 'book_id',
				'associationForeignKey'=> 'writer_id',
				'unique' => true,
			)

		);


		public function latest()
		{
			return $this->find('all', array(
				'fields' => array('title', 'image', 'sale_price', 'slug', 'price'),
				'order'  => array('created'=>'DESC'),
				'limit'  => 4,
				'conditisions' => array('published'=> 1),
				'contain'=> array('Writer' =>array(
					'fields' => array('name', 'slug')
				))
			));
		}
	}

?>