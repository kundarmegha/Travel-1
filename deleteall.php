<?php
    include("db.php");
    $obj=new db();
    $conn=$obj->dbconnector();
    if(isset($_POST['id'])){
        $id=$_POST['id'];
        $query=mysqli_query($conn,"select * from travel_details where travel_id=$id");
        $row=mysqli_fetch_assoc($query);

        $story_id=$row['story_id'];

        mysqli_query($conn,"delete from story where story_id=$story_id");
        mysqli_query($conn,"delete from travel_details where travel_id=$id");
    }
?>