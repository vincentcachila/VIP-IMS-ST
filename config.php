<?php
//Database credentials. Assuming you are running MySQL
//server with default setting (user 'root' with no password)

define('DB_SERVER', 'unixondev.com');
define('DB_USERNAME', 'vipfouuo_vip-ims');
define('DB_PASSWORD', 'Unixon2018!');
define('DB_NAME', 'vipfouuo_vip-ims-2');

 
 /*define('DB_SERVER', 'localhost');
 define('DB_USERNAME', 'root');
 define('DB_PASSWORD', '');
 define('DB_NAME', 'vipfouuo_vip-ims');*/




/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("Something Went Wrong" . mysqli_connect_error());

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
