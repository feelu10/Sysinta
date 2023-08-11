<!DOCTYPE html>
<html>
<head>
    <title>My PHP Page</title>
    <!-- Add your CSS styles or links to external CSS files here -->
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .header{
            justify-items: center;
            
        }
        #content {
            width: 80%;
            margin: 0 auto;
            padding: 10px;
            display: flex;
            justify-content: center; /* Center the content horizontally */
            align-items: center; /* Center the content vertically */
            height: 68vh; /* Set the height to occupy 70% of the viewport height */
        }
        #content-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #content-buttons button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        footer {
            background-color: #333;
            color: #fff;
            margin: 0px;
            padding: 10px;
            
        }
        a {
            color: white;
            text-decoration: none;
        }
        
    </style>
</head>
<body>
    <div class="header">
        <img src="acad.gif" alt="Unavailable" width="1340px" height="120px" >
    </div>

    <div id="content">
        <!-- Add your main content here -->
        <div id="content-buttons">
            <button><a href="classes.php">All Information</a></button>
            <button><a href="courses.php">Courses</a></button>
            <button><a href="grades.php">My Grades</a></button>
            <button>Link 4</button>
        </div>
    </div>

    <footer>
        <!-- Add your footer content here -->
        <p>&copy; <?php echo date('Y'); ?> Credits to maam Mia Lyn Bungay, ChatGPT, Helpers and myself</p>
    </footer>
</body>
</html>
