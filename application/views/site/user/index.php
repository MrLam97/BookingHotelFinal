<div class="form-content-box" style="">
    <!-- logo -->
    <!-- details -->
    <div class="footer">
        <span>
            <h2>Thông tin tài khoản</h2>
        </span>
    </div>
<?php $this->load->view('site/message', $this->data); ?>
    <div class="details">
        
        <!-- Form start -->
        <form action="<?php echo site_url('user/edit') ?>" method="post">
            <div class="form-group">
                <label>Email:</label><br>
                <input type="tex" name="email" disabled="" value="<?php echo $user_info->email; ?>" class="input-text">
            </div>
            <div class="form-group">
                <label>Họ tên:</label><br>
                <input type="tex" name="name"  value="<?php echo $user_info->name; ?>" class="input-text">
            </div>
            
            <div class="form-group">
                <label>Điện thoại:</label><br>
                <input type="tex" name="phone"  value="<?php echo $user_info->phone; ?>" class="input-text">
            </div>
            <input type="hidden" name="id" value="<?php echo $user_info->id; ?>">
            <div class="mb-0">
                <button type="submit" class="btn-md btn-theme btn-block">Cập nhật</button>
            </div>
        </form>
        <!-- Form end -->
    </div>
    <!-- Footer -->
    <div class="footer">
        <span>
            Bạn muốn đổi mật khẩu? <a href="<?php echo site_url('user/change_pwd'); ?>">Đổi mật khẩu</a>
        </span>
    </div>
</div>