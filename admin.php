<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Page Title</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
   <script src="main.js"></script>
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery.min.js"></script>
</head>

<body>
  
   <section >
           <h1 class="col-md-12 text-center">
           <span class="label label-danger"  style="text-align:center;">Login
           </h1></div><br><br>
       
     <!-- <form action="#" method="POST">
         <input type="text" name="admin-name"  placeholder="Enter admin name">
         <input type="password" name="admin-password" placeholder="password">
         <input type="submit" name="admin_login" value="Log In"> -->

         <form action="#" method="post"  class="col-md-4 col-md-offset-4"><br><br>
        <input type="text"  name="admin-name"   class="form-control" placeholder="Enter admin name"  required><br>
        <input type="password"  name="admin-password"   class="form-control" placeholder="password" required><br>
       <button type="submit" name="admin_login" class="form-control btn btn-danger">Submit</button><br><br>

     </form>

    </section>
</body>
</html>

<?php
 if(isset($_POST['admin_login'])){
$admin_name="admin";
$admin_password="admin";
if(($_POST['admin-name'] == $admin_name) && ($_POST['admin-password'] == $admin_password)){



 header('Location:admin_dashboard.php');

}
else{

 header('Location:admin.php');

}
}

?>