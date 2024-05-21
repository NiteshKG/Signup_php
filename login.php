<?php
session_start();
if(isset($_SESSION['result']) && $_SESSION['result'] == ''){
    // echo 'null';
}else if(isset($_SESSION['result']) && $_SESSION['result'] != ''){
    // echo 'find';
    echo $_SESSION['result'];
    session_destroy();
}else if(isset($_SESSION['user']) && $_SESSION['user'] != ''){
    header("location:profile.php");
}
// echo $_SESSION['result'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }
        h2 {
            margin-top: 0;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .signup-link {
            margin-top: 10px;
            display: block;
            text-decoration: none;
            color: #4CAF50;
        }
        .signup-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login_process.php" method="post">
            <input type="text" name="email_or_phone" placeholder="Email or Phone">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" name="submit" value="submit" class="btn">
        </form>
        <?php
            // if($_SESSION['result'] != ''){
            //     echo $_SESSION['msg'];
            // }
            // session_destroy();
        ?>
        <a href="signup.php" class="signup-link">Sign Up</a>
    </div>
</body>
</html>

       