<?php
// Check if user Logged in with unique id session check
include '../model/restoran.php';
include '../model/user.php';
session_start();

$user = new User();
$restoran = new Restoran();
$data_menu = $restoran->getAllMenu();
$data_user = $user->checkUsername($_SESSION['restoran.uts.username']);

if(!isset($_SESSION['restoran.uts.status']) || $_SESSION['restoran.uts.status'] == ''){
    if($_SESSION['restoran.uts.status'] != 'login'){
        header('location:login.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <?php include '../include/css.php' ?>
    <link rel="stylesheet" href="../include/css/home.css" />
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Restoran UTS IF 430</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="order.php">Order</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a class="nav-item text-nowrap nav-link" href="../controller/user_logout.php">Sign out</a>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="#777" /></svg> -->

                    <img style="object-fit: cover;" src="https://images.pexels.com/photos/326279/pexels-photo-326279.jpeg?cs=srgb&dl=pexels-pixabay-326279.jpg&fm=jpg"/>

                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Be a part of our food family!</h1>
                            <p>Lots of benefits specially for new member.</p>
                            <p><a class="btn btn-lg btn-primary" href="login.php">Sign up today</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="#777" /></svg>

                        <img style="object-fit: cover;" src="https://images.pexels.com/photos/616404/pexels-photo-616404.jpeg?cs=srgb&dl=pexels-lukas-616404.jpg&fm=jpg"/>

                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Fill up your satisfaction</h1>
                            <p>Start ordering today.</p>
                            <p><a class="btn btn-lg btn-primary" href="order.php">Order</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="#777" /></svg>
                    
                        <img style="object-fit: cover;" src="https://images.pexels.com/photos/890507/pexels-photo-890507.jpeg?cs=srgb&dl=pexels-oleg-magni-890507.jpg&fm=jpg"/>

                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>Take a look at our chef's special!</h1>
                            <p>All you have to do is just scroll below.</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div data-aos="fade-down" data-aos-delay="300" class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 fw-normal">Welcome!</h1>
                <p class="lead fw-normal">Let's take a look at our most popular menu!</p>
            </div>
            <div class="product-device shadow-sm d-none d-md-block"></div>
            <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
        </div>

        <!-- Marketing messaging and featurettes
  ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">

            <!-- START THE FEATURETTES -->

            <?php 
            $i = 0;
            foreach($data_menu as $menu) {
                $i++; 
                ?>
            <hr class="featurette-divider">

            <div class="row featurette" data-aos="<?= $i % 2 == 0 ? 'fade-right' : 'fade-left' ?>" data-aos-delay="300">
                <div class="col-md-7 <?= $i % 2 == 0 ? 'order-md-2' : '' ?>">
                    <h2 class="featurette-heading"><?php echo $menu['nama_menu']; ?></h2>
                    <p class="lead"><?= $menu['deskripsi']; ?></p>
                </div>
                <div class="col-md-5 <?= $i % 2 == 0 ? 'order-md-1' : '' ?>">
                    <img src="<?php echo $menu['gambar'] ?>" alt="No Image Found" class="menu-image" width="500" height="500">
                </div>
            </div>
            <?php 
                if($i == 3) break; // Maximum 3 item showcase
            } ?>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


        <!-- FOOTER -->
        <footer class="container">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2021 Universitas Multimedia Nusantara.</p>
        </footer>
    </main>

    <?php include '../include/js.php' ?>
    <script>
    AOS.init();

    $(document).ready(function () {
        $('.btn-add-item').on('click', function () {
            $(this).addClass('d-none');
            $(this).next('.input-group').removeClass('d-none');
            $(this).next('.input-group').find('input[name=quantity]').val(1)
        });

        
    });
    </script>
</body>

</html>