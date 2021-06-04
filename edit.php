<?php
define('DB_USER', "root"); 
define('DB_PASSWORD', ""); 
define('DB_DATABASE', "EpiDB"); 
define('DB_SERVER', "localhost"); 

session_start();
    $id=$_GET['id'];
    $title=$_POST['titre'];
    $desc=$_POST['desc'];
    echo $id;                           
    $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die("unable to connect");
    $sql=("UPDATE posts SET post_title='$title', post_description='$desc' WHERE  post_id =$id ");


if (mysqli_query($conn,$sql)) {
header("Location: a_posts.php");
} 
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>