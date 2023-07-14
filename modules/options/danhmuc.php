

<div class="slider-wrapper theme-default">
    <div class="slide-wrapper">
        <?php

            $sql_slider="SELECT * FROM slider";
            $query_slider=mysqli_query($con,$sql_slider);
            $i=0;
            while($row_slider=mysqli_fetch_array($query_slider)){
        ?>
            <div class="slide" value="<?php echo $i;?>"><img src="image/slider/<?php echo $row_slider['hinhanh'];?>"></div>
        <?php
            $i++;
        }
        ?>
        <a class="prev" value ="-1">❮</a>
        <a class="next" value="1">❯</a>
    </div>
    <div class="Nav">
        <span class="dot" value="0"></span>
        <span class="dot" value="1"></span>
        <span class="dot" value="2"></span>
    </div>
</div>
<?php
    if(isset($_GET['id'])&& ($_GET['id'])!=''){
        $id= $_GET['id'];
    }
    $sql_category="SELECT * FROM danhmuc WHERE id_danhmuc={$id}";
    $query_category=mysqli_query($con,$sql_category);
    while($row_category=mysqli_fetch_array($query_category)){
?>
<h1 class="pagetitle">
    <a href="danh-muc&loai-<?php echo $row_category['id_danhmuc']?>&9&trang-1"><?php echo $row_category['ten_danhmuc']?></a>
</h1>
<?php }?>
<ul class="listbook clearfix">
<?php
    include_once ('./function.php');
    include_once ('./connect_db.php');
    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:9;
    $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
    $offset = ($current_page - 1) * $item_per_page;
    if($id==1){
        $str="id_danhmuc=2 OR id_danhmuc=3 OR id_danhmuc=4 OR id_danhmuc=5 OR id_danhmuc=6";
        $sql="SELECT * FROM sach WHERE ".$str." ORDER BY id_sach ASC LIMIT " . $item_per_page . " OFFSET " . $offset;
        $totalRecords = mysqli_query($con, "SELECT * FROM sach WHERE ".$str."");
        $totalRecords = $totalRecords->num_rows;
    }elseif($id==7){
        $str="id_danhmuc=8 OR id_danhmuc=9 OR id_danhmuc=10 OR id_danhmuc=11 OR id_danhmuc=12 OR id_danhmuc=13 OR id_danhmuc=14 OR id_danhmuc=15 OR id_danhmuc=16 ";
        $sql="SELECT * FROM sach WHERE ".$str." ORDER BY id_sach ASC LIMIT " . $item_per_page . " OFFSET " . $offset;
        $totalRecords = mysqli_query($con, "SELECT * FROM sach WHERE ".$str."");
        $totalRecords = $totalRecords->num_rows;
    }elseif($id==17){
        $sql="SELECT * FROM sach WHERE id_danhmuc=18 OR id_danhmuc=19 OR id_danhmuc=20 ORDER BY id_sach ASC LIMIT " . $item_per_page . " OFFSET " . $offset;
        $totalRecords = mysqli_query($con, "SELECT * FROM sach WHERE id_danhmuc=18 OR id_danhmuc=19 OR id_danhmuc=20");
        $totalRecords = $totalRecords->num_rows;
    }elseif($id==21){
        $sql="SELECT * FROM sach WHERE id_danhmuc=22 OR id_danhmuc=23 ORDER BY id_sach ASC LIMIT " . $item_per_page . " OFFSET " . $offset;
        $totalRecords = mysqli_query($con, "SELECT * FROM sach WHERE id_danhmuc=12 OR id_danhmuc=23");
        $totalRecords = $totalRecords->num_rows;
    }elseif($id==33){
        $sql="SELECT s.id_sach,COUNT(soluong),s.hinhanh,s.ten_sach,s.gia,s.sotrang_sach,s.tacgia,s.ngayphathanh FROM sach s JOIN cthd ct ON ct.id_sach=s.id_sach GROUP BY id_sach,soluong ORDER BY COUNT(soluong) DESC LIMIT 6 OFFSET 0";
        $totalRecords=0;
    }else{
        $sql="SELECT * FROM sach WHERE id_danhmuc={$id} ORDER BY id_sach ASC LIMIT " . $item_per_page . " OFFSET " . $offset;
        $totalRecords = mysqli_query($con, "SELECT * FROM sach WHERE id_danhmuc={$id}");
        $totalRecords = $totalRecords->num_rows;
    }
    $products = mysqli_query($con, $sql);
    $totalPages = ceil($totalRecords / $item_per_page);
    while($row_product = mysqli_fetch_array($products)){
?>
    <li class="book bookimage0">
        <div class="wrap">
            <a href="thong-tin-sach&id-<?php echo $row_product['id_sach'] ?>" class="image" title="<?php echo $row_product['ten_sach'] ?>">
                <img src="image/sach/<?php echo $row_product['hinhanh'] ?>" alt="<?php echo $row_product['ten_sach'] ?>">
            </a>
            <div class="popup">
                <h2 class="name"><?php echo $row_product['ten_sach'] ?></h2>
                <div class="description">
                    <ul>
                        <li style="display: flex;"><p style="font-weight: bold; margin-right: 2px;">Số trang: </p><?php echo $row_product['sotrang_sach'] ?></li>
                        <li><p style="font-weight: bold;">Tác giả: </p><?php echo $row_product['tacgia'] ?></li>
                        <li style="display: flex;"><p style="font-weight: bold; margin-right: 2px;">Ngày phát hành: </p><?php echo $row_product['ngayphathanh'] ?></li>
                    </ul>
                </div>
                <p class="price"><?php echo currency_format(($row_product['gia']-($row_product['gia']*0.3))) ?>
                    <span class="old"><?php echo currency_format($row_product['gia']) ?></span>
                </p>
                <?php
                    if(isset($_SESSION['user'])&&($_SESSION['user'])){
                ?>
                <a class="addtocart" href="gio-hang&id-<?php echo $row_product['id_sach'] ?>" value="1">Thêm vào giỏ hàng
                </a>
                <?php
                }else{
                    echo '<a class="addtocart" href="dang-nhap" value="0">Thêm vào giỏ hàng
                    </a>';
                }
                ?>
                <?php
                    if(isset($_SESSION['user'])&&($_SESSION['user'])){
                ?>
                <a class="buynow" href="dat-hang&id-<?php echo $row_product['id_sach'] ?>" data-id="" data-state="">Mua ngay</a>
                </a>
                <?php
                }else{
                    echo '<a class="addtocart" href="danh-nhap" value="0">Mua ngay
                    </a>';
                }
                ?>
            </div>
        </div>
    </li>
    <?php }
    ?>
