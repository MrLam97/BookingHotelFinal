<!-- Booking flow start -->
<div class="booking-flow content-area-10">
    <div class="container">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
  
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" style="width: 100%;" >
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="" data-original-title="Step 2" aria-expanded="true">
                                <span class="round-tab">
                                    <i class="fa fa-user"></i>
                                </span>
                            </a>
                            <h3 class="booking-heading">Thông tin cá nhân</h3>
                        </li>
                    </ul>
                </div>

                <form id="contact_form" action="<?php site_url('order/checkout'); ?>" enctype="multipart/form-data" method="post">
                    <div class="tab-content">

                        <div class="tab-pane active" role="tabpanel" id="step2">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-xs-12 col-md-push-4">
                                    <div class="contact-form sidebar-widget">
                                        <h3 class="booking-heading-2 black-color">Thông tin cá nhân</h3>
                                        <div class="row mb-30">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group firstname">
                                                    <label>Họ tên</label>
                                                    <input type="text" name="name" class="input-text" value="<?php if(isset($user_info)){echo $user_info->name;}else{echo '';} ?>">
                                                    <div style="color: red;float: left;"><?php echo form_error('name'); ?></div>
                                                </div>
                                            </div>   
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group phone">
                                                    <label>Điện thoại</label>
                                                    <input type="text" name="phone" class="input-text" value="<?php if(isset($user_info)){echo $user_info->phone;}else{echo '';} ?>">
                                                    <div style="color: red;float: left;"><?php echo form_error('phone'); ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group email">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="input-text" value="<?php if(isset($user_info)){echo $user_info->email;}else{echo '';} ?>">
                                                    <div style="color: red;float: left;"><?php echo form_error('email'); ?></div>
                                                </div>
                                            </div>                                 
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group CMND">
                                                    <label>CMND</label>
                                                    <input type="text" name="CMND" class="input-text">
                                                    <div style="color: red;float: left;"><?php echo form_error('CMND'); ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group Country">
                                                    <label>Thành phố</label>
                                                    <select class="selectpicker country search-fields " id="param_provinces" name="provinces" url="<?php echo site_url('order/wards') ?>">
                                                        <option value="">Lựa chọn thành phố</option>
                                                        <?php foreach ($list_provinces as $row):?>
                                                            <option value="<?php echo $row->id; ?>" ><?php echo $row->title; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div style="color: red;float: left;"><?php echo form_error('provinces'); ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group Country">
                                                    <label>Quận/Huyện</label>
                                                    <select class="selectpicker country search-fields" name="wards" id='wards'>
                                          
                                                        <option value="">Lựa chọn quận/huyện</option>
                                             
                                                    </select>
                                                    <div style="color: red;float: left;"><?php echo form_error('wards'); ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group address-line-2">
                                                    <label>Số nhà, đường</label>
                                                    <input type="text" name="address" class="input-text">
                                                    <div style="color: red;float: left;"><?php echo form_error('address'); ?></div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group Country">
                                                    <label>Thanh toán</label>
                                                    <select class="selectpicker country search-fields" name="payment">
                                                        <option value="">Chọn phương thức thanh toán</option>
                                                        <option value="dat-50">Đặt cọc 50%</option>
                                                        <option value="offline">Trả khi nhận</option>
                                                    </select>
                                                    <div style="color: red;float: left;"><?php echo form_error('payment'); ?></div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="hotel_id" value="<?php echo $hotel_info->id; ?>">
                                            <input type="hidden" name="room_qty" value="<?php echo $room_type->room_qty; ?>">
                                            <input type="hidden" name="amout" value="<?php echo $hotel_info->price*$days; ?>">
                                            <input type="hidden" name="people" value="<?php echo $people; ?>">
                                            <input type="hidden" name="date_from" value="<?php echo $date_from; ?>">
                                            <input type="hidden" name="date_to" value="<?php echo $date_to; ?>">
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12 col-md-pull-8">
                                    <div class="booling-details-box">
                                        <h3 class="booking-heading-2">Thông tin phòng</h3>

                                        <!--  Rooms detail slider start -->
                                        <div class="rooms-detail-slider simple-slider ">
                                            <div id="carousel-custom" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-outer">
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        <?php $image_list=json_decode($hotel_info->image_list); ?>
                                                        <?php foreach ($image_list as $key => $img): ?>
                                                        <div class="item <?php if($key == 0){echo 'active';}else{echo '';} ?>">  
                                                            <img src="<?php echo base_url('upload/hotel_room/'.$img) ?>" class="thumb-preview" alt="Chevrolet Impala">
                                                        </div>
                                                        <?php endforeach ?>
                    
                                                    </div>
                                                    <!-- Controls -->
                                                    <a class="left carousel-control" href="#carousel-custom" role="button" data-slide="prev">
                                                         <span class="slider-mover-left no-bg" aria-hidden="true">
                                                              <i class="fa fa-angle-left"></i>
                                                         </span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="right carousel-control" href="#carousel-custom" role="button" data-slide="next">
                                                         <span class="slider-mover-right no-bg" aria-hidden="true">
                                                              <i class="fa fa-angle-right"></i>
                                                         </span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Rooms detail slider end -->

                                        <h4><?php echo $room_type->name; ?></h4>

                                        <ul>
                                            <li>
                                                <span>Khách sạn:</span> <?php echo $hotel_info->name; ?>
                                            </li>
                                            <li>
                                                <span>Ngày nhận:</span> <?php echo $date_from; ?>
                                            </li>
                                            <li>
                                                <span>Ngày trả:</span> <?php echo $date_to; ?>
                                            </li>
                                            <li>
                                                <span>Giới hạn:</span> <?php echo $room_type->qty; ?> người/căn phòng
                                            </li>
                                            <li>
                                                <span>Số lượng người:</span> <?php echo $people; ?> người
                                            </li>
                                        </ul>

                                        <div class="price">
                                            Tổng tiền: <?php echo number_format($hotel_info->price*$days); ?> VNĐ
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <ul class="list-inline pull-right">
                                
                                <li><button type="submit" class="btn search-button btn-theme">Tiếp tục</button></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<!-- Booking flow end -->