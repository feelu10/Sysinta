<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academics";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // get all users
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $users = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f8;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
            width: auto;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            margin-top: 2rem;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            height: 200px;
            object-fit: cover;
            max-width: 220px;
        }

        .card-body {
            padding: 20px;
        }

        .card-deck {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">All Users</h2>
    <div class="card-deck">
        <?php foreach ($users as $user) : ?>
            <div class="card mb-4" style="width: 18rem;">
                <img src="<?php echo (!empty($user['profile_image'])) ? $user['profile_image'] : '../assets/uploads/default.jpg' ?>" class="card-img-top" alt="<?php echo $user['name'] ?>'s image" style="object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $user['name'] ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
