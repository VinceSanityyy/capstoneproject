
<?php

define ('DB_NAME', 'capstoneproject');
define ('DB_USER', 'master');
define('DB_PASSWORD','password');
define('DB_HOST', 'instance1.czndbsdbr7eb.ap-southeast-1.rds.amazonaws.com');


$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if($mysqli->connect_error){
    echo "connection failed";
}else{
    echo "connection success";
}
?>
