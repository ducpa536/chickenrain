<div class="books index">
    <h2><?php echo __('Category') ?></h2>
    <h4>ID : <?php echo $cate['Category']['id']?></h4>
    <h4>Name : <?php echo $cate['Category']['name']?> </h4><br/>
    <h4>Slug : <?php echo $cate['Category']['slug']?> </h4><br/>
    <h4>Description : <?php echo $cate['Category']['description']?> </h4><br/>
    <h4>Created : <?php echo $cate['Category']['created']?> </h4><br/>
</div>
<div class="related">
    <h3><?php echo __('Related Book')?></h3>
    <?php if (!empty($books)):  ?>
        <?php echo $this->element('books', array('books'=> $books)) ?>
        <?php echo $this->element('pagination', array('object'=> 'Quyển sách')) ?>
    <?php endif; ?>
</div>