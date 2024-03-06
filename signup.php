<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $username = $_POST["username"];
    $lastname = $_POST["lastname"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $email = $_POST["email"];
    $status = $_POST["status"];
    $password = $_POST["password"];
    $cpass = $_POST["cpass"];

    
    $host = 'localhost'; 
    $uname = 'root'; 
    $pass = ''; 
    $database = 'IPT101'; 

  
    $conn = new mysqli($host, $uname, $pass, $database, 3307);

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if ($password != $cpass) {
        echo '<div class="error_message">Passwords do not match. Please enter the same password in both fields.<a href="signup.php">Go Back</a></div>';
      
        exit(); 
    }

    $check_email_sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        echo '<div class="error_message">Email address already exists. Please choose a different email or login.<a href="signup.php">Go Back</a></div>';
       
        exit();
    }






    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO user (username, lastname, first_name, middle_name, email, status, password) VALUES ('$username', '$lastname', '$first_name', '$middle_name', '$email', '$status', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="success-message">New record created successfully!!
        now click LOGIN below</div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: lightskyblue;
            width: 100%;
            height: 100vh;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signup {
            background-color: lightgreen;
            width: 450px;
            height: 770px;
            margin: auto;
            border-radius: 10px;
            padding-bottom: 0px;
        }


        h1{
            padding-top: 5px;
            text-align: center;
            color: black;
            font-family: "Times New Roman", Times, serif;
        }

        form{
            width: 400px;
            margin-left: 20px;
        }

        form label{
            display: flex;
            margin-top: 20px;
            font-size: 18px;
            color: white; 
            font-family: "Times New Roman", Times, serif;
        }

        form input{
            width: 100%;
            padding: 7px;
            border: none;
            border: 1px solid black;
            border-radius: 6px;
            outline: none;
        }

        input[type="submit"] {
            width: 320px;
            height: 35px;
            margin-top: 20px;
            border: none;
            background: rgb(255, 134, 24);
            color: black;
            font-size: 18px;
            cursor: pointer;
            font-family: "Times New Roman", Times, serif;
        }

        input[type="submit"]:hover {
            color: aliceblue;
            background: rgb(11, 211, 247);
            
        }

        p {
            text-align: left;
            padding-left: 20px;
            padding-top: 5px;
            font-size: 15px;
            font-family: "Times New Roman", Times, serif;
            color: white;
        }
        a {
            color: lightblue;
            font-family: "Times New Roman", Times, serif;
        }
        a:hover {
            opacity: .7;
        
        }

        .success-message {
            color: darkorange;
            font-weight: bold;
            text-align: above;
            margin-top: 20px;
        }

        .error_message {
            background-color: lightskyblue;

        }

    </style>
</head>
<body>  
    <div class="signup">
        <h1>Sign Up</h1>
        <form name="form" action="signup.php" method="POST">  
            <label>Username:</label>
            <input type="text" name="username" required placeholder="Enter Username" pattern = "[A-Za-z\s]+">
            <label>Lastname:</label>
            <input type="text" name="lastname" placeholder="Enter Lastname" pattern = "[A-Za-z\s]+">
            <label>Firstname:</label>
            <input type="text" name="first_name" placeholder="Enter Firstname" pattern = "[A-Za-z\s]+">
            <label>Middlename:</label>
            <input type="text" name="middle_name" placeholder="Enter Middlename" pattern = "[A-Za-z\s]+">
            <label>Email:</label>
            <input type="email" name="email" placeholder="Enter Email">
            <label>Status:</label>
            <input type="text" name="status" placeholder="Enter Status" pattern = "[A-Za-z\s]+">
            <label>Password:</label>
            <input type="password" name="password" required placeholder="Enter Password">
            <label>Repeat Password:</label>
            <input type="password" name="cpass" required placeholder="Repeat Password">
            <input type="submit" name="signup" value="Signup">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>