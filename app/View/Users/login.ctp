<?php echo $this->Session->flash('auth') ?>
<?php echo $this->Form->create('User', array('class' =>'form-horizontal')) ?>
	<?php echo $this->Form->input('username', array('placehoder' => 'nhap user name') ) ?>
	<?php echo $this->Form->input('password', array('placehoder' => 'mat khau') ) ?>
	<?php echo $this->Form->button('đăng nhâp' ,array('type' => 'submit', 'class' => 'btn btn-primary')) ?>
<?php echo $this->Form->end() ?>