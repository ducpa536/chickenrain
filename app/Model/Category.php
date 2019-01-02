<?php
	class Category extends AppModel
	{
		public $hasMany = array(
			'Book' => array(
				'className' => 'Book',
				'foreignKey'=> 'category_id',
				'dependent'	=> false,
			)
		);
	}

?>