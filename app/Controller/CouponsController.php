<?php
	class CouponsController extends AppController
	{
		public function add() {
			if ($this->request->is('post')) {
				//thuc hien kiem tra xem ma giam gia gui tu controller len co dung ko thông qua biến request data -- từ model và name của input
				$code = $this->request->data['Coupon']['code'];

				//lấy ra được mã giảm giá từ input chuyển lên giờ thực hiện tìm kiếm nó xem có trong CSDL hay k bằng cách tìm kiếm findbyTenTruong
				$coupon = $this->Coupon->findByCode($code);
				if (empty($coupon)) {
					//kiểm tra xem biến đó có còn hạn sử dụng hay k nghĩa là check thời gian ngày hiện tại có  nằm trong khoảng ngày bắt đầu và ngày kết thúc hay k
					$today = date('Y:m:d H:i:s');
					if ($this->Tool->between($today, $coupon['Coupon']['time_start'], $coupon['Coupon']['time_end'])) {
						//thuc hien luu ma giam gia, luu muc giam gia va tinh so tien phai tra vao trong ss payment
						$this->Session->write('payment.coupon', $coupon['Coupon']['code']);//ma code
						$this->Session->write('payment.discount', $coupon['Coupon']['percent']); //phan tram giam gia

						//tong gia tri don hang phai tra --> doc tu session ra
						$total = $this->Session->read('payment.total');
						echo $total;
						die();
						$pay   = $total - $coupon['Coupon']['percent']/100 * $total; 
						$this->Session->write('payment.pay', $pay);

					} else {
						$this->Session->setFlash(' Ma Giam Gia Da Het Han ', 'default', array('class'=> 'alert alert-danger'), 'coupon'); //tham số key
					}
				} else {                                      //element mac dinh 
					$this->Session->setFlash('Sai Ma Giam Gia', 'default', array('class'=> 'alert alert-danger'), 'coupon'); //tham số key
				}
				$this->redirect($this->referer());
			}
		}
	}
?>