<?php $this->load->view('admin/slide/head',$this->data); ?>
<!-- Main content wrapper -->
<?php $this->load->view('admin/message', $this->data); ?>
<div class="wrapper">
	<div class="widget">
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách slide</h6>
			<div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">

			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/')?>images/icons/tableArrows.png" /></td>
					<td style="width:60px;">Mã số</td>
					<td>Tiêu đề</td>
					<td style="width:75px;">Thứ tự</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="8">
						<div class="list_action itemActions">
							<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('slide/del_all') ?>">
								<span style='color:white;'>Xóa hết</span>
							</a>
						</div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
				<?php foreach ($list as $row):?>
				<tr class='row_<?php echo $row->id;?>'>
					<td><input type="checkbox" name="id[]" value="<?php echo $row->id;?>" /></td>
					
					<td class="textC"><?php echo $row->id; ?></td>
					
					<td>
						<div class="image_thumb">
							<img src="<?php echo base_url('upload/slide/'.$row->image_link); ?>" height="50">
							<div class="clear"></div>
						</div>

						<a href="product/view/9.html" class="tipS" title="" target="_blank">
							<b><?php echo $row->name; ?></b>
						</a>

						
					</td>
					<td><?php echo $row->sort_order; ?></td>
					
					<td class="option textC">
						
						<a  href="<?php echo $row->link; ?>" target='_blank' class='tipS' title="Xem chi tiết link">
							<img src="<?php echo public_url('admin/')?>images/icons/color/view.png" />
						</a>
						<a href="<?php echo admin_url('slide/edit/'.$row->id); ?>" title="Chỉnh sửa" class="tipS">
							<img src="<?php echo public_url('admin/')?>images/icons/color/edit.png" />
						</a>
						
						<a href="<?php echo admin_url('slide/del/'.$row->id); ?>" title="Xóa" class="tipS verify_action" >
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
