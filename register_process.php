<?php
include('connection.php');

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();
if ($user) {
    $_SESSION['message'] = 'Email already taken';
    $_SESSION['message_type'] = 'error';
    header('Location: index.php');
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
$stmt->execute([$name, $email, $hashed_password]);

$_SESSION['message'] = 'User registered successfully';
$_SESSION['message_type'] = 'success';
header('Location: index.php');
exit();
?>
