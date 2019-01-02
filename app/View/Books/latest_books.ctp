<div class="books index">
    <h2><?php echo __('Latest Book') ?></h2>
    
    
</div>



<div class="panel sachmoi panel-default">
    <div class="panel-heading">
        <h4 class="titlesachmoi"><i class="glyphicon glyphicon-th"></i> Sách mới
            <small class="sorts pull-right">Sắp xếp theo:
            <?php echo $this->Paginator->sort('title', 'Tên') ?> ∙
            <?php echo $this->Paginator->sort('created', 'Mới/Cũ') ?></small>
        </h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php echo $this->element('books', array('books', $books)) ?>
            <!-- end col 3 -->
            <?php echo $this->element('pagination' , array('object'=> 'quyen sach'))?>
            
        </div>
        <!-- end row nho -->
    </div>
</div>
<!-- end panel -->