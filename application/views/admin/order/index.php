<?php $this->load->view('admin/order/head'); ?>
<!-- Main content wrapper -->
<?php $this->load->view('admin/message', $this->data); ?>
<style type="text/css">
	.success_tran{
		color: green;
	}
</style>
<div class="wrapper">

	<div class="widget">
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách Giao dịch</h6>
			<div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="10">
				<form class="list_filter form" action="<?php echo admin_url('order/index'); ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="100%"><tbody>

						<tr>
							<td class="label" style="width:60px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" value="" id="filter_id" type="text" style="width:95px;" /></td>
							
							<td class="label" style="width:60px;"><label for="filter_type">Hình thức</label></td>
							<td class="item">
								<select name="payment">
									<option value="">Chọn</option>
									<option value="offline">Trả khi nhận</option>
									<option value="dat-50">Trả trước 50%</option>
								</select>
							</td>
							
							<td class="label" style="width:60px;"><label for="filter_created">Từ ngày</label></td>
							<td class="item"><input name="created" value="" id="filter_created" type="text" class="datepicker" /></td>

							
							<td colspan='2' style='width:60px'>
								<input type="submit" class="button blueB" value="Lọc" />
								<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('order/index') ?>'; ">
							</td>
							
						</tr>
						
						<tr>
							<td class="label" style="width:60px;"><label for="filter_user">Thành viên</label></td>
							<td class="item"><input name="user" value="" id="filter_user" class="tipS" title="Nhập mã thành viên" type="text" /></td>

							<td class="label"><label for="filter_status">Giao dịch</label></td>
							<td class="item">
								<select name="status">
									<option value="">Chọn</option>
									<option value='1' >Đợi xử lý</option>
									<option value='2' >Đã trả 50%</option>
									<option value='3' >Hoàn thành</option>
									<option value='4' >Đã trả phòng</option>
								</select>
							</td>

							<td class="label"><label for="filter_created_to">Đến ngày</label></td>
							<td class="item"><input name="created_to" value="" id="filter_created_to" type="text" class="datepicker" /></td>

							<td class="label"></td>
							<td class="item"></td>
						</tr>
						
					</tbody></table>
				</form>
			</td></tr></thead>
			<thead>
				<tr>
					<td><img src="<?php echo public_url('admin/') ?>images/icons/tableArrows.png" /></td>
					<td>Mã số</td>
					<td>Thành viên</td>
					<td>Điện thoại</td>
					<td>Email</td>
					<td>Số tiền</td>
					<td>Hình thức</td>
					<td>Giao dịch</td>
					<td>Ngày tạo</td>
					<td>Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="10">
						<div class="list_action itemActions">
							<a href="#submit" id="submit" class="button blueB" url="admin/tran/del_all.html">
								<span style='color:white;'>Xóa hết</span>
							</a>
						</div>

						<div class='pagination'>
							<?php echo $this->pagination->create_links(); ?>
						</td>
					</tr>
				</tfoot>

				<tbody class="list_item">
					<?php foreach ($list as $row): ?>
						
					
					<tr class='row_21'>
						<td><input type="checkbox" name="id[]" value="<?php echo $row->id; ?>" /></td>

						<td class="textC"><?php echo $row->id; ?></td>

						<td>
							<?php echo $row->name; ?><?php if($row->user_id==0) echo ' ( Khách ) ';?>
						</td>

						<td><?php echo $row->phone; ?></td>
						<td><?php echo $row->email; ?></td>
						<?php
						$amount=0; 
						if($row->status==2)
						{
							$amount=$row->amount/2;
						}
						else
						{
							$amount=$row->amount;
						}
						?>

						<td class="textR red"><?php echo number_format($amount); ?> VNĐ</td>

						<td><?php if($row->payment=='dat-50'){echo 'Trả trước 50%';}else{echo 'Trả khi nhận';} ?></td>


						<td class="status textC">
							<span class="
							<?php 
							if($row->status==1)
							{echo 'cancel';}
							elseif($row->status==2)
							{echo 'pending';}
							elseif($row->status==3)
							{echo 'success_tran';}
							else
							{echo '';} 
							?>">
							<?php 
							if($row->status==1)
								{echo 'Đợi xử lý tiền phòng';}
							elseif($row->status==2)
								{echo 'Đã trả 50% tiền phòng';}
							elseif($row->status==3)
								{echo 'Hoàn thành tiền phòng';}
							else
								{echo 'Đã trả phòng';} 
							?>
							</span>
						</td>

						<td class="textC"><?php echo get_date($row->created,false); ?></td>

						<td class="textC">
							<a href="<?php echo admin_url('order/view/'.$row->id); ?>" title="Chi tiết" class="tipS lightbox">
								<img src="<?php echo public_url('admin/') ?>images/icons/color/view.png" />
							</a>
							<?php if ($row->payment=='dat-50'&&$row->status==1): ?>
							<a href="<?php echo admin_url('order/pay_50/'.$row->id); ?>" title="Trả trước" class="tipS" onclick="return confirm('Kích hoạt trả 50% tiền phòng.');">
								<img src="<?php echo public_url('admin/') ?>images/icons/color/money.png" />
							</a>
							<?php endif ?>
							<?php if ($row->status!=3&&$row->status!=4): ?>		
							<a href="<?php echo admin_url('order/pay_100/'.$row->id); ?>" title="Hoàn thành" class="tipS" onclick="return confirm('Kích hoạt hoàn thành tiền phòng.');">
								<img src="<?php echo public_url('admin/') ?>images/icons/color/accept.png" />
							</a>
							<?php endif ?>	
							<?php if($row->status!=4&&$row->status==3): ?>
							<a href="<?php echo admin_url('order/check_out/'.$row->id); ?>" title="Trả phòng" class="tipS " onclick="return confirm('Kích hoạt trả phòng.');">
								<img src="<?php echo public_url('admin/') ?>images/icons/dark/refresh4.png" />
							</a>	
							<?php endif ?>	
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>

			</table>
		</div>

	</div>
	<div class="clear mt30"></div>