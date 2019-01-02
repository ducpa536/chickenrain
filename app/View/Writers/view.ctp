<div class="panel lienhe panel-info">
    <div class="panel-heading">
        <h4 class="titlesachchay">
            <i class="glyphicon glyphicon-user"></i> 
            <?php echo ($writer['Writer']['name']) ?>
        </h4> 
    </div>
    <div class="panel-body">
        <p><?php echo ($writer['Writer']['biography']) ?></p>
    </div>
</div><!-- end panel -->
<?php if (!empty($books)): ?>
    <div class="panel sachmoi panel-default">
        <div class="panel-heading">
            <h4 class="titlesachchay"><i class="glyphicon glyphicon-th"></i><small> Các sách của tác giả: </small>
                <?php echo ($writer['Writer']['name']) ?><br/>
            </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php echo $this->element('books', array('books' => $books))?>
                <?php echo $this->element('pagination' , array('object'=>'tac gia'))?>
          </div>
      </div>
    </div>
<?php endif; ?>