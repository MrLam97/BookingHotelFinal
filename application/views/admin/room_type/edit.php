<?php 
$this->load->view('admin/room_type/head') ?>

<div class="wrapper">
	<div class="widget">
		<div class="title">
			<h6>Cập nhật loại phòng</h6>
		</div>
		<form class="form" id="form" action="#" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
					<label class="formLeft" for="param_name">Loại phòng:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" onkeyup="ChangeToAlias();" value="<?php echo $info->name; ?>" /></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('name') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<input type="hidden" name="alias" id="param_alias" value="<?php echo $info->alias; ?>">
				<div class="formRow">
					<label class="formLeft" for="param_qty">Số lượng người:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="qty" id="param_qty" _autocheck="true" type="text" value="<?php echo $info->qty; ?>"/></span>
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
								<img src="<?php echo base_url('upload/room_type/'.$info->image_link); ?>" style="width: 100px;height: 70px">
							</div>
							<div class="clear"></div>
						</div>
				
				<div class="formSubmit">
           			<input type="submit" value="Cập nhật" class="redB" />
           		</div>
        		<div class="clear"></div>
			</fieldset>
		</form>
	</div>
</div>