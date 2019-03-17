<!-- Gallery secion start -->
<div class="gallery clearfix content-area">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Khách sạn</h1>
            <p>Tìm kiếm theo khách sạn.</p>
        </div>

        <div class="row">
            <div class="filtr-container">
                <?php foreach ($hotel_list as $row): ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="">
                    <figure class="portofolio-thumb">
                        <a href="<?php echo site_url('hotel/list_view/').to_slug($row->name); ?>"> <img src="<?php echo public_url('site/img/popular-places/khachsan.jpg'); ?>" alt="img-21" class="img-responsive" style="max-height: 170px;opacity: 0.5;">
                        </a>
                        <a href="<?php echo site_url('hotel/list_view/').to_slug($row->name);; ?>">
                        <figcaption>
                                <h3 class="" style="color: white;font-size: x-large;font-weight: bold;"><?php echo $row->name; ?></h3>
                                <h3 class="" style="color: white;font-size: small;font-weight: bold;">Tổng số: <?php echo $row->total; ?> phòng</h3>
                        </figcaption>
                        </a>
                    </figure>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


