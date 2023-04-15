<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
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
    <style>
        label.error{
            display: block;
            color: red;
        }
    </style>
</head>
<body>
    <div class="page_container">
        <div class="page_container_inner">
            <div class="container">
                <div class="mb-login-page">
                    <a id="logo" href="trang-chu">
                        <h2></h2>
                    </a>
                    <div class="shadow mb-login-page-inner">
                        <h1 class="head-title">Đăng nhập</h1>
                        <div class="login_email">
                            <form name="frmLogin" id="frmLogin1" action="index.php?quanly=login" method="post" autocomplete="off">
                                
                                <div class="mb-3 form-group">
                                    <label>Email<i class="required">*</i></label>
                                    <input tabindex="1" placeholder="Nhập địa chỉ email của bạn" class="form-control" type="email" name="login_user" id="login_user" value="<?php
                                    if(isset($_SESSION['email'])&&($_SESSION['email'])){
                                        echo $_SESSION['email'];
                                    }else{
                                        echo "";
                                    }
                                ?>"> 
                                </div>
                                <div class="mb-3 form-group">
                                    <label>Mật khẩu<i class="required">*</i></label>
                                    <input tabindex="2" placeholder="Nhập mật khẩu của bạn" class="form-control" type="password" name="login_password" id="login_password" value="<?php
                                    if(isset($_SESSION['password'])&&($_SESSION['password'])){
                                        echo $_SESSION['password'];
                                    }else{
                                        echo "";
                                    }
                                ?>">
                                </div>
                                <div class="mb-3 form-group remember_login">
                                    <input type="checkbox" name="remember_login" id="remember_login">
                                    <label for="remember_login">Lưu đăng nhập</label>
                                </div>
                                <?php
                                    if(isset($_COOKIE['error_login'])&&($_COOKIE['error_login'])){
                                ?>    
                                <div class="notification"><p style="color:red;"><?php echo $_COOKIE['error_login']?><br><strong>Tài khoản và mật khẩu không chính xác</strong></p></div>
                                <?php 
                                }elseif(isset($_COOKIE['success_login'])&&($_COOKIE['success_login'])){
                                ?>
                                <div class="notification"><p style="color:green;"><?php echo $_COOKIE['success_login']?></p></div>
                                <?php
                                }
                                ?>
                                <div class="mb-3 form-group">
                                    <input type="submit" tabindex="3" value="Đăng nhập" class="btn btn-primary btn-login-submit btn-block" id="login_submit" name="login">
                                </div>
                            </form>

                            <div class="login-social-text login-text-chosen"><span>Hoặc đăng nhập bằng</span></div>
                            <div class="social-login">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="" class="btn btn-outline-danger btn-block btn-login-google">
                                            <i><img src="image/google.png" class="img_social" alt=""></i> Gmail
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="" class="btn btn-outline-primary btn-block btn-login-fb">
                                            <i><img src="image/facebook.png" class="img_social" alt=""></i> Facebook
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <p>Chưa có tài khoản? <a href="dang-ky"><span>Đăng ký ngay</span></a></p>
                            <p>Quên mật khẩu? <a href="quen-mat-khau"><span>click vào đây</span></a> để đặt lại mật khẩu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script>
        $('#frmLogin1').validate({
            rules: {
                login_user: {
                    required: true,
                    email: true
                },
                login_password: {
                    required: true,
                },
            },
            messages: {
                login_user: {
                    required: "Bạn chưa nhập email",
                    email: "Email chưa đúng định dạng"
                },
                login_password: {
                    required: "Bạn phải nhập password",
                },
            },
        });
    </script>
</body>
</html>