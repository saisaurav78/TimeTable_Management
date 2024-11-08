<?php
require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();
$username = $_ENV['username'];
$password = $_ENV['password'];
$is_logged = isset($_SESSION["is_logged"]) ? $_SESSION["is_logged"] : false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    $input_password = isset($_POST["password"]) ? trim($_POST["password"]) : '';
    if ($input_username === $username && $input_password === $password) {
        $_SESSION["username"] = $username;
        $_SESSION["is_logged"] = true;
        $is_logged = true;
         echo "<div class='alert alert-success mt-3'>Login Success!</div>";
     if ($is_logged){   
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('password').value = 'admin';
            document.getElementById('username').value = 'admin';
        })
    </script>";}

    }
    else {
        echo "<div class='alert alert-danger mt-3'>Invalid Credentials!</div>";
        $is_logged = false;
        session_unset();
        session_destroy();
    }
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: " . 'login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    </style>
</head>
<body style="overflow:hidden";>
   <header class="bg-success text-white text-center py-5 position-relative">
    <h1 class="mb-0">Login Page</h1>
    <div class="position-absolute top-50 end-0 translate-middle-y d-flex">
        <?php if ($is_logged): ?>
            <a href="?logout" class="btn btn-danger me-2">Logout</a>
        <?php endif; ?>
        <a href="index.php" class="btn btn-primary me-3">Home</a>
    </div>
</header>


    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-secondary p-4 rounded" style="width: 100%; max-width: 400px; margin-bottom:300px;">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label text-white">Username:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" placeholder="username" class="form-control" name="username" id="username" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white">Password:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" placeholder="password" class="form-control" name="password"  id="password" required>
                    </div>
                </div>
               <?php  echo $is_logged? "<button type='submit' disabled name='login' class='btn btn-success w-100'>Login</button>": "<button type='submit' name='login' class='btn btn-success w-100'>login</button>"?>
            </form>
        </div>
    </div>
</body>
<script>
</script>
</html>

