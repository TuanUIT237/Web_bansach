<?php
    session_start();
    ob_start();
    include_once ('./connect_db.php');
    $sql_num="SELECT id_giohang FROM giohang";
    $query_num=mysqli_query($con,$sql_num);
    $num=mysqli_num_rows($query_num);
    if($num==NULL){
    $num=0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4T Store | Cửa hàng sách online</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/style_info_book.css">
    <link rel="stylesheet" href="./assets/base.css">
    <link rel="stylesheet" href="./fonts/fontawesome/fontawesome-free-6.2.0-web/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="/image/Logo4T.png" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="./favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="./favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="./favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>

    <div class="MainPage">
        <?php
            include_once ('./modules/header.php');
            include_once ('./modules/menu.php');
        ?>
        <div class="container">
        <?php
		if(isset($_GET['quanly'])&&($_GET['quanly'])!=''){
			$tam= $_GET['quanly'];
		}else{
			$tam ='';
		}
        switch($tam){
            case 'chinh-sach-van-chuyen':
                include('modules/options/shipping_policy.html');
                break;
            case 'thong-bao':
                include('modules/options/notification.html');
                break;
            case 'hinh-thuc-thanh-toan':
                include('modules/options/payments.html');
                break;
            case 'huong-dan-dat-hang':
                include('modules/options/order_guide.html');
                break;
            case 'quy-dinh-doi-tra-don-hang':
                include('modules/options/buy_ship_order.html');
                break;
            case 'khuyen-mai':
			    include('modules/options/promotions.php');
                break;
		    case 'chinh-sach-bao-mat':
			    include('modules/options/privacy_policy.html');
                break;
		    case 'gioi-thieu':
			    include('modules/options/introduce.html');
                break;
		    case 'lich-su':
			    include('modules/options/history.php');
                break;
		    case 'lien-he':
			    include('modules/options/contact.html');
                break;
		    case 'kiem-tra':
			    include('modules/options/check_bill.php');
                break;
		    case 'danhmuc':
			    include('modules/options/danhmuc.php');
                break;
		    case 'gio-hang':
			    include('modules/cart.php');
                break;
            case 'ordersuccess':
			    include('modules/order_success.php');
                break;
            case 'logout':
                unset($_SESSION['user']);
                unset($_SESSION['iduser']);
                header('location: trang-chu');
                break;
            case 'login':
                if(isset($_POST['login'])&&($_POST['login'])){
                    $user=$_POST['login_user'];
                    $password1=($_POST['login_password']);
                    $password=md5($_POST['login_password']);
                    $sql="SELECT * FROM nguoidung WHERE email='$user' AND matkhau='$password'";
                    $query=mysqli_query($con,$sql);
                    $count=mysqli_num_rows($query);
                    if($count==0){
                        header('location: dang-nhap');
                        setcookie("error_login", "Đăng nhập không thành công!", time()+1, "/","", 0);
                    }else{
                        while($row=mysqli_fetch_array($query)){
                                $_SESSION['iduser']=$row['id_nguoidung'];
                                $_SESSION['user']=$row['tennguoidung'];
                                setcookie("success_login", "Đăng nhập thành công!", time()+1, "/","", 0);
                                if(isset($_POST['remember_login'])&&($_POST['remember_login'])){
                                    $_SESSION['email']=$user;
                                    $_SESSION['password']=$password1;
                                }
                                header('location: trang-chu');
                                
                            }
                        }
                    }
                break;
            case 'signup':
                if(isset($_POST['signup'])&&($_POST['signup'])){
                    $sqlsearchid="SELECT * FROM nguoidung ORDER BY id_nguoidung DESC LIMIT 1 OFFSET 0";
                    $querysearchid=mysqli_query($con,$sqlsearchid);
                    $rowsearchid=mysqli_fetch_array($querysearchid);
                    $idnd=$rowsearchid['id_nguoidung']+1;
                    $fullname = $_POST['signup_fullname'];
                    if(isset($_POST['signup_sex'])) {
                        $gioitinh=$_POST['signup_sex'];
                    }
                    $sdt=$_POST['signup_phone'];
                    $email = $_POST['signup_email'];
                    $address= $_POST['signup_address'];
                    $password1 = md5($_POST['signup_password']);
                    $retypepassword = md5($_POST['signup_retype_password']);
                    $sqlcheck="SELECT * FROM nguoidung WHERE email='$email'";
                    $querycheck=mysqli_query($con,$sqlcheck);
                    $num=mysqli_num_rows($querycheck);
                    if($num==1){
                        header('location: dang-ky');
                        setcookie("error_email1", "Email đăng ký đã tồn tại", time()+1, "/","", 0);
                    }elseif($password1!=$retypepassword){
                        header('location: dang-ky');
                        setcookie("error_signup", "Lỗi! ", time()+1, "/","", 0);
                    }else{
                        $password = $password1;
                        $sql_signup= "INSERT INTO nguoidung(id_nguoidung,tennguoidung,gioitinh,sdt,diachi,email,matkhau) VALUES ('$idnd','$fullname','$gioitinh','$sdt','$address','$email','$password')";
                        $query_signup = mysqli_query($con,$sql_signup);
                        if($query_signup==false){
                            header('location: dang-ky');
                            setcookie("error_signup1", "Đăng ký không thành công!", time()+1, "/","", 0);
                        }elseif($query_signup==true){
                            header('location: dang-ky');
                            setcookie("success_signup", "Đăng ký thành công!", time()+1, "/","", 0);
                        }
                    }
                }
                break;
            case 'infouser':
                include('modules/info_user.php');
                break;
            case 'tim-kiem':
                include('modules/search.php');
                break;
            case 'dat-hang':
			    include('modules/order.php');
                break;
		    case 'infobook':
			    include('modules/info_book.php');
                break;
            case 'ordersuccessmomo':
                include('modules/order_successmomo.php');
                break;
            default:
			    include('modules/home_page.php');
                break;
		    }
	?>

        
    </div>
    <?php
            include_once ('./modules/footer.php');
    ?>
    <div id="backtop" style="display:none;">
        <i class="fas fa-chevron-up"></i>
    </div>
    <script>
        $(document).ready(function(){
            var stt = 0;
            var endImg = $(".slide:last").attr("value");

            $(".dot").click(function () {
                stt = $(this).attr("value");

                changeImg(stt);
            });

            $(".next").click(function () {
                if (++stt > endImg) {
                    stt = 0;
                }

                changeImg(stt);
            });

            $(".prev").click(function () {
                if (--stt < 0) {
                    stt = endImg;
                }

                changeImg(stt);
            });

            var interval;
            var timer = function () {
                interval = setInterval(function () {
                    $(".next").click();
                }, 5000);
            };
            timer();
        });
        function changeImg(stt) {
            $(".slide").hide();
            $(".slide").eq(stt).fadeIn(500);
            $(".dot").removeClass("active");
            $(".dot").eq(stt).addClass("active");

            clearInterval(interval);
            timer();
        };
    </script>
    <script>
        $(document).ready(function () {
            $(".addtocart").click(function() {
                if($(this).val==1){
                    alert("Đã thêm sản phẩm vào giỏ hàng")
                }
            });
            $(".btn_shopcart").click(function(){
                count=0;
                $(".shopcart").find("tr").each(function(){
                    if($(this).find("td").html())
                        count++;
                });
                if(count==0){
                    alert("Bạn chưa thêm sản phẩm vào giỏ hàng");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $(window).scroll(function(){
                if($(this).scrollTop()){
                    $("#backtop").css('display','flex');
                    $('#backtop').fadeIn();
                }else{
                    $('#backtop').fadeOut();
                }
            });
            // if($('html, body').scrollTop()==0){
            //     $('#backtop').fadeOut();
            // }
            $('#backtop').click(function(){
                $('html, body').animate({
                    scrollTop: 0
                },500);
            });
        });
    </script>
    <script language="javascript" type="text/javascript">


        function upQtyClick() {
            var qty = $(".tbQty").val();
            if (qty < 20 && qty < 203) {
                //$(".tbQty").css("color", "black");
                $(".tbQty").val(parseInt(qty) + 1);
            }
            else {
                //$(".tbQty").css("color", "red");
            }
        }

        function downQtyClick() {
            var qty = $(".tbQty").val();
            if (qty > 1) {
                //$(".tbQty").css("color", "black");
                $(".tbQty").val(parseInt(qty) - 1);
            }
            else {
                //$(".tbQty").css("color", "red");
            }
        }

        function KeyPressQty(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode;
            if (unicode != 8) { //if the key isn't the backspace key (which we should allow)
                if (unicode < 48 || unicode > 57) //if not a number
                    return false; //disable key press
            }
        }
    </script>
    <script>
        $(document).ready(function(){
            $("#select-payment").click(function(){
                var a = $(this).val();
                if(a=="Thanh toán qua Momo"){
                    $("#momo").css('display','block');
                }else{
                    $("#momo").css('display','none');
                }
                if(a=="Thanh toán ATM" || a=="Thanh toán khi nhận hàng"){
                    $("#address").css('display','block');
                    $("#note").css('display','block');
                }else{
                    $("#address").css('display','none');
                    $("#note").css('display','none');
                }
            });
            $("#buy").click(function(){
                var a= $("#select-payment").val();
                if(a=="Thanh toán qua Momo"){
                    alert('Bạn phải thanh toán qua momo trước khi đặt hàng');
                }
            });
            $(".openmenu-icon").click(function(){
                a=$(".menu_phone").val();
                if(a==1){
                    $(".menu_phone").val(0);
                    $(".menu_phone").css("display","none");
                }else{
                    $(".menu_phone").val(1);
                    $(".menu_phone").css("display","block");
                }
            });
            $(".opensearch-icon").click(function(){
                if($(".text_phone").hasClass("active")==true){
                    $(".submit_phone").css("display","none");
                    $(".text_phone").css("display","none");
                    $(".text_phone").removeClass("active");
                }else{
                    $(".submit_phone").css("display","block");
                    $(".text_phone").css("display","block");
                    $(".text_phone").addClass("active");
                }
            });
            $("#danhmuc").click(function(){
                a=$(".submenu_phone").val();
                if(a==1){
                    $(".submenu_phone").val(0);
                    $(".submenu_phone").css("display","none");
                }else{
                    $(".submenu_phone").val(1);
                    $(".submenu_phone").css("display","block");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            num=0;
            $("#list-book4").find(".book4").each(function(){
                num++;
            });
            if(num>6){
                $(".prev_info").css("display","block");
                $(".next_info").css("display","block");
            }
            $(".next_info").click(function(){
                $("#list-book4").css("left","-150px");
                var a=$("#img_info:first").attr("src");
                var c="<li class='book4 bookimage0' style='margin: 0; float: left; width: 150px; position: relative; height: 210px; transition: all 0.25s ease-in-out;'>";
                c+="<a title='' class='image_book' href='' style='display: block; padding:10px; transition: all 0.25s ease-in-out;'>";
                c+="<img src='"+a+"' alt='' style='width:130px; height:190px; transition: all 0.25s ease-in-out;' id='img_info'>";
                c+="</a>";
                c+="</li>";
                $("#list-book4").append(c);
                $(".book4:first").remove();
                $("#list-book4").css("left","0px");
            });
            $(".prev_info").click(function(){
                $("#list-book4").css("right","-150px");
                var b=$("#list-book4 img:last").attr("src");
                var d="<li class='book4 bookimage0' style='margin: 0; float: left; width: 150px; position: relative; height: 210px; transition: all 0.25s ease-in-out;'>";
                d+="<a title='' class='image_book' href='' style='display: block; padding:10px; transition: all 0.25s ease-in-out;' >";
                d+="<img src='"+b+"' alt='' style='width:130px; height:190px; transition: all 0.25s ease-in-out;' id='img_info'>";
                d+="</a>";
                d+="</li>";
                $("#list-book4").prepend(d);
                $(".book4:last").remove();
                $("#list-book4").css("right","0px");
            });
        });
    </script>
</body>
</html>