<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LoginPage</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <script>
        function isValidEmail(email) {
            var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
            return emailRegex.test(email);
       }
        function validateForm() {
            var email = document.forms["form"]["email"].value;
            var password = document.forms["form"]["pass"].value;
            if (email === "") {
                alert("Email is required.");
                return false;
            }
            if(password===""){
                alert("Password is required.");
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
            <h1>Login Form</h1>
            <form name="form" action="index.php" method="POST" onsubmit="return validateForm()">
                <label>Email: </label>
                <input type="text" id="email" name="email" placeholder="Email"></br></br>
                <label>Password: </label>
                <input type="password" id="pass" name="pass" placeholder="Password"></br></br>
                <input type="submit" id="btn" value="Login" name="submit">
                <p>Don't have an account? <a href="http://localhost/login_page/register.php">Register</a></p>
            </form>
        </div>
    </body>
</html>
<?php
    session_start();
    include("connection.php");
    if (isset($_POST['submit'])) { 
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $password =md5($password);
        $query="select * from users where email = '$email' and password = '$password'";
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);  
        if($count == 1){  
            $_SESSION['user']=$row['name'];
            header("Location: welcome.php");
        }  
        else{  
            echo  '<script>
                        window.location.href = "index.php";
                        alert("Login failed. Invalid username or password!")
                    </script>';
        }  
    }
?>