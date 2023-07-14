<?php
    include ('function.php');
    include_once ('./connect_db.php');
    if(isset($_GET['id'])&& ($_GET['id'])!=''){
        $id= $_GET['id'];
    }
?>
<div class="bookdetailwrap">
    <div class="bookdetail clearfix" >
        <?php
            $sql_product="SELECT * FROM sach WHERE id_sach={$id}";
            $query_product=mysqli_query($con,$sql_product);
            while($row_product = mysqli_fetch_array($query_product)){
        ?>
        <a href="thong-tin-sach&id-<?php echo $row_product['id_sach'] ?>" class="image image0">
            <img src="image/sach/<?php echo $row_product['hinhanh'] ?>" alt="<?php echo $row_product['ten_sach'] ?>">
            <span class="overlay"></span>
        </a>
        <div class="info">
            <span style="margin-bottom:20px;">
                <a href="" ><?php echo $row_product['ten_sach'] ?></a>
            </span>
            <div class="intro clearfix" style="border-top: 4px solid #cacbcc;">
                <div class="attributes">
                    <ul>
                        <li class="dataattr">
                            <span>Mã sản phẩm:</span>
                            <a href=""><?php echo $row_product['id_sach'] ?></a>
                        </li>
                        <li class="dataattr">
                            <span>Tác giả: </span>
                            <a href=""><?php echo $row_product['tacgia'] ?></a>
                        </li>
                        <li class="dataattr">
                            <span>Năm xuất bản: </span>
                            <a href=""><?php echo $row_product['namxb'] ?></a>
                        </li>
                    </ul>
                    <ul>
                        <li>Số trang: <?php echo $row_product['sotrang_sach'] ?>
                        </li>
                        <li>Ngày phát hành: <?php echo $row_product['ngayphathanh'] ?></li>
                    </ul>
                </div>
                <div class="action">
                    <div class="price">
                        <p class="oldprice">
                            Giá bìa:  <span><?php echo currency_format($row_product['gia']) ?></span>
                        </p>
                        <p>Giá 4T Store: <span><?php echo currency_format(($row_product['gia']-($row_product['gia']*0.3))) ?></span> (Đã có VAT)</p>
                    </div>
                    <div class="quantitytext">Số lượng:</div>
                        <form action="gio-hang" method="post">
                        <div class="quantity">

                            <input type="text" value="1" onkeypress="return KeyPressQty(event)" class="tbQty" name="sl">
                            <span class="arrowBlock">
                                <a class="upQty" href="javascript: upQtyClick();"></a>
                                <a class="downQty" href="javascript: downQtyClick();"></a>
                            </span>
                                    
                        </div>
                        <?php
                            if(isset($_SESSION['user'])&&($_SESSION['user'])){
                        ?>
                            <input type="Submit" name="addtocart" class="addtocart" value="THÊM VÀO GIỎ HÀNG"
                            style="
                            background: #fff;
                            color: #0088ff;
                            border: 1px solid #0088ff;
                            border-radius: 4px;
                            font-size: 14px;
                            width: 174px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 49px;
                            margin-left: 85px;
                            margin-top: 0;
                            margin-bottom: 5px;
	                        margin-right: 30px;
                            ">
                        <?php
                            }else{
                                echo '<a class="addtocart" href="dang-nhap" style="background: #fff; color: #0088ff; border: 1px solid #0088ff; border-radius: 4px; font-size: 14px; width: 152px; display: flex; justify-content: center; align-items: center; height: 49px; margin-left: 85px; margin-top: 0; margin-bottom: 5px; margin-right: 30px;">THÊM VÀO GIỎ HÀNG</a>';
                            }
                        ?>
                            <a class="buynow" href="dat-hang&id-<?php echo $row_product['id_sach'] ?>">Mua Ngay</a>
                            <table class="bill" style="display: none;">
                                <tr>
                                    <td>
                                        <input type="hidden" name="img" value="<?php echo $row_product['hinhanh'] ?>"><br>
                                        <input type="hidden" name="ten" value="<?php echo $row_product['ten_sach'] ?>"><br>
                                        <input type="hidden" name="id" value="<?php echo $row_product['id_sach'] ?>"><br>
                                        <input type="hidden" name="gia" value="<?php echo ($row_product['gia']-($row_product['gia']*0.3)) ?>"><br>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="bookdetailblockcontent">
                <h1> Giới thiệu sách </h1>
                <article>
                    <?php echo $row_product['mota'] ?>
                </article>
            </div>
            <?php }
            ?>
            <div class="bookdetailblock bookdetailblockrelated" id="bookrelatedauthor">
                <h1> Sách cùng tác giả</h1>
                <article>
                    <div class="bookslider">
                        <div class="caroufredsel_wrapper" style="display: block; text-align: start; float: none; position: relative; inset: auto; z-index: auto; width: 900px; height: 210px; margin: 0px; overflow: hidden;">
                            <ul id="list-book4" class="clearfix listbook3" style="text-align: left; float: none; position: absolute; inset: 0px auto auto 0px; margin: 0px; width: 1500px; height:210px; transition: all 0.25s ease-in-out;">
                                <?php
                                    $sql="SELECT * FROM sach WHERE id_sach='$id'";
                                    $query=mysqli_query($con,$sql);
                                    $row=mysqli_fetch_array($query);
                                    $tacgia=$row['tacgia'];
                                    $sql_actor="SELECT * FROM sach WHERE tacgia LIKE '%$tacgia%'";
                                    $query_actor=mysqli_query($con,$sql_actor);
                                    while($row_actor=mysqli_fetch_array($query_actor)){
                                ?>
                                <li class="book4 bookimage0" style="margin: 0; float: left; width: 150px; position: relative; height: 210px; transition: all 0.25s ease-in-out;">
                                    <a title="" class="image_book" href="" style="display: block; padding:10px; transition: all 0.25s ease-in-out;">
                                        <img src="image/sach/<?php echo $row_actor['hinhanh'];?>" alt="" style="width:130px; height:190px; transition: all 0.25s ease-in-out;" id="img_info">
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                        <a class="prev_info" href="#window" style="display: none; margin-left:-31px;">❮</a>
                        <a class="next_info" href="#window" style="display: none; margin-right:-11px;">❯</a>
                        <p id="ou"></p>
                    </div>
                </article>
            </div>
            <div class="bookdetailblock bookdetailblockcomment">
                <h1>Bình luận</h1>
                <article>
                <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="SCST7V0M"></script>
                    <div class="fb-comments" data-href="http://localhost:8080/index.php" data-width="945" data-numposts="5"></div>
                </article>
            </div>
        </div>
    </div>
</div>
        