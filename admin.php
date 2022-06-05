<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// pagination
// konfigurasi
$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM produk"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$mahasiswa = query("SELECT * FROM produk LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if (isset($_POST["cari"])) {
	$mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Halaman Admin</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<a href="logout.php">Logout</a>
	<br>

	<a href="tambah.php">Tambah data Produk</a>
	<br><br>

	<form action="" method="post">

		<input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">
		<button type="submit" name="cari">Cari!</button>

	</form>
	<br><br>

	<!-- navigasi -->
	<a href="?halaman=1">awal</a>

	<?php if ($halamanAktif > 1) : ?>
		<a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
	<?php endif; ?>

	<?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
		<?php if ($i == $halamanAktif) : ?>
			<a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
		<?php else : ?>
			<a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
		<?php endif; ?>
	<?php endfor; ?>

	<?php if ($halamanAktif < $jumlahHalaman) : ?>
		<a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
	<?php endif; ?>

	<a href="?halaman=<?= $jumlahHalaman; ?>">akhir</a>

	<br>
	<table border="1" cellpadding="10" cellspacing="0">

		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Gambar</th>
			<th>Nama</th>
			<th>stok</th>
			<th>harga</th>
		</tr>

		<?php $i = 1; ?>
		<?php foreach ($mahasiswa as $row) : ?>
			<tr>
				<td><?= $i; ?></td>
				<td>
					<a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
					<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
				</td>
				<td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
				<td><?= $row["nmproduk"]; ?></td>
				<td><?= $row["stok"]; ?></td>
				<td><?= $row["harga"]; ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach; ?>

	</table>

</body>

</html>