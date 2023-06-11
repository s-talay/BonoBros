<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root."/bits/apisessioncheck.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $success = true;
    echo $success;
}
?>