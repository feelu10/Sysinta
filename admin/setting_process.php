<?php
session_start();

// check if user is logged in
if (!isset($_SESSION['id'])) {
    die('You must be logged in to update your profile.');
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academics";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sanitize inputs
    $user_id = $_SESSION['id'];
    $newPassword = isset($_POST['password']) ? $_POST['password'] : null;
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
    $bio = isset($_POST['bio']) ? $_POST['bio'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;

    // sql to update user details
    $sql = "UPDATE users SET birthdate = :birthdate, bio = :bio, address = :address WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':birthdate' => $birthdate, ':bio' => $bio, ':address' => $address, ':id' => $user_id]);

    // hash the password
    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':password' => $hashedPassword, ':id' => $user_id]);
    }

    // handle the image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif']; // or whatever file types you want to allow
        $filename = $_FILES['image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if(!in_array($filetype, $allowed)) {
            die('Invalid file type.');
        }

        $destination = '../assets/uploads/' . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        // set image to the saved file path
        $image = $destination;

        $sql = "UPDATE users SET profile_image = :image WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':image' => $image, ':id' => $user_id]);
    }

    $_SESSION['message_type'] = "success";
    $_SESSION['message'] = "User updated successfully";
    header("Location: dashboard.php?faculty=setting");
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
