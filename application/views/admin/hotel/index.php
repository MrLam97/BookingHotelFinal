<?php $this->load->view('admin/hotel/head',$this->data); ?>
<!-- Main content wrapper -->
<?php $this->load->view('admin/message', $this->data); ?>
<div class="wrapper">
	<div class="widget">
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách phòng khách sạn</h6>
			<div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="10">
				<form class="list_filter form" action="#" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
					
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" value="" id="filter_id" type="text" style="width:55px;" /></td>
							
							<td class="label" style="width:40px;"><label for="filter_id">Tên</label></td>
							<td class="item" style="width:155px;" ><input name="name" value="" id="filter_iname" type="text" style="width:155px;" value="<?php echo $this->input->get('name'); ?>" /></td>
							
							<td class="label" style="width:60px;"><label for="filter_status">Thể loại</label></td>
							<td class="item">
								<select name="room_type" style="width:160px;">
									<option value="0"> -- Chọn loại phòng --</option>
									<?php foreach ($list_type as $row):?>
										<option value="<?php echo $row->id; ?>" <?php echo ($this->input->get('room_type')==$row->id?'selected':'') ?>><?php echo $row->name; ?></option>
									<?php endforeach; ?>
								</select>

							</td>

							<td class="label" style="width:60px;"><label for="filter_status">Trạng thái</label></td>
							<td class="item">
								<select name="status" style="width:160px;">
									<option value=""> -- Chọn trạng thái --</option>
									<option value="2">Chưa thuê</option>
									<option value="1">Đang thuê</option>
									<option value="3">Bảo trì</option>
								</select>

							</td>
							
							<td style='width:150px'>
								<input type="submit" class="button blueB" value="Lọc" />
								<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('hotel'); ?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/')?>images/icons/tableArrows.png" /></td>
					<td style="width:60px;">Mã số</td>
					<td>Tên khách sạn</td>
					<td>Loại phòng</td>
					<td>Giá</td>
					<td>Trạng thái</td>
					<td>Điện thoại</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="10">
						<div class="list_action itemActions">
							<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('hotel/del_all') ?>">
								<span style='color:white;'>Xóa hết</span>
							</a>
						</div>

						<div class='pagination'>
							<?php echo $this->pagination->create_links(); ?>
						</div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
				<?php foreach ($list as $row):?>
				<tr class='row_<?php echo $row->id;?>' <?php if($row->status==3){echo 'style="background: gold"';} ?>>
					<td><input type="checkbox" name="id[]" value="<?php echo $row->id;?>" /></td>
					
					<td class="textC"><?php echo $row->id; ?></td>
					
					<td>
						<div class="image_thumb">
							<img src="<?php echo base_url('upload/hotel_room/'.$row->image_link); ?>" height="50">
							<div class="clear"></div>
						</div>

						<a href="<?php echo site_url('hotel/view/'.$row->id); ?>" class="tipS" title="" target="_blank">
							<b><?php echo $row->name; ?></b>
						</a>

						<div class="f11" >
						Đã đăt: <?php echo $row->ordered; ?>					  | Xem: <?php echo $row->view; ?>					</div>
						
					</td>

					<td class="tipS"><?php foreach ($list_type as $row_type) {
						if($row_type->id == $row->type_id)
						{
							echo $row_type->name;
						}
					} ?></td>	
					
					<td class="textR">
						<b style="color: red"><?php echo number_format($row->price); ?>
						VNĐ</b>
					</td>
					
					

					<td class="status textC">
						<span class="<?php if($row->status==2){echo 'pending';}elseif($row->status==3){echo '';}else{echo 'cancel';} ?>"><?php if($row->status==2){echo 'Chưa thuê';}elseif($row->status==3){echo 'Bảo trì';}else{echo 'Đang thuê';} ?></span>
					</td>
					<td class="tipS"><?php echo $row->phone; ?></td>
					<td class="tipS"><?php echo get_date($row->created,false); ?></td>
					
					<td class="option textC">
						
						<a  href="<?php echo admin_url('hotel/view/'.$row->id); ?>" target='_blank' class='tipS lightbox' title="Xem chi tiết sản phẩm">
							<img src="<?php echo public_url('admin/')?>images/icons/color/view.png" />
						</a>
						<a href="<?php echo admin_url('hotel/edit/'.$row->id); ?>" title="Chỉnh sửa" class="tipS">
							<img src="<?php echo public_url('admin/')?>images/icons/color/edit.png" />
						</a>
						<?php if ($row->status!=3): ?>
						<a href="<?php echo admin_url('hotel/fix/'.$row->id); ?>" title="Sửa chữa" class="tipS" onclick="return confirm('Kích hoạt bảo trì, sửa chữa phòng.');">
							<img src="<?php echo public_url('admin/')?>images/icons/color/edit_quick.png" />
						</a>
						<?php else: ?>
						<a href="<?php echo admin_url('hotel/fixed/'.$row->id); ?>" title="Phục hồi" class="tipS" >
							<img src="<?php echo public_url('admin/')?>images/icons/dark/refresh4.png" />
						</a>
						<?php endif ?>
						<a href="<?php echo admin_url('hotel/del/'.$row->id); ?>" title="Xóa" class="tipS verify_action" >
							<img src="<?php echo public_url('admin/')?>images/icons/color/delete.png" />
						</a>


					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
			
		</table>
	</div>
</div>
<div class="clear mt30"></div>
