<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('site/head'); ?>
</head>
<body>
	<?php 
	if($title != 'Trang chủ'&&$title != 'Đăng kí'&&$title != 'Đăng nhập'){
		$this->load->view('site/header',$this->data); 
	}
	?>
	<?php $this->load->view($temp,$this->data); ?>
	<?php 
	if($title != 'Đăng kí'&&$title != 'Đăng nhập'){
		$this->load->view('site/foot'); 
	}
	?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=403098376853834&autoLogAppEvents=1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>