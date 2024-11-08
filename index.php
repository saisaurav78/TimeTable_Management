<?php
require_once __DIR__ . '/vendor/autoload.php'; // This path should be correct

use Dotenv\Dotenv;

// Load environment variables from the .env file
$dotenv = Dotenv::createImmutable(__DIR__ ); // This should point to the root where .env is located
$dotenv->load();

session_start();
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
$is_logged = isset($_SESSION["is_logged"]) ? $_SESSION["is_logged"] : false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <header class="bg-success text-white text-center py-4 position-relative">
        <h1 class="mb-0">Time Table</h1>
        <a href="login.php" class="btn btn-primary position-absolute end-0 top-50 translate-middle-y me-3">
            <?php if ($is_logged): ?>
                <i class="bi bi-person"> <?php echo htmlspecialchars($username); ?></i>
            <?php else: ?>
                <i class="bi bi-person"> Login</i>
            <?php endif; ?>
        </a>
    </header>

    <div class="container-fluid my-3">
        <form action="" method="post">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Time</th>
                        <th scope="col">Class</th>
                        <th scope="col">Faculty</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "config/connection.php";
                    $result = $con->query("SELECT * FROM timetable order by day");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                    <td>{$row['day']}</td>
                    <td>{$row['time']}</td>
                    <td>{$row['class']}</td>
                    <td>{$row['faculty']}</td>
                    <td><a class='btn btn-warning'  href='edit.php?id={$row['id']}'>Edit</a></td>
                    <td><a class='btn btn-danger' href='delete.php?id={$row['id']}'>Delete</a></td>
                      </tr>";
                    }
                    $con->close();
                    ?>
                </tbody>
            </table>
        </form>

        <a href="create.php" id="addDataBtn" class="btn btn-primary" role="button">Add Data</a>
        <?php echo "<div class='alert alert-warning mt-3 d-none' id='loginAlert'>You must log in to add data!</div>"; ?>

    </div>

    <?php if (!$is_logged): ?>
        <script>
            document.getElementById('addDataBtn').addEventListener('click', function (event) {
                event.preventDefault();
                document.getElementById('loginAlert').classList.remove('d-none');
                setTimeout(() => {
                    document.getElementById('loginAlert').classList.add('d-none');
                }, 3000)
            });
        </script>
    <?php endif; ?>
</body>

</html>