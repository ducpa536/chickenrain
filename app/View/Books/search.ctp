
<div class="panel lienhe panel-info">
    <div class="panel-heading">
        <h4 class="titlesachchay"><i class="glyphicon glyphicon-search"></i> Tìm kiếm</h4>
        </h4> 
    </div>
    <div class="panel-body">
        <div class="form-group ">
          <?php echo $this->Form->Create('Book',  array(
          'url'   => array(
               'action' => 'get_keyword',
               'novalidate'=>true,
           ), 
          )) ?>

            <div class="row">
                <div class="col col-md-10">
                    <?php if (isset($keyword)): ?>
                      <?php echo $this->Form->input('keyword', array('value'=> $keyword,'error'=>false, 'placeholder' => 'gõ vào từ khóa tìm kiếm..',
                      'class' => 'form-control search-book',
                      'div' => 'false', 'label'=>''
                      )) ?>
                  <?php else: ?>
                      <?php echo $this->Form->input('keyword', array('error'=>false, 'placeholder' => 'gõ vào từ khóa tìm kiếm..', 'class' => 'form-control search-book','div' => 'false')) ?>
                  <?php endif ?>   
                </div>
                <div class="col col-md-2">
                  <?php echo $this->Form->button('Tim' ,array('class'=> 'btn btn-primary col-md-12', 'type'=>'submit', 'div' => 'false'))?>
                </div>
                <?php echo $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!-- end panel -->
<div class="panel sachmoi panel-default">
    <div class="panel-heading">
        <h4 class="titlesachchay"><i class="glyphicon glyphicon-th"></i><small> Kết quả tìm kiếm </small>  <?php echo $keyword ?></h4>
    </div>
    <div class="panel-body">
        <div class="row list-result">
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
        </div>
        <!-- end row nho -->
    </div>
</div>
