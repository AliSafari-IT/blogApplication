<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="newpost.php"><i class='fas fa-blog'></i> Start Blogging</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php } else {
                    if ($_SESSION['userType'] && ($_SESSION['userType'] === "admin" || $_SESSION['userType'] === "moderator")) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="setPostCategory.php">Modify Other Posts</a>
                        </li>
                    <?php } else if ($_SESSION['userType'] && $_SESSION['userType'] === "admin") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">Members List</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="newpost.php">Add New Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php } ?>
            </ul>
            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons right">
                <li class="nav-item">
                    <a href="https://github.com/AliSafari-IT/blogApplication" class="nav-link waves-effect"
                       target="_blank" title="Simple Blogger GitHub">
                        <i class="fab fa-github mr-2"></i>SB GitHub
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
