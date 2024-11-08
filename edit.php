<?php
include "config/connection.php";
session_start();
$is_logged = isset($_SESSION["is_logged"]) ? $_SESSION["is_logged"] : false;
if (!$is_logged) {
    echo "<script>alert('You must log in to perform this action');window.location.href='index.php';</script>";
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (isset($_POST["submit"])) {
        $day = isset($_POST['day']) ? trim($_POST['day']) : '';
        $class = isset($_POST['class']) ? trim($_POST['class']) : '';
        $faculty = isset($_POST['faculty']) ? trim($_POST['faculty']) : '';
        $time = isset($_POST['time']) ? trim($_POST['time']) : '';
        $edit = "UPDATE timetable SET faculty='$faculty', class='$class'  WHERE id=$id";
        if ($con->query($edit)) {
            header("Location: index.php");
            exit();
        } else {
            if ($con->errno === 1062) {
                echo "<h4> Time Slot already exists </h4>";
            } else {
                echo "$con->error";
            }
        }
    }
} else {
    echo "<script>alert('No ID specified'); window.location.href='index.php';</script>";
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h1 class="mb-4">Edit Entry</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="day" class="form-label">Day</label>
                <select class="form-select" id="day" name="day">
                    <?php
                    $result = $con->query("SELECT day FROM timetable WHERE id=$id");
                   if ($row = $result->fetch_assoc()) {
                        $currentDay = $row['day'];
                        echo "<option value=\"$currentDay\" selected>$currentDay</option>";
                    }
                    else{
                        echo "<option value=\"\" selected>No day found</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <select class="form-select" id="time" name="time">
                    <?php
                    $result = $con->query("SELECT time FROM timetable WHERE id=$id");
                    if ($row = $result->fetch_assoc()) {
                        $currentTime = $row['time'];
                        echo "<option value=\"$currentTime\" selected>$currentTime</option>";
                    } else {
                        echo "<option value=\"\" selected>No Time found</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="class" class="form-label">Subject</label>
                <select class="form-select" id="class" name="class">
                     <option value="FM">FM</option>
                    <option value="HT">HT</option>
                    <option value="CRE">CRE</option>
                    <option value="MUO">MUO</option>
                    <option value="MUO-Lab">MUO-LAB</option>
                    <option value="HT-Lab">HT-LAB</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="faculty" class="form-label">Faculty</label>
                <select class="form-select" id="faculty" name="faculty">
                    <option value="FM sir">FM sir</option>
                    <option value="HT sir">HT sir</option>
                    <option value="CRE sir">CRE sir</option>
                    <option value="MUO sir">MUO sir</option>
                    <option value="MUO-LAB sir">MUO-LAB sir</option>
                    <option value="HT-LAB sir">HT-LAB sir</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-dark">Submit</button>
        </form> <br>
        <a href="index.php" role="button" class="btn btn-primary">show data</a>
    </div>
</body>

</html>