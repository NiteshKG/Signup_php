<?php
session_start();
include('connection.php');

if (!isset($_SESSION['user'])) {
    header("location: login.php");
    exit;
}

$user_id = $_SESSION['user'];

if (isset($_POST['update_profile'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $password = ($conn->real_escape_string($_POST['password']));

    // Handle photo upload if provided
    $target_dir = "uploads/";
    $target_file = $target_dir . uniqid() . '_' . basename($_FILES["photo"]["name"]);

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        // Update user data in the database
        $update_query = "UPDATE user SET name='$name', email='$email', phone_no='$phone', dob='$dob', password='$password', photo='$target_file' WHERE id='$user_id'";
        if (mysqli_query($conn, $update_query)) {
            // Redirect to the profile page after successful update
            header("location: profile.php");
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
