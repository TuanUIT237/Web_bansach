<div class="col-md-4"><div class="x_panel">
	<div class="x_title">
		<h2>Thêm mới sách</h2>
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
				$sqlsearchid="SELECT * FROM sach ORDER BY id_sach DESC LIMIT 1 OFFSET 0";
				$querysearchid=mysqli_query($con,$sqlsearchid);
				$rowsearchid=mysqli_fetch_array($querysearchid);
				$idsach=$rowsearchid['id_sach']+1;
				$iddanhmuc=$_POST["id_danhmuc"];
                $tensach= $_POST["ten_sach"];
				$sotrangsach= $_POST["sotrang_sach"];
                $tacgia= $_POST["tacgia"];
				$ngayphathanh=$_POST["ngayphathanh"];
                $gia = $_POST["gia"];
                $namxb= $_POST["namxb"];
				$mota= $_POST["mota"];
				//xử lý file ảnh
				$filename="";
				if(isset($_FILES["hinhanh"])){
					if(isset($_FILES["hinhanh"]["name"])){
						if($_FILES["hinhanh"]["type"]=="image/jpeg" || $_FILES["hinhanh"]["type"]=="image/png" || $_FILES["hinhanh"]["type"]=="image/gif"){
							if($_FILES["hinhanh"]["size"]<=240000){
								if($_FILES["hinhanh"]["error"]==0){
									move_uploaded_file($_FILES["hinhanh"]["tmp_name"],"../../image/sach/".$_FILES["hinhanh"]["name"]);
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
						$sqlUpdate="UPDATE sach SET ten_sach='$tensach',sotrang_sach='$sotrangsach', tacgia='$tacgia',ngayphathanh='$ngayphathanh',gia='$gia',mota='$mota',namxb='$namxb',hinhanh='$filename',id_danhmuc='$iddanhmuc'
						WHERE id_sach=".$_GET["id"];
						mysqli_query($con,$sqlUpdate);
						header("location:index.php?page=qlysanpham");
					}else{
						$_POST["hinhanh"]= $filename;
						$sqlInsert= "INSERT INTO sach(id_sach,id_danhmuc,ten_sach,sotrang_sach,tacgia,ngayphathanh,gia,namxb,hinhanh,mota) VALUES ('$idsach','$iddanhmuc','$tensach','$sotrangsach','$tacgia','$ngayphathanh','$gia','$namxb','$filename','$mota')";
						mysqli_query($con,$sqlInsert);
					}
				}	
            }
			//kiểm tra tham số id trên url khi sửa
			$tensach="";
			$tacgia="";
			$gia="";
			$mota="";
			$namxb="";
			$tendanhmuc="";
			$filename="";
			$ngayphathanh="";
			$sotrangsach="";
			if(isset($_GET["id"]) && isset($_GET["edit"])){
				$sqlEdit= "SELECT* FROM sach s, danhmuc d WHERE s.id_danhmuc=d.id_danhmuc and id_sach=".$_GET["id"];
				$resultEdit= mysqli_query($con, $sqlEdit);
				$rowEdit=mysqli_fetch_row($resultEdit);
				// echo "<pre>";
				// print_r($rowEdit);
				$tensach=$rowEdit[2];
				$ngayphathanh=$rowEdit[5];
				$sotrangsach=$rowEdit[3];
				$tacgia=$rowEdit[4];
				$gia=$rowEdit[6];
				$mota=$rowEdit[9];
				$namxb=$rowEdit[7];
				$tendanhmuc= $rowEdit[11];
				$filename=$rowEdit[8];
			}

			//kiểm tra tham số id trên url khi xóa
			if(isset($_GET["id"]) && isset($_GET["delete"])){
				$sqlSelect="SELECT * FROM sach WHERE id_sach=".$_GET["id"];
				$query=mysqli_query($con,$sqlSelect);
				$row=mysqli_fetch_array($query);
				$id_sach=$row['id_sach'];
				$id_danhmuc=$row['id_danhmuc'];
				$tensach=$row['ten_sach'];
				$sotrangsach=$row['sotrang_sach'];
				$tacgia=$row['tacgia'];
				$ngayphathanh=$row['ngayphathanh'];
				$gia=$row['gia'];
				$namxb=$row['namxb'];
				$hinhanh=$row['hinhanh'];
				$mota=$row['mota'];
				$sqlInsert="INSERT INTO trash_sach VALUES('$id_sach','$id_danhmuc','$tensach','$sotrangsach','$tacgia','$ngayphathanh','$gia','$namxb','$hinhanh','$mota')";
				mysqli_query($con,$sqlInsert);
				$sqlDelete="DELETE FROM sach WHERE id_sach=".$_GET["id"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=qlysanpham");
			}
        ?>

		<form class="form-label-left input_mask" method="post" enctype="multipart/form-data">

			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Tên sách</label>
				<div class="col-md-8 col-sm-8 ">
					<input type="text" class="form-control" value="<?php echo $tensach; ?>" name="ten_sach" id="ten_sach" placeholder="Nhập tên">
				</div>
			</div>
            <div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4" >Danh mục</label>
				<div class="col-md-8 col-sm-8 ">
					<?php
						$sqlSelect_dm="SELECT * FROM danhmuc";
						$result_dm=mysqli_query($con, $sqlSelect_dm);
					?>
					<select class="form-control" id="id_danhmuc" name="id_danhmuc">
						<option value=""><?php 
							if((isset($_GET["id"]) && isset($_GET["edit"]))|| isset($_POST["Search"])){
								echo $tendanhmuc;
							}
							else{
								echo "Tên danh mục";
							}
						?></option>
						<?php
							if(mysqli_num_rows($result_dm)>0){
								while($row_dm = mysqli_fetch_assoc($result_dm)){
						?>
							<option value="<?php echo $row_dm["id_danhmuc"] ?>"><?php echo $row_dm["ten_danhmuc"] ?></option>
						<?php }} ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Tác giả</label>
				<div class="col-md-8 col-sm-8 ">
					<input type="text" class="form-control" value="<?php echo $tacgia; ?>" name="tacgia" id="tacgia" placeholder="Nhập tác giả">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Số trang sách</label>
				<div class="col-md-8 col-sm-8 ">
					<input type="text" class="form-control" value="<?php echo $sotrangsach; ?>" name="sotrang_sach" id="sotrang_sach" placeholder="Nhập số trang">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Ngày phát hành
				</label>
				<div class="col-md-8 col-sm-8 ">
					<input class="date-picker form-control" value="<?php echo $ngayphathanh; ?>" name="ngayphathanh" id="ngayphathanh" placeholder="dd-mm-yyyy" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
					<script>
						function timeFunctionLong(input) {
							setTimeout(function() {
							input.type = 'text';
							}, 60000);
						}
					</script>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Giá</label>
				<div class="col-md-8 col-sm-8 ">
					<input type="text" class="form-control" value="<?php echo $gia; ?>" name="gia" id="gia" placeholder="Nhập giá">
				</div>
			</div>
            <div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Mô tả</label>
				<div class="col-md- col-sm-8 ">
					<textarea class="form-control" rows="3" name="mota" id="mota" placeholder="Mô tả sản phẩm" style="resize:none ;"><?php echo $mota; ?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-md-4 col-sm-4 ">Năm xuất bản <span class="required">*</span>
				</label>
				<div class="col-md-8 col-sm-8 ">
					<input class="date-picker form-control" value="<?php echo $namxb; ?>" name="namxb" id="namxb" placeholder="dd-mm-yyyy" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
					<script>
						function timeFunctionLong(input) {
							setTimeout(function() {
							input.type = 'text';
							}, 60000);
						}
					</script>
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
        <h2>Bảng thông tin sách</h2>
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
                <th>Danh mục</th>
                <th>Tác giả</th>
                <th>Giá</th>
                <th>Năm xuất bản</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            <?php
			if(isset($_POST["Search"])){
				$timkiem=$_POST["timkiem"];
				$sqlSearch= "SELECT* FROM sach s, danhmuc d WHERE s.id_danhmuc=d.id_danhmuc 
							and (id_sach LIKE '%$timkiem%'|| ten_sach LIKE '%$timkiem%')";

				$resultSearch= mysqli_query($con, $sqlSearch);
				if(mysqli_num_rows($resultSearch)>0){
					while($rowSearch= mysqli_fetch_assoc($resultSearch)){
					?>
					<tr>
                    <td><?php echo $rowSearch["id_sach"]?></td>
                    <td><img src="../../image/sach/<?php echo $rowSearch["hinhanh"]?>" alt="" style=" width:80px; height:80px;"></td>
                    <td><?php echo $rowSearch["ten_sach"]?></td>
                    <td><?php echo $rowSearch["ten_danhmuc"]?></td>
                    <td><?php echo $rowSearch["tacgia"]?></td>
                    <td><?php echo $rowSearch["gia"]?></td>
                    <td><?php echo $rowSearch["namxb"]?></td>
                    <td>
                        <a href="index.php?page=qlysanpham&id=<?php echo $rowSearch["id_sach"];?>&edit=1">
                            <i class="fa fa-pencil-square-o"></i> Sửa</a>
                        <a href="index.php?page=qlysanpham&id=<?php echo $rowSearch["id_sach"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
				<?php }
				}
			}else{
                //Truy vấn dữ liệu
                $sqlSelect="SELECT * FROM sach s, danhmuc dm WHERE s.id_danhmuc= dm.id_danhmuc ORDER BY id_sach ASC";
                //Thực thi
                $result= mysqli_query($con,$sqlSelect);
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                
            ?>
                <tr>
                    <td><?php echo $row["id_sach"]?></td>
                    <td><img src="../../image/sach/<?php echo $row["hinhanh"]?>" alt="" style=" width:80px; height:80px;"></td>
                    <td><?php echo $row["ten_sach"]?></td>
                    <td><?php echo $row["ten_danhmuc"]?></td>
                    <td><?php echo $row["tacgia"]?></td>
                    <td><?php echo $row["gia"]?></td>
                    <td><?php echo $row["namxb"]?></td>
                    <td>
                        <a href="index.php?page=qlysanpham&id=<?php echo $row["id_sach"];?>&edit=1">
                            <i class="fa fa-pencil-square-o"></i> Sửa</a>
                        <a href="index.php?page=qlysanpham&id=<?php echo $row["id_sach"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                <?php }}} ?>
            </tbody>
        	</table>
        </div>
    </div>
</div>