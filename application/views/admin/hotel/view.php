<div class="widget mg0 form_load" id="main_popup">

	<div class="title">
		<img src="<?php echo public_url('admin'); ?>/images/icons/color/view.png" alt="" class="titleIcon" />
		<h6>Chi tiết phòng</h6>
	</div>
	<div class="body">
		<div class="clear"></div>
		<!-- Thong tin don hang -->
		<div class="fontB f13 mb5 blue">Thông tin phòng:</div>
		<div class="clear"></div>
		<div class="left mt5 "  style='margin-left:5px;'>

			<a target='_blank' href='#' title='<?php echo $hotel->name; ?>'>
				<img class="left dInline mr10" style=" max-height:134px;" src='<?php echo base_url('upload/hotel_room/'.$hotel->image_link); ?>' alt='<?php echo $hotel->image_link; ?>'>

			</a>

			<div class="left dInline" style="margin-left: 30px;">
				<ul class="list2 valueB list_product_info" style="margin-top:-8px;">

					<li><span>Khách sạn:</span><?php echo $hotel->name;?> </li>
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
                    <li><span>Điện thoại:</span><?php echo $hotel->phone; ?></li>
                    <li><span>Email:</span><?php echo $hotel->email; ?></li>
					<li><span>Loại phòng:</span><?php echo $room_type->name; ?> </li>
					<li><span>Giá:</span><?php echo number_format($hotel->price); ?> VNĐ</li>
					<li><span>Số lượng:</span><?php echo $room_type->room_qty; ?> phòng con</li>
					

				</ul>
			</div>
		</div>
			<div class="clear" style='height:5px'></div>
			<div class="clear" style='height:5px'></div>
		
		<div class="clear" style='height:5px'></div>
		</div>

	</div>
