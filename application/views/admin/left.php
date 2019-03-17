<div id="leftSide" style="padding-top:30px;">

	<!-- Account panel -->

	<div class="sideProfile">
		<a href="#" title="" class="profileFace"><img width="40" src="<?php echo public_url('admin/') ?>images/user.png" /></a>
		<span>Xin chào: <strong>admin!</strong></span>
		<span><?php echo $admin_info->name; ?></span>
		<div class="clear"></div>
	</div>
	<div class="sidebarSep"></div>		    
	<!-- Left navigation -->

	<ul id="menu" class="nav">

		<li class="home">

			<a href="<?php echo admin_url('home') ?>" class="" id="current">
				<span>Bảng điều khiển</span>
				<strong></strong>
			</a>
			

		</li>
		<li class="tran">

			<a href="<?php echo admin_url('tran') ?>" class=" exp " >
				<span>Quản lý đặt phòng</span>
				<strong>1</strong>
			</a>
			
			<ul class="sub">
				<li >
					<a href="<?php echo admin_url('order') ?>">
					Giao dịch							</a>
				</li>
			</ul>

		</li>
		<li class="product">

			<a href="<?php echo admin_url('product') ?>" class=" exp " >
				<span>Phòng</span>
				<strong>2</strong>
			</a>
			
			<ul class="sub">
				<li >
					<a href="<?php echo admin_url('hotel') ?>">
					Phòng khách sạn							</a>
				</li>
				<li >
					<a href="<?php echo admin_url('room_type') ?>">
					Loại phòng							</a>
				</li>
			</ul>

		</li>
		<li class="account">

			<a href="<?php echo admin_url('account') ?>" class=" exp " >
				<span>Tài khoản</span>
				<strong>2</strong>
			</a>
			
			<ul class="sub">
				<li >
					<a href="<?php echo admin_url('admin') ?>">
					Ban quản trị							</a>
				</li>
				<li >
					<a href="<?php echo admin_url('user') ?>">
					Thành viên							</a>
				</li>
			</ul>

		</li>
		<li class="support">

			<a href="<?php echo admin_url('support') ?>" class=" exp " >
				<span>Liên hệ</span>
				<strong>1</strong>
			</a>
			
			<ul class="sub">
				<li >
					<a href="<?php echo admin_url('contact') ?>">
					Liên hệ							</a>
				</li>
			</ul>

		</li>
		<li class="content">

			<a href="<?php echo admin_url('content') ?>" class=" exp " >
				<span>Nội dung</span>
				<strong>2</strong>
			</a>
			
			<ul class="sub">
				<li >
					<a href="<?php echo admin_url('slide') ?>">
					Slide							</a>
				</li>
				<li >
					<a href="<?php echo admin_url('blog') ?>">
					Blog							</a>
				</li>
			</ul>

		</li>

	</ul>

</div>
<div class="clear"></div>