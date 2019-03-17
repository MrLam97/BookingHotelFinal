	    <!-- Main content -->
	<?php $this->load->view('admin/message', $this->data); ?>    
	    <!-- Title area -->
	    <div class="titleArea">
	    	<div class="wrapper">
	    		<div class="pageTitle">
	    			<h5>Bảng điều khiển</h5>
	    			<span>Trang quản lý hệ thống</span>
	    		</div>
	    		
	    		<div class="clear"></div>
	    	</div>
	    </div>

	    <div class="line"></div>


	    <!-- Message -->


	    <!-- Main content wrapper -->
	    <div class="wrapper">
	    	
	    	<div class="widgets">
	    		<!-- Stats -->
	    		
	    		<!-- Amount -->
	    		<div class="oneTwo">
	    			<div class="widget">
	    				<div class="title">
	    					<img src="<?php echo public_url('admin/') ?>images/icons/dark/money.png" class="titleIcon" />
	    					<h6>Doanh số</h6>
	    				</div>
	    				
	    				<table cellpadding="0" cellspacing="0" width="100%" class="sTable myTable">
	    					<tbody>
	    						
	    						<tr>
	    							<td class="fontB blue f13">Tổng doanh số</td>
	    							<td class="textR webStatsLink red" style="width:120px;"><?php echo number_format($amount_total) ?> VNĐ</td>
	    						</tr>
	    						
	    						<tr>
	    							<td class="fontB blue f13">Doanh số hôm nay</td>
	    							<td class="textR webStatsLink red" style="width:120px;"><?php echo number_format($amount_to_day) ?> VNĐ</td>
	    						</tr>
	    						
	    						<tr>
	    							<td class="fontB blue f13">Doanh số theo tháng</td>
	    							<td class="textR webStatsLink red" style="width:120px;"><?php echo number_format($amount_to_mon) ?> VNĐ</td>
	    						</tr>
	    						
	    					</tbody>
	    				</table>
	    			</div>
	    		</div>


	    		<!-- User -->
	    		<div class="oneTwo">
	    			<div class="widget">
	    				<div class="title">
	    					<img src="<?php echo public_url('admin/') ?>images/icons/dark/users.png" class="titleIcon" />
	    					<h6>Thống kê dữ liệu</h6>
	    				</div>
	    				
	    				<table cellpadding="0" cellspacing="0" width="100%" class="sTable myTable">
	    					<tbody>
	    						
	    						<tr>
	    							<td>
	    								<div class="left">Tổng số đặt phòng</div>
	    								<div class="right f11"><a href="<?php echo admin_url('order');?>">Chi tiết</a></div>
	    							</td>
	    							
	    							<td class="textC webStatsLink"><?php echo $order_total; ?></td>
	    						</tr>
	    						
	    						<tr>
	    							<td>
	    								<div class="left">Tổng số phòng</div>
	    								<div class="right f11"><a href="<?php echo admin_url('hotel');?>">Chi tiết</a></div>
	    							</td>
	    							
	    							<td class="textC webStatsLink"><?php echo $hotel_total; ?></td>
	    						</tr>
	    						
	    						<tr>
	    							<td>
	    								<div class="left">Tổng số bài viết</div>
	    								<div class="right f11"><a href="<?php echo admin_url('blog');?>">Chi tiết</a></div>
	    							</td>
	    							
	    							<td class="textC webStatsLink"><?php echo $blog_total; ?></td>
	    						</tr>
	    						
	    						<tr>
	    							<td>
	    								<div class="left">Tổng số thành viên</div>
	    								<div class="right f11"><a href="<?php echo admin_url('user');?>">Chi tiết</a></div>
	    							</td>
	    							
	    							<td class="textC webStatsLink"><?php echo $user_total; ?></td>
	    						</tr>
	    						<tr>
	    							<td>
	    								<div class="left">Tổng số liên hệ</div>
	    								<div class="right f11"><a href="<?php echo admin_url('contact');?>">Chi tiết</a></div>
	    							</td>
	    							
	    							<td class="textC webStatsLink"><?php echo $contact_total; ?></td>
	    						</tr>
	    					</tbody>
	    				</table>
	    			</div>
	    		</div>

	    		<div class="clear"></div>
	    		
	    		<!-- Giao dich thanh cong gan day nhat -->
	    		
	    		

	    	</div>
	    	
	    </div>
	    <div class="clear mt30"></div>
	    <div class="wrapper">
	<div class="widget">
		<div class="title">
			<img src="<?php echo public_url('admin/') ?>images/icons/dark/money.png" class="titleIcon" />
			<h6>Doanh thu theo khoản thời gian</h6>
			<div class="num f12">Tổng số: <b><?php if(isset($total_revenue)) {echo $total_revenue;}else{echo 0;} ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="10">
				<form class="list_filter form" action="<?php echo admin_url('home/index') ?>" method="post">
					<table cellpadding="0" cellspacing="0" width="40%"><tbody>
					
						<tr>

							<td class="label" style="width:60px;"><label for="filter_created">Từ ngày</label></td>
							<td class="item"><input name="created"  id="filter_created" type="text" class="datepicker" /></td>

							<td class="label"><label for="filter_created_to">Đến ngày</label></td>
							<td class="item"><input name="created_to" id="filter_created_to" type="text" class="datepicker" /></td>
							
							<td colspan='2' style='width:60px'>
								<input type="submit" class="button blueB" value="Lọc" />
								<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('home/index') ?>'; ">
							</td>

							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td>Mã số</td>
					<td>Thành viên</td>
					<td>Số tiền</td>
					<td>Ngày tạo</td>
				</tr>
			</thead>
			
			<tbody class="list_item">
				<?php if (isset($revenue)): ?>
				<?php foreach ($revenue as $row): ?>
				<tr>
					<td><?php echo $row->id; ?></td>
					<td><?php echo $row->name; ?></td>
					<td><?php echo get_date($row->created,false); ?></td>
					<td class="textR red"><?php echo number_format($row->amount); ?> VNĐ</td>
				</tr>
				<?php endforeach ?>
				<tr>
					<td colspan="3" class="textR webStatsLink ">Tổng doanh thu</td>
					<td class="textR webStatsLink red"><?php if(isset($amount_revenue)){echo number_format($amount_revenue);}{echo 0;} ?> VNĐ</td>
				</tr>
				<?php endif ?>
			</tbody>
			
		</table>
	</div>
</div>
<div class="clear mt30"></div>
	    