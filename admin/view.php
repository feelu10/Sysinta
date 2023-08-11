<?php
include('../conn.php');

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

// Function to get all registrations from the database
function getAllRegistrations($conn, $limit, $offset, $sortBy, $sortOrder) {
    $sql = "SELECT * FROM classes ORDER BY $sortBy $sortOrder LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


$msg = "";
// Filter registrations based on search criteria
// Filter registrations based on search criteria and group them by user
function searchRegistrations($conn, $searchQuery) {
    try {
        $sql = "SELECT * FROM classes
                INNER JOIN users ON classes.user_id = users.id
                WHERE users.name LIKE :searchQuery
                OR classes.CourseID LIKE :searchQuery
                OR classes.RefNum LIKE :searchQuery
                OR classes.SemNum LIKE :searchQuery
                OR classes.Campus LIKE :searchQuery
                OR classes.Room LIKE :searchQuery
                OR classes.Instructor LIKE :searchQuery
                OR classes.Grade LIKE :searchQuery";
        $stmt = $conn->prepare($sql);
        $searchQuery = '%' . $searchQuery . '%';
        $stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_STR);
        $stmt->execute();
        $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Group registrations by user_id
        $groupedRegistrations = array();
        foreach ($registrations as $registration) {
            $userId = $registration['user_id'];
            $groupedRegistrations[$userId][] = $registration;
        }

        return $groupedRegistrations;
    } catch (PDOException $e) {
        // return an error message instead of the registrations
        return "Error: " . $e->getMessage();
    }
}


$defaultSortBy = 'RefNum';
$defaultSortOrder = 'ASC';
$sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : $defaultSortBy;
$sortOrder = isset($_GET['sort_order']) ? $_GET['sort_order'] : $defaultSortOrder;
$validSortColumns = array('RefNum', 'SemNum', 'CourseID', 'Credits', 'Campus', 'Room', 'Instructor', 'Grade');

if (!in_array($sortBy, $validSortColumns)) {
    // Set a default sort column if an invalid one is provided
    $sortBy = $defaultSortBy;
}

if ($sortOrder !== 'ASC' && $sortOrder !== 'DESC') {
    // Set a default sort order if an invalid one is provided
    $sortOrder = $defaultSortOrder;
}


$defaultLimit = 10;
$defaultOffset = 0;

// Get the user-selected limit from the form or use the default value
$limit = isset($_POST['limit']) ? $_POST['limit'] : $defaultLimit;

// Calculate the offset based on the current page and the limit
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $limit;

// Apply the limit and get the registrations
$registrations = getAllRegistrations($conn, $limit, $offset, $sortBy, $sortOrder);

if (isset($_POST['search'])) {
    $searchQuery = $_POST['searchQuery'];
    $groupedRegistrations = searchRegistrations($conn, $searchQuery);
}
if (empty($registrations)) {
    $msg = "No post found";
    $_SESSION['msgType'] = "success";
    unset($_SESSION['msg']); // remove the message from the session
} else {
    $msg = "";
    $msgType = $_SESSION['msgType'] = "error";
    unset($_SESSION['msg']); // remove the message from the session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            padding: 5px 15px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-right: auto;
            padding: 0 4rem;
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
        .message {
            position: fixed;
            top: 15%;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px;
            background-color: red; 
            color: white;
            border-radius: 5px;
            animation: messageAnimation 3s ease-out;
        }

        /* Keyframes for message animation */
        @keyframes messageAnimation {
            0% {
                top: -50px;
                opacity: 0;
            }
            20% {
                top: 15%;
                opacity: 1;
            }
        }
        tr.header-row {
            border-bottom: 3px solid cyan;
        }
        .toggle-btn {
            cursor: pointer;
            color: blue;
        }
        .hidden-table {
            display: none;
        }
        .remove-btn {
            float: right;
            cursor: pointer;
            color: red;
        }
        body{
            padding:0;
            margin:0;
            background-color: white;
        }
        .image-container{
            background-color: white;
        }
        .footer{
            background-color: white;
        }
    </style>
</head>
<body>
    <h1>View Registrations</h1>
    <div class="message" style="<?php echo ($msgType == "success") ? 'display: block' : (($msgType == "error") ? 'display: none' : ''); ?>">
        <?php echo $msg; ?>
    </div>
    <form action="" method="post">
        <input type="text" name="searchQuery" placeholder="Search by name, course, refNum, or semNum">
        <input type="submit" name="search" value="Search">
    </form>
    
        <?php
    if (isset($_POST['search'])) {
        // Display separate tables for each user with the matching search query
        if (is_array($groupedRegistrations)) {
            foreach ($groupedRegistrations as $userId => $registrations) {
                echo '<table>';
                echo '<tr><td colspan="20"><h2 style="text-align:center;">' . getFullName($conn, $userId) . '</h2></td></tr>';
                echo '<tr>
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
                      </tr>';
                foreach ($registrations as $registration) {
                    displayRegistration($conn, $registration);
                }
                echo '</table>';
            }
        } else {
            // Display the error message
            echo '<div class="message" style="display: block">' . $groupedRegistrations . '</div>';
        }
    } else {
        // Display all registrations in a single table
        echo '<table>';
        echo '<tr>
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
              </tr>';
        foreach ($registrations as $registration) {
            displayRegistration($conn, $registration);
        }
        echo '</table>';
    }
    ?>
    <script src="../assets/js/dropdown.js"></script>
</body>
</html>
