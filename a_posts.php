<?php

define('DB_USER', "root"); 
define('DB_PASSWORD', ""); 
define('DB_DATABASE', "EpiDB"); 
define('DB_SERVER', "localhost"); 

    session_start();

    $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die("unable to connect");

    if ( !isset($_SESSION['id']) ) {
        header("Location: a_login.php?activity=expired");
    }

    $sql = "SELECT post_id, post_date, post_time, post_title, post_description FROM posts order by post_id desc";
    $result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Epi Portal</title>
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./src/home.css">
    <script src="https://kit.fontawesome.com/311eb43420.js" crossorigin="anonymous"></script>

    
</head>
<body>
    <nav>
        <img id="logo" src="src\epi.jpg" alt="">
        <ul>
            
            <li id="navbar">
                <a href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>
    <div class="box">
        <ul class="dashboard">
            <div class="profile">
                <img id="profile" src="src\profile.png" alt="">
                <a style="font-size: 25px" href="#"><?php echo $_SESSION["uname"] ?></a>
            </div>
            <hr>
            <div class="leftbox">    
                <li id="left-box"><a href="a_home.php">Home</a></li>
                <li id="left-box"><a href="a_posts.php" style="color: white">Posts</a></li>
            </div> 
        </ul>

        <div class="box2">
        <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>

            
            <div class="post-container">
                <label class="post">
                    <b><?php echo $row["post_title"]; ?></b>
                </label>
                <br>
                <label class="post">
                <p style="white-space:pre-wrap"><?php echo $row["post_description"]; ?></p>
                </label>
                <?php 
                $id=$row["post_id"];?>
                <div>
                  <a href="<?php echo 'delete.php?id='.$id; ?>"> <i class="far fa-trash-alt"></i></a>
                <button onclick="openForm2()"><i class="fas fa-edit"></i></button> 
                </div>
            </div>
        
        <?php
                }
        }
        $conn->close();

        ?>
    </div>
    </div>
    <button class="open-btn" onclick="openForm()" id="add-post">Add Post</button>
    
    <div class="form-popup" id="myForm">
    <form action="addpost.php" class="form-container" method="POST">
        <h1>POST DETAILS</h1>

        <label for="title"><b>Title:</b></label>
        <input type="text" placeholder="Enter Post Title" name="title" required>

        <label for="description"><b>Description:</b></label>
        <textarea type="text" style="white-space: pre-wrap" placeholder="Enter Post Description" name="description" required></textarea>

        <button type="submit" class="btn">Post</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
    </form>
    </div>
    
    
    
    <div class="form-popup" id="myForm2">

    <form action="<?php echo 'edit.php?id='.$id; ?>" id="Form2" class="form-container" method="POST">
        <h1>EDIT POST</h1>
        <label for="title"><b>Title:</b></label>
        <input type="text" placeholder="Enter Post Title" name="titre" required>

        <label for="description"><b>Description:</b></label>
        <textarea type="text" style="white-space: pre-wrap" placeholder="Enter Post Description" name="desc" required></textarea>

        <button type="submit" class="btn">Post</button>
        <button type="button" class="btn cancel" onclick="closeForm2()">Cancel</button>
    </form>
    </div>

    <script>
        function openForm() {
        document.getElementById("myForm").style.display = "flex";
        document.getElementById("add-post").style.display = "none";
        }

        function closeForm() {
        document.getElementById("myForm").style.display = "none";
        document.getElementById("add-post").style.display = "flex";
        }
        function openForm2() {
        document.getElementById("myForm2").style.display = "flex";
        document.getElementById("add-post2").style.display = "none";
        }

        function closeForm2() {
        document.getElementById("myForm2").style.display = "none";
        document.getElementById("add-post2").style.display = "flex";
        }
    

    </script>
</body>
</html>