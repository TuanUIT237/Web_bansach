<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
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
                        <h1 class="head-title">Đăng Ký</h1>
                        <?php
                            if(isset($_COOKIE['success_signup'])&&($_COOKIE['success_signup'])){
                        ?>   
                            <div class="alert alert-success" style="font-size: 14px">Đăng ký thành công</div>
                        <?php 
                        }
                        ?>
                        <div class="login_email">
                            <form name="frmSignup" id="frmLogin" action="index.php?quanly=signup" method="post" autocomplete="off">
                                <div class="mb-3 form-group">
                                    <label class="control-label" for="signup_fullname">Họ và tên<i class="required">*</i></label>
                                    <input placeholder="VD: Nguyễn Văn A" type="text" value="" tabindex="1" class="name form-control" id="signup_fullname" name="signup_fullname">
                                    
                                </div>
                                <label class="control-label" for="signup_sex" style="margin-bottom: 10px">Giới tính<i class="required">*</i></label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="gender form-check-input" name="signup_sex" id="customRadio1" value="Nam" checked>
                                    <label class="form-check-label" for="customRadio1">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="gender form-check-input" name="signup_sex" id="customRadio2" value="Nữ" >
                                    <label class="form-check-label" for="customRadio2">Nữ</label>
                                </div>
                                <div class="mb-3 form-group">
                                    <label class="control-label" for="signup_phone">Số điện thoại<i class="required">*</i></label>
                                    <input placeholder="VD: 0123456789" type="text" value="" tabindex="2" class="phone form-control" id="signup_phone" name="signup_phone"> 
                                </div>
                                <div class="mb-3 form-group">
                                    <label class="control-label" for="signup_address">Địa chỉ<i class="required">*</i></label>
                                    <input placeholder="Nhập địa chỉ" type="text" value="" tabindex="2" class="address form-control" id="signup_address" name="signup_address"> 
                                </div>
                                <div class="mb-3 form-group">
                                    <label class="control-label" for="signup_email">Email<i class="required">*</i></label>
                                    <input placeholder="VD: 4TStore@gmail.com" type="email" value="" tabindex="2" class="email form-control" id="signup_email" name="signup_email"> 
                                </div>
                                <div class="mb-3 form-group ">
                                    <label class="control-label" for="signup_password">Mật khẩu<i class="required">*</i></label>
                                    <input placeholder="VD: 123456" type="password" tabindex="4" class="password form-control" id="signup_password" name="signup_password">
                                </div>
                                <div class="mb-3 form-group password">
                                    <label class="control-label" for="signup_retype_password">Nhập lại mật khẩu<i class="required">*</i></label>
                                    <input placeholder="Nhập lại mật khẩu" type="password" tabindex="5" class="retype_password form-control" id="signup_retype_password" name="signup_retype_password">
                                </div>
                                <?php
                                    if(isset($_COOKIE['error_signup'])&&($_COOKIE['error_signup'])){
                                ?>    
                                <div class="notification_signup"><p style="color:red;"><?php echo $_COOKIE['error_signup']?><br><strong>Mật khẩu xác nhận không đúng</strong></p></div>
                                <?php 
                                }elseif(isset($_COOKIE['error_signup1'])&&($_COOKIE['error_signup1'])){
                                ?>   
                                <div class="notification_signup"><p style="color:red;"><?php echo $_COOKIE['error_signup1']?></p></div>
                                <?php 
                                }elseif(isset($_COOKIE['error_email1'])&&($_COOKIE['error_email1'])){
                                ?>   
                                <div class="notification_signup"><p style="color:red;"><?php echo $_COOKIE['error_email1']?></p></div>
                                <?php 
                                ?>
                                <?php 
                                }
                                ?>
                                <div class="mb-3 form-group">
                                    <p class="text-muted">* Bấm vào đăng ký đồng nghĩa với việc bạn đã đọc và đồng ý với các <a href="/tos" target="_blank">quy định sử dụng dịch vụ</a> của chúng tôi</p>
                                </div>
                                <div class="mb-3 form-group">
                                    <input type="submit" tabindex="6" value="Đăng ký" class="btn btn-primary     btn-block" id="signup_submit" name="signup">
                                </div>
                            </form>

                            <div class="social-login"></div>
                            <p>Đã có tài khoản? <a href="dang-nhap"><span>Đăng nhập</span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script>
        $('#frmLogin').validate({

            rules: {
                signup_fullname: {
                    required: true
                },
                signup_phone: {
                    required: true
                },
                signup_address: {
                    required: true
                },
                signup_email: {
                    required: true,
                    email: true,
                    remote: "check-email.php"
                },
                signup_password: {
                    required: true,
                    minlength: 6
                },
                signup_retype_password: {
                    equalTo: "#signup_password"
                },
            },
            messages: {
                signup_fullname: {
                    required: "Bạn phải nhập họ tên"
                },
                signup_phone: {
                    required: "Bạn phải nhập số điện thoại"
                },
                signup_address: {
                    required: "Bạn phải nhập địa chỉ"
                },
                signup_email: {
                    required: "Bạn chưa nhập email",
                    email: "Email chưa đúng định dạng",
                    remote: "Email đã tồn tại trong hệ thống. Mời bạn chọn email khác"
                },
                signup_password: {
                    required: "Bạn phải nhập password",
                    minlength: "Password tối thiểu là 6 ký tự"
                },
                signup_retype_password: {
                    equalTo: "Password nhập lại không khớp"
                },
            },
        });
    </script>
</body>
</html>