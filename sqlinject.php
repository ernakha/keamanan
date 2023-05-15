<?php

session_start();

if (isset($_POST['submit'])) {
    // Mendapatkan input dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Membuat koneksi ke database
    include('config.php');

    // Mencegah SQL injection
    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi, $password);

    // Melakukan query untuk memeriksa apakah username dan password yang diinputkan sesuai
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    // Jika query berhasil dieksekusi
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: produk.php");
        exit;
    } else {
        $error_message = "Username atau password salah";
    }

    mysqli_close($koneksi);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Halaman Login</title>
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

    <div class="login-box">
        <h1>Login Anti SqlInjection</h1>

        <?php if (isset($error_message)) { ?>
            <div><?php echo $error_message; ?></div>
        <?php } ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
    </div>

</body>

</html>