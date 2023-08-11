<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'student') {
    header("Location: ../index.php");
    $_SESSION['message'] = "You can't access this page!";
    $_SESSION['message_type'] = 'error';
    exit();
}
?>
<?php
// Define the list of excluded pages
$excludedPages = [
  'dashboard'
];

// Get the current page from the URL query parameter
$currentPage = isset($_GET['student']) ? $_GET['student'] : '';

// Check if the current page is one of the excluded pages
$hideZCS = in_array($currentPage, $excludedPages);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/msg.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .sidenav {
      height: 100%;
      width: 250px;
      min-width: 50px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #333;
      color: #fff;
      padding-top: 20px;
      transition: width 0.3s ease;
    }

    .sidenav ul {
      list-style: none;
      padding: 0;
    }

    .sidenav li {
      padding: 10px 20px;
    }

    .sidenav li a {
      text-decoration: none;
      color: #fff;
      display: flex;
      align-items: center;
    }

    .sidenav li i {
      margin-right: 10px;
    }

    .main {
      margin-left: 50px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }

    .toggle-btn {
      position: absolute;
      top: 15px;
      font-size: 24px;
      cursor: pointer;
      right: 10px;
    }

    .sidenav-minimized ul {
      display: none;
    }

    /* Hover effect for navigation items */
    .sidenav li a:hover {
      background-color: #444;
    }

    /* Active link indication */
    .sidenav li.active a {
      background-color: #555;
    }
    
  </style>
  <title>Dashboard</title>
</head>
<body>
<?php
    include('../header.php');
  ?>
  <div class="sidenav" id="sidenav">
    <i class="fas fa-bars toggle-btn" onclick="toggleSidenav()"></i>
    <ul>
      <h4 style="margin-left:2rem">Students Dashboard</h4>
      <li><a href="dashboard.php?students=home" onclick="setActive(this)"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="dashboard.php?students=view" onclick="setActive(this)"><i class="fas fa-book"></i> Courses</a></li>
      <li><a href="dashboard.php?students=setting" onclick="setActive(this)"><i class="fas fa-cog"></i> Settings</a></li>
      <li><a href="dashboard.php?students=profiles" onclick="setActive(this)"><i class="fas fa-user-circle"></i> Profiles</a></li>
      <li><a href="../auth/logout.php" onclick="setActive(this)"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
      <!-- Add more menu items as needed -->
    </ul>
  </div>

  <div class="main">
  <?php 
            if (isset($_SESSION['message'])): 
            ?>
            <div class="message <?= $_SESSION['message_type'] === 'success' ? 'success' : '' ?>"> 
              <?= $_SESSION['message'] ?>
            </div>
            <?php 
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            endif; 
          ?>
          <?php
            // Handle dynamic content based on the current page
            if (isset($_GET['students'])) {
              switch ($_GET['students']) {
                case 'home':
                  include('base.php');
                  break;
                case 'view':
                  include('view.php');
                  break;
                case 'setting':
                  include('setting.php');
                  break;
                case 'profiles':
                  include('profiles.php');
                  break;
              }
            }
          ?>  
    </div>
    <div style="text-align:center;">
        <?php
        include('../footer.php')
        ?>
    </div>
  <script>
    function toggleSidenav() {
      const sidenav = document.getElementById('sidenav');
      const main = document.querySelector('.main');
      const toggleBtn = document.querySelector('.toggle-btn');

      if (sidenav.classList.contains('sidenav-minimized')) {
        sidenav.classList.remove('sidenav-minimized');
        sidenav.style.width = '250px';
        main.style.marginLeft = '250px';
        toggleBtn.style.right = '10px';
      } else {
        sidenav.classList.add('sidenav-minimized');
        sidenav.style.width = '50px';
        main.style.marginLeft = '50px';
      }
    }

    function setActive(link) {
      const links = document.querySelectorAll('.sidenav li a');
      links.forEach((item) => {
        item.parentElement.classList.remove('active');
      });
      link.parentElement.classList.add('active');
    }
  </script>
  <script src="../assets/js/msg.js"></script>
</body>
</html>
