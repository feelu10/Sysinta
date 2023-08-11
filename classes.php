<!-- index.php -->

<?php
// Step 1: Replace 'your_hostname', 'your_username', 'your_password', and 'your_database' with your actual database credentials.
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'academics';

try {
    // Step 2: Create a connection to the database using PDO
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Step 3: Retrieve data from the database
    $sql = "SELECT * FROM classes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch data and store it in an array
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Homepage</title>
    
</head>
<style>
    /* styles.css */
body{
    background-color: black;
    height: 100vh;
}
/* Apply styles to the table */
table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #ddd;
  margin-top: 20px;
  font-size: 12px;
}

/* Apply styles to table headers */
th {
  background-color: #555; /* Darker background color for headers */
  border: 1px solid #ddd;
  padding: 8px;
}

/* Apply styles to table data cells */
td {
  border: 1px solid #ddd;
  padding: 6px;
}

/* Add some hover effect to rows */
tr:hover {
  background-color: #f5f5f5;
}

/* Center the table on the page */
.container {
  margin: 0 auto;
  max-width: 1200px;
}
table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #ddd;
  margin-top: 30px;
  font-family: Arial, sans-serif; /* Change the font family */
  background-color: #333; /* Add dark background color */
  color: #fff; /* Change font color to white */
}

/* Apply styles to table headers */
h1{
    text-align: center;
    font-family: Arial, sans-serif;
    color: #ddd;
    
}



/* Add some hover effect to rows */
tr:hover {
  background-color: #444; /* Darker hover color */
}



</style>
<body>

<h1>All Information</h1>
<div class="container">
    <table>
        <tr>
            <th>Reference No</th>
            <th>Semester No</th>
            <th>Course ID</th>
            <th>Credits</th>
            <th>Campus</th>
            <th>Room</th>
            <th>Mon</th>
            <th>Tues</th>
            <th>Wed</th>
            <th>Thurs</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Instructor</th>
            <th>Grade</th>
            <th>Notes</th>

        </tr>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?php echo $item['RefNum']; ?></td>
            <td><?php echo $item['SemNum']; ?></td>
            <td><?php echo $item['CourseID']; ?></td>
            <td><?php echo $item['Credits']; ?></td>
            <td><?php echo $item['Campus']; ?></td>
            <td><?php echo $item['Room']; ?></td>
            <td><?php echo $item['Mon']; ?></td>
            <td><?php echo $item['Tues']; ?></td>
            <td><?php echo $item['Wed']; ?></td>
            <td><?php echo $item['Thurs']; ?></td>
            <td><?php echo $item['Fri']; ?></td>
            <td><?php echo $item['Sat']; ?></td>
            <td><?php echo $item['Sun']; ?></td>
            <td><?php echo $item['StartTime']; ?></td>
            <td><?php echo $item['EndTime']; ?></td>
            <td><?php echo $item['Instructor']; ?></td>
            <td><?php echo $item['Grade']; ?></td>
            <td><?php echo $item['Notes']; ?></td>

        </tr>
        <?php endforeach; ?>
    </table>
    </div>
  
</body>
</html>
