<?php
session_start();
include('../connection.php');

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();
// Assuming 'classes' table has a column 'user_id' which corresponds to 'user_id' from 'users' table
$stmt = $pdo->prepare('SELECT * FROM classes WHERE user_id = ?');
$stmt->execute([$user['user_id']]);
$classes = $stmt->fetchAll();

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['message'] = "Incorrect email or password";
    $_SESSION['message_type'] = "error";
    header("Location: ../index.php");
    exit();
}


// Set the 'logged_in' session variable to true after successful authentication
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['id'] = $user['id'];
$_SESSION['email'] = $user['email'];
$_SESSION['role'] = $user['role'];

if ($user['role'] == 'admin') {
    $_SESSION['message'] = 'Successfully logged in!';
    $_SESSION['message_type'] = 'success';
    header("Location: ../admin/dashboard.php?faculty=home");
} else {
    $_SESSION['message'] = 'Successfully logged in!';
    $_SESSION['message_type'] = 'success';
    // Assuming you want to pass the 'classes' data to the student dashboard
    $_SESSION['classes'] = $classes;
    header("Location: ../student/dashboard.php?students=home");
}
exit();
?>
