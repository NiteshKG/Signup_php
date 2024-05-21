<?php
session_start();
include 'connection.php';

if (isset($_POST['submit'])) {
    //if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST['email_or_phone'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {
            header("location:profile.php");
            $_SESSION['user'] = $row['id'];
        }else{
            $_SESSION['result'] = 'Password is incorrect!';
            header("Location: http://localhost/signup/login.php");
        }
    } else {
        $_SESSION['result'] = 'Invalid credentials';
        header("Location: http://localhost/signup/login.php");
    }

}






