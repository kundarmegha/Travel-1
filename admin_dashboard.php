<?php
    include("db.php");
    $obj=new db();
    $conn=$obj->dbconnector();
    $res = mysqli_query($conn, "SELECT * FROM profile");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="admin.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="wrapper">
   <div class="container-fluid">
      <div class="row">
          <div class="dashboard-header">
         <div class="col-md-6 text-center search">
            <!-- <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
               <input type="text" name="employeeid"  size="30" placeholder="Search by place"/>
               <button type="submit" class="search_btn" id="search" name="search">Search</button><br /><br />
            </form> -->
         </div>
         <div class="col-md-6">
            <div class="col-md-12 text-right menus">
                <a class="button" href="admin_dashboard.php">Home</a>
                <a class="button" href="view_user.php">View users</a>
                <a class="button" href="login.php">Logout</a>
            </div>
         </div>
      </div>
      </div>

      <div class="row">
      <div class="col-md-12 main-container">
      <?php
       while($row=mysqli_fetch_array($res)){
            $user_id=$row['username'];
            $res1 = mysqli_query($conn, "SELECT * FROM travel_details where user_id=$user_id");
            
            foreach($res1 as $row1){
            $travel_id=$row1['travel_id'];
            $story_id=$row1['story_id'];
            $banner_image=$row1['banner_images'];
            $banner_path=$banner_image;

            $res2=mysqli_query($conn, "SELECT * FROM story where story_id=$story_id");
            foreach($res2 as $row2){
                $place=$row2['place'];

          ?>
               <div class="col-xs-6 col-md-6 text-center container-data">
                   <?php
               echo '<h1 class="travel_header">'.$place.'</h2>';
               echo '<a href="admin_details.php?travel_id=' . $travel_id . '"><img class="travel_img" src= ' . $banner_path .'></a><br/>';
               ?>
               </div>
                  <?php
       }
    }
}
                  ?>
              
   </div>
</div>
</body>
</html>