<div class="content-area rooms-detail-section">
	<div class="container">
		 <div class="row">
		 	<div class="col-lg-8 col-md-8 col-xs-12">
		 		<!-- Heading courses start -->
                <div class="heading-rooms  clearfix sidebar-widget">
                    <div class="pull-left">
                        <h3><?php echo $room_type->name; ?> ( <?php echo $hotel->name; ?> )</h3>
                        <p>
                            <?php 
                            $address=$hotel->address;
                            foreach ($wards as $ward) {
                                if($hotel->wards==$ward->id)
                                {
                                    $address.=', '.$ward->title;
                                }
                            }
                            foreach ($provinces as $province) {
                                if($hotel->provinces==$province->id)
                                {
                                    $address.=', '.$province->title;
                                }
                            }
                            

                            ?>
                            <i class="fa fa-map-marker"></i><?php echo $address; ?>
                        </p>
                    </div>
                    <div class="pull-right">
                        <h3><span><?php echo number_format($hotel->price);?> VNĐ</span></h3>
                         <h5>Mỗi đêm</h5>
                    </div>
                </div>
                <!-- Heading courses end -->

                <!-- sidebar start -->
                <div class="rooms-detail-slider sidebar-widget">
                    <!--  Rooms detail slider start -->
                    <div class="rooms-detail-slider simple-slider mb-40 ">
                        <div id="carousel-custom" class="carousel slide" data-ride="carousel">
                            <div class="carousel-outer">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                        <?php $image_list=json_decode($hotel->image_list); ?>
                                        <?php foreach ($image_list as $key => $img): ?>
                                        <div class="item <?php if($key == 0){echo 'active';}else{echo '';} ?>">
                                            <img src="<?php echo base_url('upload/hotel_room/'.$img) ?>" class="thumb-preview" alt="">
                                        </div>
                                        <?php endforeach; ?>
                                </div>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-custom" role="button" data-slide="prev">
                                    <span class="slider-mover-left t-slider-l" aria-hidden="true">
                                        <i class="fa fa-angle-left"></i>
                                    </span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-custom" role="button" data-slide="next">
                                    <span class="slider-mover-right t-slider-r" aria-hidden="true">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <!-- Indicators -->
                            <ol class="carousel-indicators thumbs visible-lg visible-md">

                                <?php foreach ($image_list as $key => $img): ?>
                                <li data-target="#carousel-custom" data-slide-to="<?php echo $key; ?>" class=""><img src="<?php echo base_url('upload/hotel_room/'.$img) ?>" alt=""></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                    <!-- Rooms detail slider end -->

                    <!-- Search area box 2 start -->
                    <div class="sidebar-widget search-area-box-2 hidden-lg hidden-md clearfix">
                        <div class="text-center">
                           <!--  <h3>Phòng đã chọn</h3>
                            <?php if ($price): ?>
                                <h1><?php echo number_format($price); ?> VNĐ/<?php echo $days; ?> Đêm</h1>
                            <?php else: ?>
                                <h1><?php echo number_format($hotel->price); ?> VNĐ/<?php echo $days; ?> Đêm</h1>
                            <?php endif ?> -->
                        </div>
                        <div class="search-contents">
                            <form method="post" action="<?php echo site_url('order/checkout') ?>">
                                <div class="row">
                                    <div class="search-your-details">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="btn-default datepicker" placeholder="Check In" name="date_from" value="<?php if($date_from){echo get_date($date_from,false);}else{echo '';} ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="btn-default datepicker" placeholder="Check Out" name="date_to" value="<?php if($date_to){echo get_date($date_to,false);}else{echo '';} ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Loại phòng</label>
                                                <input type="text" class="btn " placeholder="Ngày trả phòng" value="<?php echo $room_type->name; ?>" disabled="" style="background: white;width: 100%;" name="room_type">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Gồm</label>
                                                <input type="text" class="btn " placeholder="Ngày trả phòng" value="<?php echo $room_type->qty; ?> người" disabled="" style="background: white;width: 100%;" name="qty">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div type="text" class="form-group">
                                                <label>Số lượng phòng</label>
                                                <input type="text" class="btn " placeholder="Ngày trả phòng" value="<?php echo $room_type->room_qty; ?> phòng" disabled="" style="background: white;width: 100%;" name="room_qty">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Số lượng người</label>
                                                <select class="selectpicker search-fields form-control-2" name="people">
                                                    <option value="0">Chọn số người</option>
                                                    <?php for ($i=1; $i <= 10 ; $i++):?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> người</option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php if ($hotel->status==3): ?>
                                                    <div class="alert alert-<?php if($hotel->status==2){echo 'info';}elseif($hotel->status==3){echo 'warning';}else{echo 'danger';} ?>" role="alert" style="text-align: center;">
                                                        <b style="text-align: center;"><?php if($hotel->status==2){echo 'Chưa thuê';}elseif($hotel->status==3){echo 'Bảo trì';}else{echo 'Đã thuê';} ?></b>
                                                    </div>
                                                <?php else: ?>
                                                    
                                                    <button class="search-button btn-theme">Đặt ngay</button>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Search area box 2 end -->

                    <!-- Rooms description start -->
                    <div class="panel-box course-panel-box course-description">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab" aria-expanded="true">Mô tả</a></li>
                            
                        </ul>
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="tab1default">
                                        <div class="divv">
                                            <!-- Title -->
                                            <h3>Mô tả phòng</h3>
                                            <!-- paragraph -->
                                            <p><?php echo $hotel->description; ?></p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Rooms description end -->
                </div>
                <!-- sidebar end -->

                <!-- Comments section start -->
                <div class="comments-section sidebar-widget">
                    <!-- Main Title 2 -->
                    <div class="main-title-2">
                        <h1><span>Bình luận </span></h1>
                        <div class="fb-comments" data-href="<?php echo current_url()?>" data-numposts="5" data-width="260px"></div>
                    </div>
                </div>
                <!-- Comments section end -->
		 	</div>
		 	<div class="col-lg-4 col-md-4 col-xs-12">
		 		<div class="sidebar">
		 			<!-- Search area box 2 start -->
                    <div class="sidebar-widget search-area-box-2 hidden-sm hidden-xs clearfix bg-grey">
                        <!-- <h3>Phòng đã chọn</h3>
                        <?php if ($price): ?>
                            <h1><?php echo number_format($price); ?> VNĐ/<?php echo $days; ?> Đêm</h1>
                        <?php else: ?>
                            <h1><?php echo number_format($hotel->price); ?> VNĐ/<?php echo $days; ?> Đêm</h1>
                        <?php endif ?> -->
                        <div class="search-contents">
                            <form method="post" action="<?php echo site_url('order/checkout') ?>">
                                <div class="row">
                                    <div class="search-your-details">
                                        <input type="hidden" name="hotel_id" value="<?php echo $hotel->id; ?>">
                                        <input type="hidden" name="price" value="<?php if($price){echo $price;}else{echo $hotel->price;} ?>">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="btn-default datepicker date_from" url="<?php echo site_url('hotel/date_pick'); ?>" placeholder="Ngày nhận phòng" value="<?php if($date_from){echo get_date($date_from,false);}else{echo '';} ?>" name="date_from">

                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="btn-default datepicker date_to" placeholder="Ngày trả phòng" value="<?php if($date_to){echo get_date($date_to,false);}else{echo '';} ?>" name="date_to" url="<?php echo site_url('hotel/date_pick'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Loại phòng</label>
                                                <input type="text" class="btn " placeholder="Ngày trả phòng" value="<?php echo $room_type->name; ?>" disabled="" style="background: white;width: 100%;" name="room_type">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Gồm</label>
                                                <input type="text" class="btn " placeholder="Ngày trả phòng" value="<?php echo $room_type->qty; ?> người" disabled="" style="background: white;width: 100%;" name="qty">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Số lượng người</label>
                                                <select class="selectpicker search-fields form-control-2" name="people">
                                                    <option value="0">Chọn số người</option>
                                                    <?php for ($i=1; $i <= $room_type->qty; $i++):?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> người</option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group mrg-btm-10">
                                                <?php if ($hotel->status==3||$hotel->status==1): ?>
                                                    <div class="alert alert-<?php if($hotel->status==2){echo 'info';}elseif($hotel->status==3){echo 'warning';}else{echo 'danger';} ?>" role="alert" style="text-align: center;">
                                                        <b style="text-align: center;"><?php if($hotel->status==2){echo 'Chưa thuê';}elseif($hotel->status==3){echo 'Bảo trì';}else{echo 'Đã thuê';} ?></b>
                                                    </div>
                                                <?php else: ?>
                                                    
                                                    <button class="search-button btn-theme">Đặt ngay</button>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Search area box 2 end -->

                    <!-- Recent News start -->
                    <div class="sidebar-widget recent-news">
                        <div class="main-title-2">
                            <h1>Bài viết gần đây</h1>
                        </div>
                        <?php foreach ($blog_list as $row): ?>
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object" src="<?php echo base_url('upload/blog/'.$row->image_link); ?>" alt="<?php echo $row->alias ?>">
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="rooms-details.html"><?php echo $row->title; ?></a>
                                </h3>
                                
                                <h5><i class="fa fa-calendar"></i><?php echo get_date($row->created,false); ?></h5>
                            </div>
                        </div>
                        <?php endforeach; ?>     
                    </div>
                    <!-- Recent News end -->

                    <!-- Category posts start -->
                    <div class="sidebar-widget category-posts">
                        <div class="main-title-2">
                            <h1>Loại phòng</h1>
                        </div>
                        <ul class="list-unstyled list-cat">
                            <?php foreach ($type_qty as $row): ?>
                                
                            <li><a href="<?php echo base_url('hotel/room_type/'.$row->id); ?>"><?php echo $row->name; ?> <span>(<?php echo $row->qty; ?>)</span></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <!-- Category posts end -->
		 		</div>
		 	</div>
		 </div>
	</div>
</div>
<?php $this->load->view('site/message', $this->data); ?>