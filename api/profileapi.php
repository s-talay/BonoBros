<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root."/bits/apisessioncheck.php");

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $username = $_GET["userid"];// ändern in username
    $obj = new stdClass();
    $obj->id = $_SESSION["id"];
    $obj->username = $_SESSION["username"];
    $obj->email = $_SESSION["email"];
    $obj->admin = $_SESSION["admin"];
    $obj->created_at = $_SESSION["created_at"];
    $json = json_encode($obj);    
    echo $json;
}
?>