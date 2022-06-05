<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$produk = query("SELECT * FROM produk WHERE id = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

	// cek apakah data berhasil diubah atau tidak
	if (ubah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'index.php';
			</script>
		";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Ubah data mahasiswa</title>
</head>

<body>
	<h1>Ubah data mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $produk["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $produk["gambar"]; ?>">
		<ul>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nmproduk" id="nmproduk" value="<?= $produk["nmproduk"]; ?>">
			</li>
			<li>
				<label for="stok">Stok :</label>
				<input type="text" name="stok" id="stok" value="<?= $produk["stok"]; ?>">
			</li>
			<li>
				<label for="harga">harga :</label>
				<input type="text" name="harga" id="harga" value="<?= $produk["harga"]; ?>">
			</li>
			<li>
				<label for="gambar">Gambar :</label> <br>
				<img src="img/<?= $produk['gambar']; ?>" width="40"> <br>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Ubah Data!</button>
			</li>
		</ul>

	</form>




</body>

</html>