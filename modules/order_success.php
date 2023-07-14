<div class="bookdetailwrap">
    <div class="img_order" style="text-align: center;"><img src="./image/check.png" alt="" ></div>
    <h1 style="text-align: center; margin-top:10px; margin-bottom:10px;">Đặt hàng thành công</h1>
    <p style="margin:0 auto; text-align:center; width:460px; font-size:14px;" class="p_order">Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ giao hàng nhanh nhất cho bạn. Cảm ơn bạn đã tin tưởng và mua hàng tại 4T Store</p>
    <div class="content" style="display: inline-block;">
        <div class="order_content">
            <h2 style="margin-left:20px; margin-top:20px;">Thông tin đơn hàng</h2>
            <ul style="margin:10px; float:left; font-size:14px; width:534px;">
                <?php
                    include './function.php';
                    if(isset($_GET['id'])&&($_GET['id'])){
                        $sql="SELECT * FROM hoadon WHERE id_hoadon={$_GET['id']}";
                        $query=mysqli_query($con,$sql);
                        while($row=mysqli_fetch_array($query)){
                ?>
                <li style="margin:10px;">Số đơn hàng: <p style="float:right; font-weight:bold;"><?php echo $row['id_hoadon'];?></p></li>
                <li style="margin:10px;">Ngày đặt hàng: <p style="float:right; font-weight:bold;"><?php echo $row['ngayhd'];?></p></li>
                <li style="margin:10px;">Phương thức thanh toán: <p style="float:right; font-weight:bold;">
                <?php 
                    echo $row['thanhtoan'];
                ?></p></li>
                <li style="margin:10px;">Tổng cộng: <p style="float:right; font-weight:bold; color:red;"><?php echo currency_format($row['tonghd']);?></p></li>
                <li style="margin:10px;">Ghi chú: <p style="float:right; font-weight:bold;"><?php echo $row['ghichu'];?></p></li>
                <?php
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="order_payment">
            <div style="padding: 20px 20px 0px 20px;">
                <h2 style="padding: 5px; ">Chuyển khoản qua ATM</h2>
                <p style="padding: 5px; ">Nếu bạn đã chọn hình thức thanh toán qua ATM</p>
                <p style="padding: 5px; ">Để hoàn tất đặt hàng, vui lòng chuyển khoản số tiền trong thông tin đơn hàng tới một torng những tài khoản dưới đây:</p>
                <p style="padding: 5px; font-style:italic;">Lưu ý: Nội dung chuyển khoản ghi theo cú pháp.</p>
                <h2 style="padding: 5px; color:red;">Tên khách hàng - Tên sách - Số điện thoại liên hệ</h2>
                <p style="padding: 5px; font-style:italic;">Ví dụ: A - ABC - 09xx.xxx.xxx</p>
            </div>
            <div style="padding: 8px 20px 20px 20px;">
                <h2 style="padding: 10px;">Ngân hàng Đầu tư và Phát triển Việt Nam - BIDV</h2>
                <ul>
                    <li><p style="padding: 7px; font-size:13px">Chủ tài khoản: Trường Đại Học Công Nghệ Thông Tin</p></li>
                    <li><p style="padding: 7px; font-size:13px">Số tài khoản: 314.100.01210304</p></li>
                    <li><p style="padding: 7px; font-size:13px">Chi nhánh: Đông Sài gòn</p></li>
                </ul>
            </div>
        </div>
        <br>
        <div class="order_content" >
            <h2 style="margin-left:20px; margin-top:20px; ">Thông tin người nhận hàng</h2>
            <ul style="margin:10px; float:left; font-size:14px; width:534px;">
            <?php
                if(isset($_GET['id'])&&($_GET['id'])){
                    $sql1="SELECT hd.sdt,tennguoidung,hd.diachi,email FROM hoadon hd JOIN nguoidung nd ON nd.id_nguoidung=hd.id_nguoidung WHERE hd.id_hoadon={$_GET['id']}";
                    $query1=mysqli_query($con,$sql1);
                    while($row1=mysqli_fetch_array($query1)){
            ?>
                <li style="margin:10px;">Họ tên: <p style="float:right; font-weight:bold;"><?php echo $row1['tennguoidung'];?></p></li>
                <li style="margin:10px;">Điện thoại: <p style="float:right; font-weight:bold;"><?php echo $row1['sdt'];?></p></li>
                <li style="margin:10px;">Email: <p style="float:right; font-weight:bold;"><?php echo $row1['email'];?></p></li>
                <li style="margin:10px;">Địa chỉ: <p style="float:right; font-weight:bold;"><?php echo $row1['diachi'];?></p></li>
            <?php
                    }
                }
            ?>
            </ul>
        </div>
        <div class="order_payment1" style="display:none">
            <div style="padding: 20px 20px 0px 20px;">
                <h2 style="padding: 5px; ">Chuyển khoản qua ATM</h2>
                <p style="padding: 5px; ">Nếu bạn đã chọn hình thức thanh toán qua ATM</p>
                <p style="padding: 5px; ">Để hoàn tất đặt hàng, vui lòng chuyển khoản số tiền trong thông tin đơn hàng tới một torng những tài khoản dưới đây:</p>
                <p style="padding: 5px; font-style:italic;">Lưu ý: Nội dung chuyển khoản ghi theo cú pháp.</p>
                <h2 style="padding: 5px; color:red;">Tên khách hàng - Tên sách - Số điện thoại liên hệ</h2>
                <p style="padding: 5px; font-style:italic;">Ví dụ: A - ABC - 09xx.xxx.xxx</p>
            </div>
            <div style="padding: 8px 20px 20px 20px;">
                <h2 style="padding: 10px;">Ngân hàng Đầu tư và Phát triển Việt Nam - BIDV</h2>
                <ul>
                    <li><p style="padding: 7px; font-size:13px">Chủ tài khoản: Trường Đại Học Công Nghệ Thông Tin</p></li>
                    <li><p style="padding: 7px; font-size:13px">Số tài khoản: 314.100.01210304</p></li>
                    <li><p style="padding: 7px; font-size:13px">Chi nhánh: Đông Sài gòn</p></li>
                </ul>
            </div>
        </div>
    </div>
</div>