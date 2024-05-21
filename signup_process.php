<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user2_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone_no = $conn->real_escape_string($_POST['phone']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $password = ($conn->real_escape_string($_POST['password'])); // Hash the password

   // File upload process
$target_dir = "uploads/";
$target_file = $target_dir . uniqid() . '_' . basename($_FILES["profile_pic"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Debug: Print target file path
echo "Target File: " . $target_file . "<br>";

// Check if the directory exists and is writable
if (!file_exists($target_dir)) {
    // Attempt to create the directory recursively
    if (!mkdir($target_dir, 0777, true)) {
        echo "Error: Failed to create directory.";
        $uploadOk = 0;
    }
}

// Check if the directory is writable
if (!is_writable($target_dir)) {
    echo "Error: The uploads directory is not writable.";
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Error: File already exists.";
    $uploadOk = 0;
}

// Perform file upload if everything is okay
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename($_FILES["profile_pic"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

    
    // Check file size, file type, and perform the upload
    // (The rest of your file upload code here)
    
    $sql = "INSERT INTO user (name, email, phone_no, dob, password, profile_pic) VALUES ('$name', '$email', '$phone_no', '$dob', '$password', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();

}
?>