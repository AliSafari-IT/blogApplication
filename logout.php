<?php
include "include/functions.php";
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    //if it doesn't display an error message
    ?>
    <html lang="en">
    <head>
        <?php getHeader(); ?>
        <!-- include summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.js"></script>
    </head>
    <div class="jumbotron jumbotron-fluid">
        <div style="margin-top: 30vh">
            <p class="note-icon-summernote text-warning text-center" style="font-family: 'Lalezar', cursive; color: #401603"> You need to be logged in to log out!</p>
            <p class="text-center text-info"><a href="index.php">[Homepage]</a></p>
            <p class="text-center text-info"><a href="login.php">[Login]</a></p>
            <p class="text-center text-info"><a href="register.php">[Register]</a></p>
        </div>
    </div>
    <?php
} else {
    //if it does continue checking
    //destroy all sessions canceling the login session
    session_destroy();
    ?>
    <html lang="en">
    <head>
        <?php getHeader(); ?>
        <!-- include summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.js"></script>
    </head>

    <body>
    <?php getNavigation(); ?>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="row">
                <hr class="border-top my-3">
            </div>
            <div class="row">
                <hr class="border-top my-3">
            </div>
            <div class="row">
                <hr class="mark" style="margin-top: 40%">
                <div class="col-md-4 text-center h3 icon-button star" style="font-family: 'Lalezar', cursive; color: #401603">You have successfully logged out!</div>
                <hr>
                <div class="col-md-3">
                    <a href="index.php" class="h2 text-center">
                        Homepage
                        <i class="fas fa-arrow-alt-circle-left" style="font-size:48px;color:#0D0525"></i>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="login.php" class="h2 text-center">
                        Login
                        <i class="fas fa-sign-in-alt" style="font-size:48px;color:#0D0525"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php getFooter(); ?>

    </body>
    </html>
    <?php
}
?>