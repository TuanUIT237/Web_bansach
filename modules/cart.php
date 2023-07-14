<?php
    include ('function.php');
    if(isset($_POST['addtocart'])){
        $sqlsearchid="SELECT * FROM giohang ORDER BY id_giohang DESC LIMIT 1 OFFSET 0";
        $querysearchid=mysqli_query($con,$sqlsearchid);
        $rowsearchid=mysqli_fetch_array($querysearchid);
        $idcart=$rowsearchid['id_giohang']+1;
 	    $tensanpham = $_POST['ten'];
 	    $sanpham_id = $_POST['id'];
 	    $hinhanh = $_POST['img'];
 	    $gia = ($_POST['gia']-$_POST['gia']*0.3);
 	    $soluong = $_POST['sl'];	
        $sql_select_giohang = mysqli_query($con,"SELECT * FROM giohang WHERE id_sach='$sanpham_id'");
        $count = mysqli_num_rows($sql_select_giohang);
        if($count>0){
            $row_sanpham = mysqli_fetch_array($sql_select_giohang);
            $soluong = $row_sanpham['soluong'] + 1;
            $sql_giohang = "UPDATE giohang SET soluong='$soluong' WHERE id_sach='$sanpham_id'";
        }else{
            $soluong = $soluong;
            $sql_giohang = "INSERT INTO giohang(id_giohang,ten_sach,id_sach,gia,soluong,hinhanh) values ('$idcart','$tensanpham','$sanpham_id','$gia','$soluong','$hinhanh')";
        }
        
        $insert_row = mysqli_query($con,$sql_giohang);
        header('location: gio-hang');
        
    }elseif(isset($_GET['xoa'])){
        $id = $_GET['xoa'];
        $sql_delete = mysqli_query($con,"DELETE FROM giohang WHERE id_giohang='$id'");
        header('location: gio-hang');
    }elseif(isset($_POST['capnhatsoluong'])){
        if(isset($_POST['product_id'])){
            for($i=0;$i<count($_POST['product_id']);$i++){
                $sanpham_id = $_POST['product_id'][$i];
                $soluong = $_POST['soluong'][$i];
                if($soluong<=0){
                    $sql_delete = mysqli_query($con,"DELETE FROM giohang WHERE id_sach='$sanpham_id'");
                }else{
                    $sql_update = mysqli_query($con,"UPDATE giohang SET soluong='$soluong' WHERE id_sach='$sanpham_id'");
                }
            }
        }else{
            header('location: gio-hang');
        }
    }elseif(isset($_GET['id'])){
        $id = $_GET['id'];
        $sqlsearchid="SELECT * FROM giohang ORDER BY id_giohang DESC LIMIT 1 OFFSET 0";
        $querysearchid=mysqli_query($con,$sqlsearchid);
        $rowsearchid=mysqli_fetch_array($querysearchid);
        $idcart=$rowsearchid['id_giohang']+1;
        $query_product = mysqli_query($con,"SELECT * FROM sach WHERE id_sach='$id'");
        $row = mysqli_fetch_array($query_product);
        $tensp = $row['ten_sach'];
        $gia = ($row['gia']-$row['gia']*0.3);
        $hinhanh = $row['hinhanh'];
        $soluong = 1;
        $sql_select_giohang = mysqli_query($con,"SELECT * FROM giohang WHERE id_sach='$id'");
        $count = mysqli_num_rows($sql_select_giohang);
        if($count>0){
            $row_sanpham = mysqli_fetch_array($sql_select_giohang);
            $soluong = $row_sanpham['soluong'] + 1;
            $sql_giohang = "UPDATE giohang SET soluong='$soluong' WHERE id_sach='$id'";
        }else{
            $soluong = $soluong;
            $sql_giohang = "INSERT INTO giohang(id_giohang,ten_sach,id_sach,gia,soluong,hinhanh) values ('$idcart','$tensp','$id','$gia','1','$hinhanh')";
        }
        $insert_row = mysqli_query($con,$sql_giohang);
        header('location: gio-hang');
    }
    
   
