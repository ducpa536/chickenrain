<!--Hiển thị thông tin chi tết giỏ hạng-->
<?php pr($this->Session->read('cart')) ?>
<!--Hiển thị chi tiết sách-->

<div class="books index">
    <h2><?php echo __('Book chi tiet') ?></h2>
   
    <h4>ID : <?php echo $book['Book']['id']?> </h4><br/>
    <!-- <h4>Category : <?php echo $book['Category']['name']?> </h4><br/> -->
    
    <h4>Title : <?php echo $book['Book']['title']?> </h4><br/>
    <h4>Slug : <?php echo $book['Book']['slug']?> </h4><br/>
    <h4>số bình luận: <?php echo $book['Book']['comment_count'] ?><h4><br/>
    <h4>Image : <?php echo $this->Html->image(
                    'http://localhost:8080/trainning-cake2/cake2_chicken/app'.$book['Book']['image'],
                    array('width' => '60px' , 'height' => '60px')
                 )?> 
    </h4><br/>
    <?php echo $this->Form->postLink('them gio hang - view' , '/books/add_to_cart/'.$book['Book']['id'] ); ?> 
    <h4>price : <?php echo $book['Book']['price']?> </h4><br/>
    <h4>sale_price : <?php echo $book['Book']['sale_price']?> </h4><br/>
    <h4>publisher : <?php echo $book['Book']['publisher']?> </h4><br/>
    <h4>publish_date : <?php echo $book['Book']['publish_date']?> </h4><br/>
</div>

<!--Hiển thị chi tiết tác giả-->

<div class="related" id="related">
    <div> Hiển thị thông tin tác giả</div>

    <?php if (!empty($book['Writer'])): ?>
        <?php foreach ($book['Writer'] as $key => $writer): ?>
            <?php echo $this->Html->link($writer['name'], '/tac-gia/'.$writer['slug']) ?>
            <!-- <a href="<?php echo $this->webroot.'tac-gia/'.$writer['slug'] ?>"><?php echo $writer['name'] ?></a -->

        <?php endforeach ?>
    <?php endif ?>
</div>
<div class="related">
    <div>hiển thị comment</div>
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $key => $comment): ?>
            <b><?php echo $comment['User']['username'] ?></b>:
            "<?php echo $comment['Comment']['content'] ?>" <br/>
        <?php endforeach ?>
    <?php endif ?>
</div>

<!--Hiển thị sách liên quan-->
<h3>Sách Liên Quan</h3>

<div class="related">
    <?php echo $this->element('books', array('books'=> $related_books)) ?>
</div>

<!--gửi comment-->
<div>

    <!--chú ý cần khai báo form này sử dụng model nào và controller nào-->
    <?php echo $this->Form->create('Comment',array(
        'url'   => array(
               'controller' => 'comments',
               'action' => 'add',
               // 'novalidate' => false, //bỏ validate ở trình duyệt
           ), 
    ))
    ?>
    <?php if (isset($errors)): ?>
         <?php foreach ($errors as $key => $error): ?>
            <?php echo "<span style='color:red'>{$error[0]}</span>"; ?>
        <?php endforeach ?>   
    <?php endif ?>
    
    <fieldset>
        <legend><?php echo __('Add Comment') ?></legend>
        <?php 
            echo $this->Form->input('user_id', array('label'=> '','type'=> 'text', 'value'=>1, 'hidden' => 'true')); //hàm input dựa vào kiểu dữ liệu để sinh ra trường tương ứng
            echo $this->Form->input('book_id', array('label'=> '','type'=> 'text' , 'value'=> $book['Book']['id'], 'hidden' => 'true')) ;//cần điều chỉnh lại kiểu dữ liệu để nó sinh ra form khác
            echo $this->Form->input('content', array('required'=> 'false')) ;
        ?>

    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
