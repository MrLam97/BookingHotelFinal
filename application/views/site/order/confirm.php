<!-- Booking flow start -->
<div class="booking-flow content-area-10">
    <div class="container">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
      
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" style="width: 100%;">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="" data-original-title="Complete">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-ok"></i>
                                </span>
                            </a>
                            <h3 class="booking-heading">Thông tin phòng vừa thuê</h3>
                        </li>
                    </ul>
                </div>

                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="complete">
                            <div class="booling-details-box booling-details-box-2 mrg-btm-30">
                                <h3 class="booking-heading-2">Thông tin thuê phòng</h3>
                                <div class="row mrg-btm-30">
                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                        <!--  Rooms detail slider start -->
                                        <div class="rooms-detail-slider simple-slider ">
                                            <div id="carousel-custom-3" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-outer">
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        <?php $image_list=json_decode($hotel->image_list); ?>
                                                        <?php foreach ($image_list as $key => $img): ?>
                                                        <div class="item <?php if($key == 0){echo 'active';}else{echo '';} ?>">  
                                                            <img src="<?php echo base_url('upload/hotel_room/'.$img) ?>" class="thumb-preview" alt="Chevrolet Impala">
                                                        </div>
                                                        <?php endforeach ?>
                                                        
                                                    </div>
                                                    <!-- Controls -->
                                                    <a class="left carousel-control" href="#carousel-custom-3" role="button" data-slide="prev">
                                                         <span class="slider-mover-left no-bg" aria-hidden="true">
                                                              <i class="fa fa-angle-left"></i>
                                                         </span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="right carousel-control" href="#carousel-custom-3" role="button" data-slide="next">
                                                         <span class="slider-mover-right no-bg" aria-hidden="true">
                                                              <i class="fa fa-angle-right"></i>
                                                         </span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Rooms detail slider end -->
                                        <p class="hidden-lg hidden-md"><?php echo $hotel->intro; ?></p>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <h4>Mã đơn đạt phòng: #<?php echo $order->id; ?></h4>

                                        <ul>
                                             <li>
                                                <span>Khách sạn:</span> <?php echo $hotel->name; ?>
                                            </li>
                                            <li>
                                                <span>Ngày nhận:</span> <?php echo get_date($order->check_in,false); ?>
                                            </li>
                                            <li>
                                                <span>Ngày trả:</span> <?php echo get_date($order->check_out,false); ?>
                                            </li>
                                            <li>
                                                <span>Số lượng phòng con:</span> <?php echo $room_type->room_qty; ?> phòng
                                            </li>
                                            <li>
                                                <span>Số lượng người:</span> <?php echo $order->people; ?> người
                                            </li>
                                        </ul>

                                        <div class="your-address">
                                            <strong>Địa chỉ của bạn:</strong>
                                            <address>
                                                <strong><?php echo $order->name; ?></strong>
                                                <?php 
                                                $address=$order->address;
                                                foreach ($wards as $ward) {
                                                    if($order->wards==$ward->id)
                                                    {
                                                        $address.=', '.$ward->title;
                                                    }
                                                }
                                                foreach ($provinces as $province) {
                                                    if($order->provinces==$province->id)
                                                    {
                                                        $address.=', '.$province->title;
                                                    }
                                                }
                                                

                                                ?>
                                                <br><br>

                                                <?php echo $address; ?>
                                            </address>
                                        </div>

                                        <div class="price">
                                            Tổng tiền: <?php echo number_format($order->amount)?> VNĐ
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 hidden-sm hidden-xs price">
                                        <p><?php echo $hotel->intro; ?></p>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <ul class="list-inline pull-right">
                                <li><a type="button" class="btn search-button btn-theme next-step" href="<?php echo site_url('') ?>">Trở về trang chủ</a></li>
                            </ul>
                        </div>
                    </div>
            </div>
        </section>
    </div>
</div>
<!-- Booking flow end -->