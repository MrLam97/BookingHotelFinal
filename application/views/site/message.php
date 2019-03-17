<?php if(isset($message)&&$message): ?>
<div class="" style="height: 50px;color: red;
    font-size: 20px;
    line-height: 50px;
    text-align: center;">
	<!-- <i class="icon-info-large"></i> <strong>Thông báo!</strong> <?php echo $message; ?>. -->
	<script type="text/javascript">
		alert('<?php echo $message; ?>');
	</script>
</div>
<?php endif ?>