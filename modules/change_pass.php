<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <link rel="stylesheet" href="./assets/style_login.css">
    <link rel="stylesheet" href="./assets/base.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="./fonts/fontawesome/fontawesome-free-6.2.0-web/css/all.min.css">
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
<?php
    include '../connect_db.php';
    $loi1="";
    $loi2="";
    $thanhcong="";
    if(isset($_POST['change'])&&($_POST['change'])){
        $email=$_POST['change_email'];
        $old_password=md5($_POST['change_curpassword']);
        $password=md5($_POST['change_password']);
        $retype_password=md5($_POST['change_retype_password']);
        $sql="SELECT * FROM nguoidung WHERE email='".$email."' AND matkhau='".$old_password."'";
        $query=mysqli_query($con,$sql);
        $count=mysqli_num_rows($query);
        if($count==0){
            $loi1="Tài khoản hoặc mật khẩu không đúng";
        }elseif($password!=$retype_password){
            $loi2="Mật khẩu xác nhận không đúng";
        }else{
            $sql_update="UPDATE nguoidung SET matkhau='$password' WHERE email='$email'";
            $query_update=mysqli_query($con,$sql_update);
            $thanhcong ="Bạn đã đổi mật khẩu thành công.";
        }
    }
?>
    <div class="page_container">
        <div class="page_container_inner">
            <div class="container">
                <div class="mb-login-page">
                    <a id="logo" href="./trang-chu">
                        <h2></h2>
                    </a>
                    <div class="shadow mb-login-page-inner">
                        <h1 class="head-title">Đổi mật khẩu</h1>
                        <div class="login_email">
                            <form name="frmSignup" id="frmLogin" action="" method="post" autocomplete="off">
                                <?php 
                                    if($loi1!=""){
                                        echo '<div class="alert alert-danger" style="font-size: 14px">'.$loi1.'</div>';
                                    }
                                    if($loi2!=""){
                                        echo '<div class="alert alert-danger" style="font-size: 14px">'.$loi2.'</div>';
                                    }
                                    if($thanhcong!=""){
                                        echo '<div class="alert alert-success" style="font-size: 14px">'.$thanhcong.'</div>';
                                    }
                                ?>
                                <div class="mb-3 form-group">
                                    <label class="control-label" for="signup_email">Email<i class="required">*</i></label>
                                    <input placeholder="Nhập email" type="text" value="" tabindex="2" class="form-control" id="signup_email" name="change_email">
                                </div>
                                <div class="mb-3 form-group ">
                                    <label class="control-label" for="signup_password">Mật khẩu hiện tại<i class="required">*</i></label>
                                    <input placeholder="Nhập mật khẩu" type="password" tabindex="4" class="form-control" id="signup_password" name="change_curpassword">
                                </div>
                                
                                <div class="mb-3 form-group ">
                                    <label class="control-label" for="signup_password">Mật khẩu mới<i class="required">*</i></label>
                                    <input placeholder="Nhập mật khẩu" type="password" tabindex="4" class="form-control" id="signup_password" name="change_password">
                                </div>
                                <div class="mb-3 form-group password">
                                    <label class="control-label" for="signup_retype_password">Nhập lại mật khẩu<i class="required">*</i></label>
                                    <input placeholder="Nhập lại mật khẩu" type="password" tabindex="5" class="form-control" id="signup_retype_password" name="change_retype_password">
                                </div>
                                <div class="mb-3 form-group">
                                    <input type="submit" tabindex="6" value="Đổi mật khẩu" class="btn btn-primary     btn-block" id="signup_submit" name="change">
                                </div>
                            </form>
                            <p>Tiếp tục? <a href="./dang-nhap"><span>Đăng nhập</span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>