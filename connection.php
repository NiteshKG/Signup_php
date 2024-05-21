<!-- Database connection -->
<!-- $conn = new mysqli('localhost', 'root', '', 'user2_system');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } -->


    <?php
$SERVER="localhost";
$USERNAME="root";
$PASSWORD="";
$DBNAME="user2_system";

$conn= mysqli_connect($SERVER,$USERNAME,$PASSWORD,$DBNAME);

if($conn->connect_error){
    die ("Connection failed".$conn->connect_error);
    exit();
}
?>