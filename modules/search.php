
    <?php
        include_once ('./function.php');
        if(isset($_POST['search'])&&($_POST['search'])){
            $row;
            $tensp=$_POST['content_search'];
            $sql="SELECT * FROM sach WHERE ten_sach LIKE '%$tensp%' OR id_sach LIKE '%$tensp%' OR tacgia LIKE '%$tensp%'";
            $query=mysqli_query($con,$sql);
            echo '<h1 class="title_search" style="margin: 20px 20px 20px 280px;">Kết quả tìm kiếm của "'; echo $tensp; echo'"</h1>';
    ?>
            <ul class="listbook clearfix">
    <?php
            while($row=mysqli_fetch_array($query)){
                echo 
                    '<li class="book bookimage0">
                        <div class="wrap">
                            <a href="thong-tin-sach&id-'; echo $row['id_sach']; echo'" class="image" title="'; echo $row['ten_sach']; echo'" value="'; echo $row['id_sach']; echo'">;
                                <img class="image" src="image/sach/'; echo $row['hinhanh']; echo'" alt="Đắc Nhân Tâm">
                            </a>
                            <div class="popup" style="padding-bottom: 10px;">
                                <h2 class="name">'; echo $row['ten_sach']; echo '</h2>
                                <div class="description">
                                    <ul>
                                        <li style="display: flex;"><p style="font-weight: bold; margin-right: 2px;">Số trang: </p>'; echo $row['sotrang_sach']; echo'</li>
                                        <li><p style="font-weight: bold;">Tác giả: </p>'; echo $row['tacgia']; echo '</li>
                                        <li style="display: flex;"><p style="font-weight: bold; margin-right: 2px;">Ngày phát hành: </p>'; echo $row['ngayphathanh']; echo '</li>
                                    </ul>
                                </div>
                                <p class="price">'; echo currency_format(($row['gia']-($row['gia']*0.3))); echo'
                                    <span class="old">'; echo currency_format($row['gia']); echo'</span>
                                </p>';
                                if(isset($_SESSION['user'])&&($_SESSION['user'])){
                                echo '<a class="addtocart" href="gio-hang&id-'; echo $row['id_sach']; echo '" value="1">Thêm vào giỏ hàng
                                </a>';
                                }else{
                                    echo '<a class="addtocart" href="login.php" value="0">Thêm vào giỏ hàng
                                    </a>';
                                }
                                if(isset($_SESSION['user'])&&($_SESSION['user'])){
                                echo '<a class="buynow" href="dat-hang&id-'; echo $row['id_sach']; echo '" value="1">Mua ngay</a>
                                </a>';
                                }else{
                                    echo '<a class="addtocart" href="login.php" value="0">Mua ngay
                                    </a>';
                                }
                                echo '
                            </div>    
                        </div>
                    </li>';
            }
    ?>
            </ul>
    <?php
        }
    ?>
