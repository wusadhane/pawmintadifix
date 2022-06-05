<?php

if (isset($_POST['cart'])) {
    $_SESSION['produk'][$_POST['id']]['id'] = $_POST['id'];
    $_SESSION['produk'][$_POST['id']]['nama'] = $_POST['nama'];
    $_SESSION['produk'][$_POST['id']]['harga'] = $_POST['harga'];
    if (isset($_SESSION['produk'][$_POST['id']]['stok'])) {
        # code...
        $_SESSION['produk'][$_POST['id']]['stok'] += $_POST['stok'];
    } else {
        # code...
        $_SESSION['produk'][$_POST['id']]['stok'] = $_POST['stok'];
    }
}
