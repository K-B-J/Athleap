<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/home.css" rel="stylesheet">
    <link rel="preload" as="image" href="../assets/icons/Home.svg">
    <link rel="preload" as="image" href="../assets/icons/Home selected.svg">
    <link rel="preload" as="image" href="../assets/icons/Yoga.svg">
    <link rel="preload" as="image" href="../assets/icons/Yoga selected.svg">
    <link rel="preload" as="image" href="../assets/icons/Running.svg">
    <link rel="preload" as="image" href="../assets/icons/Running selected.svg">
    <link rel="preload" as="image" href="../assets/icons/Workout.svg">
    <link rel="preload" as="image" href="../assets/icons/Workout selected.svg">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
    }
    ?>
    <nav class="navbar my-navbar">
        <div class="container-fluid" style="justify-content: unset;">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="hamburger fas fa-bars fa-lg"></i>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="color: #707070;">Home</h5>
                    <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <hr class="sidebar-divider" style="color:#707070; margin: 6px 12px;">
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active-link" href="">
                                <div style="height: 40px;">
                                    <img id="homeIcon" src="../assets/icons/Home selected.svg" alt="Home icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Home</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="yoga.php" onmouseover="yoga_hover();" onmouseout="yoga_unhover();">
                                <div style="height: 40px;">
                                    <img id="yogaIcon" src="../assets/icons/Yoga.svg" alt="Yoga icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Yoga</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="running.php" onmouseover="running_hover();" onmouseout="running_unhover();">
                                <div style="height: 40px;">
                                    <img id="runningIcon" src="../assets/icons/Running.svg" alt="Running icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Running</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gym.php" onmouseover="gym_hover();" onmouseout="gym_unhover();">
                                <div style="height: 40px;">
                                    <img id="gymIcon" src="../assets/icons/Gym.svg" alt="Gym icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Gym</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php" onmouseover="shop_hover();" onmouseout="shop_unhover();">
                                <div style="height: 40px;">
                                    <i id="shopIcon" class="shop-icon fas fa-lg fa-shopping-cart"></i>
                                    <span class="sidebar-text" style="vertical-align: middle;">Shop</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <a class="my-brand navbar-brand" href="">Home</a>
            <div style="flex:1;"></div>
            <div class="mr-3">
                <div class="dropdown">
                    <button style="padding-right: 36px !important;" class="my-dropdown btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION["name"]; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid my-3">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" id="caraousel">
                <div class="carousel-item active">
                    <img src="../assets//images/yoga.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block text-light">
                        <h3>Yoga</h3>
                        <h6>"Yoga is Essentially a practioce for your <strong>Soul</strong> working through the medium
                            of
                            your Body" <br>
                            -Tara Fraser</h6>
                    </div>
                </div>
                <div class="carousel-item ">
                    <img src="../assets//images/run.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Running</h3>
                        <h6>"The feeling you get from <strong>Running</strong> is far better than the feeling you get
                            from
                            sitting around wishing you were running" <br>
                            -Sarah Condor</h6>
                    </div>
                </div>
                <div class="carousel-item ">
                    <img src="../assets//images/sport.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Sports</h3>
                        <h6>"Never Say Never because limits, like fears, are often <strong>Illusions</strong> "<br>
                            -Michael Jordan</h6>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="row my-5" id="nav-contents">
    <div class="col-md-3 new-info">
            <div class="card" id="card2">
                <div class="imgBx">
                    <img src="../assets/images/shop.jpg">
                </div>
                <div class="content">
                    <h2><a href="shop.php" class="redir-anchor">Shop</a></h2>
                    <p>
                        Spend your hard earned Fitness Coins here! <br>
                        Your sweat is Rewarded by us<br>
                        because we value your <br>
                        <strong>Fitness!</strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 new-info">
            <div class="card" id="card1">
                <div class="imgBx">
                    <img src="https://wallpaperaccess.com/full/1642690.jpg">
                </div>
                <div class="content">
                    <h2> <a href="yoga.php" class="redir-anchor">Yoga</a> </h2>
                    <p>
                        Yoga is a Flame <br>
                        When you light it up <br>
                        The Glow <br>
                        Never Fades Away!
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 new-info">
            <div class="card" id="card3">
                <div class="imgBx">
                    <img src="https://images.pexels.com/photos/949131/pexels-photo-949131.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500">
                </div>
                <div class="content">
                    <h2><a href="gym.php" class="redir-anchor">Gym</a></h2>
                    <p>
                        Always have a track on your gains!<br>
                        Leave it to us to help you calculate the best course for your Gains.
                        <!-- <strong>Magic</strong> -->
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 new-info">
            <div class="card" id="card4">
                <div class="imgBx">
                    <img src="https://images.unsplash.com/photo-1594882645126-14020914d58d?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cnVubmluZ3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80">
                </div>
                <div class="content">
                    <h2><a href="running.php" class="redir-anchor">Running</a></h2>
                    <p>
                        Running is one of the best athletic activities! <br>
                        It supports mental as well as physical health! <br>
                        Leave it to us to calculate your calorie consumption! <br>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarHover.js"></script>
</body>

</html>