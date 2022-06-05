<?php
require 'functions.php';

if (isset($_POST["register"])) {

	if (registrasi($_POST) > 0) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
			  </script>";
	} else {
		echo mysqli_error($conn);
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Blitz | Daftar</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" href="css/login.css">
</head>

<body>
	<form action="" method="POST">
		<div class="login-page">
			<div class="form">
				<div class="title"><img src="img/logo.png">
					<form class="register-form">
						<input type="text" placeholder="name" name="username" id="username" />
						<input type="password" placeholder="password" name="password" id="password" />
						<input type="password" placeholder="password2" name="password2" id="password2" />
						<button type="submit" name="register">create</button>
						<p class="message">Sudah Terdaftar? <a href="login.php">Sign In</a></p>
					</form>
				</div>
			</div>
		</div>
	</form>
</body>

</html>