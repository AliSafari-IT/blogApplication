<?php
session_start();
include "include/functions.php";

$userProfile = getUserProfile($_GET['username']);
if (!$userProfile) {
    header("location: login.php");
    die();
}

$username = $userProfile['username'];
$firstname = $userProfile['firstname'];
$lastname = $userProfile['lastname'];
$email = $userProfile['email'];
$userType = $userProfile['userType'];
$phoneGsmNr = $userProfile['phoneGsmNr'];
$addressStreet = $userProfile['addressStreet'];
$addressHouseNr = $userProfile['addressHouseNr'];
$addressPostalCode = $userProfile['addressPostalCode'];
$addressCity = $userProfile['addressCity'];
$addressCountry = $userProfile['addressCountry'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php getHeader(); ?>
    <title>Updating details for <?php echo $username ?></title>
</head>
<body>
<?php getNavigation(); ?>
<?php getPostMenuBg(); ?>
<section class="" id="contact-section">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-12 bg-primary">
                <form action="#" class="p-3 contact-form">

                    <h2 class="h4 mb-3 heading">Update user profile </h2>
                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" class="form-control" value="<?php echo $firstname ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" class="form-control" value="<?php echo $lastname ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" value="<?php echo $email ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="username">Username</label>
                            <input type="text" id="username" class="form-control bg-warning text-dark"
                                   value="<?php echo $username ?>"
                                   disabled title="You can't change your username!">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="userType">User Type</label>
                            <input type="text" id="userType" class="form-control" value="<?php echo $userType ?>"
                                   disabled title="You don't have the privilege to change the user type!">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="phoneGsmNr">Phone/GSM number</label>
                            <input type="text" id="phoneGsmNr" class="form-control" value="<?php echo $phoneGsmNr ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="addressStreet">Street</label>
                            <input type="text" id="addressStreet" class="form-control" value="<?php echo $addressStreet ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="addressHouseNr">House Nr.</label>
                            <input type="text" id="addressHouseNr" class="form-control" value="<?php echo $addressHouseNr ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="addressPostalCode">Postal Code / Zip Code</label>
                            <input type="text" id="addressPostalCode" class="form-control" value="<?php echo $addressPostalCode ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="addressCity">City</label>
                            <input type="text" id="addressCity" class="form-control" value="<?php echo $addressCity ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="addressCountry">Country</label>
                            <input type="text" id="addressCountry" class="form-control" value="<?php echo $addressCountry ?>">
                        </div>

                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="submitUserDetails">Update you details:</label>
                                <a href="<?php echo 'userProfile.php?username=' . $_SESSION["username"]; ?>"
                                class="btn col-md-12">Save</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php getFooter(); ?>
<script type="text/javascript">
    $(".hoverable").hover(
        function () {
            $(this).addClass("hoverStyle");
        }, function () {
            $(this).removeClass("hoverStyle");
        }
    );
</script>

</body>
</html>
