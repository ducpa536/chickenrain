<!-- neu session co ton tai thi hien thi no ra-->
<?php  echo ($this->Session->flash('cart')); ?>
<?php if ($this->Session->check('cart')): ?>
	<?php $cart = $this->Session->read('cart') ?> <!--doc session va hien thi no ra-->
	<ul class="motgh">
		<?php foreach ($cart as $key => $book): ?>
			<li>
				<?php echo $this->Html->link($book['title'],'/'.$book['slug']) ?> <!--hien thi link ra-->
				<?php echo $this->Number->currency($book['sale_price'], ' VND', array('places'=>0, 'wholePosition'=>'after')); ?>
			</li>
		<?php endforeach ?>
    
	</ul>

	<?php $total = $this->Session->read('payment.total'); ?> <!--hien thi tong gia tri-->
	<p class="pricetotal">
		<span class="label">
			<?php echo $this->Number->currency($total , ' VND', array('places'=>0, 'wholePosition'=>'after')); ?>
		</span>
	</p>
	<?php echo $this->Html->link('Xem/Cập nhật Giỏ hàng', '/gio-hang', array('class'=>'btn btn-primary btn-block')) ?>
<?php else: ?>
	Giỏ hàng đang rỗng	
<?php endif ?>