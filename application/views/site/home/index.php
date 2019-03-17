<!-- Banner start -->
<div class="banner banner-2">
    <div class="banner-inner">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php foreach ($slide_list as $row): ?>
                    
                <div class="item <?php if($row->sort_order==1){echo 'active';}else{echo '';} ?>">
                    <img src="<?php echo base_url('upload/slide/'.$row->image_link); ?>" alt="<?php echo $row->name; ?>">
                    <div class="carousel-caption banner-slider-inner banner-top-align">
                        <div class="banner-content text-center">
                            <h1 data-animation="animated fadeInDown delay-05s"><span><?php echo $row->name; ?></span></h1>
                            <p data-animation="animated fadeInUp delay-1s"><?php echo $row->info; ?></p>
                            <a href="<?php echo $row->link; ?>" class="btn btn-md btn-theme" data-animation="animated fadeInUp delay-15s">Bắt đầu</a>
                            <!-- <a href="<?php echo $row->link; ?>" class="btn btn-md border-btn-theme" data-animation="animated fadeInUp delay-15s">Xem thêm</a> -->
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="slider-mover-left" aria-hidden="true">
                <i class="fa fa-angle-left"></i>
            </span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="slider-mover-right" aria-hidden="true">
                <i class="fa fa-angle-right"></i>
            </span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- Main header start -->
        <header class="main-header main-header-2 main-header-3">
            <div class="container">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navigation" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo site_url(); ?>" style="color: white;font-size: 25px;font-weight: bold;" class="logo">
                            <!-- <img src="<?php echo public_url('site/') ?>img/logos/white-logo.png" alt="white-logo"> -->
                            Booking Hotel
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="navbar-collapse collapse" role="navigation" aria-expanded="true" id="app-navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown active">
                                <a  href="<?php echo base_url(); ?>">
                                    Trang chủ
                                </a>
                                
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
                                <a  href="<?php echo base_url('hotel/room_list'); ?>">
                                    Khách sạn
                                </a>
                            </li>
                            <li class="dropdown">
                                <a  href="<?php echo base_url('blog/list_blog'); ?>">
                                    Bài viết
                                </a>
                            </li>
                            <li class="dropdown">
                                <a  href="<?php echo base_url('contact/form'); ?>">
                                    Liên hệ
                                </a>
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
        <!-- Main header end -->
    </div>
</div>
<!-- Banner end -->

<!-- Search area box 2 start -->
<div class="search-area-box-2 search-area-box-6">
    <div class="container">
        <div class="search-contents">
            <form method="get" action="<?php echo site_url('hotel/search_more') ?>">
                <div class="row search-your-details">
                    <div class="col-lg-3 col-md-3">
                        <div class="search-your-rooms mt-20">
                            <h3 class="hidden-xs hidden-sm">Tìm Kiếm</h3>
                            <h2 class="hidden-xs hidden-sm">Phòng <span>Của Bạn</span></h2>
                            <h2 class="hidden-lg hidden-md">Tìm Kiếm Phòng <span>Của Bạn</span></h2>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="btn-default datepicker" placeholder="Ngày nhận phòng" name="date_from">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="btn-default datepicker" placeholder="Ngày trả phòng" name="date_to">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields form-control-2" name="room_type">
                                        <option value="0">Loại phòng</option>
                                        <?php foreach ($type_list as $row): ?>
                                            <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields form-control-2" name="provinces">
                                        <option value="0">Thành phố</option>
                                        <?php foreach ($provinces as $row): ?>
                                            <option value="<?php echo $row->id; ?>"><?php echo $row->title; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields form-control-2" name="price_from">
                                        <option>Giá từ</option>
                                        <?php for ($i=0; $i <= 1200000 ; $i=$i+100000):?>
                                            <option><?php echo number_format($i); ?> VNĐ</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields form-control-2" name="price_to">
                                        <option>Giá tới</option>
                                        <?php for ($i=0; $i <= 1200000 ; $i=$i+100000):?>
                                            <option><?php echo number_format($i); ?> VNĐ</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                    <input type="text" name="" id="" class="btn-default" placeholder="Nhập địa điểm...">
                                </div>
                            </div> -->
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                    <button class="search-button btn-theme">Search</button>
                                </div>
                            </div>
                                     <?php $this->load->view('site/message', $this->data); ?>
                        </div>
                    </div>
                </div>
            </form>
                   
        </div>
    </div>
</div>
<!-- Search area box 2 end -->

