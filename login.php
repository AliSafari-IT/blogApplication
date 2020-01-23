<?php
include "include/functions.php";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    header("location: index.php");
    die();
}
?>


<html lang="en">

<head>

    <?php getHeader(); ?>
</head>

<body>

<?php getNavigation(); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="panel-info">
            <hr class="mb-5">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <hr class="mb-5">
                    <h2 class="text-center" style="font-family: 'Lalezar', cursive; color: #401603">Sign in using email
                        or username </h2>
                    <hr class="mb-5">
                    <form class="form needs-validation" novalidate data-request="loginUser" data-url="include/api.php"
                          data-method="POST" id="FormLoginUser" autocomplete="on">
                        <div class="form-group">
                            <label for="email">E-mail | username</label>
                            <input data-data="emailUsername" type="text" class="form-control" id="emailUsername"
                                   placeholder="E-mail | username">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input data-data="password" type="password" class="form-control" id="password"
                                   placeholder="Enter password " autocomplete="on">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submitLogin">Login</button>
                        <div class="alert alert-primary response d-none" role="alert"></div>

                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>

<?php getFooter(); ?>
<script>
    // Disable form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>

</html>