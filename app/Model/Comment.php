<?php
	class Comment extends AppModel
	{
		public $actsAs = array('Containable');
		
		public $belongsTo = array(
			'User' => array(
				'className' => 'User',
				'foreignKey'=> 'user_id'
			),
			'Book' => array(
				'className' => 'Book',
				'foreignKey'=> 'book_id',
				'counterCache'=> true,
			)
		);

		//validate
		public $validate = array(
			'content' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => 'nội dung bình luận k được rỗng'
				),
				'minlength' => array(
					'rule' => array('minLength', '8' ),
					'message' =>  'nội dung nhận xét phải có độ dài lớn hơn 8 kí tự'
				)
			)
		);
	}

?>