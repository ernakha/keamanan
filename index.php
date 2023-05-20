<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: sans-serif;
			background: url(bg.jpg) no-repeat;
			background-size: cover;
		}

		.login-box {
			width: 320px;
			height: 420px;
			background: #000;
			color: #fff;
			top: 50%;
			left: 50%;
			position: absolute;
			transform: translate(-50%, -50%);
			box-sizing: border-box;
			padding: 70px 30px;
		}

		h1 {
			margin: 0;
			padding: 0 0 20px;
			text-align: center;
			font-size: 22px;
		}

		.login-box label {
			margin: 0;
			padding: 0;
			font-weight: bold;
			display: block;
		}

		.login-box input {
			width: 100%;
			margin-bottom: 20px;
		}

		.login-box input[type="text"],
		.login-box input[type="password"] {
			border: none;
			border-bottom: 1px solid #fff;
			background: transparent;
			outline: none;
			height: 40px;
			color: #fff;
			font-size: 16px;
		}

		.login-box input[type="submit"] {
			border: none;
			outline: none;
			height: 40px;
			background: #fb2525;
			color: #fff;
			font-size: 18px;
			border-radius: 20px;
		}

		.login-box input[type="submit"]:hover {
			cursor: pointer;
			background: #ffc107;
			color: #000;
		}
	</style>
</head>

<body>

	<?php
	// Verifikasi login
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		// Koneksi ke database
		include('config.php');

		// Cek username dan password di database
		$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
		$result = $koneksi->query($query);

		if ($result->num_rows > 0) {
			// Login berhasil
			session_start();
			$_SESSION['username'] = $username;
			header('Location: dashboard.php');
			exit;
		} else {
			// Login gagal
			echo '<p>Username atau password salah</p>';
		}

		$conn->close();
	}
	?>

	<div class="login-box">
		<h1>Login</h1>
		<form method="post" action="">
			<label for="username">Username</label>
			<input type="text" id="username" name="username">
			<label for="password">Password</label>
			<input type="password" id="password" name="password">
			<input type="submit" value="Login">
		</form>
	</div>

	<!-- <form method="post" action="">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" required>

		<label for="password">Password</label>
		<input type="password" name="password" id="password" required>

		<input type="submit" value="Login">
	</form> -->

</body>

</html>