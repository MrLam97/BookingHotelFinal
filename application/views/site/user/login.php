<!-- Content area start -->
<div class="contact-bg overview-bgi">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form content box start -->
                <div class="form-content-box">
                    <!-- logo -->
                    <a href="index.html" class="clearfix alpha-logo">
                        <img src="<?php echo public_url('site')?>/img/logos/white-logo.png" alt="white-logo">
                    </a>
                    <!-- details -->
                    <div class="details">
                        <h3>Đăng nhập</h3>
                        <!-- Form start -->
                        <form action="<?php echo site_url('user/login') ?>" method="post">

                            <div class="form-group">
                                <input type="email" name="email" class="input-text" placeholder="Email đăng nhập" value="<?php echo set_value('email') ?>">
                                <div style="color: red;float: left;"><?php echo form_error('email'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="input-text" placeholder="Mật khẩu">
                                <div style="color: red;float: left;"><?php echo form_error('password'); ?></div>
                            </div>
                            <div class="checkbox">
                                <div class="ez-checkbox pull-left">
                                    <label>
                                        <input type="checkbox" class="ez-hide">
                                        Nhớ tài khoản.
                                    </label>
                                </div>
                                <a href="forgot_password" class="link-not-important pull-right">Quên mật khẩu?</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="mb-0">
                                <div style="color: red;float: left;"><?php echo form_error('login'); ?></div>
                                <button type="submit" class="btn-md btn-theme btn-block">Đăng nhập</button>
                            </div>
                        </form>
                        <!-- Form end -->
                    </div>
                    <!-- Footer -->
                    <div class="footer">
                        <span>
                            Chưa có tài khoản? <a href="register">Đăng ký ngay!!</a>
                        </span>
                    </div>
                </div>
                <!-- Form content box end -->
            </div>
        </div>
    </div>
</div>
<!-- Content area end -->