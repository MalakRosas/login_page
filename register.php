<?php
    include ("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <script>
        function isValidEmail(email) {
            var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
            return emailRegex.test(email);
       }
        function validateForm() {
            var username = document.forms["regform"]["user"].value;
            var email = document.forms["regform"]["email"].value;
            var password = document.forms["regform"]["pass"].value;
            var confirmPassword = document.forms["regform"]["confirmPass"].value;
            if (username === "") {
                alert("Username is required."); 
                return false;
            }
            if (email === "") {
                alert("Email is required.");
                return false;
            }
            if (password === "") {
                alert("Password is required.");
                return false;
            }
            if (confirmPassword === "") { 
            alert("Confirm password is required.");
            return false;
        }
            if (password !== confirmPassword) {
                alert("Password and Confirm Password must match.");
                return false;
            }
            if (!isValidEmail(email)) {
                alert("Invalid email format.");
                return false;
            }
            return true;
        }
    </script>
    <body>
        <div id="form">
            <h1>Registration Form</h1>
            <form name="regform" method="POST" onsubmit="return validateForm()">
                <label>Username: </label>
                <input type="text" id="user" name="user" placeholder="Username"></br></br>
                <label>Email: </label>
                <input type="email" id="email" name="email" placeholder="Email"></br></br>
                <label>Password: </label>
                <input type="password" id="pass" name="pass" placeholder="Password"></br></br>
                <label>Confirm password: </label>
                <input type="password" id="confirmPass" name="confirmPass" placeholder="Confirm password"></br></br>
                <input type="submit" id="btn" value="Register" name="submit">
            </form>
        </div>
    </body>
</html>
<?php
    session_start();
    include("connection.php");
    if (isset($_POST['submit'])) {
        $username = $_POST['user'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $password=md5($password);
        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo   '<script>
            window.location.href = "register.php";
            alert("Email already exists.")
        </script>';
        } else {
            $insertQuery = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$password')";
            if ($conn->query($insertQuery)) {
                $_SESSION['user'] = $username;
                header("Location: welcome.php");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
        }
?>