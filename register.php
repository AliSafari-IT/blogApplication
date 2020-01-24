<?php include "include/functions.php"; ?>

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
        <section class="card wow fadeIn" style="background-image: url(include/img/bg/7.jpg);">

            <!-- Content -->
            <div class="card-body text-white text-center py-3 px-3 my-3">

                <h3>
                    <strong>Create an Account to Start Blogging</strong>
                </h3>
                <form class="form needs-validation" novalidate data-request="registerUser" data-url="include/api.php"
                      data-method="POST" id="FormRegisterUser">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="firstname">First name:</label>
                                <input id="firstname" name="firstname" data-data="firstname" type="text"
                                       placeholder="Enter first name"
                                       class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="lastname">Last name:</label>
                                <input id="lastname" name="lastname" data-data="lastname" type="text"
                                       placeholder="Enter last name"
                                       class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input id="email" name="email" data-data="email" type="email" placeholder="Enter E-mail"
                                       class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input id="username" name="username" data-data="username" type="text"
                                       placeholder="Enter username"
                                       class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input id="password" name="password" data-data="password" type="password"
                                       placeholder="Enter password"
                                       class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="confPassword">Repeat password:</label>
                                <input id="confPassword" name="confPassword" data-data="confPassword" type="password"
                                       placeholder="Enter password again"
                                       class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" required> I agree on blabla.
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Check this checkbox to continue.</div>
                        </label>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-lg text-black-50 px-5 py-3"
                                id="submitRegistrationForm"> Register
                        </button>
                    </div>
                </form>
            </div>
            <!-- Content -->
        </section>
        <!--Section: Jumbotron-->
    </div>
</main>
<!--Main layout-->

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
<?php getFooter(); ?>
</body>

</html>