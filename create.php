<?php

if (isset($_POST['submit'])) {
    $day = isset($_POST['day']) ? trim($_POST['day']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $faculty = isset($_POST['faculty']) ? trim($_POST['faculty']) : '';
    $time = isset($_POST['time']) ? trim($_POST['time']) : '';
    include "config/connection.php";
    if ($con) {
        if (!empty($day) && !empty($faculty) && !empty($subject) && !empty($time)) {
            $stmt = $con->prepare("INSERT INTO timetable (day, class, faculty,time) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $day, $subject, $faculty, $time);
            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                if ($stmt->errno === 1062) {
                    echo "<h3> Time slot already exists, try different time </h3>";
                } else
                    echo "<br> an error occured: $stmt->error";

            }
            $stmt->close();
        }
    } else {
        echo $con->connect_error;
    }
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Create Entry</h1>
        <form action="create.php" method="post">
            <div class="mb-3">
                <label for="day" class="form-label">Day</label>
                <select class="form-select" id="day" name="day">
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <select class="form-select" id="time" name="time">
                    <option disabled>Morning Session</option>
                    <option value="9-10">9am-10am</option>
                    <option value="10-11">10am-11am</option>
                    <option value="11-12">11am-12pm</option>
                    <option value="12-1">12pm-1pm</option>
                    <option disabled >Afternoon Session</option>
                    <option value="2-3">2pm-3pm</option>
                    <option value="3-4">3pm-4pm</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select class="form-select" id="subject" name="subject">
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
