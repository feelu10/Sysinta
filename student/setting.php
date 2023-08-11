<!DOCTYPE html>
<html>
<body>
<style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        h2{
            text-align: center;
        }

        body {
            background-color: #f6f6f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: white;
            width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            color: white;
            background-color: #5C6BC0;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #3F51B5;
        }
        footer{
            display: none;
        }
        .image-container{
            display: none;
        }
    </style>
<h2>User Update Form</h2>


<form action="setting_process.php" method="post" enctype="multipart/form-data" id="updateForm">
  <label for="password">New Password:</label><br>
  <input type="password" id="password" name="password"><br>
  <label for="image">Profile Image:</label><br>
  <input type="file" id="image" name="image"><br>
  <label for="birthdate">Birthdate:</label><br>
  <input type="date" id="birthdate" name="birthdate"><br>
  <label for="bio">Bio:</label><br>
  <input type="text" id="bio" name="bio"><br>
  <label for="address">Address:</label><br>
  <input type="text" id="address" name="address"><br>
  <input type="submit" value="Submit">
</form> 

<p id="message" style="color: red; text-align: center; display: none;">Please fill at least one field to update.</p>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
document.getElementById("updateForm").addEventListener("submit", function(event) {
  // Check if any of the input fields are filled
  if (!anyFieldFilled()) {
    event.preventDefault(); // Prevent form submission
    document.getElementById("message").style.display = "block";
  } else {
    document.getElementById("message").style.display = "none";
  }
});

function anyFieldFilled() {
  var password = document.getElementById("password").value;
  var image = document.getElementById("image").value;
  var birthdate = document.getElementById("birthdate").value;
  var bio = document.getElementById("bio").value;
  var address = document.getElementById("address").value;

  return (password !== "" || image !== "" || birthdate !== "" || bio !== "" || address !== "");
}

// Attach sweetalert confirmation directly to the form submission
document.getElementById("updateForm").addEventListener("submit", function(e) {
    if (anyFieldFilled()) {
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Do you want to update your information?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willChange) => {
            if (willChange) {
                this.submit();
            }
        });
    }
});
</script>

</body>
</html>