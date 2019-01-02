<?php 
	class ToolComponent extends Component
	{
        //hàm tính tổng số tiền 
		public function array_sum($cart, $quantity_col = 'quantity', $price_col = 'price') 
        {
            $total = 0;
            foreach ($cart as $key => $item) {
                $total += $item[$quantity_col]*$item[$price_col];
            }
            return $total;
        }

        //hàm kiểm tra ngày hiện tại có nằm trong khoảng ngày bắt đầu và ngày kết thúc hay k
        public function between($date, $start, $end, $timezone = 'Asia/Ho_Chi_Minh')
        {
            date_default_timezone_get($timezone); //set mặc định time zone
            $date  = strtotime($date);
            $start = strtotime($start);
            $end   = strtotime($end);
            if ($date >= $start && $date <= $end) {
                return true;
            } else {
                return false;
            }

        }
	}

 ?>