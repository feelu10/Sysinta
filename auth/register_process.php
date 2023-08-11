<?php
include('../connection.php');

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

if (!isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['role'])) {
    // one or more values are not set, redirect user back to registration page
    $_SESSION['message'] = 'Please fill in all fields';
    $_SESSION['message_type'] = 'error';
    header('Location: ../index.php');
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();
if ($user) {
    $_SESSION['message'] = 'Email already taken';
    $_SESSION['message_type'] = 'error';
    header('Location: ../index.php');
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
$stmt->execute([$name, $email, $hashed_password, $role]);

$_SESSION['message'] = 'User registered successfully';
$_SESSION['message_type'] = 'success';
header('Location: ../index.php');
exit();
?>
