<?php
	class Writer extends AppModel
	{
		public $hasAndBelongsToMany = array(
			'Book' => array(
				'className' => 'Book',
				'joinTable' => 'books_writers',
				'foreignKey'=> 'writer_id',
				'associationForeignKey'=> 'book_id',
				'unique' => true,
			)
		);
	}

?>