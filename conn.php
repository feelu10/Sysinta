<?php

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Connecting to your database, replace with your details
$host = "localhost";
$db_name = "academics";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // SQL Query to get users
 $sql = "SELECT * FROM users";
 $stmt = $conn->prepare($sql);
 $stmt->execute();

 // Fetch all users
 $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
 // Iterate over the users array and generate select options

?>