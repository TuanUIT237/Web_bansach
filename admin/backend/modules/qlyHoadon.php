<?php 
    if(isset($_GET["id"]) && isset($_GET["delete"])){
        $id_hd=$_GET["id"];
        $sqlSelHD_CTHD="SELECT * FROM hoadon hd JOIN cthd ct ON hd.id_hoadon=ct.id_hoadon WHERE hd.id_hoadon='$id_hd'";
        $query=mysqli_query($con,$sqlSelHD_CTHD);
        while($row=mysqli_fetch_array($query)){
            $id_nd=$row['id_nguoidung'];
            $sdt=$row['sdt'];
            $diachi=$row['diachi'];
            $tonghd=$row['tonghd'];
            $ngayhd=$row['ngayhd'];
            $ghichu=$row['ghichu'];
            $tinhtrang=$row['tinhtrang'];
            $trangthai=$row['trangthai'];
            $id_sach=$row['id_sach'];
            $soluong=$row['soluong'];
            $giaohang=$row['giaohang'];
        }
        $sqltrashHD="INSERT INTO trash_hoadon VALUES('$id_hd','$id_nd','$sdt','$diachi','$tonghd','$ngayhd','$ghichu','$tinhtrang','$trangthai')";
        $sqltrashCTHD="INSERT INTO trash_cthd VALUES('$id_hd','$id_sach','$soluong','$giaohang')";
        mysqli_query($con,$sqltrashCTHD);
        mysqli_query($con,$sqltrashHD);
        $sqlDelete="DELETE FROM hoadon WHERE id_hoadon=".$_GET["id"];
        $sqlDelete2="DELETE FROM cthd WHERE id_hoadon=".$_GET["id"];
        mysqli_query($con,$sqlDelete2);
        mysqli_query($con,$sqlDelete);
        header("location:index.php?page=qlyHoadon");
    }
?>
<div class="col-md-12" >
    <div class="x_search">
		<form class="form-label-left" method="post">
			<div class="form-group row">
				<div class="col-md-4 col-sm-4 "></div>
				<div class="col-md-4 col-sm-4 ">
					<input type="text" class="form-control"  name="timkiem" id="timkiem" placeholder="Tìm hóa đơn">
				</div>
				<div class="col-md-4 col-sm-4">
						<button type="submit" class="btn btn-success" name="Search"><i class="fa fa-search"></i></button>
					</div>
			</div>
		</form>
    </div>
</div>
<div class="col-md-12">
    <div class="x_panel" style="height: 600px;overflow: scroll;">
        <div class="x_title" >
        <h2>Bảng hóa đơn</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
        </div>
        <div class="x_content" >
        	<table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>ID khách hàng</th>
                <th>Tên khách hàng</th>
                <th>Địa chỉ</th>
                <th>Tổng hóa đơn</th>
                <th>Ngày hóa đơn</th>
                <th>Trạng thái</th>
                <th>Xử lý</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if(isset($_POST["Search"])){
                    $timkiem=$_POST["timkiem"];
                    $sqlSearch= "SELECT id_hoadon, hd.id_nguoidung,tennguoidung ,hd.diachi, tonghd,ngayhd 
                                    FROM  hoadon hd, nguoidung nd  WHERE hd.id_nguoidung= nd.id_nguoidung AND (id_hoadon LIKE '%$timkiem%')";
                    $resultSearch= mysqli_query($con, $sqlSearch);
                    if(mysqli_num_rows($resultSearch)>0){
                        while($rowSearch= mysqli_fetch_assoc($resultSearch)){
            ?>          
                        <tr>
                            <td><?php echo $rowSearch["id_hoadon"]?></td>
                            <td><?php echo $rowSearch["id_nguoidung"]?></td>
                            <td><?php echo $rowSearch["tennguoidung"]?></td>
                            <td><?php echo $rowSearch["diachi"]?></td>
                            <td><?php echo $rowSearch["tonghd"]?></td>
                            <td><?php echo $rowSearch["ngayhd"]?></td>
                            <td>
                                <a href="index.php?page=qlyHoadon&id=<?php echo $rowSearch["id_hoadon"];?>&edit=1">
                                    <i class="fa fa-pencil-square-o"></i> Sửa</a>
                                <a href="index.php?page=qlyHoadon&id=<?php echo $rowSearch["id_hoadon"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                            </td>
                        </tr>
                <?php }
				    }
                }else{
                    //Truy vấn dữ liệu
                    $sqlSelect="SELECT id_hoadon, hd.id_nguoidung,tennguoidung ,hd.diachi, tonghd,ngayhd,trangthai,tinhtrang 
                                FROM  hoadon hd, nguoidung nd  WHERE hd.id_nguoidung= nd.id_nguoidung";
                    //Thực thi
                    $result= mysqli_query($con,$sqlSelect);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                
            ?> 
                <tr>
                    <td><?php echo $row["id_hoadon"]?></td>
                    <td><?php echo $row["id_nguoidung"]?></td>
                    <td><?php echo $row["tennguoidung"]?></td>
                    <td><?php echo $row["diachi"]?></td>
                    <td><?php echo $row["tonghd"]?></td>
                    <td><?php echo $row["ngayhd"]?></td>
                    <td>
                        <?php if($row['trangthai']==0){echo 'Chưa thanh toán';
                        }else{
                            echo 'Đã thanh toán';
                        }?>
                    </td>
                    </td>
                    <td>
                        <?php if($row['tinhtrang']==0 || $row['tinhtrang']==1){
                        ?>
                            <form action="index.php?page=confirm" method="post" class="form">
                            <input type="hidden" name="id" value="<?php echo $row['id_hoadon']; ?>">
                            <input type="Submit" name="confirm" value="Đã nhận hàng" class="btn btn-primary btn-login-submit btn-block" style="width: 140px; font-size:13px;">
                            </form>
                        <?php
                        }else{
                            echo 'Đã xử lý';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="index.php?page=xemhoadon&id=<?php echo $row["id_hoadon"];?>&view=1">
                            <i class="fa fa-eye"></i> Xem</a>
                        <a href="index.php?page=qlyHoadon&id=<?php echo $row["id_hoadon"];?>&delete=1" 
                            onclick="return confirm('Bạn có muốn xóa hóa đơn này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                <?php }}} ?>
            </tbody>
        	</table>
        </div>
    </div>
</div>
