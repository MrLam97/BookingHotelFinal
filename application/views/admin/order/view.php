<div class="widget mg0 form_load" id="main_popup">

	<div class="title">
		<img src="<?php echo public_url('admin'); ?>/images/icons/color/view.png" alt="" class="titleIcon" />
		<h6>Chi tiết đơn đặt phòng</h6>
	</div>
	<div class="body">
		<div class="left tran_info" style="width:280px;">
			<div class="left fontB f13 mb5 blue">Chi tiết đơn đặt phòng:</div>
			<div class="clear"></div>
			<ul class="list2 valueB link">
				<li>
					<span>Mã đơn đặt:</span>
					<font class="red"><?php echo $order->id; ?></font>
					<div class="clear"></div>
				</li>

				<li>
					<span>Mã phòng:</span>
					<font class="red"><?php echo $order->hotel_id; ?></font>
					<div class="clear"></div>
				</li>

				<li>
					<span>Loại phòng:</span>
					<?php echo $room_type->name; ?>
					<div class="clear"></div>
				</li>
				

				<li>
					<span>Khách sạn:</span>
					<?php echo $hotel->name; ?>
					<div class="clear"></div>
				</li>

				<li>
					<span>Ngày nhận:</span>
					<?php echo get_date($order->check_in,false)?>
					<div class="clear"></div>
				</li>

				<li>
					<span>Ngày trả:</span>
					<?php echo get_date($order->check_out,false)?>
					<div class="clear"></div>
				</li>

				<li>
					<span>Số lượng:</span>
					<span class="pending"><?php echo $room_type->room_qty; ?> phòng con</span>
					<div class="clear"></div>
				</li>

				<li>
					<span>Số người:</span>
					<?php echo $order->people; ?> người
					<div class="clear"></div>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<!-- Order info -->
		<div class="left order_info" style="width:290px;">	
			<div class="left fontB f13 mb5 blue">Thông tin khách hàng:</div>
			<div class="clear"></div>
			<ul class="list2 valueB">
				<li><span>Họ tên:</span><?php echo $order->name; ?></li>
				<li><span>Email:</span><?php echo $order->email; ?></li>
				<li><span>Điện thoại:</span><?php echo $order->phone; ?></li>
				<?php 
                $address=$hotel->address;
                foreach ($wards as $ward) {
                    if($hotel->wards==$ward->id)
                    {
                        $address.=', '.$ward->title;
                    }
                }
                foreach ($provinces as $province) {
                    if($hotel->provinces==$province->id)
                    {
                        $address.=', '.$province->title;
                    }
                }
                ?>
				<li><span>Địa chỉ:</span><?php echo $address; ?></li>
			</ul>
		</div>
		<div class="clear"></div>
		<!-- Thong tin don hang -->
		<div class="fontB f13 mb5 blue">Thông tin đơn đặt phòng:</div>
		<div class="clear"></div>
		<div class="left mt5 "  style='margin-left:5px;'>

			<a target='_blank' href='#' title='<?php echo $hotel->name; ?>'>
				<img class="left dInline mr10" style=" max-height:110px;" src='<?php echo base_url('upload/hotel_room/'.$hotel->image_link); ?>' alt='<?php echo $hotel->image_link; ?>'>

			</a>

			<div class="left dInline" style="margin-left: 100px;">
				<ul class="list2 valueB list_product_info" style="margin-top:-8px;">

					<li><span>Khách sạn:</span><?php echo $hotel->name;?> </li>
					<li><span>Loại phòng:</span><?php echo $room_type->name; ?> </li>
					<li><span>Giá:</span><?php echo number_format($hotel->price); ?> VNĐ</li>
					<li><span>Số lượng:</span><?php echo $room_type->room_qty; ?> phòng con</li>
					<li><span>Thành tiền:</span> <font class="red f15"><?php echo number_format($order->amount); ?> VNĐ</font></li>
					<li class='status'><span>Trạng thái:</span><font class="<?php echo $order->status; ?>"><?php 
							if($order->status==1)
								{echo 'Đợi xử lý tiền phòng';}
							elseif($order->status==2)
								{echo 'Đã trả 50% tiền phòng';}
							elseif($order->status==3)
								{echo 'Hoàn thành tiền phòng';}
							else
								{echo 'Đã trả phòng';} 
							?></font></li>

				</ul>
			</div>
		</div>
			<div class="clear" style='height:5px'></div>
			<div class="clear" style='height:5px'></div>
		
		<div class="clear" style='height:5px'></div>
		</div>

	</div>
