<header class="main-header main-header-4">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navigation" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo site_url(); ?>" style="color: black;font-size: 25px;font-weight: bold;" class="logo">
                    <!-- <img src="<?php echo public_url('site/') ?>img/logos/white-logo.png" alt="white-logo"> -->
                    Booking Hotel
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar-collapse collapse" role="navigation" aria-expanded="true" id="app-navigation">
                <ul class="nav navbar-nav">
                    <li class="dropdown active">
                        <a href="<?php echo base_url(); ?>">Trang chủ</a>
                    </li>
                    <li class="dropdown">
                        <a tabindex="0" data-toggle="dropdown" data-submenu="" aria-expanded="false">
                            Phòng<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($type_list as $row): ?>
                                
                            <li><a href="<?php echo base_url('hotel/room_type/'.$row->id); ?>"><?php echo $row->name; ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo base_url('hotel/room_list'); ?>"> Khách sạn</a>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo base_url('blog/list_blog'); ?>"> Bài viết</a>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo base_url('contact/form'); ?>"> Liên hệ</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right hidden-sm hidden-xs">
                    <li>
                        <?php if (isset($user_info)): ?>
                            <a class="btn-navbar btn btn-sm  btn-round" href="<?php echo site_url('user/index') ?>"><?php echo $user_info->name; ?></a>
                        <?php else: ?>   
                            <a class="btn-navbar btn btn-sm btn-white-sm-outline btn-round" href="<?php echo site_url('user/login') ?>">Đăng nhập/Đăng ký</a>
                        <?php endif;?>
                    </li>
                    <?php if (isset($user_info)): ?>
                    <li>
                        <a href="<?php echo site_url('user/logout') ?>" class="btn-navbar btn btn-sm  btn-round">Đăng xuất</a>
                    </li>
                    <?php endif;?>
                    <li>
                        <a id="header-search-btn" class="btn-navbar search-icon"><i class="fa fa-search"></i></a>
                    </li>
                </ul>
            </div>

            <!-- /.navbar-collapse -->
            <!-- /.container -->
        </nav>

        <div class="header-search animated fadeInDown">
            <form class="form-inline" action="<?php echo site_url('hotel/search') ?>" method="get">
                <input type="text" class="form-control searchKey" id="searchKey" name="key-search" placeholder="Search..." value="<?php echo isset($key)?$key:'' ?>">
                <div class="search-btns">
                    <button type="submit" class="btn btn-default">Search</button>
                </div>
            </form>
        </div>
    </div>
</header>

<div class="sub-banner overview-bgi">
    <div class="container">
        <div class="breadcrumb-area">
            <h1><?php echo $title; ?></h1>
            <ul class="breadcrumbs">
                <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                <li class="active"><?php echo $title; ?></li>
            </ul>
        </div>
    </div>
</div>