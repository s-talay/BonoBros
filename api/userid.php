<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root."/bits/apisessioncheck.php");
// API die username und id dieser Session zurück gibt
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $obj = new stdClass();
    $obj->id = $_SESSION["id"];
    $obj->username = $_SESSION["username"];
    $json = json_encode($obj);    
    echo $json;
}
?>