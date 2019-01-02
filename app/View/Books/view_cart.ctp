<!--kiem tra gio hang co san pham hay k-->
<?php if ($this->Session->check('cart')): ?>
	<div class="wrapper">
      <div class="container_fullwidth">
        <div class="container shopping-cart">
          <div class="row">
            <div class="col-md-12">
              <h3 class="title">
                Shopping Cart
              </h3>
              <div class="clearfix">
              </div>
              <table class="shop-table">
                <thead>
                  <tr>
                    <th>
                      STT
                    </th>
                    <th>
                      Ten Sach
                    </th>
                    <th>
                      Price
                    </th>
                    <th>
                      Quantity
                    </th>
                    <th>
                      Price
                    </th>
                    <th>
                      Delete
                    </th>
                  </tr>
                </thead>
                <tbody>
                	<?php $i = 1 ?>
                	<?php foreach ($cart as $key => $book): ?>
                		<tr>
		                    <td>
		                      <?php echo $i++ ?>
		                    </td>
		                    <td>
		                      <div class="shop-details">
		                        <div class="productname">
		                          	<?php echo $this->Html->link($book['title'],''.$book['slug']) ?>
		                        </div>
		                      </div>
		                    </td>
		                    <td>
		                      <h5>
		                        <?php echo $this->Number->currency($book['sale_price'], ' VND', array('places'=>0, 'wholePosition'=>'after')); ?>
		                      </h5>
		                    </td>
		                    <td>
		                      <?php echo $this->Form->create('Book'); ?>
		                      <!-- <input type="text" value="1" name=""> -->
		                      	<?php echo $this->Form->input('quantity', array('value' => $book['quantity'] , 'label' => false, 'div' => false))?>
		                     	<?php echo $this->Form->button('cap nhap', array('type'=>"submit", 'class'=>"btn btn-link"))?>
		                      <?php echo $this->Form->end(); ?>
		                    </td>
		                    <td>
		                      <h5>
		                        <strong class="red">
		                          <?php echo $this->Number->currency($payment['total'], ' VND', array('places'=>0, 'wholePosition'=>'after')); ?>
		                        </strong>
		                      </h5>
		                    </td>
		                    <td>
		                      <!-- <a href="#" class="glyphicon glyphicon-remove">
		                      </a> -->
		                      <?php echo $this->Form->postLink('','/books/remove/'.$book['id'] , array('class' => 'glyphicon glyphicon-remove'))?>
		                    </td>
                 	 	</tr>
                	<?php endforeach ?>
                  
              </table>
              <div class="clearfix">
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-6">
                  <div class="shippingbox">
                    <h5>
                      	<?php echo $this->Form->postLink('Làm rỗng giỏ hàng', '/books/empty_cart')?>
                    </h5>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6">
                  <div class="shippingbox">
                    <!-- Form nhap ma giam gia  model Coupon  -->
                    <?php echo $this->Form->create('Coupon', array('action'=> 'add'))?>
                      <?php echo $this->Form->input('code', array('placeholder' => 'nhap ma giam gia')); ?>
                      <?php echo $this->Form->button('Nhap' , array('type' => 'submit'))?>
                    <?php echo $this->Form->end() ?>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6">
                  <div class="shippingbox">
                    <div class="subtotal">
                      <h5>
                        Sub Total
                      </h5>
                      <span>
                        $1.000.00
                      </span>
                    </div>
                    <div class="grandtotal">
                      <h5>
                        GRAND TOTAL 
                      </h5>
                      <span>
                        <?php echo $this->Number->currency($payment['total'], ' VND', array('places'=>0, 'wholePosition'=>'after')); ?>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <?php if (true): ?>
            <?php echo $this->Session->flash('order') ?>
            <div class="panel panel-primary">
              <div class="panel-heading">Thanh Toan Don Hang</div>
              <div class="panel-body">
                <?php echo $this->Form->create('Order', array('action'=> 'checkout','class'=> 'form-horizontal', 'inputDefault' => array('label'=>false))) ?>
                  <?php echo $this->Form->label('name', 'Ten' , array('class' => 'control-label')) ?>
                  <?php echo $this->Form->input('name', array('placeholder'=> 'Nhap ten', 'value' => 'DucPA123456')) ?>

                  <?php echo $this->Form->label('email', 'email' , array('class' => 'control-label')) ?>
                  <?php echo $this->Form->input('email', array('placeholder'=> 'Nhap email', 'value' => 'phamanhduc536@gmail.com')) ?>
                  
                  <?php echo $this->Form->label('address', 'dia chi' , array('class' => 'control-label')) ?>
                  <?php echo $this->Form->input('address', array('placeholder'=> 'Nhap dia chi', 'value' => 'Trieu Khuc Thanh Xuan Ha Noi')) ?>

                  <?php echo $this->Form->label('phone', 'phone' , array('class' => 'control-label')) ?>
                  <?php echo $this->Form->input('phone', array('placeholder'=> 'Nhap so dien thoai' , 'value' => '123456789')) ?>
                  <?php echo $this->Form->button('submit', array('type'=>'submit', 'class' => 'btn btn-primary')) ?>
                <?php echo $this->Form->end() ?>
              </div>
            </div>
        <?php else: ?>
          
        <?php endif ?>
        
      </div>
    </div> 
<?php else: ?> 	 
	Gio hang dang rong
	quay ve <?php echo $this->Html->link('trang-chu', '/')?> de them sach vao gio hang
<?php endif; ?>
