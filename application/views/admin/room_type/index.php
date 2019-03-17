<?php $this->load->view('admin/room_type/head') ?>
<?php $this->load->view('admin/message', $this->data); ?>
<div class="wrapper">
	<div class="widget">
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách loại phòng</h6>
			<div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
		</div>
		
		<form action="http://localhost/webphp/index.php/admin/user.html" method="get" class="form" name="filter">
			<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
				<thead>
					<tr>
						<td><img src="<?php echo public_url('admin/') ?>images/icons/tableArrows.png" /></td>
						<td>Mã số</td>
						<td>Tên loại</td>
						<td>Số phòng</td>
						<td>Số người</td>
						<td>Hành động</td>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<td colspan="7">
							<div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('room_type/del_all') ?>">
									<span style='color:white;'>Xóa hết</span>
								</a>
							</div>
							
							<div class='pagination'>
							</div>
						</td>
					</tr>
				</tfoot>

				<tbody>
					<!-- Filter -->
					<?php foreach ($list as $row):?>
					<tr class='row_<?php echo $row->id;?>'>
						<td><input type="checkbox" name="id[]" value="<?php echo $row->id ?>" /></td>
						
						<td class="textC"><?php echo $row->id ?></td>
						
						
						<td>
							<div class="image_thumb">
								<img src="<?php echo base_url('upload/room_type/'.$row->image_link); ?>" height="50">
							<div class="clear"></div>
							</div>
							<span title="<?php echo $row->name ?>" class="tipS"><?php echo $row->name ?></span>
						</td>
						
						<td style="text-align: center;"><span title="<?php echo $row->qty ?>" class="tipS"><?php echo $row->room_qty ?></span></td>
						<td style="text-align: center;"><span title="<?php echo $row->qty ?>" class="tipS"><?php echo $row->qty ?></span></td>
						
						
						
						
						<td class="option">
							<a href="<?php echo admin_url('room_type/edit/'.$row->id) ?>" title="Chỉnh sửa" class="tipS ">
								<img src="<?php echo public_url('admin/') ?>images/icons/color/edit.png" />
							</a>
							
							<a href="<?php echo admin_url('room_type/delete/'.$row->id) ?>" title="Xóa" class="tipS verify_action" >
								<img src="<?php echo public_url('admin/') ?>images/icons/color/delete.png" />
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</form>
	</div>
</div>
<div class="clear mt30"></div>