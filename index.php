<?php
session_start();
require_once 'tambahbarang.php';
require 'functions.php';

$produk = query("SELECT * FROM produk");

if (isset($_POST["login"])) {

	$username = $_POST["name"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	if (mysqli_num_rows($result) === 1) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {
			// set session
			$_SESSION["login"] = true;
			$_SESSION["username"] = $username;
			$_SESSION["is_admin"] = $row["is_admin"];

			if ($_SESSION['is_admin'] == '0') {
				header("Location:admin.php");
				exit;
			}
			if ($_SESSION['is_admin'] == '1') {
				header("Location:index.php");
				exit;
			}
			exit;
		}
	}

	$error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Blitz Studio</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" type="image/x-icon" href="/img/favicon.ico">
</head>

<body>

	<header>
		<h1 class="logo"><a href="#"><img src="img/logo.png"></a></h1>
		<input type="checkbox" id="nav-toggle" class="nav-toggle">
		<nav>
			<ul>
				<li><a href="#">Home</a></li>
				<?php
				$i = 1;
				$total = 0;
				?>
				<li><a href="cart.php">Cart <span><?php if (!isset($_SESSION['produk'])) : ?><sup>0</sup>
							<?php else : ?>
								<sup><?= count($_SESSION['produk']); ?></sup>
							<?php endif; ?></span></a></li>
				<?php if (!isset($_SESSION["login"])) : ?>
					<li><a href="login.php">Login</a></li>
				<?php endif; ?>
				<?php if (isset($_SESSION["login"])) : ?>
					<li><a href="logout.php">Logout</a></li>
				<?php endif; ?>
			</ul>
		</nav>
		<label for="nav-toggle" class="nav-toggle-label">
			<span></span>
		</label>
	</header>




	<div class="container">
		<!-- banner -->
		<div class="box">
			<div class="banner">
				<img src="img/banner/banner1.jpg">
			</div>
		</div>
		<div class="box">
			<div class="banner">
				<img src="img/banner/banner2.png">
			</div>
		</div>
		<!-- /banner -->

		<!-- produk -->
		<?php foreach ($produk as $row) : ?>
			<form action="" method="POST">
				<div class="image">
					<img class="image__img" src="img/<?= $row["gambar"]; ?>" alt="">
					<div class="image__overlay image__overlay--primary">
						<div class="image__title"><?= $row["nmproduk"]; ?></div>
						<p class="image__description">Stok <?= $row["stok"]; ?></p>
						<p class="image__description">Rp.<?= $row["harga"]; ?></p>
						<br>
						<input type="hidden" name="id" value="<?= $row['id']; ?>">
						<input type="hidden" name="nama" value="<?= $row['nmproduk']; ?>">
						<input type="hidden" name="harga" value="<?= $row['harga']; ?>">
						<input type="hidden" name="stok" value="1">
						<button type="submit" class="button" name="cart" onclick="">
							add to cart
						</button>
						<button type="submit" class="button" name="buy" onclick="">
							Buy now
						</button>
					</div>
				</div>

			</form>
		<?php endforeach; ?>
		<!-- /produk -->
	</div>

</body>

</html>