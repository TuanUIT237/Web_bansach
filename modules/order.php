<?php
    include ('function.php');
	if(isset($_POST['order'])&&($_POST['order'])){
		$ship="";
		$iduser = $_SESSION['iduser'];
		$address = $_POST['address_order'];
		$tong =$_POST['muahang_tong'];
		$note=$_POST['note_order'];
		$phone=$_POST['phone_order'];
		$tinhtrang=0;
		if(isset($_POST['ship_order'])&&($_POST['ship_order'])){
			$ship=$_POST['ship_order'];
		}
		$date = date("y/m/d");
		$id_hd = rand(100000,999999);	

		$sql_hoadon = mysqli_query($con,"INSERT INTO hoadon(id_hoadon,id_nguoidung,sdt,diachi,tonghd,ngayhd,ghichu,thanhtoan,tinhtrang,trangthai) values ('2052$id_hd','$iduser','$phone','$address','$tong','$date','$note','$ship','$tinhtrang','0')");
		for($i=0;$i<count($_POST['muahang_product_id']);$i++){
			$sanpham_id = $_POST['muahang_product_id'][$i];
			$giohang_id = $_POST['muahang_cart_id'][$i];
			$soluong = $_POST['muahang_soluong'][$i];
			$sql_cthd = mysqli_query($con,"INSERT INTO cthd(id_hoadon,id_sach,soluong) values ('2052$id_hd','$sanpham_id','$soluong')");
			$sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM giohang WHERE id_giohang='$giohang_id'");
		}
		header('location: dat-hang-thanh-cong&id-2052'.$id_hd.'');
		
	}elseif(isset($_GET['id'])){
        $id = $_GET['id'];
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
            $sql_giohang = "INSERT INTO giohang(ten_sach,id_sach,gia,soluong,hinhanh) values ('$tensp','$id','$gia','1','$hinhanh')";
        }
        $insert_row = mysqli_query($con,$sql_giohang);
		header('location: dat-hang');
    }
?>
<div class="bookdetailwrap">
    <h1 >Thông tin mua hàng</h1>
	<form action="" method="post" >
	
    <table class="shopcart">
        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        <?php
        $total=0;
        $sql_cart="SELECT * FROM giohang ORDER BY id_giohang DESC";
        $query_cart= mysqli_query($con,$sql_cart);
        while($row_cart = mysqli_fetch_array($query_cart)){
        ?>
        <tr>
            <td><img src="image/sach/<?php echo $row_cart['hinhanh']?>" alt="" style="width: 60px; height:60px;"></td>
            <td><?php echo $row_cart['ten_sach']?></td>
            <td><?php echo currency_format($row_cart['gia'])?></td>
            <td><?php echo $row_cart['soluong']?></td>
            <td><?php echo currency_format($row_cart['gia']*$row_cart['soluong'])?></td>
        </tr>
        <?php $total=$total+($row_cart['gia']*$row_cart['soluong']);
        }
        ?>
		
		</table>
		
		<h4 class="title_order" style="color: #0088ff;
		font-size: 15px;
		font-family: monospace;
		margin: 20px 20px 20px 0px;">Thêm địa chỉ giao hàng</h4>

		<div class="page">
			<?php
			if(isset($_SESSION['iduser'])&&($_SESSION['iduser'])){
				$sql_user="SELECT * FROM nguoidung WHERE id_nguoidung={$_SESSION['iduser']}";
				$query_user= mysqli_query($con,$sql_user);
				while($row_user = mysqli_fetch_array($query_user)){
			?>
  			<div class="field field_v1">
    			<input type="text" class="field__input" placeholder="" name="name_order" required="" value="<?php echo $row_user['tennguoidung']; ?>">
    			<span class="field__label-wrap" aria-hidden="true">
      				<span class="field__label">Họ và tên</span>
    			</span>
 			</div>
			<div class="field field_v2">
    			<input type="text" class="field__input" placeholder="" name="email_order" required="" value="<?php echo $row_user['email']; ?>">
    			<span class="field__label-wrap" aria-hidden="true">
      				<span class="field__label">E-mail</span>
    			</span>
  			</div>
  			<div class="field field_v2">
    			<input type="text" class="field__input" placeholder="e.g." name="phone_order" required="" value="<?php echo $row_user['sdt'];?>">
    			<span class="field__label-wrap" aria-hidden="true">
      				<span class="field__label">Số điện thoại</span>
    			</span>
  			</div>
			  <?php
			}
		}
			?>
			
			<div class="field field_v2" style="display: none;" id="address">
    			<input type="text" class="field__input" placeholder="e.g." name="address_order" required="" >
    			<span class="field__label-wrap" aria-hidden="true">
      				<span class="field__label">Địa chỉ</span>
    			</span>
  			</div>        
			<div class="field field_v2" style="display: none;" id="note">
    			<input type="text" class="field__input" placeholder="e.g." name="note_order" required="" >
    			<span class="field__label-wrap" aria-hidden="true">
      				<span class="field__label">Ghi chú</span>
    			</span>
  			</div>
			
			<div class="field field_v2">
				<select class="field__input" name="ship_order" required="" id="select-payment">
					<option>Chọn hình thức thanh toán</option>
					<option value="Thanh toán ATM">Thanh toán ATM</option>
					<option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
					<option value="Thanh toán qua Momo" >Thanh toán qua Momo</option>
				</select>
    			<span class="field__label-wrap" aria-hidden="true">
      				<span class="field__label">Thanh toán</span>
    			</span>
  			</div>
		</div>
		
		<?php
			$total_order=0;
			$sql_lay_giohang = mysqli_query($con,"SELECT * FROM giohang ORDER BY id_giohang DESC");
			while($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)){ 
		?>
		<input type="hidden" name="muahang_product_id[]" value="<?php echo $row_thanhtoan['id_sach'] ?>">
		<input type="hidden" name="muahang_cart_id[]" value="<?php echo $row_thanhtoan['id_giohang'] ?>">
		<input type="hidden" name="muahang_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
		<?php $total_order=$total_order+($row_thanhtoan['soluong']*$row_thanhtoan['gia']);
		}
		?>
		<input type="hidden" name="muahang_tong" value="<?php echo $total_order ?>">
    <table class="total">
		
        <tr>
            <th>Tổng tiền: <?php echo currency_format($total) ?></th>
        </tr>
        <tr>
            <td>Nếu đặt online, bạn hãy đồng ý với điều khoản sử dụng và hướng dẫn hoàn trả</td>
        </tr>
    </table>
    <div class="shopcart_btn">
		<input type="Submit" class="btn_payment" name="order" value="Đặt hàng" id="buy">
    </div>
	</form>
	<form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="xulythanhtoan_momo.php" style="display: none; position: absolute; margin: -72px 0px 50px 250px;" id="momo">
		<input type="hidden" name="total_order" value="<?php echo $total_order;?>">
		<div style="display: flex; width:205px; border: 2px solid #c9c8c8; border-radius:5px;" class="dathang-momo"><img src="./image/momo.png" alt="" style="width: 40px; height: 40px; border-radius:5px; margin: 5px 0px 5px 5px;">
		<input type="Submit" class="btn_mom" name="momo" value="Thanh toán qua Momo" style="border:none; background-color:#fff; font-size:14px; margin:5px 0px 5px 0px; padding:10px 0px 10px 10px; cursor:pointer;"></div>

	</form>
</div>
