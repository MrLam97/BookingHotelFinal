<div class="widget mg0 form_load" id="main_popup">

	<div class="title">
		<img src="<?php echo public_url('admin'); ?>/images/icons/dark/dialog.png" alt="" class="titleIcon" />
		<h6>Xem tin nhắn</h6>
	</div>
	<div class="body">
		<div style="width:1500px;height: 350px;" class="left tran_info">
			<div class="formRow">
				<label class="formLeft" for="param_sale" style="font-size: 30px;">Tiêu đề:</label>
				<div class="formRight">
					<span class="oneTwo"><textarea name="sale" id="param_sale" rows="4" cols="" style="height: 150px;

width: 1000px;font-size: 25px;"><?php echo $contact->title; ?></textarea></span>
					<span name="sale_autocheck" class="autocheck"></span>
					<div name="sale_error" class="clear error"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label class="formLeft" for="param_sale" style="font-size: 30px;">Tin nhắn:</label>
				<div class="formRight">
					<span class="oneTwo"><textarea name="sale" id="param_sale" rows="4" cols="" style="height: 150px;

width: 1000px;font-size: 25px;"><?php echo $contact->content; ?></textarea></span>
					<span name="sale_autocheck" class="autocheck"></span>
					<div name="sale_error" class="clear error"></div>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
		
		<div class="clear" style='height:5px'></div>
		</div>
	</div>
</div>
