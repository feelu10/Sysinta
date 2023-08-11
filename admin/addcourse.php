<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academics";

    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE role = 'student'");

    // Execute the SQL statement
    $stmt->execute();

    // Fetch all users as an associative array
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);


$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Your custom CSS styles go here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f8f8f8;
        }
        h1 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }
        form {
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 2px;
        }
        select, input[type="time"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        select[multiple] {
            height: 120px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        .radio-group {
            display: flex;
            align-items: center;
        }
        input[type="submit"] {
            display: block;
            margin: 0 auto;
            background-color: #8371fd;
            color: white;
            border: none;
            padding: 12px 50px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; 
        }
        input[type="submit"]:hover {
            background-color: #292450;
        }
    </style>
</head>
<body>
<h1>Course Registration</h1>
<form action="addcourse_process.php" method="post">
    <label for="users">Choose a user:</label><br>
    <select id="users" name="users" required>
    <?php
    foreach ($users as $user) {
        echo '<option value="'.$user['id'].'">'.$user['name'].'</option>';
    }
     ?>
    </select><br>
    <label for="semester">Choose a semester:</label><br>
    <select id="semester" name="semester" required>
        <option value="120">1st semester</option>
        <option value="220">2nd semester</option>
        <option value="320">3rd semester</option>
    </select><br>

    <label for="campus">Choose a campus:</label><br>
    <select id="campus" name="campus" required>
        <option value="Main">Main</option>
        <option value="Sub-Station">Sub-Station</option>
        <option value="Online">Online</option>
    </select><br>

    <label for="credits">Credits:</label><br>
    <select id="credits" name="credits" required>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select><br>

    <label for="courseID">Course ID:</label><br>
    <select id="courseID" name="courseID" required>
    </select><br>

    <label for="room">Rooms:</label><br>
    <select id="room" name="room" required>
        <option value="sample1">sample1</option>
        <option value="sample2">sample2</option>
        <option value="sample3">sample3</option>
    </select><br>
    
    <div style="display:inline-flex;margin:1rem auto; padding:1rem .5rem;border:1px solid gray; border-radius:4px;">
        <label for="weekdays">Days:</label>
    <input type="checkbox" id="mon" name="days[]" value="mon">
    <label for="mon">Mon</label><br>
    <input type="checkbox" id="tues" name="days[]" value="tues">
    <label for="tues">Tues</label><br>
    <input type="checkbox" id="wed" name="days[]" value="wed">
    <label for="wed">Wed</label><br>
    <input type="checkbox" id="thu" name="days[]" value="thu">
    <label for="thu">Thu</label><br>
    <input type="checkbox" id="fri" name="days[]" value="fri">
    <label for="fri">Fri</label><br>
    <input type="checkbox" id="sat" name="days[]" value="sat">
    <label for="sat">Sat</label><br>
    <input type="checkbox" id="sun" name="days[]" value="sun">
    <label for="sun">Sun</label><br>
    </div>

    <label for="startTime">Start Time:</label><br>
    <input type="time" id="startTime" name="startTime" required><br>

    <label for="endTime">End Time:</label><br>
    <input type="time" id="endTime" name="endTime" required><br>

    <label for="instructor">Instructor:</label><br>
    <select id="instructor" name="instructor" required>
        <option value="Lebron James">Lebron James</option>
        <option value="Stephen Curry">Stephen Curry</option>
        <option value="Michael Jordan">Michael Jordan</option>
    </select><br>

    <label for="grade">Grade:</label><br>
    <select id="grade" name="grade" required>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select><br>

    <label for="notes">Notes:</label><br>
    <textarea id="notes" name="notes"></textarea><br>

    <input type="submit" name="submit" value="Submit">
</form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/dropdown.js"></script>
</body>
</html>