?>

<div class="bookdetailwrap">
    <h1 >Giỏ hàng</h1>
    <?php
        if(isset($_SESSION['user'])&&($_SESSION['user'])){
    ?>
    <form action="" method="POST">
    <table class="shopcart">
        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Thao tác</th>
            
        </tr>
        <?php
        $total=0;
        $sql_cart="SELECT * FROM giohang ORDER BY id_giohang DESC";
        $query_cart= mysqli_query($con,$sql_cart);
        while($row_cart = mysqli_fetch_array($query_cart)){
        ?>
        <tr>
            <td><img src="image/sach/<?php echo $row_cart['hinhanh']?>" alt="" style="width:60px; height:60px;"></td>
            <td><?php echo $row_cart['ten_sach']?></td>
            <td><?php echo currency_format($row_cart['gia'])?></td>
            <td>
                <input type="hidden" name="product_id[]" value="<?php echo $row_cart['id_sach']?>">
				<input type="number" min="1" name="soluong[]" value="<?php echo $row_cart['soluong']?>" style="width=50px">
            </td>
            <td><?php echo currency_format($row_cart['gia']*$row_cart['soluong'])?></td>
            <td><a class="delete" href="gio-hang&xoa-<?php echo $row_cart['id_giohang'] ?>"><i class="fa fa-trash"></i></a></td>
        </tr>
        <?php $total=$total+($row_cart['gia']*$row_cart['soluong']);
        }
        ?>
    </table>
        <input type="submit" class="btn_update" value="Cập nhật giỏ hàng" name="capnhatsoluong" style="
            font-size: 14px;
	        width: 200px;
	        height: 30px;
	        border-radius: 5px;
	        border: none;
	        background-color: #0088ff;
            display: flex;
            justify-content: center;
	        align-items: center;
            color: #fff;
            cursor: pointer;
            ">
    </form>
    <table class="total">
        <tr>
            <th>Tổng tiền: <?php echo currency_format($total) ?></th>
        </tr>
        <tr>
            <td>Nếu đặt online, bạn hãy đồng ý với điều khoản sử dụng và hướng dẫn hoàn trả</td>
        </tr>
    </table>
    <div class="shopcart_btn">
        <?php
            $sql_select_giohang = mysqli_query($con,"SELECT * FROM giohang");
            $count = mysqli_num_rows($sql_select_giohang);
            $link="";
            if($count==0){
                $link="gio-hang";
            }else{
                $link="dat-hang";
            }
        ?>
        <a href="<?php echo $link ?>" class="btn_shopcart">Mua hàng
        </a>
        <a href="trang-chu" class="homepage">Tiếp tục mua hàng</a>
    </div>
    <?php
        }else{
    ?>
    <form action="" method="POST">
    <table class="shopcart">
        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Thao tác</th>
            
        </tr>
    </table>
        <input type="submit" class="btn_update" value="Cập nhật giỏ hàng" name="capnhatsoluong" style="
            font-size: 14px;
	        width: 200px;
	        height: 30px;
	        border-radius: 5px;
	        border: none;
	        background-color: #0088ff;
            display: flex;
            justify-content: center;
	        align-items: center;
            color: #fff;
            cursor: pointer;
            ">
    </form>
    <table class="total">
        <tr>
            <th>Tổng tiền: </th>
        </tr>
        <tr>
            <td>Nếu đặt online, bạn hãy đồng ý với điều khoản sử dụng và hướng dẫn hoàn trả</td>
        </tr>
    </table>
    <div class="shopcart_btn">
        <a href="dang-nhap" class="btn_shopcart1" style="font-size: 14px;
	text-align: center;
	margin: 0px 20px 20px 0px;
	width: 180px;
	padding: 8px;
	border-radius: 5px;
	border-color: #0088ff;
	background-color: #0088ff;
	color: #fff;">Mua hàng
        </a>
        <a href="trang-chu" class="homepage">Tiếp tục mua hàng</a>
    </div>
    <?php
        }
    ?>
</div>
