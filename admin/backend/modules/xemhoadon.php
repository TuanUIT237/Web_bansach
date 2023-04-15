<?php
    $id=$_GET['id'];
    $sql= "SELECT hd.id_hoadon, ten_sach, soluong, gia, tonghd, tennguoidung, hd.diachi, ngayhd, email, nd.sdt
            FROM hoadon hd, cthd ct, nguoidung nd, sach s
            where hd.id_hoadon=ct.id_hoadon and hd.id_nguoidung=nd.id_nguoidung and ct.id_sach= s.id_sach and hd.id_hoadon=$id";
   $result= mysqli_query($con, $sql);
   $row= mysqli_fetch_array($result);
?>
<div class="col-md-12" style="font-family: Times New Roman;">
    
    <div class="x_panel">
        <div class="form-group row">
            <div class="col-md-4 col-sm-4 "></div>
            <div class="col-md-4 col-sm-4 ">
                <h4 style="text-align:center; color:black;">CHI TIẾT HÓA ĐƠN</h4>
            </div>
            <div class="col-md-4 col-sm-4">
            </div>
        </div>
            
        <div class="form-group" style="color: black; font-size: 15px">
            <div>
                <label class="col-form-label col-md-2 col-sm-2">Tên khách hàng:</label>    
                <div class="col-form-label" style="font-weight: 550;"><?php echo $row["tennguoidung"]?></div>
            </div>
            <div>
                <label class="col-form-label col-md-2 col-sm-2">Số điện thoại:</label>    
                <div class="col-form-label" style="font-weight: 550;"><?php echo $row["sdt"]?></div>
            </div>
            <div>
                <label class="col-form-label col-md-2 col-sm-2">Email:</label>    
                <div class="col-form-label" style="font-weight: 550;"><?php echo $row["email"]?></div>
            </div>
            <div>
                <label class="col-form-label col-md-2 col-sm-2">Địa chỉ giao hàng:</label>    
                <div class="col-form-label" style="font-weight: 550;"><?php echo $row["diachi"]?></div>
            </div>
            <div>
                <label class="col-form-label col-md-2 col-sm-2">Ngày lập:</label>    
                <div class="col-form-label" style="font-weight: 550;"><?php echo $row["ngayhd"]?></div>
            </div>
        </div>
        <div class="x_title" >
        <div class="clearfix"></div>
        </div>
        <div class="x_content" >
        	<table class="table table-bordered" style="font-size: 14px;">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $i=1;
                $result= mysqli_query($con, $sql);
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $row["ten_sach"]?></td>
                    <td><?php echo $row["soluong"]?></td>
                    <td><?php echo $row["gia"]?></td>
                </tr>

            <?php $i++; }}?>
            </tbody>
        	</table>
        </div>

        <?php  
            $result= mysqli_query($con, $sql);
            $row= mysqli_fetch_array($result);
        ?>
        <div class="form-group row">
            <div class="col-md-4 col-sm-4 "></div>
            <div class="col-md-4 col-sm-4 "></div>
            <div class="col-md-4 col-sm-4">
                <h2 style="text-align: end; color:black">Tổng tiền: <?php echo $row["tonghd"]."đ"?></h2>
            </div>
        </div>
    </div>
    
    <div class="form-group row">
            <div class="col-md-4 col-sm-4 "></div>
            <div class="col-md-4 col-sm-4 "></div>
            <div class="col-md-4 col-sm-4" style="text-align: end; color:white">
                <a class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> In hóa đơn</a>
                <a class="btn btn-danger" href="index.php?page=qlyHoadon" ><i class="fa fa-arrow-left"></i> Quay lại</a>
            </div>
        </div>
    
</div>