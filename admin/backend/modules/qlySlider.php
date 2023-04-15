<div class="col-md-4"><div class="x_panel">
	<div class="x_title">
		<h2>Thêm mới Slider</h2>
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
				$loi="";
				$sqlsearchid="SELECT * FROM slider ORDER BY id_slider DESC LIMIT 1 OFFSET 0";
				$querysearchid=mysqli_query($con,$sqlsearchid);
				$rowsearchid=mysqli_fetch_array($querysearchid);
				$idslider=$rowsearchid['id_slider']+1;
				$tenslider=$_POST['tenslider'];
				//xử lý file ảnh
				$filename="";
				if(isset($_FILES["hinhanh"])){
					if(isset($_FILES["hinhanh"]["name"])){
						if($_FILES["hinhanh"]["type"]=="image/jpeg" || $_FILES["hinhanh"]["type"]=="image/png" || $_FILES["hinhanh"]["type"]=="image/gif"){
							if($_FILES["hinhanh"]["size"]<=240000){
								if($_FILES["hinhanh"]["error"]==0){
									move_uploaded_file($_FILES["hinhanh"]["tmp_name"],"../../image/slider/".$_FILES["hinhanh"]["name"]);
									$filename=$_FILES["hinhanh"]["name"];
								}else{
									$loi="Lỗi file";
									echo "Lỗi file";
								}
							}else{
								$loi="File quá lớn";
								echo "File quá lớn";
							}
						}else{
							$loi="File không là ảnh";
							echo "File không là ảnh";
						}
					}else{
						$loi="Bạn chưa chọn ảnh";
						echo "Bạn chưa chọn ảnh";
					}
				}
				if($loi==""){
					if(isset($_GET["id"]) && isset($_GET["edit"])){
						$sqlUpdate="UPDATE slider SET ten_slider='$tenslider',hinhanh='$filename'
						WHERE id_slider=".$_GET["id"];
						mysqli_query($con,$sqlUpdate);
						header("location:index.php?page=qlySlider");
					}else{
						$_POST["hinhanh"]= $filename;
						$sqlInsert= "INSERT INTO slider(id_slider,ten_slider,hinhanh) VALUES ('$idslider','$tenslider','$filename')";
						mysqli_query($con,$sqlInsert);
					}
				}	
            }
			//kiểm tra tham số id trên url khi sửa
			$tenslider="";
			$filename="";
			if(isset($_GET["id"]) && isset($_GET["edit"])){
				$sqlEdit= "SELECT* FROM slider WHERE id_slider=".$_GET["id"];
				$resultEdit= mysqli_query($con, $sqlEdit);
				$rowEdit=mysqli_fetch_row($resultEdit);
				// echo "<pre>";
				// print_r($rowEdit);
				$tenslider=$rowEdit[1];
				$filename=$rowEdit[2];
			}

			//kiểm tra tham số id trên url khi xóa
			if(isset($_GET["id"]) && isset($_GET["delete"])){
				$sqlSelect="SELECT * FROM slider WHERE id_slider=".$_GET["id"];
				$query=mysqli_query($con,$sqlSelect);
				$row=mysqli_fetch_array($query);
				$id_slider=$row['id_slider'];
				$ten_slider=$row['ten_slider'];
				$hinhanh=$row['hinhanh'];
				$sqlInsert="INSERT INTO trash_slider VALUES('$id_slider','$ten_slider','$hinhanh')";
				mysqli_query($con,$sqlInsert);
				$sqlDelete="DELETE FROM slider WHERE id_slider=".$_GET["id"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=qlySlider");
			}
        ?>

		<form class="form-label-left input_mask" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Ten slider</label>
				<div class="col-md-8 col-sm-8 ">
					<input type="text" class="form-control" value="<?php echo $tenslider?>" name="tenslider" id="tenslider" placeholder="Nhập tên slider">
				</div>
			</div>
            <div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Chọn tệp</label>
				<div class="col-md-8 col-sm-8">
					<input type="file" name="hinhanh" id="hinhanh" >
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
					<input type="text" class="form-control"  name="timkiem" id="timkiem" placeholder="Tìm sản phẩm">
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
        <h2>Bảng thông tin slider</h2>
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
                <th>Hình ảnh</th>
                <th>Tên Sách</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            <?php
			if(isset($_POST["Search"])){
				$timkiem=$_POST["timkiem"];
				$sqlSearch= "SELECT* FROM slider WHERE id_slider LIKE '%$timkiem%'|| ten_slider LIKE '%$timkiem%'";

				$resultSearch= mysqli_query($con, $sqlSearch);
				if(mysqli_num_rows($resultSearch)>0){
					while($rowSearch= mysqli_fetch_assoc($resultSearch)){
					?>
					<tr>
                    <td><?php echo $rowSearch["id_slider"]?></td>
                    <td><img src="../../image/slider/<?php echo $rowSearch["hinhanh"]?>" alt="" style=" width:150px; height:80px;"></td>
                    <td><?php echo $rowSearch["ten_slider"]?></td>
                    <td>
                        <a href="index.php?page=qlySlider&id=<?php echo $rowSearch["id_slider"];?>&edit=1">
                            <i class="fa fa-pencil-square-o"></i> Sửa</a>
                        <a href="index.php?page=qlySlider&id=<?php echo $rowSearch["id_slider"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
				<?php }
				}
			}else{
                //Truy vấn dữ liệu
                $sqlSelect="SELECT * FROM slider";
                //Thực thi
                $result= mysqli_query($con,$sqlSelect);
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                
            ?>
                <tr>
                    <td><?php echo $row["id_slider"]?></td>
                    <td><img src="../../image/slider/<?php echo $row["hinhanh"]?>" alt="" style=" width:150px; height:80px;"></td>
                    <td><?php echo $row["ten_slider"]?></td>
                    <td>
                        <a href="index.php?page=qlySlider&id=<?php echo $row["id_slider"];?>&edit=1">
                            <i class="fa fa-pencil-square-o"></i> Sửa</a>
                        <a href="index.php?page=qlySlider&id=<?php echo $row["id_slider"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                <?php }}} ?>
            </tbody>
        	</table>
        </div>
    </div>
</div>