<?php
define('DB_USER', "root"); 
define('DB_PASSWORD', ""); 
define('DB_DATABASE', "EpiDB"); 
define('DB_SERVER', "localhost"); 

session_start();

date_default_timezone_set('Africa/Tunis	');

$title = $_POST['title'];
$description = $_POST['description'];
$date = date("Y-m-d");
$time = date("h:i:sa");
$a_id = $_SESSION['id'];

$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die("unable to connect");

$sql = "INSERT INTO posts (a_id,post_date,post_time,post_title,post_description) VALUES('$a_id','$date','$time','$title','$description')";

if (mysqli_query($conn,$sql)) {
    header("Location: a_posts.php");
} 
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>