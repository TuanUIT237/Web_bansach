<?php
    $tb="";
    $tb1="";
    if(isset($_POST['update']) && ($_POST['update'])){
        
        $id=$_SESSION['iduser'];
        $gioitinh=$_POST['gioitinh'];
        $sdt=$_POST['sdt'];
        $diachi=$_POST['diachi'];
        $namsinh=$_POST['namsinh'];
        $sqlInsert="UPDATE nguoidung SET diachi='$diachi',gioitinh='$gioitinh',sdt='$sdt',namsinh='$namsinh'
        WHERE id_nguoidung='$id'";
        $kq=mysqli_query($con,$sqlInsert);
        if($kq==true){
            $tb= "Cập nhật thông tin thành công !";
        }else{
            $tb1= "Cập nhật thông tin thất bại !";
        }
    }
?>
<div class="bookdetailwrap">
    <div class="user_content">
        <h1 >Thông tin người dùng</h1>
        <?php
            if($tb!=""){
                echo '<p style="font-size: 14px; margin: 10px; color:green;">'.$tb.'</p>';
            }elseif($tb1!=""){
                echo '<p style="font-size: 14px; margin: 10px; color:red;">'.$tb1.'</p>';
            }
        ?>
        <form action="" class="form-info" method="post">
            <?php
                $id="";
                if(isset($_GET['id'])&&($_GET['id'])){
                    $id=$_GET['id'];
                    $sql="SELECT * FROM nguoidung WHERE id_nguoidung='$id'";
                    $query=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($query)){
            ?>
            <label for="">Email</label>
            <p style="padding: 5px 12px;
    font-size: 14px;"><?php echo $row['email'];?></p>
            <label for="">Tên người dùng</label>
            <input type="text" value="<?php echo $row['tennguoidung'];?>"  class="form-control" required="">
            <label for="">Địa chỉ</label>
            <input type="text" value="<?php echo $row['diachi'];?>" class="form-control" name="diachi">
            <label for="">Số điện thoại</label>
            <input type="text" value="<?php echo $row['sdt'];?>" class="form-control" name="sdt">
            <label for="">Giới tính: <?php echo $row['gioitinh'];?></label>
            <div class="gender">
                <input type="radio" value="Nam" name="gioitinh" <?php if($row['gioitinh']=='Nam'){ echo 'checked';}?>>Nam
                <input type="radio" value="Nữ" name="gioitinh" <?php if($row['gioitinh']=='Nữ'){ echo 'checked';}?>>Nữ
                <input type="radio" value="Khác" name="gioitinh" <?php if($row['gioitinh']=='Khác'){ echo 'checked';}?>>Khác
            </div>
            <label for="">Ngày sinh</label>
            <input type="date" value="<?php echo $row['namsinh'];?>" style="width: 110px; font-size: 14px;" id="datepicker" name="namsinh">
            <div style="display: flex;">
                <input type="Submit" value="Cập nhật" style="font-size: 14px;
	        width: 80px;
	        height: 30px;
	        border-radius: 5px;
	        border: none;
            outline: none;
	        background-color: #0088ff;
            display: flex;
            justify-content: center;
	        align-items: center;
            color: #fff;
            cursor: pointer;
            margin: 20px 20px 20px 0px;
            " name="update">
                <a href="doi-mat-khau" style="font-size: 14px;
	        width: 100px;
	        height: 30px;
	        border-radius: 5px;
	        border: none;
            outline: none;
	        background-color: #d0d7de;
            display: flex;
            justify-content: center;
	        align-items: center;
            color: #000;
            cursor: pointer;
            margin: 20px 20px 20px 0px;
            ">Đổi mật khẩu</a>
            </div>
            <?php
                    }
                }
            ?>
        </form>
    </div>
</div>