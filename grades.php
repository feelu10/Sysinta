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
    .button-container button {
        padding: 10px 20px;
        font-size: 16px;
        background-color: grey;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        text-align: center;
        font-family: Arial, sans-serif;
        margin: 0 5px; /* Adding some spacing between buttons */
    }
        
    </style>
</head>
<body>
    <h2>My Grades</h2>
    <table id="gradesTable">
        <tr>
            <th>Course ID</th>
            <th>Grade</th>
        </tr>
    </table>
    <div class="button-container">
        <button onclick="previousGrade()">Previous</button>
        <button onclick="nextGrade()">Next</button>
    </div>

    <script>
        // JavaScript to control dynamic display of grades
        var grades = <?php
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
                $sql = "SELECT CourseID, Grade FROM Classes ORDER BY CourseID";

                $stmt = $conn->query($sql);
                $grades = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode($grades);
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>;
        
        var currentGradeIndex = -1;

        function displayGrade(index) {
            var table = document.getElementById("gradesTable");
            if (index >= 0 && index < grades.length) {
                var row = table.insertRow();
                var courseIDCell = row.insertCell(0);
                var gradeCell = row.insertCell(1);
                courseIDCell.innerHTML = grades[index]['CourseID'];
                gradeCell.innerHTML = grades[index]['Grade'];
            }
        }

        function clearTable() {
            var table = document.getElementById("gradesTable");
            while (table.rows.length > 1) {
                table.deleteRow(1);
            }
        }

        function nextGrade() {
            clearTable();
            currentGradeIndex++;
            if (currentGradeIndex >= grades.length) {
                currentGradeIndex = 0;
            }
            displayGrade(currentGradeIndex);
        }

        function previousGrade() {
            clearTable();
            currentGradeIndex--;
            if (currentGradeIndex < 0) {
                currentGradeIndex = grades.length - 1;
            }
            displayGrade(currentGradeIndex);
        }
        
        
    

        // Display the first grade on page load
        nextGrade();
    </script>
</body>
</html>
