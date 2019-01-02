<?php echo $this->Form->Create('Book',  array(
          'url'   => array(
               'action' => 'get_keyword',
               'novalidate'=>true
           ), 
       )) ?>

<?php if (isset($keyword)): ?>
    <?php echo $this->Form->input('keyword', array('value'=> $keyword,'error'=>false, 'placeholder' => 'gõ vào từ khóa tìm kiếm..')) ?>
<?php else: ?>
    <?php echo $this->Form->input('keyword', array('error'=>false, 'placeholder' => 'gõ vào từ khóa tìm kiếm..')) ?>
<?php endif ?>   


<?php echo $this->Form->end('Search') ?>

<!------------Hien thi ket qua tim kiem -------------->
<?php if (isset($errors)): ?>

    <?php foreach ($errors as $key => $error): ?>
        <?php echo $errors['keyword'][0] ?>
    <?php endforeach ?>
<?php endif ?>
ket qua tim kiem cua tu khoa : <strong> <?php echo $keyword ?></strong> <br/>
<?php if ($notfound === false && isset($results)): ?>
    <?php echo $this->element('books', array('books'=>$results)); ?>
    
<?php elseif ($notfound): ?> 
    khong tim thay saCH
<?php endif ?>




