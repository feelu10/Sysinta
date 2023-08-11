<?php
include('connection.php');

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
$stmt->execute([$email]); // Changed here
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['message'] = "Incorrect email or password";
    $_SESSION['message_type'] = "error";
    header("Location: index.php");
    exit();
}

// Logged in successfully
$_SESSION['email'] = $user['email'];
$_SESSION['role'] = $user['role'];

if ($user['role'] == 'admin') {
    header("Location: admin/dashboard.php");
} else {
    header("Location: student/dashboard.php");
}
exit();
?>
