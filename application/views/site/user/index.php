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
<div class="row" style="text-align: center;">
    <div class="col col-md-2"></div>
    <div class="col col-md-8">
        <h3 style="font-weight: bold;">
            Lịch sử đặt phòng
        </h3>
        <hr />
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td style="font-weight: bold;text-align: center; font-size: 23px; color: #3ac4fa;">
                            Khách sạn
                        </td>
                         <td style="font-weight: bold;text-align: center; font-size: 23px; color: #3ac4fa;">
                            Ngày nhận phòng
                        </td>
                         <td style="font-weight: bold;text-align: center; font-size: 23px; color: #3ac4fa;">
                            Ngày trả phòng
                        </td>
                         <td style="font-weight: bold;text-align: center; font-size: 23px; color: #3ac4fa;">
                            Tổng tiền
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $row): ?>
                        <tr>
                             <td style="text-align: center;">
                                <?php foreach ($hotel as $row1) 
                                {
                                    if($row1->id==$row->hotel_id)
                                    {
                                        echo $row1->name;
                                        break;
                                    }
                                } ?>
                            </td>
                            <td style="text-align: center;">
                                 <?php echo get_date($row->check_in,false); ?>
                            </td>
                            <td style="text-align: center;">
                                 <?php echo get_date($row->check_out,false); ?>
                            </td>
                            <td style="text-align: center;">
                                 <?php echo number_format($row->amount); ?> VNĐ
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
    </div>
</div>