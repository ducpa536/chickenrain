<?php
	class OrdersController extends AppController
	{
		//thực hiện thanh toán đơn hàng và lưu thông tin đơn hàng và lưu vào bảng order trong CSDL
		public function checkout() 
		{
			if ($this->request->is('post')) {
				$data = array(
					'user_id' => 1,
					//thông tin giỏ hàng đọc từ session cart
					'customer_info' => json_encode($this->Session->read('cart')), //là array thì chuyển thành json để nó lưu dc
					'orders_info'   => json_encode($this->request->data['Order']),
					//thông tin hóa đơn đọc từ session ra
					'payment_info'  => json_encode($this->Session->read('payment')),
					'status' => 0
				);
				// echo '<pre>';
				// var_dump($data);
				// die();
				if($this->Order->saveAll($data)) {
					$this->Session->delete('cart');
					$this->Session->delete('payment');
				} else {
					$this->Session->setFlash('Thanh toan k thuc hien dc', 'default', array('class' => 'alert alert-danger'), 'order');
				}
				$this->redirect($this->referer());
			}
		}
		
	}

?>