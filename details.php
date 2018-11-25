<?php
include("data.php");
$id = null;
if ( !empty($_GET['id'])) {
   $id = $_GET['id'];
}
?>
<html>
    <head>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="ckeditor/ckeditor.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
   
    <div class="col-md-12 main-container">
    <div class="col-md-6 headerstyle">
    <a href="viewStories.php" >   <img src="logo.png" class="logo">
    </div>
    <div class="col-md-6 headerstyle text-right">
    <button type="submit" name="view" class="btnstyle">
    <a href="edit.php?id=<?php echo $id?>">Edit</a></button>
            <button type="submit" name="view" class="btnstyle"><a href="viewStories.php" >Back</a></button>
    </div>
    <img src="slider-1.jpg" class="centerview">
    </div>
        <div class="col-sm-9" style="margin:auto;">
<?php
$res=$k->viewdetail($id);
$result = $res->fetch_assoc();
$title=$result['title'];
$description=$result['description'];
$photo=$result['photo']?>
<h2 class="moreDetailtiyle"><?php echo $title;?></h2>
<!-- <img src="<?php echo $photo;?>"  class="centerview"> -->
<p class="moreDetailcontent"><?php echo $description;?></p>


</div>