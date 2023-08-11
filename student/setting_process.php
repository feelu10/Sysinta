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

    // Fetch the current data for the user
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $user_id]);
    $currentData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Prepare the update statement
    $sql = "UPDATE users SET ";
    $data = [];
    $params = [];

    if (isset($_POST['birthdate']) && $_POST['birthdate'] !== "") {
        $data[] = 'birthdate = :birthdate';
        $params[':birthdate'] = $_POST['birthdate'];
    }

    if (isset($_POST['bio']) && $_POST['bio'] !== "") {
        $data[] = 'bio = :bio';
        $params[':bio'] = $_POST['bio'];
    }

    if (isset($_POST['address']) && $_POST['address'] !== "") {
        $data[] = 'address = :address';
        $params[':address'] = $_POST['address'];
    }

    // Add the WHERE clause
    $sql .= implode(', ', $data) . ' WHERE id = :id';
    $params[':id'] = $user_id;

    // Execute the update
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);

    // hash the password
    if (!empty($_POST['password'])) {
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':password' => $hashedPassword, ':id' => $user_id]);
    }

    // handle the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif']; 
        $filename = $_FILES['image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        $error_message = '';
    
        if (!in_array($filetype, $allowed)) {
            $_SESSION['message'] = 'Invalid file type. Please upload an image file (jpg, jpeg, png, or gif).';
            $_SESSION['message_type'] = 'error';
        } else {
            $destination = '../assets/uploads/' . $filename;
            if(move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                // update the user's image in the database
                $sql = "UPDATE users SET profile_image = :image WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':image' => $destination, ':id' => $user_id]);
            } else {
                $error_message = 'There was a problem uploading your file. Please try again.';
            }
        }
        
        if($error_message != ''){
            // Display the error message to the user
            echo '<div class="alert alert-danger">' . $error_message . '</div>';
        }
    }
    

    $_SESSION['message_type'] = "success";
    $_SESSION['message'] = "User updated successfully";
    header("Location: dashboard.php?students=setting");
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
