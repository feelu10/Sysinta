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

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs and validate semester
    $userId = filter_input(INPUT_POST, 'users', FILTER_SANITIZE_NUMBER_INT);
    $semester = filter_input(INPUT_POST, 'semester', FILTER_SANITIZE_NUMBER_INT);
    $campus = filter_input(INPUT_POST, 'campus', FILTER_SANITIZE_STRING);
    $credits = filter_input(INPUT_POST, 'credits', FILTER_SANITIZE_NUMBER_INT);
    $courseID = filter_input(INPUT_POST, 'courseID', FILTER_SANITIZE_STRING);
    $room = filter_input(INPUT_POST, 'room', FILTER_SANITIZE_STRING);
    $startTime = filter_input(INPUT_POST, 'startTime', FILTER_SANITIZE_STRING);
    $endTime = filter_input(INPUT_POST, 'endTime', FILTER_SANITIZE_STRING);
    $instructor = filter_input(INPUT_POST, 'instructor', FILTER_SANITIZE_STRING);
    $grade = filter_input(INPUT_POST, 'grade', FILTER_SANITIZE_STRING);
    $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
    
    // Handling checkboxes for weekdays
    $weekdays = ['Mon' => null, 'Tues' => null, 'Wed' => null, 'Thu' => null, 'Fri' => null, 'Sat' => null, 'Sun' => null];
    foreach ($_POST['days'] as $day) {
        if(array_key_exists(ucfirst($day), $weekdays)) {
            $weekdays[ucfirst($day)] = 'Yes';
        }
    }
    
    // Validation for semester
    $currentYear = date('Y');  // 'Y' will return the full year
    $semester = $semester . substr($currentYear, 2); // concatenate semester and last two digits of the current year



    // SQL Query
    $sql = "INSERT INTO classes (user_id, SemNum, CourseID, Credits, Campus, Room, Mon, Tues, Wed, Thu, Fri, Sat, Sun, StartTime, EndTime, Instructor, Grade, Notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $semester, $courseID, $credits, $campus, $room, $weekdays['Mon'], $weekdays['Tues'], $weekdays['Wed'], $weekdays['Thu'], $weekdays['Fri'], $weekdays['Sat'], $weekdays['Sun'], $startTime, $endTime, $instructor, $grade, $notes]);
        $_SESSION['message_type'] = "success";
        $_SESSION['message'] = "New record created successfully";
        header("Location: dashboard.php?faculty=addcourse");
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>
