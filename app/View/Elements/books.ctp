<!-- <?php echo "<pre>"; var_dump($books); ?> -->
<?php foreach ($books as $key => $book): ?>
    <div class="col col-md-3 motsp">
        <?php echo $this->Html->image(
            'http://localhost:8080/chicken/app'.$book['Book']['image'],
            array('width' => '50px' , 'height' => '50px')
        )?>
        <p><?php echo $this->Html->link($book['Book']['title'],'/'.$book['Book']['slug']) ?> <br></p>
        <p>
            <?php foreach ($book['Writer'] as $key => $Writer): ?>
            <?php echo $this->Html->Link($Writer['name'], '/tac-gia/' .$Writer['slug'] , array('class'=>'author'))?>
            <?php endforeach ?>
        </p>
        <p class="price">Giá : <?php echo $this->Number->currency($book['Book']['price'], ' VND' , array('places'=> 0, 'wholePosition' => 'after'))?></p>  

        <p class="price">Giá sele: <?php echo $this->Number->currency($book['Book']['sale_price'], ' VND' , array('places'=> 0, 'wholePosition' => 'after'))?></p>
        <?php echo $this->Form->postLink('them gio hang', '/books/add_to_cart'.$book['Book']['id']) ?> <!--Tao ra 1 link su dung method post-->
    </div>
<?php endforeach ?>
