<?php $this->load->view('admin/hotel/head',$this->data); ?>
<div class="wrapper">

	<!-- Form -->
	<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin/') ?>images/icons/dark/add.png" class="titleIcon" />
					<h6>Thêm mới phòng khách sạn</h6>
				</div>

				<ul class="tabs">
					<li><a href="#tab1">Thông tin chung</a></li>
				</ul>

				<div class="tab_container">
					<div id='tab1' class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft" for="param_name">Tên Khách sạn:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" value="<?php echo set_value('name') ?>"/></span>
								<span name="name_autocheck" class="autocheck"></span>
								<div name="name_error" class="clear error"><?php echo form_error('name') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
							<div class="formRight">
								<div class="left"><input type="file"  id="image" name="image"  ></div>
								<div name="image_error" class="clear error"><?php echo form_error('image') ?></div>
								
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="formRow">
							<label class="formLeft">Ảnh kèm theo:</label>
							<div class="formRight">
								<div class="left"><input type="file"  id="image_list" name="image_list[]" multiple></div>
								<div name="image_list_error" class="clear error"></div>
								
							</div>
							<div class="clear"></div>
						</div>

						<!-- Price -->
						<div class="formRow">
							<label class="formLeft" for="param_price">
								Giá :
								<span class="req">*</span>
							</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="price"  style='width:100px' id="param_price" class="format_number" _autocheck="true" type="text" value="<?php echo set_value('price') ?>"/>
									<img class='tipS' title='Giá bán sử dụng để giao dịch' style='margin-bottom:-8px'  src='<?php echo public_url('admin/') ?>crown/images/icons/notifications/information.png'/>
								</span>
								<span name="price_autocheck" class="autocheck"></span>
								<div name="price_error" class="clear error"><?php echo form_error('price') ?></div>
							</div>
							<div class="clear"></div>
						</div>


						<div class="formRow">
							<label class="formLeft" for="param_room_type">Loại phòng:<span class="req">*</span></label>
							<div class="formRight">
								<select name="room_type" _autocheck="true" id='param_room_type' class="left">
									<option value="">Lựa chọn loại phòng</option>
									<?php foreach ($list_type as $row):?>
										<option value="<?php echo $row->id; ?>" ><?php echo $row->name; ?></option>
									<?php endforeach; ?>

								</select>
								<span name="cat_autocheck" class="autocheck"></span>
								<div name="cat_error" class="clear error"><?php echo form_error('room_type') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_cat">Địa chỉ:<span class="req">*</span></label>
							<div class="formRight">
								<select name="provinces" _autocheck="true" id='param_provinces' class="left" url="<?php echo admin_url('hotel/wards'); ?>">
									<option value="">Lựa chọn thành phố</option>
									<?php foreach ($list_provinces as $row):?>
										<option value="<?php echo $row->id; ?>" ><?php echo $row->title; ?></option>
									<?php endforeach; ?>
									

								</select>
								<span name="cat_autocheck" class="autocheck"></span>
								<div name="cat_error" class="clear error"><?php echo form_error('provinces') ?></div>
							</div><br><br>
							<div class="formRight">
								<select name="wards" _autocheck="true" id='param_wards' class="left wards" >
									<option value="">Lựa chọn quận/huyện</option>
								</select>
								<span name="cat_autocheck" class="autocheck"></span>
								<div name="cat_error" class="clear error"><?php echo form_error('wards') ?></div>
							</div><br><br>
							<div class="formRight">
								<span class="oneTwo"><input name="address" id="param_address" _autocheck="true" type="text" placeholder="Số nhà, tên đường"  /></span>
								<span name="name_autocheck" class="autocheck"></span>
								<div name="name_error" class="clear error"><?php echo form_error('address') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_name">Liên hệ:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="email" id="param_email" _autocheck="true" type="text" placeholder="Email"  value="<?php echo set_value('email') ?>"/></span>
								<span name="name_autocheck" class="autocheck"></span>
								<div name="name_error" class="clear error"><?php echo form_error('email') ?></div>
							</div><br><br>
							<div class="formRight">
								<span class="oneTwo"><input name="phone" id="param_phone" _autocheck="true" type="text" placeholder="Điện thoại"  value="<?php echo set_value('phone') ?>"/></span>
								<span name="name_autocheck" class="autocheck"></span>
								<div name="name_error" class="clear error"><?php echo form_error('phone') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft">Giới thiệu:</label>
							<div class="formRight">
								<textarea name="intro" id="param_intro" class="editor"><?php echo set_value('intro') ?></textarea>
								<div name="content_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft">Nội dung:</label>
							<div class="formRight">
								<textarea name="content" id="param_content" class="editor"><?php echo set_value('content') ?></textarea>
								<div name="content_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>


						<div class="formRow hide"></div>
					</div>
				</div><!-- End tab_container-->

				<div class="formSubmit">
					<input type="submit" value="Thêm mới" class="redB" />
					<input type="reset" value="Hủy bỏ" class="basic" />
				</div>
				<div class="clear"></div>
			</div>
		</fieldset>
	</form>
</div>
<div class="clear mt30"></div>

</div>