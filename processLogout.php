<?php
session_start();

if(isset($_SESSION["user"]["bukti_ngantor"])) {
    // hapus bukti sedang ngantor menggunakan fungsi unlink()
    unlink($_SESSION["user"]["bukti_ngantor"]);
}

// Hapus session user
session_destroy();

// Redirect ke halaman login
header("Location: ./login.php");
