<?php
session_start();
include "include/functions.php";

$userProfile = getUserProfile($_GET['username']);
if (!$userProfile) {
    header("location: login.php");
    die();
}

echo $_GET['username'];
