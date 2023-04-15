<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "bansach";
$cookie_name = 'siteAuth';
$cookie_time = (3600 * 24 * 30); // 30 days
$con = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()){
    echo "Connection Fail: ".mysqli_connect_errno();exit;
}
    mysqli_set_charset($con,"utf8");
?>