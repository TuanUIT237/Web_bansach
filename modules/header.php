<div class="header">
            <div class="topbar hidden-mobile">
                <div class="wrapper">
                    <div class="clearfix">
                        <ul class="topnav ">
                            <!-- thanhmenu -->
                            <li>
                                <a href="gioi-thieu">Giới thiệu</a>
                            </li>
                            <?php
                                if(isset($_SESSION['user'])&&($_SESSION['user'])){
                                    if(isset($_SESSION['iduser'])&&($_SESSION['iduser'])){
                                        echo '<li><a href="lich-su&id-'.$_SESSION['iduser'].'">Lịch sử giao dịch</a></li>';
                                        echo '<li><a href="kiem-tra&id-'.$_SESSION['iduser'].'">Kiểm tra đơn hàng</a></li>';
                                    }
                                }else{
                            ?>
                            <li><a href="lich-su">Lịch sử giao dịch</a></li>
                            <li><a href="kiem-tra">Kiểm tra đơn hàng</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <ul class="topprofile ">
                            <?php
                                if(isset($_SESSION['user'])&&($_SESSION['user'])){
                                    if(isset($_SESSION['iduser'])&&($_SESSION['iduser'])){
                                    echo '<li><a href="thong-tin-khach-hang&id-'.$_SESSION['iduser'].'" class="btn_dk">'.$_SESSION['user'].'</a></li>';
                                    echo '<li><a href="logout" class="btn_dn">Thoát</a></li>';
                                    }
                                }else{
                            ?>
                            <li><a href="dang-ky" class="btn_dk">Đăng ký</a></li>
                            <li><a href="dang-nhap" class="btn_dn">Đăng nhập</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="wrapper wrap">
                <h1 class="logo">
                    <a href="trang-chu">
                        4Tshop</a>
                </h1>
                <a href="gio-hang" class="cart", id="cart">
                <?php
                    if(isset($_SESSION['user'])&&($_SESSION['user'])){
                ?>
                    <div class="cartcount"><?php
                    echo $num
                    ?></div>
                
                <?php
                }else{
                    echo '<div></div>';
                }
                ?>
                </a>
                <div class="search">
                    <form action="tim-kiem" method="post" novalidate="novalidate" class="searchbox">
                        <input name="content_search" class="text" type="text" placeholder="Tìm kiếm sách..."/>
                        <input class="submit" type="submit" value="Tìm kiếm" name="search"/>
                    </form>
                </div>
                <span class="openmenu-icon"></span>
                <form action="tim-kiem" method="post" novalidate="novalidate" class="searchbox">
                    <input name="content_search" class="text_phone" type="text" placeholder="Tìm kiếm sách..." style="display: none;
                    background: none repeat scroll 0 0 #fff;
                    border: medium none;
                    top:46px;
                    margin-left: -3px;
                    height: 45px;
                    position: absolute;
                    outline: none;
                    color: #333;
                    float: left;
                    transition: all 0.25s ease-in-out;
                    width: 102%"/>
                    <input class="submit_phone" type="submit" value="Tìm kiếm" name="search" style="display:none"/>
                    <span class="opensearch-icon"></span>
                </form>
            </div>
</div>