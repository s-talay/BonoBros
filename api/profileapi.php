<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $username = $_GET["userid"];
    $obj = new stdClass();
    $obj->id = $_SESSION["id"];
    $obj->username = $_SESSION["username"];
    $obj->email = $_SESSION["email"];
    $obj->admin = $_SESSION["admin"];
    $json = json_encode($obj);    
    echo $json;
}
?>