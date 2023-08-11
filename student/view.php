<?php

include('../conn.php');
    
$userId = $_SESSION['id'];
// Function to get the user's full name from the user_id
function getFullName($conn, $userId) {
    // Replace "users" with your actual user's table name
    $sql = "SELECT * FROM users WHERE id = :userId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user['name'];
}

// Function to display the registration details for a given user
function displayRegistration($conn, $registration) {
    echo '<tr>';
    if (!empty($registration['profile_image']) && file_exists($registration['profile_image'])) {
        // Display the profile image from the database
        echo '<td><img src="' . $registration['profile_image'] . '" alt="Profile Image" style="border-radius: 50%; width: 50px; height: 50px;"></td>';
    } else {
        // Display a default image if profile_image is empty or doesn't exist
        echo '<td><img src="../assets/uploads/default.jpg" alt="Default Profile Image" style="border-radius: 50%; width: 50px; height: 50px;"></td>';
    }    
    echo '<td>' . getFullName($conn, $registration['user_id']) . '</td>';
    echo '<td>' . $registration['RefNum'] . '</td>';
    echo '<td>' . $registration['SemNum'] . '</td>';
    echo '<td>' . $registration['CourseID'] . '</td>';
    echo '<td>' . $registration['Credits'] . '</td>';
    echo '<td>' . $registration['Campus'] . '</td>';
    echo '<td>' . $registration['Room'] . '</td>';
    echo '<td>' . ($registration['Mon'] ? 'Yes' : 'No') . '</td>';
    echo '<td>' . ($registration['Tues'] ? 'Yes' : 'No') . '</td>';
    echo '<td>' . ($registration['Wed'] ? 'Yes' : 'No') . '</td>';
    echo '<td>' . ($registration['Thu'] ? 'Yes' : 'No') . '</td>';
    echo '<td>' . ($registration['Fri'] ? 'Yes' : 'No') . '</td>';
    echo '<td>' . ($registration['Sat'] ? 'Yes' : 'No') . '</td>';
    echo '<td>' . ($registration['Sun'] ? 'Yes' : 'No') . '</td>';
    echo '<td>' . $registration['StartTime'] . '</td>';
    echo '<td>' . $registration['EndTime'] . '</td>';
    echo '<td>' . $registration['Instructor'] . '</td>';
    echo '<td>' . $registration['Grade'] . '</td>';
    echo '<td>' . $registration['Notes'] . '</td>';
    echo '</tr>';
}

function getAllUserRegistrations($conn, $userId) {
    $sql = "SELECT * FROM classes WHERE user_id = :userId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($_SESSION['id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: ../index.php");
    exit;
}

$loggedInUserId = $_SESSION['id']; // Use the user_id from the session

// Get all registrations for the current user
$registrations = getAllUserRegistrations($conn, $loggedInUserId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registrations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:#F0F0F0;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
            border: 1px solid cyan;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        td{
            border: 1px solid black;
        }

    </style>
</head>
<body>
    <h1>View Registrations</h1>
    <table>
        <tr>
            <th>Profile</th>
            <th>Full Name</th>
            <th>RefNum</th>
            <th>SemNum</th>
            <th>CourseID</th>
            <th>Credits</th>
            <th>Campus</th>
            <th>Room</th>
            <th>Mon</th>
            <th>Tues</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
            <th>StartTime</th>
            <th>EndTime</th>
            <th>Instructor</th>
            <th>Grade</th>
            <th>Notes</th>
        </tr>
        <?php
        foreach ($registrations as $registration) {
            displayRegistration($conn, $registration);
        }
        ?>
    </table>
    <script src="../assets/js/dropdown.js"></script>
</body>
</html>
