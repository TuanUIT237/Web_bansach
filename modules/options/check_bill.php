<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    require('./carbon/autoload.php');
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    if(isset($_GET['iduser'])){
        $id_user = $_GET['iduser'];
    }else{
        $id_user = '';
    }
    if(isset($_POST['checkbill'])&&($_POST['checkbill'])){
        $id_hoadon=$_POST['orderid'];
    }else{
        $id_hoadon="";
    }
?>
<div class="bookdetailwrap">
    <header class="pageheader">
        <h1>
            Kiểm tra đơn hàng
        </h1>
    </header>
    <div class="checkorder">    
        <div class="form">
            <form action="" method="post" novalidate="novalidate">
                <input name="orderid" placeholder="Nhập mã đơn hàng của bạn" class="text">
                <input type="submit" value="Tìm mã" class="submit" name="checkbill">
            </form>
            
        </div>    
     </div>
    <div class="checkorder">
        <?php
        $sql_select = mysqli_query($con,"SELECT * FROM hoadon hd JOIN cthd ct ON hd.id_hoadon=ct.id_hoadon WHERE id_nguoidung='$id_user' AND hd.id_hoadon='$id_hoadon' AND tinhtrang=0 AND trangthai=0 GROUP BY '$id_hoadon'"); 
        ?> 
        <table class="table_checkbill">
            <tbody>
            <tr>
                <th>STT</th>
                <th>Số hoá đơn</th>
                <th>Ngày đặt</th>
                <th>Quản lý</th>
                <th>Tình trạng</th>
                <th>Xác nhận</th>
            </tr>
            <?php
            $i = 0;
            while($row_donhang = mysqli_fetch_array($sql_select)){ 
                $i++;
            ?> 
            <tr>
                <td><?php echo $i; ?></td>
                
                <td><?php echo $row_donhang['id_hoadon']; ?></td>
            
                
                <td><?php echo $row_donhang['ngayhd'] ?></td>
                <td><a href="index.php?quanly=kiem-tra&khachhang=<?php echo $_SESSION['iduser'] ?>&idhd=<?php echo $row_donhang['id_hoadon'] ?>"><p style="font-size: 14px; color: #0088ff;"><i class="fa fa-eye"></i></p></a></td>
                <td><?php 
                if($row_donhang['tinhtrang']==0){
                    echo 'Chuẩn bị';
                }elseif($row_donhang['tinhtrang']==1){
                    echo 'Đang giao hàng';
                }
                ?></td>
                <td>
                <form action="" method="post" class="form">
                    <input type="hidden" name="id" value="<?php echo $row_donhang['id_hoadon']; ?>">
                    <input type="Submit" name="confirm" value="Đã nhận hàng" class="submit">
                </form>
                </td>
            </tr>
                <?php
            } 
            ?> 
          </tbody>
        </table>
    </div>


    <div class="checkorder">
        <h2 style="margin-top: 10px;">Chi tiết đơn hàng</h2><br>
        <?php
        if(isset($_GET['idhd'])){
            $id_hoadon = $_GET['idhd'];
        }else{
            $id_hoadon = '';
        }
        $sql_select = mysqli_query($con,"SELECT * FROM (hoadon hd JOIN cthd ct ON hd.id_hoadon=ct.id_hoadon) JOIN sach s ON s.id_sach=ct.id_sach WHERE hd.id_hoadon='$id_hoadon' ORDER BY hd.id_hoadon DESC"); 
        ?> 
        <table>
            <tbody>
            <tr>
                <th>STT</th>
                <th>Số hoá đơn</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Ngày đặt</th>
                <th>Giao hàng</th>
                <th>Trạng thái</th>
            </tr>
            <?php
            $i = 0;
            while($row_donhang = mysqli_fetch_array($sql_select)){ 
                $i++;
            ?> 
            <tr>
                <td><?php echo $i; ?></td>
                
                <td><?php echo $row_donhang['id_hoadon']; ?></td>
            
                <td><?php echo $row_donhang['ten_sach']; ?></td>

                <td><?php echo $row_donhang['soluong']; ?></td>
                
                <td><?php echo $row_donhang['ngayhd'] ?></td>
            
                <td><?php echo $row_donhang['thanhtoan'];
                ?></td>
                <td><?php if($row_donhang['trangthai']==0){echo 'Chưa thanh toán';
                }else{
                    echo 'Đã thanh toán';
                }?></td>
            </tr>
                <?php
            } 
            ?> 
            </tbody>
        </table>
    </div>
    </div>
</div>
<?php
    if(isset($_POST['confirm'])&&($_POST['confirm'])){
        $id=$_POST['id'];
        $sql="UPDATE hoadon SET tinhtrang=2,trangthai=1,ngayhd='$now' WHERE id_hoadon='$id'";
        $query=mysqli_query($con,$sql);
        $sql_hd = "SELECT * FROM hoadon WHERE id_hoadon='$id'";
        $query_hd = mysqli_query($con,$sql_hd);
        $row = mysqli_fetch_array($query_hd);
        $soluongban=0;
        $doanhthu = 0;
        $doanhthu=$row['tonghd'];
        $sql_cthd = "SELECT * FROM cthd WHERE id_hoadon='$id'";
        $query_cthd = mysqli_query($con,$sql_cthd);
        $sql_thongke = "SELECT * FROM thongke WHERE ngaythongke='$now'"; 
        $query_thongke = mysqli_query($con,$sql_thongke);
        $soluongmua = 0;
        while($row1=mysqli_fetch_array($query_cthd)){
            $soluongmua+=$row1['soluong']; 
        }
        if(mysqli_num_rows($query_thongke)==0){
                $soluongban = $soluongmua;
                $doanhthu = $doanhthu;
                $donhang = 1;
                $sql_update_thongke = mysqli_query($con,"INSERT INTO thongke (ngaythongke,soluongban,doanhthu,sohoadon) VALUEs('$now','$soluongban','$doanhthu','$donhang')" );
        }elseif(mysqli_num_rows($query_thongke)!=0){
            while($row_tk = mysqli_fetch_array($query_thongke)){
                $soluongban = $row_tk['soluongban']+$soluongmua;
                $doanhthu = $row_tk['doanhthu']+$doanhthu;
                $donhang = $row_tk['sohoadon']+1;
                $sql_update_thongke = mysqli_query($con,"UPDATE thongke SET soluongban='$soluongban',doanhthu='$doanhthu',sohoadon='$donhang' WHERE ngaythongke='$now'" );
            }
        }
    }
?>
