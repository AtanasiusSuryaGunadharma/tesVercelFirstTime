<?php
session_start();

// detail yang akan ditampilkan di halaman ini
// contoh: %detail["name"] akan menampilkan nama  hotel 
$detail = [
    "name" => "Atma Kitchen",
    "tagline" => "Restaurant & Bar",
    "page_title" => "Atma Kitchen Restaurant & Bar",
    "logo" => "assets/images/HatCook.png",
    "user" => " Surya/220711667"
];

// gambar yang akan ditampilkan di carousel (menggunakan foreach)
$gambar = [
    "./assets/images/c3.jpg",
    "./assets/images/c2.jpg",
    "./assets/images/c1.jpg"
];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title><?php echo $detail["page_title"]; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--Icon tab -->
    <link rel="icon" href="<?php echo $detail["logo"]; ?>" type="image/x-icon" />

    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />

    <!-- Poppins dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="./assets/css/poppins.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <header class="fixed-top" id="navbar">
        <nav class="container d-flex justify-content-between align-items-center py-2">

            <a href="./" class="rounded py-2 px-3 d-flex align-items-center nav-home-btn " style="background-color: #EE4D2D;">
                <img src="<?php echo $detail['logo']; ?>" class="crown-logo" />
                <div>
                    <p class="mb-0 fs-5 fw-bold text-"><?php echo $detail['name']; ?></p>
                    <p class="small mb-0"><?php echo $detail['tagline']; ?></p>
                </div>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="#" class="nav-link active text-white" aria-current="page" style="background-color: #EE4D2D;">Home</a>
                </li>
                <li class="nav-item ms-3">
                    <a href="./login.php" class="nav-link" style="color: #EE4D2D;">Admin Login</a>
                </li>
            </ul>

        </nav>
    </header>


    <main>
        <!-- Carousel -->
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                
            <?php foreach($gambar as $i => $gbr){
                //Foreach untuk menampilkan indikator
            ?>
                <button
                    type="button"
                    data-bs-target="#myCarousel"
                    data-bs-slide-to="<?php echo $i; ?>"
                    class="<?php echo $i === 0 ? "active" : ""; ?>"
                    aria-label="Slide <?php echo $i + 1; ?>"></button>
            <?php } ?>

            </div>
            <div class="carousel-inner">

                <?php foreach($gambar as $i => $gbr){
                    //Foreach untuk menampilkan gambar
                ?>
                    <div class="carousel-item <?php echo $i === 0 ? "active" : ""; ?>">
                    <img 
                        src="<?php echo $gbr; ?>"
                        class="carousel-img"
                        role="img"
                        aria-label="Gambar ke-<?php echo ($i + 1); ?>"
                        focusable="false"/>
                    </div>
                <?php } ?>

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

        <div class="container ">
        
            <!-- Featurettes -->
            <div class="row featurette" style="background-image: url('./assets/images/employee.jpg');
                        background-size: cover; background-position: center; padding: 20px; border-radius: 8px;">
                <div class="col-md-7 offset-md-5" style="background-color: rgba(0, 0, 0, 0.6); padding: 10px 20px; 
                            border-radius: 12px; color: white; display: flex; align-items: center;">
                    <div>
                        <h2 class="featurette-heading fw-normal">
                            Restauran dengan cita rasa <strong>yang fantastis</strong>.
                        </h2>
                        <p class="lead">
                            Diciptakan oleh <strong>[Atanasius Surya Gunadharma]</strong>,
                            mahasiswa Universitas Atma Jaya Yogyakarta dari program studi informatika.
                        </P>
                        <p class="lead">Nomor Pokok Mahasiswa: <strong>[220711667]</strong>.</p>
                    </div>
             </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette" style="background-image: url('./assets/images/food.jpg');
                    background-size: cover; background-position: center; padding: 20px; padding-top: 10;border-radius: 8px;">
            <div class="col-md-7" style="background-color: rgba(0, 0, 0, 0.6); padding: 20px; border-radius: 12px; color: white;">
                <h2 class="featurette-heading fw-normal">
                    Your taste is our priority, <strong>indulge in the vibrant flavors of our restaurant & bar</strong>.
                </h2>

                <p class="lead">
                    Our sophisticated dining space is designed to elevate your experience with a curated selection of exquisite dishes,
                    handcrafted cocktails, and a warm ambiance perfect for any occasion.
                </P>

            </div>
        </div>

    <!-- FOOTER -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-body-light">© 2024 <?php echo $detail["name"], $detail["user"]; ?></span>
            </div>
        </footer>
    </div>
    </main>

    <!-- Bootstrap JS 5.3 JS-->
    <script src="./assets/js/bootstrap.min.js"></script>

    <!-- Custom JS untuk Navbar -->
    <script src="assets/js/home-nav.js"></script>
</body>

</html>