<?php 
$this->load->view('admin/admin/head') ?>

<div class="wrapper">
	<div class="widget">
		<div class="title">
			<h6>Cập nhật quản trị viên</h6>
		</div>
		<form class="form" id="form" action="#" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
					<label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" value="<?php echo $info->name; ?>" /></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('name') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label class="formLeft" for="param_user">Tài khoản:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input disabled style="background: #e9e8e8" name="username" id="param_user" _autocheck="true" type="text" value="<?php echo $info->username; ?>" /></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="user_error" class="clear error"><?php echo form_error('username') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formRow">
					<label class="formLeft" for="param_email">Email:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="email" id="param_email" _autocheck="true" type="text" value="<?php echo $info->email; ?>"/></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="email_error" class="clear error"><?php echo form_error('email') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label class="formLeft" for="param_phone">Điện thoại:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="phone" id="param_phone" _autocheck="true" type="text" value="<?php echo $info->phone; ?>"/></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="phone_error" class="clear error"><?php echo form_error('phone') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<b>Đổi mật khẩu mới nhập giá trị</b>
				</div>
				<div class="formRow">
					<label class="formLeft" for="param_pass">Mật khẩu:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="password" id="param_pass" _autocheck="true" type="password" /></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="pass_error" class="clear error"><?php echo form_error('password') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label class="formLeft" for="param_pass">Nhập lại mật khẩu:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="Repassword" id="param_Repass" _autocheck="true" type="password" /></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="Repass_error" class="clear error"><?php echo form_error('Repassword') ?></div>
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