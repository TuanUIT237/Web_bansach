<?php
    include ('function.php');
    $sql_index="SELECT * FROM danhmuc ORDER BY id_danhmuc DESC";
    $query_index=mysqli_query($con,$sql_index);
    while($row_index = mysqli_fetch_array($query_index)){
    if($row_index['id_parent']==0 || $row_index['id_parent']==35){
?>
<h1 class="pagetitle" >
    <a href="danh-muc&loai-<?php echo $row_index['id_danhmuc']?>&9&trang-1"><?php echo $row_index['ten_danhmuc'] ?></a>
</h1>
<ul class="listbook clearfix">
<?php
    if($row_index['id_danhmuc']==1){
        $str="id_danhmuc=2 OR id_danhmuc=3 OR id_danhmuc=4 OR id_danhmuc=5 OR id_danhmuc=6";
        $sql_product="SELECT * FROM sach WHERE ".$str." ORDER BY RAND() LIMIT 6 OFFSET 0";
    }elseif($row_index['id_danhmuc']==7){
        $str="id_danhmuc=8 OR id_danhmuc=9 OR id_danhmuc=10 OR id_danhmuc=11 OR id_danhmuc=12 OR id_danhmuc=13 OR id_danhmuc=14 OR id_danhmuc=15 OR id_danhmuc=16 ";
        $sql_product="SELECT * FROM sach WHERE ".$str." ORDER BY RAND() LIMIT 6 OFFSET 0";
    }elseif($row_index['id_danhmuc']==17){
        $sql_product="SELECT * FROM sach WHERE id_danhmuc=18 OR id_danhmuc=19 OR id_danhmuc=20 ORDER BY RAND() LIMIT 6 OFFSET 0";
    }elseif($row_index['id_danhmuc']==21){
        $sql_product="SELECT * FROM sach WHERE id_danhmuc=22 OR id_danhmuc=23 ORDER BY RAND() LIMIT 6 OFFSET 0 ";
    }elseif($row_index['id_danhmuc']==33){
        $sql_product="SELECT s.id_sach,COUNT(soluong),s.hinhanh,s.ten_sach,s.gia,s.sotrang_sach,s.tacgia,s.ngayphathanh FROM sach s JOIN cthd ct ON ct.id_sach=s.id_sach GROUP BY id_sach,soluong ORDER BY COUNT(soluong) DESC LIMIT 6 OFFSET 0";
    }else{
        $sql_product="SELECT * FROM sach WHERE id_danhmuc={$row_index['id_danhmuc']}";
    }
    $query_product=mysqli_query($con,$sql_product);
    while($row_product = mysqli_fetch_array($query_product)){
?>
    <li class="book bookimage0">
        <div class="wrap">
            <a href="thong-tin-sach&id-<?php echo $row_product['id_sach'] ?>" class="image" title="<?php echo $row_product['ten_sach'] ?>" value="<?php echo $row_product['id_sach'] ?>">
                <img class="image" src="image/sach/<?php echo $row_product['hinhanh'] ?>" alt="<?php echo $row_product['ten_sach'] ?>">
            </a>
            <div class="popup" style="padding-bottom: 10px;">
                <h2 class="name"><?php echo $row_product['ten_sach'] ?></h2>
                <div class="description">
                    <ul>
                        <li style="display: flex;"><p style="font-weight: bold; margin-right: 2px;">Số trang: </p><?php echo $row_product['sotrang_sach'] ?></li>
                        <li><p style="font-weight: bold;">Tác giả: </p><?php echo $row_product['tacgia'] ?></li>
                        <li style="display: flex;"><p style="font-weight: bold; margin-right: 2px;">Ngày phát hành: </p><?php echo $row_product['ngayphathanh'] ?></li>
                    </ul>
                    
                </div>
                <p class="price"><?php echo currency_format(($row_product['gia']-($row_product['gia']*0.3)))?>
                    <span class="old"><?php echo currency_format($row_product['gia'])?></span>
                </p>
                <div data-alerts=”alerts” data-ids=”myid” data-fade=”6000″></div>
                <?php
                    if(isset($_SESSION['user'])&&($_SESSION['user'])){
                ?>
                <a class="addtocart" href="gio-hang&id-<?php echo $row_product['id_sach'] ?>" value="1">Thêm vào giỏ hàng
                </a>
                <?php
                }else{
                    echo '<a class="addtocart" href="login.php" value="0">Thêm vào giỏ hàng
                    </a>';
                }
                ?>
                <?php
                    if(isset($_SESSION['user'])&&($_SESSION['user'])){
                ?>
                <a class="buynow" href="dat-hang&id-<?php echo $row_product['id_sach'] ?>" value="1">Mua ngay</a>
                </a>
                <?php
                }else{
                    echo '<a class="addtocart" href="login.php" value="0">Mua ngay
                    </a>';
                }
                ?>
                
            </div>    
        </div>
    </li>

    <?php }
    ?>
</ul>
<?php }
}
?>