<div class="col-md-12">
    <!-- Admin đã xóa -->
    <div class="x_panel">
        <div class="x_title" >
        <h2>Thông tin quản trị viên đã xóa</h2>
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
                //Truy vấn dữ liệu
                $sqlSelect="SELECT * FROM trash_admin";
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
                        <a href="index.php?page=trash&id_admin=<?php echo $row["id_admin"];?>&restore_admin=1"><i class="fa fa-undo"></i></i> Khôi phục</a>
                        <a href="index.php?page=trash&id_admin=<?php echo $row["id_admin"];?>&delete_admin=1" onclick="return confirm('Bạn có muốn xóa khách hàng này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                <?php }} ?>
            </tbody>
        	</table>
        </div>
        <?php
            if(isset($_GET["id_admin"]) && isset($_GET["restore_admin"])){
                $sqlSelect="SELECT * FROM trash_admin WHERE id_admin=".$_GET["id_admin"];
                $query=mysqli_query($con,$sqlSelect);
                $row=mysqli_fetch_array($query);
                $id_admin=$row['id_admin'];
                $fullname=$row['fullname'];
                $email=$row['username'];
                $matkhau=$row['password'];
                $sqlInsert="INSERT INTO admin VALUES('$id_nguoidung','$fullname','$email','$matkhau')";
				mysqli_query($con,$sqlInsert);
                $sqlDelete="DELETE FROM trash_admin WHERE id_admin=".$_GET["id_admin"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=trash");
			}
            if(isset($_GET["id_admin"]) && isset($_GET["delete_admin"])){
				$sqlDelete="DELETE FROM trash_admin WHERE id_admin=".$_GET["id_admin"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=trash");
			}
        ?>
    </div>
    <!-- Khách hàng đã xóa -->
    <div class="x_panel">
        <div class="x_title" >
        <h2>Thông tin khách hàng đã xóa</h2>
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
                //Truy vấn dữ liệu
                $sqlSelect="SELECT * FROM trash_nguoidung";
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
                        <a href="index.php?page=trash&id_user=<?php echo $row["id_nguoidung"];?>&restore_user=1"><i class="fa fa-undo"></i></i> Khôi phục</a>
                        <a href="index.php?page=trash&id_user=<?php echo $row["id_nguoidung"];?>&delete_user=1" onclick="return confirm('Bạn có muốn xóa khách hàng này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                <?php }} ?>
            </tbody>
        	</table>
        </div>
        <?php 
            if(isset($_GET["id_user"]) && isset($_GET["restore_user"])){
                $sqlSelect="SELECT * FROM trash_nguoidung WHERE id_nguoidung=".$_GET["id_user"];
                $query=mysqli_query($con,$sqlSelect);
                $row=mysqli_fetch_array($query);
                $id_nguoidung=$row['id_nguoidung'];
                $tennguoidung=$row['tennguoidung'];
                $gioitinh=$row['gioitinh'];
                $sdt=$row['sdt'];
                $diachi=$row['diachi'];
                $email=$row['email'];
                $matkhau=$row['matkhau'];
                $namsinh=$row['namsinh'];
                $role=$row['role'];
                $sqlInsert="INSERT INTO nguoidung VALUES('$id_nguoidung','$tennguoidung','$gioitinh','$sdt','$diachi','$email','$matkhau','$namsinh','$role')";
				mysqli_query($con,$sqlInsert);
                $sqlDelete="DELETE FROM trash_nguoidung WHERE id_nguoidung=".$_GET["id_user"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=trash");
			}
            if(isset($_GET["id_user"]) && isset($_GET["delete_user"])){
				$sqlDelete="DELETE FROM trash_nguoidung WHERE id_nguoidung=".$_GET["id_user"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=trash");
			}
        ?>
    </div>

    <!-- Sản phẩm đã xóa -->
    <div class="x_panel">
            <div class="x_title" >
            <h2>Thông tin sách đã xóa</h2>
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
                    //Truy vấn dữ liệu
                    $sqlSelect="SELECT * FROM trash_sach s, danhmuc dm WHERE s.id_danhmuc= dm.id_danhmuc";
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
                            <a href="index.php?page=trash&id_sach=<?php echo $row["id_sach"];?>&restore_sach=1" ><i class="fa fa-undo"></i></i> Khôi phục</a>
                            <a href="index.php?page=trash&id_sach=<?php echo $row["id_sach"];?>&delete_sach=1" onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                        </td>
                    </tr>
                    <?php }} ?>
                </tbody>
                </table>
            </div>
        </div>
        <?php 
            if(isset($_GET["id_sach"]) && isset($_GET["restore_sach"])){
                $sqlSelect="SELECT * FROM trash_sach WHERE id_sach=".$_GET["id_sach"];
                $query=mysqli_query($con,$sqlSelect);
                $row=mysqli_fetch_array($query);
                $id_sach=$row['id_sach'];
                $id_danhmuc=$row['id_danhmuc'];
                $ten_sach=$row['ten_sach'];
                $sotrang=$row['sotrang_sach'];
                $tacgia=$row['tacgia'];
                $ngayphathanh=$row['ngayphathanh'];
                $gia=$row['gia'];
                $namxb=$row['namxb'];
                $hinhanh=$row['hinhanh'];
                $mota=$row['mota'];
                $query1=mysqli_query($con,"SELECT * FROM trash_danhmuc WHERE id_danhmuc='$id_danhmuc'");
                $num=mysqli_num_rows($query1);
                if($num!=0)
                {
                    echo '<script>alert("Danh mục của sách này đã bị xoá");</script>';
                    header("location:index.php?page=trash");
                }else{
                    $sqlInsert="INSERT INTO sach VALUES ('$id_sach','$id_danhmuc','$ten_sach','$sotrang','$tacgia','$ngayphathanh','$gia','$namxb','$hinhanh','$mota')";
                    mysqli_query($con,$sqlInsert);
                    $sqlDelete="DELETE FROM trash_sach WHERE id_sach=".$_GET["id_sach"];
                    mysqli_query($con,$sqlDelete);
                    header("location:index.php?page=trash");
                }
                
			}
            if(isset($_GET["id_sach"]) && isset($_GET["delete_sach"])){
				$sqlDelete="DELETE FROM trash_sach WHERE id_sach=".$_GET["id_sach"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=trash");
			}
        ?>
    </div>

    <!-- Khuyến mãi đã xóa -->
    <div class="x_panel">
        <div class="x_title" >
        <h2>Khuyến mãi đã xóa</h2>
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
                <th>Tên chương trình</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Discount</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            <?php
                    //Truy vấn dữ liệu
                    $sqlSelect="SELECT * FROM trash_khuyenmai";
                    //Thực thi
                    $result= mysqli_query($con,$sqlSelect);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                
            ?> 
                <tr>
                    <td><?php echo $row["id_km"]?></td>
                    <td><?php echo $row["ten_ctkm"]?></td>
                    <td><?php echo $row["ngay_bd"]?></td>
                    <td><?php echo $row["ngay_kt"]?></td>
                    <td><?php echo ($row["discount"]*100)."%"?></td>
                    <td>
                        <a href="index.php?page=trash&id_km=<?php echo $row["id_km"];?>&restore_km=1" ><i class="fa fa-undo"></i></i> Khôi phục</a>
                        <a href="index.php?page=trash&id_km=<?php echo $row["id_km"];?>&delete_km=1" 
                        onclick="return confirm('Bạn có muốn xóa khuyến mãi này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                
                <?php }} ?>
            </tbody>
        	</table>
        </div>
        <?php 
            if(isset($_GET["id_km"]) && isset($_GET["restore_km"])){
                $sqlSelect="SELECT * FROM trash_khuyenmai WHERE id_km=".$_GET["id_km"];
                $query=mysqli_query($con,$sqlSelect);
                $row=mysqli_fetch_array($query);
                $id_km=$row['id_km'];
                $ten_km=$row['ten_km'];
                $ngaybd=$row['ngaybd'];
                $ngaykt=$row['ngaykt'];
                $discount=$row['discount'];
                $sqlInsert="INSERT INTO khuyenmai VALUES ('$id_km','$ten_km','$ngaybd','$ngaykt','$discount')";
                mysqli_query($con,$sqlInsert);
                $sqlDelete="DELETE FROM trash_khuyenmai WHERE id_km=".$_GET["id_km"];
                mysqli_query($con,$sqlDelete);
                header("location:index.php?page=trash");
            }
            if(isset($_GET["id_km"]) && isset($_GET["delete_km"])){
				$sqlDelete="DELETE FROM trash_khuyenmai WHERE id_km=".$_GET["id_km"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=trash");
			}
        ?>
    </div>

    <!-- Slider đã xóa -->
    <div class="x_panel">
        <div class="x_title" >
        <h2>Slider đã xóa</h2>
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
                <th>Tên slider</th>
                <th>Hình ảnh</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            <?php
                    //Truy vấn dữ liệu
                    $sqlSelect="SELECT * FROM trash_slider";
                    //Thực thi
                    $result= mysqli_query($con,$sqlSelect);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                
            ?> 
                <tr>
                    <td><?php echo $row["id_slider"]?></td>
                    <td><?php echo $row["ten_slider"]?></td>
                    <td><img src="../../image/slider/<?php echo $row["hinhanh"]?>" alt="" style=" width:150px; height:80px;"></td>
                    <td>
                        <a href="index.php?page=trash&id_slider=<?php echo $row["id_slider"];?>&restore_slider=1" ><i class="fa fa-undo"></i></i> Khôi phục</a>
                        <a href="index.php?page=trash&id_slider=<?php echo $row["id_slider"];?>&delete_slider=1" 
                        onclick="return confirm('Bạn có muốn xóa slider này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                
                <?php }} ?>
            </tbody>
        	</table>
        </div>
        <?php 
            if(isset($_GET["id_slider"]) && isset($_GET["restore_slider"])){
                $sqlSelect="SELECT * FROM trash_slider WHERE id_slider=".$_GET["id_slider"];
                $query=mysqli_query($con,$sqlSelect);
                $row=mysqli_fetch_array($query);
                $idslider=$row['id_slider'];
                $tenslider=$row['ten_slider'];
                $hinhanh=$row['hinhanh'];
                $sqlInsert="INSERT INTO slider VALUES ('$idslider','$tenslider','$hinhanh')";
                mysqli_query($con,$sqlInsert);
                $sqlDelete="DELETE FROM trash_slider WHERE id_slider=".$_GET["id_slider"];
                mysqli_query($con,$sqlDelete);
                header("location:index.php?page=trash");
            }
            if(isset($_GET["id_slider"]) && isset($_GET["delete_slider"])){
				$sqlDelete="DELETE FROM trash_slider WHERE id_slider=".$_GET["id_slider"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=trash");
			}
        ?>
    </div>

    <!-- Danh mục đã xóa -->
    <div class="x_panel">
        <div class="x_title" >
        <h2>Danh mục đã xóa</h2>
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
                    //Truy vấn dữ liệu
                    $sqlSelect="SELECT * FROM trash_danhmuc";
                    //Thực thi
                    $result= mysqli_query($con,$sqlSelect);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                
            ?> 
                <tr>
                    <td><?php echo $row["id_danhmuc"]?></td>
                    <td><?php echo $row["ten_danhmuc"]?></td>
                    <td>
                        <a href="index.php?page=trash&id_danhmuc=<?php echo $row["id_danhmuc"];?>&restore_danhmuc=1" ><i class="fa fa-undo"></i> Khôi phục</a>
                        <a href="index.php?page=trash&id_danhmuc=<?php echo $row["id_danhmuc"];?>&delete_danhmuc=1" onclick="return confirm('Bạn có muốn xóa danh mục này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                
                <?php }} ?>
            </tbody>
        	</table>
        </div>
        <?php 
            if(isset($_GET["id_danhmuc"]) && isset($_GET["restore_danhmuc"])){
                $sqlSelect="SELECT * FROM trash_danhmuc WHERE id_danhmuc=".$_GET["id_danhmuc"];
                $query=mysqli_query($con,$sqlSelect);
                $row=mysqli_fetch_array($query);
                $id_danhmuc=$row['id_danhmuc'];
                $ten_danhmuc=$row['ten_danhmuc'];
                $id_parent=$row['id_parent'];
                $sqlInsert="INSERT INTO danhmuc VALUES('$id_danhmuc','$ten_danhmuc','$id_parent')";
                mysqli_query($con,$sqlInsert);
                $sqlDelete="DELETE FROM trash_danhmuc WHERE id_danhmuc=".$_GET["id_danhmuc"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=trash");
            }
            if(isset($_GET["id_danhmuc"]) && isset($_GET["delete_danhmuc"])){
				$sqlDelete="DELETE FROM trash_danhmuc WHERE id_danhmuc=".$_GET["id_danhmuc"];
				mysqli_query($con,$sqlDelete);
				header("location:index.php?page=trash");
			}
        ?>
    </div>

    <!-- Hóa đơn đã xóa -->
    <div class="x_panel" >
        <div class="x_title" >
        <h2>Hóa đơn đã xóa</h2>
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
                <th>Địa chỉ</th>
                <th>Tổng hóa đơn</th>
                <th>Ngày hóa đơn</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            <?php
                    //Truy vấn dữ liệu
                    $sqlSelect="SELECT * FROM trash_hoadon";
                    //Thực thi
                    $result= mysqli_query($con,$sqlSelect);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                
            ?> 
                <tr>
                    <td><?php echo $row["id_hoadon"]?></td>
                    <td><?php echo $row["id_nguoidung"]?></td>
                    <td><?php echo $row["diachi"]?></td>
                    <td><?php echo $row["tonghd"]?></td>
                    <td><?php echo $row["ngayhd"]?></td>
                    <td>
                        <a href="index.php?page=trash&id_hoadon=<?php echo $row["id_hoadon"];?>&restore_hoadon=1"><i class="fa fa-undo"></i> Khôi phục</a>
                        <a href="index.php?page=trash&id_hoadon=<?php echo $row["id_hoadon"];?>&delete_hoadon=1" 
                            onclick="return confirm('Bạn có muốn xóa hóa đơn này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                
                <?php }} ?>
            </tbody>
        	</table>
        </div>
    
        <?php 
            if(isset($_GET["id_hoadon"]) && isset($_GET["restore_hoadon"])){
				$sql="SELECT * FROM trash_hoadon WHERE id_hoadon=".$_GET["id_hoadon"];
                $query=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($query);
                $id_hd=$row['id_hoadon'];
                $id_user=$row['id_nguoidung'];
                $sdt=$row['sdt'];
                $diachi=$row['diachi'];
                $tonghd=$row['tonghd'];
                $ngayhd=$row['ngayhd'];
                $ghichu=$row['ghichu'];
                $tinhtrang=$row['tinhtrang'];
                $trangthai=$row['trangthai'];
                $queryRSuser=mysqli_query($con,"SELECT * FROM trash_nguoidung WHERE id_nguoidung='$id_user'");
                $num=mysqli_num_rows($queryRSuser);
                if($num!=0){
                    echo '<script>alert("Người dùng mua hoá đơn này đã bị xoá");</script>';
                    header("location:index.php?page=trash");
                }else{
                    $sql1="SELECT * FROM trash_cthd WHERE id_hoadon=".$_GET["id_hoadon"];
                    $query1=mysqli_query($con,$sql1);
                    $row1=mysqli_fetch_array($query1);
                    $id_sach=$row1['id_sach'];
                    $soluong=$row1['soluong'];
                    $giaohang=$row1['giaohang'];
                    $sqlInsert2="INSERT INTO cthd VALUES ('$id_hd','$id_sach','$soluong','$giaohang')";
                    $sqlInsert1="INSERT INTO hoadon VALUES ('$id_hd','$id_user','$sdt','$diachi','$tonghd','$ngayhd','$ghichu','$tinhtrang','$trangthai')";
                    mysqli_query($con,$sqlInsert1);
				    mysqli_query($con,$sqlInsert2);
                    $sqlDelete1="DELETE FROM trash_hoadon WHERE id_hoadon='$id_hd'";
				    $sqlDelete2="DELETE FROM trash_cthd WHERE id_hoadon='$id_hd'";
				    mysqli_query($con,$sqlDelete2);
				    mysqli_query($con,$sqlDelete1);
                    header("location:index.php?page=trash");
                }
			}
            if(isset($_GET["id_hoadon"]) && isset($_GET["delete_hoadon"])){
				$sqlDelete1="DELETE FROM trash_hoadon WHERE id_hoadon=".$_GET["id_hoadon"];
				$sqlDelete2="DELETE FROM trash_cthd WHERE id_hoadon=".$_GET["id_hoadon"];
				mysqli_query($con,$sqlDelete2);
				mysqli_query($con,$sqlDelete1);
				header("location:index.php?page=trash");
			}
        ?>
    </div>
</div>
