<?php
include("dbFunc.php");
$flag=0;
$title = $_POST["title"];
$user="deeksha";
$description = $_POST["description"];
$photo=$_FILES['file']['name'];

$filepath="upload/".$photo;
$up=move_uploaded_file($_FILES["file"]["tmp_name"] , "$filepath");


condition($_POST["title"]);
condition($_POST["description"]);
condition($filepath);


function condition($valueoffeild){
  global $flag;      
    if (empty($valueoffeild) ){ 
      $flag = 1;
    }
  }
if(!$up)
{
echo'image not uploaded';
}
if(!$flag){
$form_data = array(
    'title'=> $title,
    'description'=>$description,
    'photo'=>$filepath,
    'user'=>$user
    
  );

  $table_name = 'stories';
  $x = new Connect();
  $x->insertstories("$table_name",$form_data);
}
 
  
?>

