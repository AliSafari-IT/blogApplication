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

<!doctype html>
<html lang="en">
<head>
    <?php getHeader(); ?>
    <title><?php echo $username ?></title>
    <style>
        .list-group div {
            font-family: "Open Sans";
            font-size: 14px;
        }

        ul li.w-75 {
            background-color: whitesmoke;
            border-radius: 10px;
        }
        #updateProfile {
            float: left;
        }
        #updateProfile:hover {
            background-color: whitesmoke;
        }
        .hoverStyle {
            border-radius: 15px;
            border-style: groove;
            width: 100%;
            /*background-color: whitesmoke;*/
            color: #090ca1;
        }
        label {
            font-size: 14px;
            font-family: SansSerief;
            font-weight: 900;
            color: whitesmoke;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" id="home-section">
<?php getNavigation(); ?>
<?php getPostMenuBg(); ?>

<section class="" id="contact-section">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-6 bg-primary">
                <form action="#" class="p-3 contact-form">

                    <h2 class="h4 mb-3 heading">User profile </h2>
                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" class="form-control" value="<?php echo $firstname ?>"
                                   disabled>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" class="form-control" value="<?php echo $lastname ?>" disabled>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" value="<?php echo $email ?>" disabled>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="username">Username</label>
                            <input type="text" id="username" class="form-control" value="<?php echo $username ?>"
                                   disabled>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="userType">User Type</label>
                            <input type="userType" id="userType" class="form-control" value="<?php echo $userType ?>"
                                   disabled>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="phoneGsmNr">Phone/GSM number</label>
                            <input type="text" id="phoneGsmNr" class="form-control" value="<?php echo $phoneGsmNr ?>"
                                   disabled>
                        </div>
                    </div>
                    <div class="row list-group">
                        <div class="col-md-12">
                            Address:
                            <ul>
                                <li class="col-md-12 pt-1 m-1 w-75" title="Street and house number"><?php echo $addressStreet ?>, <?php echo $addressHouseNr ?> </li>
                                <li class="col-md-12 pt-1 m-1 w-75" title="Postal code and city name"><?php echo $addressPostalCode ?>, <?php echo $addressCity ?></li>
                                <li class="col-md-12 pt-1 m-1 w-75" title="Country"><?php echo $addressCountry ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12 ">
                            <button type="button" id="updateProfile" class="btn btn-info btn-md text-white hoverable" title="If you want to change your personal/account details click here!">
                                <a href="<?php echo 'userProfileChange.php?username=' . $_SESSION["username"]; ?>" >Modify Profile Details</a>
                            </button>
                        </div>
                    </div>
                </form>


            </div>
            <div class="col-lg-6 bg-secondary">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-lg-6 text-center heading-section mb-5 align-self-center">
                        <div class="paws">
                            <span class="icon-paw"></span>
                        </div>
                        <h2 class="text-white mb-5">Most Recent Posts</h2>
                        <ul class="list-unstyled text-left address">
                            <li>
                                <span class="d-block">Address:</span>
                                <p>Melbourne St,South Birbane 4101 Austraila</p>
                            </li>
                            <li>
                                <span class="d-block">Phone:</span>
                                <p>+(000) 123 4567 89</p>
                            </li>
                            <li>
                                <span class="d-block">Email:</span>
                                <p>info@yourdomain.com</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php getFooter(); ?>
<script type="text/javascript">
    $( ".hoverable" ).hover(
        function() {
            $( this ).addClass( "hoverStyle" );
        }, function() {
            $( this ).removeClass( "hoverStyle" );
        }
    );
</script>
</body>
</html>
