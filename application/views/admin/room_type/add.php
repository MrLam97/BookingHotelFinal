<?php 
$this->load->view('admin/room_type/head') ?>

<div class="wrapper">
	<div class="widget">
		<div class="title">
			<h6>Thêm mới loại phòng</h6>
		</div>
		<form class="form" id="form" action="#" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
					<label class="formLeft" for="param_name">Loại phòng:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" onkeyup="ChangeToAlias();"/></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('name') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<input type="hidden" name="alias" value="" id="param_alias" >
				<div class="formRow">
					<label class="formLeft" for="param_room_qty">Số lượng phòng:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="room_qty" id="param_room_qty" _autocheck="true" type="text" /></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="room_qty_error" class="clear error"><?php echo form_error('room_qty') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label class="formLeft" for="param_qty">Số lượng người:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="qty" id="param_qty" _autocheck="true" type="text" /></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="qty_error" class="clear error"><?php echo form_error('qty') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
							<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
							<div class="formRight">
								<div class="left"><input type="file"  id="image" name="image"  ></div>
								<div name="image_error" class="clear error"></div>
								
							</div>
							<div class="clear"></div>
						</div>
				
				<div class="formSubmit">
           			<input type="submit" value="Thêm mới" class="redB" />
           		</div>
        		<div class="clear"></div>
			</fieldset>
		</form>
	</div>
</div>