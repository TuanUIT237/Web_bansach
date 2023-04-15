<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    require('../carbon/autoload.php');
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    include("../connect_db.php");
    if(isset($_POST['confirm'])&&($_POST['confirm'])){
        $id=$_POST['id'];
        $sql="UPDATE hoadon SET tinhtrang=2,trangthai=1 WHERE id_hoadon='$id'";
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
    header('location: index.php?page=qlyHoadon');
?>