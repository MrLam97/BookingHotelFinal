<?php $this->load->view('admin/blog/head',$this->data); ?>
<div class="wrapper">

	<!-- Form -->
	<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin/') ?>images/icons/dark/add.png" class="titleIcon" />
					<h6>Thêm mới bài viết</h6>
				</div>

				<ul class="tabs">
					<li><a href="#tab1">Thông tin chung</a></li>
				</ul>

				<div class="tab_container">
					<div id='tab1' class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft" for="param_title">Tiêu đề:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="title" id="param_name" _autocheck="true" type="text" onkeyup="ChangeToAlias();" value="<?php echo set_value('title') ?>"/></span>
								<span name="name_autocheck" class="autocheck"></span>
								<div name="name_error" class="clear error"><?php echo form_error('title') ?></div>
							</div>
							<div class="clear"></div>
						</div>
						<input type="hidden" name="alias" value="" id="param_alias" >
						<div class="formRow">
							<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
							<div class="formRight">
								<div class="left"><input type="file"  id="image" name="image"  ></div>
								<div name="image_error" class="clear error"></div>
								
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft">Mô tả:</label>
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
								<div name="content_error" class="clear error"><?php echo form_error('content') ?></div>
							</div>
							<div class="clear"></div>
						</div>


						<div class="formRow hide"></div>
					</div>
				</div><!-- End tab_container-->

				<div class="formSubmit">
					<input type="submit" value="Thêm mới" class="redB" />
		
				</div>
				<div class="clear"></div>
			</div>
		</fieldset>
	</form>
</div>
<div class="clear mt30"></div>

<!-- Footer -->
<div id="footer">
	<div class="wrapper">
		<div>Bản quyền © 2012-2016 hocphp.info</div>
	</div>
</div>
</div>