</ul>
<div id="pagination">
    <?php
    if ($current_page > 3) {
        $first_page = 1;
        ?>
        <a class="page-item" href="danh-muc&loai-<?= $id ?>&<?= $item_per_page ?>&trang-<?= $first_page ?>">First</a>
        <?php
    }
    if ($current_page > 1) {
        $prev_page = $current_page - 1;
        ?>
        <a class="page-item" href="danh-muc&loai-<?= $id ?>&<?= $item_per_page ?>&trang-<?= $prev_page ?>">Prev</a>
    <?php }
    ?>
    <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
        <?php if ($num != $current_page) { ?>
            <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                <a class="page-item" href="danh-muc&loai-<?= $id ?>&<?= $item_per_page ?>&trang-<?= $num ?>"><?= $num ?></a>
            <?php } ?>
        <?php } else { ?>
            <strong class="current-page page-item"><?= $num ?></strong>
        <?php } ?>
    <?php } ?>
    <?php
    if ($current_page < $totalPages - 1) {
        $next_page = $current_page + 1;
        ?>
        <a class="page-item" href="danh-muc&loai-<?= $id ?>&<?= $item_per_page ?>&trang-<?= $next_page ?>">Next</a>
    <?php
    }
    if ($current_page < $totalPages - 3) {
        $end_page = $totalPages;
        ?>
        <a class="page-item" href="danh-muc&loai-<?= $id ?>&<?= $item_per_page ?>&trang-<?= $end_page ?>">Last</a>
        <?php
    }
    ?>
</div>