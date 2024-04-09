<?php
session_start();

// Check if the user is logged in
// if (!array_key_exists('is_logged_in', $_SESSION) || !$_SESSION['is_logged_in']) {
//     header('Location: sign-in.php');
//     exit;
// }

// // Check the user's role
// if ($_SESSION['role'] == 'project') {
//     header('Location: profile.php');
//     die('You are not an authorized user');
// }

require 'classes/Database.php';
require 'classes/WdEmployeeData.php';

// Create a new instance of the Database class
$conn = new Database;
$conn = $conn->connectDB();

$data = WdEmployee::getAll($conn);

// Check if data is empty or not an array
if (empty($data) || !is_array($data)) {
    die('No data available or an error occurred.');
}

// Set the maximum execution time to unlimited and disable the memory limit
set_time_limit(0);
ini_set('memory_limit', '-1');

// Sanitize the data before outputting it to CSV
function sanitize($data) {
    return str_replace(array("\r", "\n", "\t", ''), '', $data);
}

// Create a file handle for the CSV file
$fh = fopen('php://temp', 'w');

// Get the column names from the first row of the data
$columns = array_keys($data[0]);

// Sanitize the column names
$columns = array_map('sanitize', $columns);

// Write the column names to the CSV file
fputcsv($fh, $columns);

// Loop through the data and add each row to the CSV file
foreach ($data as $row) {
    $row = array_map("sanitize", $row);
    fputcsv($fh, $row);
}

// Set the header for the CSV file download with a dynamic file name
$timestamp = date("ymd_his");
// Generate a unique filename with the timestamp
$filename = "employeeRecord" . $timestamp . ".csv";

// Set the headers for the CSV file download
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");

// Send the CSV file to the user and exit
rewind($fh);
fpassthru($fh);
exit;
?>
