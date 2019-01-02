<?php

class User extends AppModel
{
    public $hasMany = array(
        'Group'=> array(
            'className'=>'Group',
            'foreignKey'=>'group_id'
        ),
        'Order'=> array(
            'className'=> 'Order',
            'foreignKey'=>'user_id'
        ),
        'Comment' => array(
            'className'=> 'Comment',
            'foreignKey'=>'comment_id'
        )

    );
    
}