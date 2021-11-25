<?php
session_start();
$host = 'localhost';
$user = 'tstingp_zie';
$password = '2207kenzie';
$database = 'tstingp_furniture_website';
$port = '3306';
// $conn = new mysqli($host, $user, $password, $database);
$conn = new mysqli($host, 'root', '', 'furniture_website');
if ($conn->connect_errno) {
    die($conn->connect_error);
}

function alert($message)
{
  echo "<script>alert('$message');</script>";
}