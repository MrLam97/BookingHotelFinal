<?php $this->load->view('admin/contact/head',$this->data); ?>
<!-- Main content wrapper -->
<?php $this->load->view('admin/message', $this->data); ?>
<div class="wrapper">
	<div class="widget">
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách contact</h6>
			<div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			

			
			<thead>
				<tr>
					<td><img src="<?php echo public_url('admin/')?>images/icons/tableArrows.png" /></td>
					<td>Mã số</td>
					<td>Họ tên</td>
					<td>Email</td>
					<td>Điện thoại</td>
					<td>Ngày tạo</td>
					<td>Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="9">
						<div class="list_action itemActions">
							<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('contact/del_all') ?>">
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
				<tr class='row_<?php echo $row->id;?>'>
					<td><input type="checkbox" name="id[]" value="<?php echo $row->id;?>" /></td>
					
					<td class="textC"><?php echo $row->id; ?></td>
					<td><?php echo $row->name; ?></td>
					<td><?php echo $row->email; ?></td>
					<td><?php echo $row->phone; ?></td>
					
					<td class="tipS"><?php echo get_date($row->created,false); ?></td>
					
					<td class="option textC">
						<a  href="<?php echo admin_url('contact/view/'.$row->id) ?>" target='_blank' class='tipS lightbox' title="Xem tin nhắn">
							<img src="<?php echo public_url('admin/')?>images/icons/color/view.png" />
						</a>						
						<a href="<?php echo admin_url('contact/del/'.$row->id); ?>" title="Xóa" class="tipS verify_action" >
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
