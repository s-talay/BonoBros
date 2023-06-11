<?php
$ini_path = "php.ini";
$array = parse_ini_file($ini_path);
define('DB_SERVER', $array["db_host"]);
define('DB_USERNAME', $array["db_username"]);
define('DB_PASSWORD', $array["db_password"]);
define('DB_NAME', $array["db_name"]);

$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>