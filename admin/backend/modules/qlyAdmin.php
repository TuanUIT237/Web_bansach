<div class="col-md-4"><div class="x_panel">
	<div class="x_title">
		<h2>Thông tin quản trị viên</h2>
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
				$sqlsearchid="SELECT * FROM admin ORDER BY id_admin DESC LIMIT 1 OFFSET 0";
				$querysearchid=mysqli_query($con,$sqlsearchid);
				$rowsearchid=mysqli_fetch_array($querysearchid);
				$idadmin=$rowsearchid['id_admin']+1;
                $tenadmin= $_POST["ten_KH"];
                $username= $_POST["email"];
				$matkhau=md5(123456);
				if(isset($_GET["id"]) && isset($_GET["edit"])){
					$sqlUpdate="UPDATE admin SET fullname='$tenadmin'
					WHERE id_admin=".$_GET["id"];
					mysqli_query($con,$sqlUpdate);
					header("location:index.php?page=qlyAdmin");
				}else{
					$sqlInsert= "INSERT INTO nguoidung(id_admin,fullname,username,password) VALUES ('$idadmin','$tenadmin','$username','$matkhau')";
					mysqli_query($con,$sqlInsert);
				}
            }
			//kiểm tra tham số id trên url khi sửa
			$tenadmin="";
			$email="";
			$password="";
			if(isset($_GET["id"]) && isset($_GET["edit"])){
				$sqlEdit= "SELECT* FROM admin WHERE id_admin=".$_GET["id"];
				$resultEdit= mysqli_query($con, $sqlEdit);
				$rowEdit=mysqli_fetch_row($resultEdit);
				// echo "<pre>";
				// print_r($rowEdit);
				$tenKH=$rowEdit[1];
				$email=$rowEdit[2];
				$password=$rowEdit[3];
			}

			//kiểm tra tham số id trên url khi xóa
			if(isset($_GET["id"]) && isset($_GET["delete"])){
				$sqlsel="SELECT * FROM admin WHERE id_admin=".$_GET["id"];
				$query=mysqli_query($con,$sqlsel);
				while($row=mysqli_fetch_array($query)){
					$id=$row['id_admin'];
					$ten=$row['fullname'];
					$email=$row['username'];
					$matkhau=$row['password'];
				}
				$sqlInsert="INSERT INTO trash_admin VALUES('$id','$ten','$email','$matkhau')";
				mysqli_query($con,$sqlInsert);
				$sqlDelete="DELETE FROM admin WHERE id_admin=".$_GET["id"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=qlyAdmin");
			}
        ?>

		<form class="form-label-left input_mask" id="demo-form" method="post">

			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Tên khách hàng</label>
				<div class="col-md-8 col-sm-8 ">
					<input type="text" class="form-control" value="<?php echo $tenadmin; ?>" name="ten_KH" id="ten_KH" placeholder="Nhập tên">
				</div>
			</div>
            
			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Email</label>
				<div class="col-md-8 col-sm-8 ">
					<input type="email" class="form-control" value="<?php echo $email; ?>" name="email" id="email" placeholder="Nhập email">
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
        <h2>Bảng thông tin quản trị viên</h2>
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
                <th>Tên quản trị viên</th>
                <th>Email</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            <?php 
				if(isset($_POST["Search"])){
					$timkiem=$_POST["timkiem"];
					$sqlSearch= "SELECT * FROM admin WHERE id_admin LIKE '%$timkiem%'|| fullname LIKE '%$timkiem%'";
					$resultSearch= mysqli_query($con, $sqlSearch);
					if(mysqli_num_rows($resultSearch)>0){
						while($rowSearch= mysqli_fetch_assoc($resultSearch)){
			?>
							<tr>
								<td><?php echo $rowSearch["id_admin"]?></td>
								<td><?php echo $rowSearch["fullname"]?></td>
								<td>
									<a href="index.php?page=qlyAdmin&id=<?php echo $rowSearch["id_admin"];?>&edit=1">
										<i class="fa fa-pencil-square-o"></i> Sửa</a>
									<a href="index.php?page=qlyAdmin&id=<?php echo $rowSearch["id_admin"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa khách hàng này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
								</td>
							</tr>
				<?php }
					}
				}else{
                //Truy vấn dữ liệu
                $sqlSelect="SELECT * FROM admin";
                //Thực thi
                $result= mysqli_query($con,$sqlSelect);
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                
            ?>
                <tr>
                    <td><?php echo $row["id_admin"]?></td>
                    <td><?php echo $row["fullname"]?></td>
					<td><?php echo $row["username"]?></td>
                    <td>
                        <a href="index.php?page=qlyAdmin&id=<?php echo $row["id_admin"];?>&edit=1">
                            <i class="fa fa-pencil-square-o"></i> Sửa</a>
                        <a href="index.php?page=qlyAdmin&id=<?php echo $row["id_admin"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa khách hàng này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                <?php }}} ?>
            </tbody>
        	</table>
    </div>
</div>
