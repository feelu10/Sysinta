<!DOCTYPE html>
<html>
<head>
    <title>Class Information</title>
    <style>
        body {
            background-color: black;
        }

        h2 {
            text-align: center;
            color: #ddd;
            margin-top: 20px;
            font-size: xx-large;
            font-family: Arial, sans-serif;
        
        }

        table {
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto;
            margin-top: 20px;
            background-color: #fff;
            font-size: 12px;
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
        .button-container {
        text-align: center;
        margin-top: 20px;
    }

    .button-container a {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #333;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        text-align: center;
        font-family: Arial, sans-serif;

    }
        
    </style>
</head>
<body>
    <h2>My Class Information</h2>
    <table>
        <tr>
            <th>Semester</th>
            <th>Course ID</th>
            <th>Instructor</th>
            <th>Reference Number</th>
        </tr>

        <?php
        // Replace these variables with your database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "academicsDB";

        try {
            // Create a connection to the database using PDO
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL query
            $sql = "SELECT `SemNum`, `CourseID`, `Instructor`, `RefNum`
                    FROM `Classes`
                    WHERE `SemNum` >= 32022
                    ORDER BY `SemNum`";

            $stmt = $conn->query($sql);

            if ($stmt !== false) {
                if ($stmt->rowCount() > 0) {
                    // Output data of each row
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row["SemNum"] . "</td>";
                        echo "<td>" . $row["CourseID"] . "</td>";
                        echo "<td>" . $row["Instructor"] . "</td>";
                        echo "<td>" . $row["RefNum"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Error executing the query</td></tr>";
            }

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>

    </table>
    <div class="button-container">
        <a href="homepage.php">Back</a>
        <a href="courses2.php">Next</a>
    </div>
</body>
</html>
