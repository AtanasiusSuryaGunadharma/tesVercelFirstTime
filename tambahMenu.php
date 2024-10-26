<?php
session_start();

if (!isset($_SESSION["menu_list"])) {
    $_SESSION["menu_list"] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $menu = $_POST['menu'];
    $price = $_POST['price'];
    $notes = $_POST['notes'];

    if (empty($date) || empty($menu) || empty($price) || empty($notes)) {
        echo "<script>alert('Please fill out all fields.'); window.history.back();</script>";
        exit;
    }

    $formatted_date = date('l, d F Y', strtotime($date));

    $image_path = "./assets/images/"; 
    $image_file = $image_path . strtolower(str_replace(' ', '', $menu)) . ".jpg"; 

    if (!file_exists($image_file)) {
        $image_file = $image_path . "default.jpg"; 
    }

    $newMenu = [
        'name' => $menu,
        'price' => $price,
        'notes' => $notes,
        'date' => $date,
        'formatted_date' => $formatted_date,
        'image' => $image_file 
    ];

    $_SESSION["menu_list"][] = $newMenu;

    $menu_name = $newMenu['name'];
    $_SESSION["success"] = "Berhasil menyimpan reservasi untuk {$menu_name}";
    $_SESSION["activity_log"]["menambah"]++;
    header("Location: dashboard.php");
    exit;
}

$detail = [
    "name" => "Atma Kitchen",
    "tagline" => "Restaurant & Bar",
    "page_title" => "Atma Kitchen Restaurant & Co",
    "logo" => "./assets/images/HatCook.png",
    "user" => " Surya/220711667"
];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Tambah Menu</title>
    <link rel="stylesheet" href="./assets/css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Icon tab -->
    <link rel="icon" href="<?php echo $detail['logo']; ?>" type="image/x-icon"/>

    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <!-- Poopins dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="./assets/css/poppins.min.css" rel="stylesheet">
</head>

<body>
    <header class="fixed-top scrolled" id="navbar">
        <nav class="container nav-top py-2">
            <a href="./" class="rounded py-2 px-3 d-flex align-items-center nav-home-btn " style="background-color: #EE4D2D;">
                <img src="<?php echo $detail['logo']; ?>" class="crown-logo"/>
                <div>
                    <p class="mb-0 fs-5 fw-bold text-"><?php echo $detail['name']; ?></p>
                    <p class="small mb-0 text-white"><?php echo $detail['tagline']; ?></p>
                </div>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item ">
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
        <div class="container mt-5">
            <h1 class="text-muted"><strong> Tambah Menu</strong></h1>

            <hr class="text-muted" style="border-top: 3px solid #ccc;"/>

            <form action="tambahMenu.php" method="post">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="date" class="form-label">Tanggal Pemesanan</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="date" name="date" placeholder="mm/dd/yyyy" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="menu" class="form-label">Menu yang Dipesan</label>
                    </div>
                    <div class="col-sm-9">
                        <select class="form-control" id="menu" name="menu" required>
                            <option value=""disabled selected hidden>Pilih Menu Paket</option>
                            <option value="Paket 1">Paket 1</option>
                            <option value="Paket 2">Paket 2</option>
                            <option value="Paket 3">Paket 3</option>
                            <option value="Paket 4">Paket 4</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="price" class="form-label">Biaya Pemesanan (Rp)</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="price" name="price" placeholder="Biaya Pemesanan (Rp)" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="notes" class="form-label">Catatan Menu</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="notes" name="notes" placeholder="catatanMenu" required></textarea>
                    </div>
                </div>

                <div class="text-start">
                    <button type="submit" class="btn btn-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                            <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z"/>
                            <path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z"/>
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Bootstrap 5.3 JS-->
    <script src="./assets/js/bootstrap.min.js"></script>
    
    <style>
        .btn-orange {
            background-color: #EE4D2D;
            color: white;
        }

        .btn-orange:hover {
            background-color: #d94428;
        }

        hr.text-muted {
            margin-top: 0;
            border-width: 2px; 
        }

        .row {
            display: flex;
            align-items: center;
        }

        .col-sm-3 {
            padding-right: 15px;
        }

        .col-sm-9 {
            padding-left: 0;
        }

        .form-control {
            box-shadow: none;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .text-start {
            text-align: left;
        }

        h1.text-muted {
            color: #6c757d;
        }
    </style>
</body>

</html>


