<div class="col-md-4"><div class="x_panel">
	<div class="x_title">
		<h2>Thông tin khách hàng</h2>
		<ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			</li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br>
        <?php
            if(isset($_POST["addNew"])){
				$sqlsearchid="SELECT * FROM nguoidung ORDER BY id_nguoidung DESC LIMIT 1 OFFSET 0";
				$querysearchid=mysqli_query($con,$sqlsearchid);
				$rowsearchid=mysqli_fetch_array($querysearchid);
				$idkh=$rowsearchid['id_nguoidung']+1;
                $tenKH= $_POST["ten_KH"];
                $diachi= $_POST["diachi"];
                $gioitinh= $_POST["gioitinh"];
                $sdt = $_POST["sdt"];
                $email= $_POST["email"];
                $namsinh=$_POST["namsinh"];
				$matkhau=md5(123456);
				if(isset($_GET["id"]) && isset($_GET["edit"])){
					$sqlUpdate="UPDATE nguoidung SET tennguoidung='$tenKH', diachi='$diachi',gioitinh='$gioitinh',sdt='$sdt',email='$email', namsinh='$namsinh'
					WHERE id_nguoidung=".$_GET["id"];
					mysqli_query($con,$sqlUpdate);
					header("location:index.php?page=qlyKhachhang");
				}else{
					$sqlInsert= "INSERT INTO nguoidung(id_nguoidung,tennguoidung,gioitinh,sdt,diachi,email,matkhau,namsinh) VALUES ('$idkh','$tenKH','$gioitinh','$sdt','$diachi','$email','$matkhau','$namsinh')";
					mysqli_query($con,$sqlInsert);
				}
            }
			//kiểm tra tham số id trên url khi sửa
			$tenKH="";
			$diachi="";
			$gioitinh="";
			$sdt="";
			$email="";
			$password="";
			$namsinh="";
			if(isset($_GET["id"]) && isset($_GET["edit"])){
				$sqlEdit= "SELECT* FROM nguoidung WHERE id_nguoidung=".$_GET["id"];
				$resultEdit= mysqli_query($con, $sqlEdit);
				$rowEdit=mysqli_fetch_row($resultEdit);
				// echo "<pre>";
				// print_r($rowEdit);
				$tenKH=$rowEdit[1];
				$diachi=$rowEdit[4];
				$gioitinh=$rowEdit[2];
				$sdt=$rowEdit[3];
				$email=$rowEdit[5];
				$password=$rowEdit[6];
				$namsinh= $rowEdit[7];
			}

			//kiểm tra tham số id trên url khi xóa
			if(isset($_GET["id"]) && isset($_GET["delete"])){
				$sqlsel="SELECT * FROM nguoidung WHERE id_nguoidung=".$_GET["id"];
				$query=mysqli_query($con,$sqlsel);
				while($row=mysqli_fetch_array($query)){
					$id=$row['id_nguoidung'];
					$ten=$row['tennguoidung'];
					$gioitinh=$row['gioitinh'];
					$sdt=$row['sdt'];
					$diachi=$row['diachi'];
					$email=$row['email'];
					$matkhau=$row['matkhau'];
					$namsinh=$row['namsinh'];
				}
				$sqlInsert="INSERT INTO trash_nguoidung VALUES('$id','$ten','$gioitinh','$sdt','$diachi','$email','$matkhau','$namsinh')";
				mysqli_query($con,$sqlInsert);
				$sqlSelCTHD="SELECT * FROM hoadon WHERE id_nguoidung='$id'";
				$query=mysqli_query($con,$sqlSelCTHD);
				while($rows=mysqli_fetch_array($query)){
					$id_hd=$rows['id_hoadon'];
					$sqlSelHD_CTHD="SELECT * FROM hoadon hd JOIN cthd ct ON hd.id_hoadon=ct.id_hoadon WHERE hd.id_hoadon='$id_hd'";
					$query1=mysqli_query($con,$sqlSelHD_CTHD);
					while($row1=mysqli_fetch_array($query1)){
						$id_nd=$row1['id_nguoidung'];
						$sdt=$row1['sdt'];
						$diachi=$row1['diachi'];
						$tonghd=$row1['tonghd'];
						$ngayhd=$row1['ngayhd'];
						$ghichu=$row1['ghichu'];
						$tinhtrang=$row1['tinhtrang'];
						$trangthai=$row1['trangthai'];
						$id_sach=$row1['id_sach'];
						$soluong=$row1['soluong'];
						$giaohang=$row1['giaohang'];
					}
					$sqltrashHD="INSERT INTO trash_hoadon VALUES('$id_hd','$id_nd','$sdt','$diachi','$tonghd','$ngayhd','$ghichu','$tinhtrang','$trangthai')";
					$sqltrashCTHD="INSERT INTO trash_cthd VALUES('$id_hd','$id_sach','$soluong','$giaohang')";
					mysqli_query($con,$sqltrashCTHD);
					mysqli_query($con,$sqltrashHD);
					$sqlHD="DELETE FROM hoadon WHERE id_hoadon='$id_hd'";
					$sqlCTHD="DELETE FROM cthd WHERE id_hoadon='$id_hd'";
					mysqli_query($con,$sqlCTHD);
					mysqli_query($con,$sqlHD);
				}
				$sqlDelete="DELETE FROM nguoidung WHERE id_nguoidung=".$_GET["id"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=qlyKhachhang");
			}
        ?>

		<form class="form-label-left input_mask" id="demo-form" method="post">

			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Tên khách hàng</label>
				<div class="col-md-8 col-sm-8 ">
					<input type="text" class="form-control" value="<?php echo $tenKH; ?>" name="ten_KH" id="ten_KH" placeholder="Nhập tên">
				</div>
			</div>
            
			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Email</label>
				<div class="col-md-8 col-sm-8 ">
					<input type="email" class="form-control" value="<?php echo $email; ?>" name="email" id="email" placeholder="Nhập email">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Số điện thoại</label>
				<div class="col-md-8 col-sm-8 ">
					<input type="text" class="form-control" value="<?php echo $sdt; ?>" name="sdt" id="sdt" placeholder="Nhập số điện thoại">
				</div>
			</div>
            <div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4" >Giới tính</label>
                <div class="col-md-8 col-sm-8 " style="margin-top: 8px;">
                <input type="radio" id="gioitinh" name="gioitinh" value="Nam" style="margin-right:4px;" checked>Nam
                <input type="radio" id="gioitinh" name="gioitinh" value="Nữ" style="margin-left: 4px; margin-right:4px">Nữ
                </div>
			</div>
            <div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Địa chỉ</label>
				<div class="col-md- col-sm-8 ">
					<textarea class="form-control" rows="3" name="diachi" id="diachi" placeholder="Địa chỉ" style="resize:none ;"><?php echo $diachi; ?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Năm sinh <span class="required">*</span>
				</label>
				<div class="col-md-8 col-sm-8 ">
					<input class="date-picker form-control" value="<?php echo $namsinh; ?>" name="namsinh" id="namsinh" placeholder="dd-mm-yyyy" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
					<script>
						function timeFunctionLong(input) {
							setTimeout(function() {
							input.type = 'text';
							}, 60000);
						}
					</script>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group row">
				<div class="col-md-9 col-sm-9  offset-md-3">
					<button class="btn btn-primary" type="reset" name="reset">Làm mới</button>
					<button type="submit" class="btn btn-success" name="addNew">Xác nhận</button>
				</div>
			</div>
            
		</form>
	</div>
	</div>
	<div class="x_search">
		<form class="form-label-left input_mask" method="post">
			<div class="form-group row">
				<label class="col-form-label col-md-3 col-sm-3 ">Tìm kiếm:</label>
				<div class="col-md-6 col-sm-6 ">
					<input type="text" class="form-control"  name="timkiem" id="timkiem" placeholder="Tìm khách hàng">
				</div>
				<div class="col-md-3 col-sm-3">
						<button type="submit" class="btn btn-warning" name="Search"><i class="fa fa-search"></i></button>
					</div>
			</div>
		</form>
    </div>
</div>
<div class="col-md-8">
    <div class="x_panel" style="height: 660px;overflow: scroll;">
        <div class="x_title" >
        <h2>Bảng thông tin khách hàng</h2>
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
                <th>Tên khách hàng</th>
                <th>Giới tính</th>
                <th>Năm sinh</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            <?php 
				if(isset($_POST["Search"])){
					$timkiem=$_POST["timkiem"];
					$sqlSearch= "SELECT * FROM nguoidung WHERE id_nguoidung LIKE '%$timkiem%'|| tennguoidung LIKE '%$timkiem%'";
					$resultSearch= mysqli_query($con, $sqlSearch);
					if(mysqli_num_rows($resultSearch)>0){
						while($rowSearch= mysqli_fetch_assoc($resultSearch)){
			?>
							<tr>
								<td><?php echo $rowSearch["id_nguoidung"]?></td>
								<td><?php echo $rowSearch["tennguoidung"]?></td>
								<td><?php echo $rowSearch["gioitinh"]?></td>
								<td><?php echo $rowSearch["namsinh"]?></td>
								<td><?php echo $rowSearch["email"]?></td>
								<td><?php echo $rowSearch["sdt"]?></td>
								<td><?php echo $rowSearch["diachi"]?></td>
								<td>
									<a href="index.php?page=qlyKhachhang&id=<?php echo $rowSearch["id_nguoidung"];?>&edit=1">
										<i class="fa fa-pencil-square-o"></i> Sửa</a>
									<a href="index.php?page=qlyKhachhang&id=<?php echo $rowSearch["id_nguoidung"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa khách hàng này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
								</td>
							</tr>
				<?php }
					}
				}else{
                //Truy vấn dữ liệu
                $sqlSelect="SELECT * FROM nguoidung";
                //Thực thi
                $result= mysqli_query($con,$sqlSelect);
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                
            ?>
                <tr>
                    <td><?php echo $row["id_nguoidung"]?></td>
                    <td><?php echo $row["tennguoidung"]?></td>
                    <td><?php echo $row["gioitinh"]?></td>
                    <td><?php echo $row["namsinh"]?></td>
                    <td><?php echo $row["email"]?></td>
                    <td><?php echo $row["sdt"]?></td>
                    <td><?php echo $row["diachi"]?></td>
                    <td>
                        <a href="index.php?page=qlyKhachhang&id=<?php echo $row["id_nguoidung"];?>&edit=1">
                            <i class="fa fa-pencil-square-o"></i> Sửa</a>
                        <a href="index.php?page=qlyKhachhang&id=<?php echo $row["id_nguoidung"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa khách hàng này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                <?php }}} ?>
            </tbody>
        	</table>
    </div>
</div>
