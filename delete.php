<?php

include "config/connection.php";
session_start();

$is_logged = isset($_SESSION["is_logged"]) ? $_SESSION["is_logged"] : false;
if (!$is_logged) {
    echo "<script>alert('You must log in to perform this action');window.location.href='index.php';</script>";
    exit();
}
if (isset($_GET["id"])) {
   
    $id = intval($_GET['id']);
    $delete = "DELETE FROM timetable WHERE id=$id";
    if ($con->query($delete)) {
        header("Location: index.php");
        exit();
    } else {
        echo "an error occured  . $con->error ";
    }

} else {
    echo "<script>alert('No ID specified'); window.location.href='index.php';</script>";
    exit();
}

?>