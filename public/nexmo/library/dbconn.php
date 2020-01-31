
<?php
define ('DB_NAME', 'b0AtAUbxl2');
define ('DB_USER', 'b0AtAUbxl2');
define('DB_PASSWORD', 'He1yE2whbv');
define('DB_HOST', 'remotemysql.com');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if($mysqli->connect_error){
    echo "connection failed";
}else{
    // echo "connection success";
}
?>