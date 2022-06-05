<?php
session_start();
require 'functions.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

if (isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}


if (isset($_POST["login"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	if (mysqli_num_rows($result) === 1) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {
			// set session
			$_SESSION["login"] = true;

			// cek remember me
			if (isset($_POST['remember'])) {
				// buat cookie
				setcookie('id', $row['id'], time() + 60);
				setcookie('key', hash('sha256', $row['username']), time() + 60);
			}

			header("Location: index.php");
			exit;
		}
	}

	$error = true;
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Blitz | Login</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" href="css/login.css">
</head>

<body>



	<div class="login-page">
		<div class="form">
			<form class="login-form" action="" method="POST">
				<div><img src="img/logo.png"></div>
				<br>
				<input type="text" placeholder="username" name="username" id="username" />
				<input type="password" placeholder="password" name="password" id="password" />
				<button action="submit" name="login">login</button>
				<p class="message">Belum Terdaftar? <a href="registrasi.php">Yuk buat dulu</a></p>
				<br>
				<?php if (isset($error)) : ?>
					<p style="color: red; font-style: italic;">username / password salah</p>
				<?php endif; ?>
			</form>
		</div>
	</div>

</body>

</html>