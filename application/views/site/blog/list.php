<!-- Blog body start -->
<div class="blog-body blog-creative content-area">
    <div class="container">
        <div class="row">
            <?php foreach ($list as $row): ?>
                
            
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
                                <li class="fr mr-0"><span><?php echo get_date($row->created,false); ?></span></li>
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
            <?php endforeach ?>
        </div>
        <div class="text-center">
            <!-- Page navigation start -->
            <nav aria-label="Page navigation">
                <?php echo $this->pagination->create_links(); ?>
            </nav>
            <!-- Page navigation end -->
        </div>
    </div>
</div>
<!-- Blog body end -->