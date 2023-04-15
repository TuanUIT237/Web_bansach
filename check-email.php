<?php
    include './connect_db.php';
    $email= $_GET['signup_email'];
    $result = mysqli_query($con, "SELECT * FROM nguoidung WHERE email ='$email'");
    $num=mysqli_num_rows($result);
    if($result == true && $num > 0){ //Tồn tại email rồi
        echo json_encode(false);
    }else{ //Chưa tồn tại email.
        echo json_encode(true);
    }
?>