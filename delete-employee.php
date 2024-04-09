<?php

session_start();
require "classes/Database.php";
require "classes/WdEmployeeData.php";
require "classes/GdEmployeeData.php";
require "includes/header.php";

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true) {
    header('Location: login.php');
    exit;
}

$database = new Database;
$conn = $database->connectDB();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $delete = new WdEmployee;
    $id = $_POST['id'];
    $deleted = $delete->deleteOne($conn , $id);
    header("Location: Wd-Employees.php");
}