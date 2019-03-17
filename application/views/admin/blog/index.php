<?php $this->load->view('admin/blog/head',$this->data); ?>
<!-- Main content wrapper -->
<?php $this->load->view('admin/message', $this->data); ?>
<div class="wrapper">
	<div class="widget">
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách blog</h6>
			<div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="8">
				<form class="list_filter form" action="#" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>

						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" value="" id="filter_id" type="text" style="width:55px;" /></td>
							
							<td class="label" style="width:40px;"><label for="filter_title">Tiêu đề</label></td>
							<td class="item" style="width:155px;" ><input name="title" value="" id="filter_title" type="text" style="width:155px;" value="<?php echo $this->input->get('title'); ?>" /></td>
							
							<td style='width:150px'>
								<input type="submit" class="button blueB" value="Lọc" />
								<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('blog'); ?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/')?>images/icons/tableArrows.png" /></td>
					<td style="width:60px;">Mã số</td>
					<td>Tiêu đề</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="8">
						<div class="list_action itemActions">
							<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('blog/del_all') ?>">
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
					
					<td>
						<div class="image_thumb">
							<img src="<?php echo base_url('upload/blog/'.$row->image_link); ?>" height="50">
							<div class="clear"></div>
						</div>

						<a href="product/view/9.html" class="tipS" title="" target="_blank">
							<b><?php echo $row->title; ?></b>
						</a>

						<div class="f11" >
						Xem: <?php echo $row->view; ?>					</div>
						
					</td>
					
					<td class="tipS"><?php echo get_date($row->created,false); ?></td>
					
					<td class="option textC">
						
						<a  href="product/view/9.html" target='_blank' class='tipS' title="Xem chi tiết sản phẩm">
							<img src="<?php echo public_url('admin/')?>images/icons/color/view.png" />
						</a>
						<a href="<?php echo admin_url('blog/edit/'.$row->id); ?>" title="Chỉnh sửa" class="tipS">
							<img src="<?php echo public_url('admin/')?>images/icons/color/edit.png" />
						</a>
						
						<a href="<?php echo admin_url('blog/del/'.$row->id); ?>" title="Xóa" class="tipS verify_action" >
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
