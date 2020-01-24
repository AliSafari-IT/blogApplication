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


<!--Main layout-->
<main class="mt-5 pt-5">
    <div class="container">
        <!--Section: Jumbotron-->
        <section class="card wow fadeIn col-md-6 m-auto" style="background-image: url(include/img/bg/7.jpg);">

            <!-- Content -->
            <div class="card-body text-white text-center py-3 px-3 my-5">

                <div class="col-md-10 m-auto">
                    <h3>
                        <strong>Sign in using email or username</strong>
                    </h3>
                    <form class="form needs-validation" novalidate data-request="loginUser" data-url="include/api.php"
                          data-method="POST" id="FormLoginUser" autocomplete="on">
                        <div class="form-group left">
                            <label for="email">E-mail | username</label>
                            <input data-data="emailUsername" type="text" class="form-control" id="emailUsername"
                                   placeholder="E-mail | username">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <div class="form-group left">
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
            </div>
            <!-- Content -->
        </section>
        <!--Section: Jumbotron-->
    </div>
</main>
<!--Main layout-->

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