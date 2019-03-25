<!-- Content bg area start -->
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
                        <h3>Đăng ký thành viên</h3>
                        <!-- Form start-->
                        <form action="<?php echo site_url('user/register') ?>" method="post">
                            <div class="form-group">
                                <input type="text" name="name" class="input-text" placeholder="Họ tên" value="<?php echo set_value('name') ?>">
                                <div style="color: red;float: left;"><?php echo form_error('name'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" class="input-text" placeholder="Điện thoại" value="<?php echo set_value('phone') ?>">
                                <div style="color: red;float: left;"><?php echo form_error('phone'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="input-text" placeholder="Email" value="<?php echo set_value('email') ?>">
                                <div style="color: red;float: left;"><?php echo form_error('email'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="input-text" placeholder="mật khẩu">
                                <div style="color: red;float: left;"><?php echo form_error('password'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirm_Password" class="input-text" placeholder="Nhập lại mật khẩu">
                                <div style="color: red;float: left;"><?php echo form_error('confirm_Password'); ?></div>
                            </div>
                            <div class="mb-0">
                                <button type="submit" class="btn-md btn-theme btn-block">Đăng kí</button>
                            </div>
                        </form>
                        <!-- Form end-->
                    </div>
                    <!-- Footer -->
                    <div class="footer">
                        <span>
                            Đã là thành viên hay chưa? <a href="<?php echo site_url('user/login') ?>">Đăng nhập</a>
                        </span>
                    </div>
                </div>
                <!-- Form content box end -->
            </div>
        </div>
    </div>
</div>
<!-- Content bg area end -->