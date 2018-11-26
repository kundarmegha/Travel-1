<?php
    include("db.php");
    $obj=new db();
    $conn=$obj->dbconnector();
    $user_id=$_GET['user_id'];
    $story=mysqli_query($conn,"select * from travel_details where user_id=$user_id");
    $row=mysqli_fetch_assoc($story);

    $story_id=$row['story_id'];

    mysqli_query($conn,"delete from story where story_id=$story_id");
    mysqli_query($conn,"delete from travel_details where user_id=$user_id");
    mysqli_query($conn,"delete from user_details where user_id=$user_id");
    header('Location:view_user.php');
    ?>