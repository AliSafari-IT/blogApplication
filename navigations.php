<?php
//$files = array_diff(scandir(dirname(__DIR__,1)), array('.', '..'));

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    $files = array("Home", "Sign In", "Sign Up");
} else {
    if ($_SESSION['userType'] && $_SESSION['userType'] === "admin") {
        $files = array("Home", "Add New Post", "Approve Post Categories", "Members List", "Set User Privilege", "Sign Out");
    } elseif ($_SESSION['userType'] && $_SESSION['userType'] === "moderator") {
        $files = array("Home", "Add New Post", "Approve Post Categories", "Sign Out");
    } else {
        $files = array("Home", "Add New Post", "Sign Out");
    }
}
?>
<!--<nav class="navmenu navbar-dark bg-dark">-->
<!--<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top scrolling-navbar">-->
<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark scrolling-navbar">
    <div class="container">

<!--        <a class="navbar-brand" href="index.php" style='font-size:58px;font-weight:900;color:#63ff34'>S<i-->
<!--                    class='fas fa-blog' style='font-size:58px;color:#ffe709'></i>-->
<!--        </a>-->

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="index.php" target="_blank" style='font-size:58px;font-weight:900;color:#63ff34'>
            S<i class='fas fa-blog' style='font-size:58px;color:#ffe709'></i>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">

                <?php
                $menuLink = "index.php";
                foreach ($files as $file) {
                    if ($file == "Sign In") {
                        $menuLink = "login.php";
                    } elseif ($file == "Sign Up") {
                        $menuLink = "register.php";
                    } elseif ($file == "Sign Out") {
                        $menuLink = "logout.php";
                    } elseif ($file == "Add New Post") {
                        $menuLink = "newpost.php";
                    } elseif ($file == "Approve Post Categories") {
                        $menuLink = "setPostCategory.php";
                    } elseif ($file == "Members List") {
                        $menuLink = "users.php";
                    } elseif ($file == "Set User Privilege") {
                        $menuLink = "userPrivilege.php";
                    }
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link waves-effect" href="<?php echo $menuLink; ?>">
                            <?php echo $file; ?>
                        </a>
                    </li>

                <?php } ?>
            </ul>
            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a href="https://gitlab.com/AliSafari-IT/simple-blogger" class="nav-link border border-light rounded waves-effect"
                       target="_blank" title="Simple Blogger GitHub">
                        <i class="fab fa-github mr-2"></i>SB GitHub
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>