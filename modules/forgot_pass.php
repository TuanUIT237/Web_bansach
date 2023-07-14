
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi lại mật khẩu</title>
    <link rel="stylesheet" href="./assets/style_login.css">
    <link rel="stylesheet" href="./assets/base.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
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
    include '../function.php';
    include '../connect_db.php';
    $loi="";
    $thanhcong="";
    if(isset($_POST['input_email'])&&($_POST['input_email'])){
        $email=$_POST['email'];
        $sql="SELECT * FROM nguoidung WHERE email='".$email."'";
        $query=mysqli_query($con,$sql);
        $count=mysqli_num_rows($query);
        if($count==0){
            $loi ="Email của bạn nhập chưa đăng ký trên website";
        }
        else{
           $newpass = substr(md5(rand(0,999999)),0,8);
           $newpass1 = md5($newpass);
           $sql_update="UPDATE nguoidung SET matkhau='$newpass1' WHERE email='$email'";
           $query_update=mysqli_query($con,$sql_update);
           $kq=SentMail($email,$newpass);
           $thanhcong ="Mật khẩu mới đã gửi vào mail của bạn.";
        }
        
    }
    ?>
    <div class="page_container">
        <div class="page_container_inner">
            <div class="mb-login-page">
                <a id="logo" href="./trang-chu">
                    <h2></h2>
                </a>
                <div class="shadow mb-login-page-inner">
                    <h2 class="head-title">Gửi yêu cầu đổi mật khẩu</h2>
                    <?php
                        if($loi!=""){
                            echo '<div class="alert alert-danger" style="font-size: 14px">'.$loi.'</div>';
                        }elseif($thanhcong!=""){
                            echo '<div class="alert alert-success" style="font-size: 14px">'.$thanhcong.'<br>
                            Vui lòng bạn kiểm tra email</div>';
                        }
                    ?>
                    <form name="frmForgotPassword" id="frmForgotPassword" action="" method="post">
                        <div class="text-danger margin-top-bottom-20" id="forgotpassword_error">
                                            </div>
                        <div class="form-group">
                            <label class="control-label">Nhập email bạn đã dùng để đăng ký tài khoản</label>
                            <input tabindex="1" placeholder="Nhập email" type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input tabindex="2" type="submit" class="btn btn-primary btn-block btn-login-submit" value="Gửi yêu cầu" name="input_email">
                        </div>
                    </form>
                    <p>Bạn muốn đổi mật khẩu mới? <a href="doi-mat-khau"><span>Đổi mật khẩu</span></a></p>
                    <p>Bạn muốn tiếp tục? <a href="./dang-nhap"><span>click vào đây</span></a> để đăng nhập</p>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>