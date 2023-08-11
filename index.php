<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $_SESSION['message'] = "You Cant access this page!";
    $_SESSION['message_type'] = "info";

    // Redirect based on user role
    if ($_SESSION['role'] == 'student') {
        header("Location: student/dashboard.php");
    } elseif ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
    }
    exit();
}

$isAdmin = false;

// Replace 'your_db_connection' with the actual code to establish a database connection
$connection = mysqli_connect('localhost', 'root', '', 'academics');

if ($connection) {
    // Replace 'your_users_table' with the actual name of your users table
    $query = "SELECT COUNT(*) AS count FROM users WHERE role = 'admin'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row['count'] > 0) {
            $isAdmin = true;
        }
    }

    mysqli_close($connection);
}

$message = $_GET['message'] ?? null;
$type = $_GET['type'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in & Sign up Form</title>
    <link rel="stylesheet" href="assets/css/login.css"/>
    <link rel="stylesheet" href="assets/css/msg.css">
  <style>
.image-container {
    height: 15vh;  
    width: 100%;
    overflow: hidden; 
    display: flex;
    justify-content: center;  
    align-items: center;  
    background-color: #e4a7ff;
}
.full-width {
    width: 100%;
    height: auto;
}
    </style>
  </head>
  <body>
      <div class="image-container">
        <img src="assets/img/header.jpg" alt="PCC Banner" class="full-width" style="width: 50%;">
      </div>
    <main>
      <div class="box">
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
            if (isset($_SESSION['message'])): 
            ?>
            <div class="message <?= $_SESSION['message_type'] === 'info' ? 'info' : 'eror' ?>"> 
              <?= $_SESSION['message'] ?>
            </div>
            <?php 
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            endif; 
          ?>
          <?php
            if ($message && $type) {
                echo "<div class='message " . ($type === 'success' ? 'success' : '') . "'>{$message}</div>";
            }
            ?>
            
        <div class="inner-box">
          <div class="forms-wrap">
          <form action="auth/login_process.php" method="post" autocomplete="off" class="sign-in-form">
              <div class="logo">
                <img src="assets/img/logo-main.png" alt="SYSINTA" />
                <h4>SYSINTA</h4>
              </div>

              <div class="heading">
                <h2>Welcome Back</h2>
                <h6>Not registred yet?</h6>
                <a href="#" class="toggle">Sign up</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="email"
                    name="email"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    name="password"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Password</label>
                </div>
                <input type="submit" value="Sign In" class="sign-btn" />
              </div>
            </form>

            <form action="auth/register_process.php" method="post" autocomplete="off" class="sign-up-form">
              <div class="logo">
                <img src="assets/img/logo-main.png" alt="SYSINTA" />
                <h4>SYSINTA</h4>
              </div>

              <div class="heading">
                <h2>Get Started</h2>
                <h6>Already have an account?</h6>
                <a href="#" class="toggle">Sign in</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="name"
                    required
                  />
                  <label>Fullname</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="email"
                    class="input-field"
                    autocomplete="off"
                    name="email"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="password"
                    required
                  />
                  <label>Password</label>
                </div>


                <div class="input-wrap" id="roleSelection">
    <?php if (!$isAdmin): ?>
        <select id="role" name="role">
            <option value="student">Student</option>
            <option value="admin">Admin</option>
        </select>
    <?php else: ?>
        <input type="hidden" id="role" name="role" value="student">
    <?php endif; ?>
</div>

                <input type="submit" value="Sign Up" class="sign-btn" />

              </div>
            </form>
          </div>
         
          <div class="carousel">
            <div class="images-wrapper">
              <img src="assets/img/image1.png" class="image img-1 show" alt="" />
              <img src="assets/img/image2.png" class="image img-2" alt="" />
              <img src="assets/img/image3.png" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Get your own course</h2>
                  <h2>Learn anytime anywhere!</h2>
                  <h2>Manage your course progress</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php
    echo '<style>';
    echo 'footer{
      background-color:#e4a7ff;
      text-align:center;
    }
    .footer .social-media-icons a {
      margin: 0 10px;
      text-decoration: none;
      color: red;
    } ';
    echo '</div>';
    include('footer.php');
    ?>
    <!-- Javascript file -->
    <script>
  // Function to handle the role selection based on whether admin exists or not
  function handleRoleSelection() {
    var roleSelection = document.getElementById('roleSelection');
    var roleSelect = document.getElementById('role');
    var isAdmin = <?php echo $isAdmin ? 'true' : 'false'; ?>;

    if (isAdmin) {
      roleSelection.style.display = 'none'; // Hide the role selection div
      // Set the value to 'student' for the hidden input
      roleSelect.value = 'student';
    } else {
      roleSelection.style.display = 'block'; // Show the role selection div
    }
  }

  // Call the function once when the page loads
  handleRoleSelection();
</script>
    <script src="assets/js/login.js"></script>
    <script src="assets/js/msg.js"></script>
  </body>
</html>
