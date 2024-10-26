<?php
session_start();

if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];

    if (isset($_SESSION['menu_list'][$index])) {
        $menu_name = $_SESSION['menu_list'][$index]['name']; 
        unset($_SESSION['menu_list'][$index]);
        $_SESSION['menu_list'] = array_values($_SESSION['menu_list']); 

        $_SESSION["delete_success"] = "Berhasil menghapus data {$menu_name}.";
        $_SESSION["activity_log"]["menghapus"]++;

        header("Location: dashboard.php");
        exit;
    }
}
?>