<!-- Hotel Booking start -->
<div class="hotel-Booking content-area-12">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="text">
                    <h5>BookingHotel WEBSITE</h5>
                    <h1>Chào Mừng Đến Với BookingHotel</h1>
                    <p>Đây là website đặt phòng khách sạn khắp cả nước hàng đầu Việt Nam. Đến đây khách hàng có thể chọn thuê những căn phòng ưng ý nhất. Cảm ơn đã sử dụng dịch vụ website đặt phòng của chúng tôi.</p>

                    <br>
                </div>
            </div>
            <div class="col-lg-5 col-lg-offset-1 col-md-6">
                <img src="<?php echo public_url('site/') ?>img/b.jpg" alt="a" class="" style="max-width: 60%;">
            </div>
        </div>
    </div>
</div>
<!-- Hotel Booking end -->

<!-- Gallery secion start -->
<div class="gallery clearfix content-area">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Loại phòng</h1>
            <p>Tìm kiếm theo loại phòng.</p>
        </div>

        <div class="row">
            <div class="filtr-container">
                <?php foreach ($type_list as $row): ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="">
                    <figure class="portofolio-thumb">
                        <a href="<?php echo base_url('hotel/room_type/'.$row->id); ?>"><img src="<?php echo base_url('upload/room_type/'.$row->image_link); ?>" alt="img-21" class="img-responsive" style="max-height: 170px"></a>
                        <figcaption>
                            <div class="figure-content">
                                <h3 class="title"><?php echo $row->name; ?></h3>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- Gallery secion end -->

<!-- Hotel section start -->
<div class="content-area-11 hotel-section chevron-icon">
    <div class="overlay">
        <div class="container">
            <!-- Main title -->
            <div class="main-title">
                <h1>Phòng được xem nhiều</h1>
                <p>Những phòng được xem nhiều nhất</p>
            </div>
            <div class="row">
                <div class="carousel our-partners slide" id="ourPartners3">
                    <div class="col-lg-12 mb-30">
                        <a class="right carousel-control" href="#ourPartners3" data-slide="prev"><i class="fa fa-chevron-left icon-prev"></i></a>
                        <a class="right carousel-control" href="#ourPartners3" data-slide="next"><i class="fa fa-chevron-right icon-next"></i></a>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($hotel_list as $key => $row): ?>
                        <div class="item <?php if($key==0){echo 'active';}else{echo '';} ?>">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="hotel-box">
                                    <!--header -->
                                    <div class="header clearfix">
                                        <a href="<?php echo base_url('hotel/view/'.$row->id); ?>">
                                        <img src="<?php echo base_url('upload/hotel_room/'.$row->image_link); ?>" alt="<?php echo $row->name; ?>" class="img-responsive">
                                        </a>
                                    </div>
                                    <!-- Detail -->
                                    <div class="detail clearfix">
                                        <div class="pr" style="padding: 35px 15px;">
                                            <?php echo number_format($row->price); ?> VNĐ<sub>/Đêm</sub>
                                        </div>
                                        <h3>
                                            <a href="<?php echo base_url('hotel/view/'.$row->id); ?>"><?php echo $row->name; ?></a>
                                        </h3>
                                        <h5 style="float: right;margin-top: 4px;">Lượt xem: <b><?php echo $row->view; ?></b></h5>
                                        <?php foreach ($type_list as $type): ?>
                                        <?php if ($type->id==$row->type_id): ?>
                                        <h4 style="color: #fa4e3a"><?php echo $type->name; ?></h4>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                        <h5 class="location">
                                            <a href="<?php echo base_url('hotel/view/'.$row->id); ?>">
                                                <?php 
                                                $address=$row->address;
                                                foreach ($wards as $ward) {
                                                    if($row->wards==$ward->id)
                                                    {
                                                        $address.=', '.$ward->title;
                                                    }
                                                }
                                                foreach ($provinces as $province) {
                                                    if($row->provinces==$province->id)
                                                    {
                                                        $address.=', '.$province->title;
                                                    }
                                                }
                                                

                                                ?>
                                                <i class="fa fa-map-marker"></i><?php echo $address; ?>
                                            </a>
                                        </h5>
                                        <p><?php echo $row->intro; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div></div>
<!-- Hotel section end -->

