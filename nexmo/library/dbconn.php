<?php
define ('DB_NAME', 'checke_db');
define ('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if($mysqli->connect_error){
    echo "connection failed";
}else{
    // echo "connection success";
}
?>