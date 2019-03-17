<div class="form-content-box" style="">
    <!-- logo -->
    <!-- details -->
    <div class="footer">
        <span>
            <h2>Mật khẩu</h2>
        </span>
    </div>

    <!-- Form start -->
    <form action="<?php echo site_url('user/change_pwd') ?>" method="post">
        <div class="details">
            <div class="form-group">
                <label>Mật khẩu cũ:</label><br>
                <input type="password" name="password"  value="" class="input-text">
                <div style="color: red;float: left;"><?php echo form_error('password'); ?></div>
            </div>
            <div class="form-group">
                <label>Mật khẩu mới:</label><br>
                <input type="password" name="password_new"  value="" class="input-text">
                <div style="color: red;float: left;"><?php echo form_error('password_new'); ?></div>
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu mới:</label><br>
                <input type="password" name="re_password"  value="" class="input-text">
                <div style="color: red;float: left;"><?php echo form_error('re_password'); ?></div>
            </div>
            <input type="hidden" name="id" value="<?php echo $user_info->id; ?>">
            <div style="color: red;float: left;"><?php echo form_error('chk_pwd'); ?></div>
        </div>
        <div class="footer">
            <div class="mb-0">
                <button type="submit" class="btn-md btn-theme btn-block">Đổi mật khẩu</button>
            </div>
        </div>
    </form>
    <!-- Form end -->
    <!-- Footer -->

    

</div>