<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION["room_list"])) {
    $_SESSION["room_list"] = [];
}

if (!isset($_SESSION["menu_list"])) {
    $_SESSION["menu_list"] = [];
}

if (!isset($_SESSION["activity_log"])) {
    $_SESSION["activity_log"] = [
        "menambah" => 0,
        "menghapus" => 0,
    ];
}

$detail = [
    "name" => "Atma Kitchen",
    "tagline" => "Restaurant & Bar",
    "page_title" => "Atma Kitchen Restaurant & Co",
    "logo" => "./assets/images/HatCook.png",
    "user" => " Surya/220711667"
];

function formatHarga($harga) {
    return number_format($harga, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $detail["page_title"]; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Icon tab -->
    <link rel="icon" href="<?php echo $detail['logo']; ?>" type="image/x-icon"/>

    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <!-- Poppins Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="./assets/css/poppins.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <style>
        .img-bukti-ngantor {
            width: 100%;
            aspect-ratio: 1/1;
            object-fit: cover;
        }
        .activity-table {
        width: 100%;
        border-collapse: collapse; /* Membuat border kolom terlihat jelas */
        }
        .activity-table th,
        .activity-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd; /* Menambahkan border di setiap kolom dan baris */
        }
        .card-body.equal-height {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .dashboard-section .card-body {
            padding-top: 10px;
        }
        .dashboard-section .card-body p {
            margin-bottom: 5px;
        }
        .menu-item {
            display: flex;
            align-items: flex-start;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
        }
        .menu-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }
        .menu-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .menu-info h1 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .menu-info p {
            color: #6c757d;
            margin: 0;
        }
        .menu-info .price {
            font-weight: bold;
            color: #6c757d;
        }
        .menu-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }
        .menu-footer .btn-danger {
            margin-top: 10px;
        }
        hr {
            margin-top: 3px;
            margin-bottom: 10px;
        }
        .menu-info p:last-of-type {
            margin-top: 7px;
        }
        .dashboard-section {
            margin-bottom: 1rem; 
        }
        .card-body.equal-height {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
    </style>
</head>

<body>
    <header class="fixed-top scrolled" id="navbar">
        <nav class="container nav-top py-2">
            <a href="./" class="rounded py-2 px-3 d-flex align-items-center nav-home-btn" style="background-color: #EE4D2D;">
                <img src="<?php echo $detail['logo']; ?>" class="crown-logo"/>
                <div>
                    <p class="mb-0 fs-5 fw-bold text-"><?php echo $detail['name']; ?></p>
                    <p class="small mb-0 text-white"><?php echo $detail['tagline']; ?></p>
                </div>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="./" class="nav-link" style="color: #EE4D2D;">Home</a>
                </li>
                <li class="nav-item ms-3">
                    <a href="#" class="nav-link active" style="background-color: #EE4D2D;" aria-current="page">Admin Panel</a>
                </li>
                <li class="nav-item">
                    <a href="./processLogout.php" class="nav-link text-danger" style="color: #EE4D2D;">Logout</a>
                </li>
            </ul>
        </nav>
    </header>

    <main style="padding-top: 84px;" class="container">
        <h1 class="text-start mt-5 display-4"><strong>Dashboard</strong></h1>
        <hr class="text-muted" style="border-top: 3px solid #ccc;"/>
        <!-- Success Alert -->
        <?php if (isset($_SESSION["success"])): ?>
            <div class="alert alert-success mb-4 text-start" role="alert">
                <strong>Berhasil!</strong> <?php echo $_SESSION["success"]; ?>
            </div>
            <?php unset($_SESSION["success"]); ?>
        <?php endif; ?>

        <!-- Delete Success Alert -->
        <?php if (isset($_SESSION["delete_success"])): ?>
            <div class="alert alert-success mb-4 text-start" role="alert">
                <strong>Berhasil!</strong> <?php echo $_SESSION["delete_success"]; ?>
            </div>
            <?php unset($_SESSION["delete_success"]); ?>
        <?php endif; ?>

        <div class="row dashboard-section">
            <div class="col-lg-2">
                <div class="card card-body equal-height">
                    <p>Bukti sedang ngantor:</p>
                    <img 
                        src="<?php echo $_SESSION['user']['bukti_ngantor']; ?>" 
                        class="img-fluid rounded img-bukti-ngantor"
                        alt="Bukti ngantor" />
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-body equal-height">
                    <p><strong>Laporan Aktivitas:</strong></p>
                    <table class="activity-table">
                        <tr>
                            <th>Aktivitas</th>
                            <th>Jumlah</th>
                        </tr>
                        <tr>
                            <td>Menambah</td>
                            <td><?php echo $_SESSION["activity_log"]["menambah"]; ?></td>
                        </tr>
                        <tr>
                            <td>Menghapus</td>
                            <td><?php echo $_SESSION["activity_log"]["menghapus"]; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Row Selamat Datang -->
        <div class="row dashboard-section">
            <div class="col-lg-10">
                <div class="card card-body h-100 justify-content-center">
                    <h4>Selamat datang,</h4>
                    <h1 class="fw-bold display-6 mb-3"><?php echo $_SESSION['user']['username']; ?></h1>
                    <p class="mb-0">Kamu sudah login sejak:</p>
                    <p class="fw-bold lead mb-0"><?php echo $_SESSION['user']['login_at']; ?></p>
                </div>
            </div>
        </div>
    </main>

    <div class="container mt-5">
        <h1>Daftar Menu Atma Kitchen</h1>
        <hr class="text-muted" style="border-top: 3px solid #ccc;"/>
        <p>Saat ini terdapat <strong><?php echo count($_SESSION['menu_list']); ?> </strong> Menu yang tersedia.</p>
        <a href="tambahMenu.php" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0"/>
            </svg>
            Tambah Menu
        </a>

        <!-- List of Menus -->
        <?php if (count($_SESSION['menu_list']) > 0): ?>
            <div class="list-group mt-4">
                <?php foreach ($_SESSION['menu_list'] as $index => $menu): ?>
                    <div class="menu-item">
                        <img src="<?php echo $menu['image']; ?>" alt="Menu Image">
                        <div class="menu-info">
                            <h1><?php echo $menu['name']; ?></h1>
                            <p>Catatan: </p>
                            <p><?php echo $menu['notes']; ?></p>
                            <hr class="text-muted" style="border-top: 3px solid #ccc;"/>
                            <p>Tanggal Pemesanan: <strong><?php echo $menu['formatted_date']; ?></strong> - Harga: <span class="price">Rp <?php echo formatHarga($menu['price']); ?></span></p>
                            <div class="menu-footer">
                                <a href="hapusMenu.php?index=<?php echo $index; ?>" class="btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Tidak ada menu tersedia.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="./assets/js/bootstrap.min.js"></script>
</body>

</html>
