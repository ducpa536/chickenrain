<ul class="pagination">
    <!-- ten, khai bao tag => the li bao boc , 2 tham so dang sau la phan the khi active ma disable -->
    <?php echo $this->Paginator->prev('<<',array('tag'=>'li'),'<<',array('tag'=>'li', 'disabledTag' =>'a' , 'class'=>'disabled')) ?>
    <?php echo $this->Paginator->numbers(array('separator'=>'', 'tag'=>'li', 'currentClass' =>'active', 'currentTag'=> 'a' )) ?>
    <?php echo $this->Paginator->prev('>>',array('tag'=>'li'),'>>',array('tag'=>'li', 'disabledTag' =>'a' , 'class'=>'disabled')) ?>
</ul>


