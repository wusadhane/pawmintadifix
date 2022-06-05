<?php
session_start();
require_once 'tambahbarang.php';
require 'functions.php';

$produk = query("SELECT * FROM produk");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blitz Studio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
</head>

<body>

    <div class="container">
        <div class="table-title">
            <h3>My Cart</h3>
            <h5><a href="index.php">Home</a></h5>
        </div> <?php
                $i = 1;
                $total = 0;
                ?>

        <table class="table-fill">
            <thead>
                <tr>
                    <th class="text-left">Gambar</th>
                    <th class="text-left">Nama Produk</th>
                    <th class="text-left">Harga</th>
                    <th class="text-left">Qty</th>
                    <th class="text-left">Total</th>
                    <th class="text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-hover">
                <?php if (isset($_SESSION['barang'])) : ?>
                    <?php foreach ($_SESSION['barang'] as $row) : ?>
                        <tr>
                            <td class="text-left"><img class="image__img" src="img/<?= $row["gambar"]; ?>" alt="" width="100"></td>
                            <td class="text-left"><?= $row["nmproduk"]; ?></td>
                            <td class="text-left"><?= $row["harga"]; ?></td>
                            <td class="text-left"><?= $row["stok"]; ?></td>
                            <td class="text-left"><?= number_format($row['stok'] * $row['harga'], 0, ",", "."); ?></td>
                            <td>
                                <a href="?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <button action="submit" name="checkout" class="button"><a href="checkout.php">Check Out</a></button>
</body>

</html>