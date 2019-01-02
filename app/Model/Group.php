<?php
	class Group extends AppModel
	{
		public $belongsTo = array(
            'User' => array(
                'className' => 'User',
                'foreignKey'=> 'user_id'
            ),
        ); 
	}

?>