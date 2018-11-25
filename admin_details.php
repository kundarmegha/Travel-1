<?php
    include("db.php");
    $obj=new db();
    $conn=$obj->dbconnector();
    $travel_id=$_GET['travel_id'];
    $res=mysqli_query($conn,"select * from travel_details where travel_id=$travel_id");
    $row=mysqli_fetch_assoc($res);
    $travelid=$row['travel_id'];

    if(isset($_POST['btnUpdate'])){
        
        $place=$_POST['place'];
        $desc=$_POST['description'];
        $storyid=$_POST['storyid'];
        $table_name="story";
        $formdata=array(
            'place'=>$place,
            'description'=>$desc
        );
        $obj=new db();
        $obj->dbconnector();
        $update_result=$obj->update_data($table_name,$formdata,$storyid);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="admin.css">
   <link rel="stylesheet" href="jquery.fancybox.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script type="text/javascript">
   $(document).ready(function() {
       $("#deleteall").click(function() {
         var id = $(this).data('id');
         $.ajax({
           type: "POST",
           url: "deleteall.php",
           data:{
                 id:id,
           },
           success: function(response){
            if(response === "no_errors") location.href = "admin_dashboard.php"   
           }
       });
     });
     });
       </script>
</head>
<body class="wrapper">
   <div class="container-fluid">
      <div class="row dashboard-header">
         <div class=" col-xs-12 col-md-6 text-center search">
            <!-- <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
               <input type="text" name="employeeid"  size="30" placeholder="Search by place"/>
               <button type="submit" class="search_btn" id="search" name="search">Search</button><br /><br />
            </form> -->
         </div>
         <div class="col-xs-12 col-md-6">
            <div class="col-md-12 text-right menus">
                <a class="button" href="admin_dashboard.php">Home</a>
                <a class="button" href="view_user.php">View users</a>
                <a class="button" href="logout.php">Logout</a>
            </div>
         </div>
      </div>

      <div class="col-xs-12 col-md-12">
            <div class="col-md-12 text-right menus">
                <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal">Edit</button>
                <div class="dropdown">
                <button class="dropbtn  btn btn-warning btn-lg">Delete</button>
                <div class="dropdown-content">
                    <?php
                echo '<a href="delete_images.php?travel_id=' . $travelid . '">Delete Images</a><br/>';
                ?>
                    <a href="" name="deleteall" id="deleteall" data-id="<?php echo $travelid;?>">Delete All</a>
                </div>
                </div>
            </div>
      </div>

      <div class="row">
      <div class="col-md-12 main-container">
      <?php
            $user_id=$row['user_id'];
            $banner_image=$row['banner_images'];
            $banner_path=$banner_image;
            
            $sub_image=$row['sub_images'];
            $sub_image_data  = $sub_image;
            $sub_image_final = explode(",", $sub_image_data);
           

            $story_id=$row['story_id'];

            $res = mysqli_query($conn, "SELECT * FROM story where story_id=$story_id");
            $row=mysqli_fetch_assoc($res);
            $storyid=$row['story_id'];
            $place=$row['place'];
            $description=$row['description'];

          ?>
               <div class="col-xs-6 col-md-6 text-center container-data">
                   <img class="travel_img" src=<?php echo $banner_path;?>>

                    <div class="col-md-12">
                      <?php
                      $arr_length=count($sub_image_final);
                      $i=0;
                      foreach($sub_image_final as $sub_images)
                      {
                           ?>
                        <a class="fancybox" href="#one<?php echo $i;?>">
                        <div class="col-xs-6 col-md-4 inner-image" id="one<?php echo $i;?>">
                        <img class="travel_inner_img" src=<?php echo $sub_images;?> >
                        </div>
                        <div class="col-xs-6 col-md-4" id="one<?php echo $i;?>">
                        <img class="travel_simg" src=<?php echo $sub_images;?> >
                        </div>
                       </a>
                        <?php
                        $i++;
                       }
                       ?>
                  </div>
               </div>

                <div class="col-md-6">
                     <div class="story">
                        <h2 class="text-center heading"><?php echo $place ?></h2>
                        <p class="description"><?php echo $description; ?></p>

                     </div>
                  </div> 

    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Travel Details</h4>
        </div>
        <div class="modal-body">
            <form method="post" action="">
         <input type="hidden" value="<?php echo $storyid; ?>" name="storyid"/>
         <input type="text" name="place" class="form-control" value="<?php echo $place ?>" required><br/>
         <textarea class="form-control" name="description" required><?php echo $description ?></textarea><br/>
         <div class="col-md-4 col-md-offset-4">
         <button type="submit" class="btn btn-info form-control" id="btnUpdate" name="btnUpdate">Update</button><br/><br/>
         </div> 
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  
        </div>
      </div>
      </div>
      </div>
                 
              
   </div>
</div>
<script type="text/javascript" src="jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="general.js"></script>
</body>
</html>