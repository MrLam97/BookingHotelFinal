<!-- Blog body start -->
<div class="blog-body content-area">
    <div class="container">
        <div class="row">
            <div class="">
                <div class="blog-1 mb-50">
                    <div class="blog-photo">
                        <img src="<?php echo base_url('upload/blog/'.$blog->image_link); ?>" alt="<?php echo $blog->alias; ?>" class="img-responsive">
                    </div>
                    <div class="detail">
                        <div class="post-meta clearfix">
                            <ul>
                                <li>
                                     <?php foreach ($admin_list as $admin): ?>
                                        
                                    <strong><a href="<?php echo site_url('blog/view/'.$blog->id); ?>"><?php if($blog->user_id==$admin->id) echo $admin->name; ?></a></strong>
                                    <?php endforeach ?>
                                </li>
                                <li class="fr mr-0"><span><?php echo get_date($blog->created,false); ?></span></li>

                            </ul>
                        </div>
                        <h3>
                            <a href="#"><?php echo $blog->title; ?></a>
                        </h3>
                        <p><?php echo $blog->intro; ?></p>
                        <p><?php echo $blog->content; ?></p>
                        <br>
                    </div>
                </div>

                <!-- Comments section start -->
                <div class="comments-section">
                    <!-- Main Title 2 -->
                    <div class="fb-comments" data-href="<?php echo current_url()?>" data-numposts="5" data-width="260px"></div>
                </div>
                <!-- Comments section end -->

                <!-- Contact 1 start -->
                <!-- Contact-1 end -->
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="sidebar">
                    <!-- Search box start -->

                    <!-- Search box end -->

                    <!-- Recent nesw start -->

                    <!-- Recent nesw end -->

                    <!-- Category posts start -->

                    <!-- Category posts end -->

                    <!-- Archives start -->
                    
                    <!-- Archives end -->

                    <!-- tags box start -->
                    
                    <!-- tags box end -->

                    <!-- Social media start -->
                    
                    <!-- Social media end -->

                    <!-- Recent comments start -->
                    
                    <!-- Recent comments end -->

                    <!-- Latest tweet start -->
                    
                    <!-- Latest tweet end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog body end -->

<div class="blog-section content-area-11">
    <div class="container">
        <!-- Main title -->

        <div class="row">
            <?php foreach ($blog_list as $row): ?>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog-1">
                    <div class="blog-photo">
                        <a href="<?php echo site_url('blog/view/'.$blog->id); ?>">
                            
                        <img src="<?php echo base_url('upload/blog/'.$row->image_link); ?>" alt="<?php echo $row->alias; ?>" class="img-responsive">
                        </a>
                    </div>
                    <div class="detail">
                        <div class="post-meta clearfix">
                            <ul>
                                <li>
                                     <?php foreach ($admin_list as $admin): ?>
                                        
                                    <strong><a href="<?php echo site_url('blog/view/'.$blog->id); ?>"><?php if($blog->user_id==$admin->id) echo $admin->name; ?></a></strong>
                                    <?php endforeach ?>
                                </li>
                                <li class="fr mr-0"><span><?php echo get_date($row->created,true); ?></span></li>
                              
                            </ul>
                        </div>
                        <h3>
                            <a href="<?php echo site_url('blog/view/'.$blog->id); ?>"><?php echo $row->title; ?></a>
                        </h3>
                        <p><?php echo $row->intro; ?></p>
                        <a href="<?php echo site_url('blog/view/'.$blog->id); ?>" class="read-more-btn">Xem thêm...</a>
                    </div>
                </div>
            </div>
                
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Partners block start -->
<div class="partners-block">
    <div class="container">
        <h3>Our Partners</h3>
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