<?php
session_start();
include('connection.php');
if(!isset($_SESSION['user'])){
    header("location:login.php");
    exit;
}
$user_id = $_SESSION['user'];
$select_user = mysqli_query($conn,"SELECT * FROM `user` WHERE id='$user_id'");
$fetch_data = mysqli_fetch_assoc($select_user);
?>
<?php echo  "welcome -"?>
<?php

if(isset($_POST['logout'])){
    session_destroy();
    setcookie("submit","",time()-1);
    header("location:login.php");
    
}

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    
    <h1>Details</h1>
    <h3>Email id: <?php echo $fetch_data['email'];?></h3>
    <h3>password : <?php echo $fetch_data['password'];?></h3>
    <?php if (!empty($fetch_data['photo'])): ?>
        <img src="<?php echo $fetch_data['photo']; ?>" alt="User Photo" style="max-width: 200px; max-height: 200px;">
    <?php else: ?>
        <p>No photo uploaded.</p>
    <?php endif; ?>
    <form action="update.php" method="GET">
        <input type="submit" value="Update Profile">
    </form>
    <form action="" method="POST">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>