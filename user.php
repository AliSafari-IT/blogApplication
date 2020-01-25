<?php
session_start();
$id = (INT)$_GET['id'];
$postedBy = $_GET['postedBy'];

if ($id < 1) {
    header("location: index.php");
}
include "include/functions.php";
echo "Posted by: ".$postedBy;
?>