<!-- Hotel section start -->
<div class="content-area-11 hotel-section chevron-icon">
    <div class="overlay">
        <div class="container">
            <!-- Main title -->
            <div class="main-title">
                <h1>Phòng được đặt nhiều</h1>
                <p>Những phòng được đặt nhiều nhất</p>
            </div>
            <div class="row">
                <div class="carousel our-partners slide" id="ourPartners4">
                    <div class="col-lg-12 mb-30">
                        <a class="right carousel-control" href="#ourPartners4" data-slide="prev"><i class="fa fa-chevron-left icon-prev"></i></a>
                        <a class="right carousel-control" href="#ourPartners4" data-slide="next"><i class="fa fa-chevron-right icon-next"></i></a>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($hotel_list_order as $key => $row): ?>
                        <div class="item <?php if($key==0){echo 'active';}else{echo '';} ?>">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="hotel-box">
                                    <!--header -->
                                    <div class="header clearfix">
                                        <a href="<?php echo base_url('hotel/view/'.$row->id); ?>">
                                        <img src="<?php echo base_url('upload/hotel_room/'.$row->image_link); ?>" alt="<?php echo $row->name; ?>" class="img-responsive">
                                        </a>
                                    </div>
                                    <!-- Detail -->
                                    <div class="detail clearfix">
                                        <div class="pr" style="padding: 35px 15px;">
                                            <?php echo number_format($row->price); ?> VNĐ<sub>/Đêm</sub>
                                        </div>
                                        <h3>
                                            <a href="<?php echo base_url('hotel/view/'.$row->id); ?>"><?php echo $row->name; ?></a>
                                        </h3>
                                        <h5 style="float: right;margin-top: 4px">Lượt đặt: <b><?php echo $row->ordered; ?></b></h5>
                                        <?php foreach ($type_list as $type): ?>
                                        <?php if ($type->id==$row->type_id): ?>
                                        <h4 style="color: #fa4e3a"><?php echo $type->name; ?></h4>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                        <h5 class="location">
                                            <a href="<?php echo base_url('hotel/view/'.$row->id); ?>">
                                                <?php 
                                                $address=$row->address;
                                                foreach ($wards as $ward) {
                                                    if($row->wards==$ward->id)
                                                    {
                                                        $address.=', '.$ward->title;
                                                    }
                                                }
                                                foreach ($provinces as $province) {
                                                    if($row->provinces==$province->id)
                                                    {
                                                        $address.=', '.$province->title;
                                                    }
                                                }
                                                

                                                ?>
                                                <i class="fa fa-map-marker"></i><?php echo $address; ?>
                                            </a>
                                        </h5>
                                        <p><?php echo $row->intro; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div></div>
<!-- Hotel section end -->



<!-- Blog section start -->
<div class="blog-section content-area-11">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Bài viết</h1>
            <p>Top 3 bài viết mới nhất về các căn phòng khách sạn.</p>
        </div>
        <div class="row">
            <?php foreach ($blog_list as $row): ?>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog-1">
                    <div class="blog-photo">
                    <a href="<?php echo site_url('blog/view/'.$row->id); ?>">
                        
                        <img src="<?php echo base_url('upload/blog/'.$row->image_link); ?>" alt="<?php echo $row->alias; ?>" class="img-responsive">
                    </a>  
                    </div>
                    <div class="detail">
                        <div class="post-meta clearfix">
                            <ul>
                                <li>
                                    <?php foreach ($admin_list as $admin): ?>
                                        
                                    <strong><a href="<?php echo site_url('blog/view/'.$row->id); ?>"><?php if($row->user_id==$admin->id) echo $admin->name; ?></a></strong>
                                    <?php endforeach ?>
                                </li>
                                <li class="fr mr-0"><span><?php echo get_date($row->created,true); ?></span></li>
                              
                            </ul>
                        </div>
                        <h3>
                            <a href="<?php echo site_url('blog/view/'.$row->id); ?>"><?php echo $row->title; ?></a>
                        </h3>
                        <p><?php echo $row->intro; ?></p>
                        <a href="<?php echo site_url('blog/view/'.$row->id); ?>" class="read-more-btn">Xem thêm...</a>
                    </div>
                </div>
            </div>
                
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Blog section end -->

<!-- Partners block start -->
<div class="partners-block">
    <div class="container">
        <h3>Đối tác</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="carousel our-partners slide" id="ourPartners">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="#">
                                    <img src="<?php echo public_url('site/') ?>img/brand/audiojungle.png" alt="audiojungle">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="#">
                                    <img src="<?php echo public_url('site/') ?>img/brand/themeforest.png" alt="themeforest">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="#">
                                    <img src="<?php echo public_url('site/') ?>img/brand/tuts.png" alt="tuts">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="#">
                                    <img src="<?php echo public_url('site/') ?>img/brand/graphicriver.png" alt="graphicriver">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="#">
                                    <img src="<?php echo public_url('site/') ?>img/brand/codecanyon.png" alt="codecanyon">
                                </a>
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#ourPartners" data-slide="prev"><i class="fa fa-chevron-left icon-prev"></i></a>
                    <a class="right carousel-control" href="#ourPartners" data-slide="next"><i class="fa fa-chevron-right icon-next"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Partners block end -->