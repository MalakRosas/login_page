<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WelcomePage</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <h1>Welcome Page</h1>
        <?php
         session_start(); 
         if (isset($_SESSION['user'])) {
             $name = $_SESSION['user'];
             echo "<p>Welcome, " . $name . "</p>";
             echo '<p><a href="register.php">Go back to registration</a></p>';
             echo '<p><a href="index.php">Sign in to another account</a></p>';
         }
        ?>
    </body>
    <style>
body {
    font-family: Arial, sans-serif;
    text-align: center;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

h1 {
    color: #333;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin: 20px;
}

p {
    margin: 10px;
}

a {
    text-decoration: none;
    color: #0077cc;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}
    </style>
    </html>