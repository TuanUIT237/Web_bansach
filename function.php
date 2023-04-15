<?php
    if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = 'đ') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
        }
    }
    function SentMail($email,$matkhau){
        require "PHPMailer-master/src/PHPMailer.php"; 
        require "PHPMailer-master/src/SMTP.php"; 
        require 'PHPMailer-master/src/Exception.php'; 
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
        try {
            $mail->SMTPDebug = 0; //0,1,2: chế độ debug
            $mail->isSMTP();  
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $mail->Username = '20522108@gm.uit.edu.vn'; // SMTP username
            $mail->Password = 'tuan237267';   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // port to connect to                
            $mail->setFrom('20522108@gm.uit.edu.vn','4TStore'); 
            $mail->addAddress($email); 
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Thư cấp lại mật khẩu';
            $noidungthu = "<p>Bạn nhận được thư này do bạn hoặc ai đó đã yêu cầu cấp lại mật khẩu mới từ website 4TStore</p>
                Mật khẩu mới của bạn là: {$matkhau}
            "; 
            $mail->Body = $noidungthu;
            $mail->smtpConnect( array(
                "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
                )
            ));
            $mail->send();
        } catch (Exception $e) {
            echo 'Error: ', $mail->ErrorInfo;
        }
    }
?>