<?php
session_start();

//untuk mengset waktu agar menyesuaikan daerah asia/jakarta
date_default_timezone_set("Asia/Jakarta");

// kalau user sudah login, arahkan ke halaman dashboard
if (isset($_SESSION["user"])) {
    header("Location: ./dashboard.php");
    exit;
}

// kalau ada $_POST["mencoba_login"], artinya user sudah mengirimkan data login
if (isset($_POST["mencoba_login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // cek apakah username dan password sudah diisi
    if (empty($username) || empty($password)) {
        //kalau belum, set error ke session agar bisa ditampilkan di halaman login
        $_SESSION["error"] = "Username dan password harus diisi!";
        
        // redirect kembali ke halaman login
        header("Location: ./login.php");
        exit;
    }

    // proses bukti sedang ngantor
    if (!isset($_FILES["bukti_ngantor"])) {
        $_SESSION["error"] = "Bukti sedang ngantor harus diisi!";
        header("Location: ./login.php");
        exit;
    }

    // get file dari $_FILES
    $buktiNgantor = $_FILES["bukti_ngantor"];
    $tmpFile = $buktiNgantor["tmp_name"];

    $folderTujuan = "./bukti_ngantor/";
    $namaFile = $buktiNgantor ["name"];
    $alamatFile = $folderTujuan . $namaFile;

    // upload file ke folder tujuan
    if (!move_uploaded_file($tmpFile, $alamatFile)) {
        $_SESSION["error"] = "Gagal mengupload bukti sedang ngantor!";
        header("Location: ./login.php");
        exit;
    }

    // selesai, set session user dan redirect ke halaman dashboard
    $_SESSION["user"] = [
        "username" => $username,
        "password" => $password,
        "bukti_ngantor" => $alamatFile,
        // tambahkan waktu login menggunakan fungsi date()
        "login_at" => date("Y-m-d H:i:s")
    ];  
    header("Location: dashboard.php");
}