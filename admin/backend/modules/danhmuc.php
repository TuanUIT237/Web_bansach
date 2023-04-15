<div class="col-md-4">
    <div class="x_panel">
        <div class="x_title">
            <h2>Thêm mới danh mục</h2>
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
                    $tendanhmuc= $_POST["ten_danhmuc"];
                    if(isset($_GET["id"]) && isset($_GET["edit"])){
                        $sqlUpdate="UPDATE danhmuc SET ten_danhmuc='$tendanhmuc'
                        WHERE id_danhmuc=".$_GET["id"];
                        mysqli_query($con,$sqlUpdate);
                        header("location:index.php?page=danhmuc");
                    }else{
                        $sqlsearchid="SELECT * FROM danhmuc ORDER BY id_danhmuc DESC LIMIT 1 OFFSET 0";
				        $querysearchid=mysqli_query($con,$sqlsearchid);
				        $rowsearchid=mysqli_fetch_array($querysearchid);
				        $iddm=$rowsearchid['id_danhmuc']+1;
                        $sqlInsert= "INSERT INTO danhmuc(id_danhmuc,ten_danhmuc,id_parent) VALUES ('$iddm','$tendanhmuc','0')";
					    mysqli_query($con,$sqlInsert);
                    }
                }
                //kiểm tra tham số id trên url khi sửa
                $tendanhmuc="";
                if(isset($_GET["id"]) && isset($_GET["edit"])){
                    $sqlEdit= "SELECT* FROM danhmuc  WHERE id_danhmuc=".$_GET["id"];
                    $resultEdit= mysqli_query($con, $sqlEdit);
                    $rowEdit=mysqli_fetch_row($resultEdit);
                    // echo "<pre>";
                    // print_r($rowEdit);
                    $tendanhmuc=$rowEdit[1];
                }

                //kiểm tra tham số id trên url khi xóa
                if(isset($_GET["id"]) && isset($_GET["delete"])){
                    $sqlSelectSach="SELECT * FROM sach WHERE id_danhmuc=".$_GET["id"];
                    $query1=mysqli_query($con,$sqlSelectSach);
                    while($row1=mysqli_fetch_array($query1)){
                        $id_sach=$row1['id_sach'];
                        $id_danhmuc=$row1['id_danhmuc'];
                        $tensach=$row1['ten_sach'];
                        $sotrangsach=$row1['sotrang_sach'];
                        $tacgia=$row1['tacgia'];
                        $ngayphathanh=$row1['ngayphathanh'];
                        $gia=$row1['gia'];
                        $namxb=$row1['namxb'];
                        $hinhanh=$row1['hinhanh'];
                        $mota=$row1['mota'];
                        $sqlInsertSach="INSERT INTO trash_sach VALUES('$id_sach','$id_danhmuc','$tensach','$sotrangsach','$tacgia','$ngayphathanh','$gia','$namxb','$hinhanh','$mota')";
                        mysqli_query($con,$sqlInsertSach);
                        $sqlDeleteSach="DELETE FROM sach WHERE id_sach='$id_sach'";
				        mysqli_query($con,$sqlDeleteSach);
                    }
                    $sqlSelect="SELECT * FROM danhmuc WHERE id_danhmuc=".$_GET["id"];
                    $query=mysqli_query($con,$sqlSelect);
                    $row=mysqli_fetch_array($query);
                    $id=$row['id_danhmuc'];
                    $tendanhmuc=$row['ten_danhmuc'];
                    $id_parent=$row['id_parent'];
                    $sqlInsert="INSERT INTO trash_danhmuc VALUES('$id','$tendanhmuc','$id_parent')";
                    mysqli_query($con,$sqlInsert);
                    $sqlDelete="DELETE FROM danhmuc WHERE id_danhmuc=".$_GET["id"];
                    mysqli_query($con,$sqlDelete);
                    header("location:index.php?page=danhmuc");
                }
            ?>
            <form class="form-label-left input_mask" method="post">

                <div class="form-group row">
                    <label class="col-form-label col-md-4 col-sm-4 ">Tên danh mục</label>
                    <div class="col-md-8 col-sm-8 ">
                        <input type="text" class="form-control" value="<?php echo $tendanhmuc; ?>" name="ten_danhmuc" id="ten_danhmuc" placeholder="Nhập tên">
                    </div>
                </div>
                
                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button class="btn btn-primary" type="reset" name="Reset">Làm mới</button>
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
					<input type="text" class="form-control"  name="timkiem" id="timkiem" placeholder="Tìm danh mục">
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
        <h2>Bảng danh mục</h2>
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
                <th>Tên Danh mục</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if(isset($_POST["Search"])){
                    $timkiem=$_POST["timkiem"];
                    $sqlSearch= "SELECT* FROM  danhmuc  WHERE  (id_danhmuc LIKE '%$timkiem%'|| ten_danhmuc LIKE '%$timkiem%')";
                    $resultSearch= mysqli_query($con, $sqlSearch);
                    if(mysqli_num_rows($resultSearch)>0){
                        while($rowSearch= mysqli_fetch_assoc($resultSearch)){
            ?>          
                        <tr>
                            <td><?php echo $rowSearch["id_danhmuc"]?></td>
                            <td><?php echo $rowSearch["ten_danhmuc"]?></td>
                            <td>
                                <a href="index.php?page=danhmuc&id=<?php echo $rowSearch["id_danhmuc"];?>&edit=1">
                                    <i class="fa fa-pencil-square-o"></i> Sửa</a>
                                <a href="index.php?page=danhmuc&id=<?php echo $rowSearch["id_danhmuc"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa danh mục này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                            </td>
                        </tr>
                <?php }
				    }
                }else{
                    //Truy vấn dữ liệu
                    $sqlSelect="SELECT * FROM  danhmuc";
                    //Thực thi
                    $result= mysqli_query($con,$sqlSelect);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                
            ?> 
                <tr>
                    <td><?php echo $row["id_danhmuc"]?></td>
                    <td><?php echo $row["ten_danhmuc"]?></td>
                    <td>
                        <a href="index.php?page=danhmuc&id=<?php echo $row["id_danhmuc"];?>&edit=1">
                            <i class="fa fa-pencil-square-o"></i> Sửa</a>
                        <a href="index.php?page=danhmuc&id=<?php echo $row["id_danhmuc"];?>&delete=1" onclick="return confirm('Bạn có muốn xóa danh mục này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                
                <?php }}} ?>
            </tbody>
        	</table>
        </div>
    </div>
</div>