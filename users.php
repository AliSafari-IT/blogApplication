<?php include "include/functions.php";
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['userType'] === 'admin') {
    ?>
    <html lang="en">

    <head>

        <?php getHeader(); ?>

        <script>
            $(document).ready(function () {

                $.ajax({
                    method: "post",
                    url: 'include/api.php',
                    data: {request: 'getUsers', data: ''}
                }).done(function (jsonData) {

                    var data = JSON.parse(jsonData);
                    // console.log(data['data']);
                    $(".table-users").html(generateTable(data['data']))
                });
            });

        </script>

    </head>

    <body>

    <?php getNavigation(); ?>
    <p class="p-5"></p>
    <div class="jumbotron jumbotron-fluid">
        <div class="col-12">

            <h3>List of All Users</h3>

            <div class="table-users"></div>

        </div>
    </div>

    <?php getFooter(); ?>

    </body>

    </html>
    <?php
} else {
    ?>
    <html lang="en">
<head>
    <?php getHeader(); ?>
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.js"></script>
    <title>User List</title>
</head>
<body>
<div style="margin-top: 30vh">
    <p class="note-icon-summernote text-danger text-center px-2">
        You need to be logged in as <b>ADMIN</b> to view
        <u>Users list</u>!
    </p>
    <p class="p-2"></p>
    <p class="text-center text-info p-1"><a href="index.php">[Homepage]</a></p>
    <p class="text-center text-info p-1"><a href="login.php">[Login]</a></p>
    <p class="text-center text-info p-1"><a href="register.php">[Register]</a></p>
</div>
</body>
    <?php
}
?>