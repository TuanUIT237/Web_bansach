<div id="mainnav_phone">

    <div class="wrapper">

        <ul class="menu_phone clearfix" value="0" style="display: none;">
            <li>
               <a href="#window" id="danhmuc">
                    Danh mục sách
                </a>
                <ul class="submenu_phone" value="0" style="display: none;">
                    <?php
                    $sql="SELECT * FROM danhmuc WHERE id_parent=0";
                    $query=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($query)){
                    ?>
                        <li>
                            <a href="danh-muc&loai-<?php echo $row['id_danhmuc']?>&9&trang-1">
                                <?php echo $row['ten_danhmuc'];?>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                        
                </ul>
            </li>
			<li>
                <a href="danh-muc&loai-33&9&trang-1">Sách bán chạy</a>
            </li>
            <li>
                <a href="khuyen-mai">Chương trình khuyến mãi</a>
            </li>			
            <li>
                <a href="danh-muc&loai-32&9&trang-1">
                    Giảm giá đặc biệt
                </a>
            </li> 
	
            <li class="show-mobile"><a href="gioi-thieu">Giới thiệu</a></li>

            <li class="show-mobile"><a href="lich-su">Lịch sử giao dịch</a></li>

            <li class="show-mobile"><a href="kiem-tra">Kiểm tra đơn hàng</a></li>
            <?php
            if(isset($_SESSION['user'])&&($_SESSION['user'])){
                if(isset($_SESSION['iduser'])&&($_SESSION['iduser'])){   
            ?>
                <li class="show-mobile">
                    <a href="thong-tin-khach-hang&id-<?php echo $_SESSION['iduser'];?>"><?php echo $_SESSION['user'];?></a>
                </li>
                <li><a href="logout" class="show-mobile">Thoát</a></li>
            <?php
                }
            }else{
            ?>
                <li class="show-mobile">
                    <a href="dang-ky">Đăng ký</a>
                </li>
                <li class="show-mobile">
                    <a href="dang-nhap">Đăng nhập</a>
                </li>
            <?php
            }
            ?>
        </ul>

    </div>

</div>
<div id="mainnav">
    <div class="wrapper">
        <ul class="menu clearfix">
            <li>
                <a href="danh-muc&loai-0&9&trang-1">Danh mục sách</a>
                <ul class="submenu">
                <?php
                    include_once ('./connect_db.php');
                    $sql_category="SELECT * FROM danhmuc ORDER BY id_danhmuc ASC";
                    $query_category=mysqli_query($con,$sql_category);
                    while($row_category = mysqli_fetch_array($query_category)){
                    if($row_category['id_parent']==0){
                ?>
                    <li><a href="danh-muc&loai-<?php echo $row_category['id_danhmuc']?>&9&trang-1"><?php echo $row_category['ten_danhmuc']?></a>
                    <ul class="submenu2">
                    <?php
                        $sql_category1="SELECT * FROM danhmuc WHERE id_parent={$row_category['id_danhmuc']}";
                        $query_category1=mysqli_query($con,$sql_category1);
                        while($item = mysqli_fetch_array($query_category1)){
                    ?>
                        <li><a href="danh-muc&loai-<?php echo $item['id_danhmuc']?>&9&trang-1"><?php echo $item['ten_danhmuc']?></a>
                    <?php } 
                    ?>
                    </ul>
                <?php }
                }
                ?>
                </ul>
            </li>
            <li><a href="danh-muc&loai-33&9&trang-1">Sách bán chạy</a></li>
            <li><a href="khuyen-mai">Chương trình khuyến mãi</a></li>
            <li><a href="danh-muc&loai-32&9&trang-1">Giảm giá đặc biệt</a></li>
        </ul>
    </div>
</div> 
