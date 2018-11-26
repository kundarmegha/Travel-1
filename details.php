<?php

session_start();

echo "<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>";

include("dbFunc.php");
//$id = null;

// story id is ftched
if ( !empty($_GET['id'])) {
    $id = $_GET['id'];
}
$_SESSION['id']= $_GET['id'];

?>

<html>
<head>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="col-md-12 main-container">
    <div class="col-md-6 headerstyle">
        <a href="index.php"><img src="logo.png" class="logo" style="display:inline;">
        <h2 style="font-size:22px;color:#FF005F;display:inline;" >Travel experience</h2>
    </div>
    <div class="col-md-6 headerstyle text-right">
        <!--    <button type="submit" name="view" class="btnstyle">-->
        <!--    <a href="edit.php?id=--><?php //echo $id?><!--">Edit</a></button>-->
        <a href="index.php" style="color:black;text-decoration:none;"> <button type="submit" name="view" class="btnstyle">Back</button></a>
    </div>
    <img src="slider-1.jpg" style="height:50%;" class="centerview">
</div>
<div>

    <?php

    $res=$k->viewdetail($id);
    $result = $res->fetch_assoc();
    $title=$result['title'];
    $description=$result['description'];
    $photo=$result['photo'];
    $alt=$result['alt'];
    $filtered_image=$result['filtered_image'];

    ?>

    <h2 class="moreDetailtiyle"><?php echo $title;?></h2>
    <!-- <img src="<?php echo $photo;?>"  class="centerview"> -->

    <!-- megha added for image filtering -->
    <div class="image_story" style="text-align:center;">
    <img src=<?php if(empty($filtered_image)){echo $photo;} else echo $filtered_image;?> alt=<?php echo $alt?> align="middle"  style="height:60%;width:60%;"/><br/><br/>
    <button onclick="window.location.href='exp.php'" style="border:none;background-color:#FF005F;color:white;padding:5px 5px;">Add image filters</button>
    <br/>
    </div>
    <!-- image filtering ends -->
     <div class="desc">
    <p class="descriptiondetail"><?php echo $description;?></p>
    </div>

</div>

<?php  

require_once('reaction.php');

require_once('dbFunc.php');
if (isset($_SESSION['username'])) {
    $name = $_SESSION['username'];
    $sid = $_SESSION['id'];

}
else
    $name = "Annonymus";

$obj = new dbFunc();
$flag = 1;
if(isset($_POST['submit']))
{
    $comment=$_POST['comment'];
    $comment = trim($comment);
    $gcaptch_response = $_POST['g-recaptcha-response'];

    $remoteip = $_SERVER['REMOTE_ADDR'];
    $secret = '6LdumnwUAAAAAHFDUR77bYYM9o8XPhg2xJsVdNxW';
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $post_data = http_build_query(
        array(
            'secret' => $secret,
            'response' => $gcaptch_response,
            'remoteip' => $remoteip
        )
    );
    $options=array(
        'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
    );

    $context = stream_context_create( $options );

    $result_json = file_get_contents( $url, false, $context );
    $resulting = json_decode($result_json, true);
    if($resulting['success']) {
        $flag=1;
    } else {

        $captchaerr = "captcha error";
        $flag=0;
    }

    if(!(empty($comment))) {
        $date = date('Y-m-d H:i:s');
        $date = strtotime($date);
        if (preg_match('/call|buy|poker|casino|www.|.com/i', $comment)) {
            $flag = 0;
        }
        if ($flag == 1) {
            $table = "comments";
            $field = array("sid", "name", "body", "date");
            $data = array($sid, $name, $comment, $date);
            $obj->Insertdata($table, $field, $data);
            $_POST['comment']='';
        }
    }
}
if(isset($_POST['reply']))
{
   if(isset($_POST['creply']))
    {
        $reply = $_POST['creply'];
        $reply = trim($reply);
        $pid = $_POST['pid'];
        $date=date('Y-m-d H:i:s');
        $date = strtotime($date);
        $rurlId=$_POST['rurlId'];
        $table = "reply";
        $field = array("name","reply","pid","date");
        $data = array($name,$reply,$pid,$date);
        $var = $obj->Insertdata($table,$field,$data);
        $_POST['creply'] = '';
    }
   $_POST['reply']='';
}
$row = $obj-> fetch_comment($sid);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="js/main.js"></script>
</head>
<body>
<div class="container">
    <h2 class='page-header'>Comments</h2>
    <div class="container">
        <div class='row'>
            <div class='col-md-8'>
                <form method='POST' action=''>
                    <textarea name='comment1' id='comment1'></textarea>
                    <input type='text' name='urlId'  value="<?php echo $_GET['id'] ?>" style="display: none;">
                    <textarea name='comment' id='comment' class='form-control' cols='30' rows='10' maxlength='300' required></textarea>
                    <br>
                    <span class="error"><?php if(isset($captchaerr)) echo $captchaerr ?> </span><br>
                    <div class="g-recaptcha" data-sitekey="6LdumnwUAAAAAPxnmm9BtC-WW9Uid4mSQGXbKPEz"></div><br>
                    <input type='submit' name='submit' class='btn btn-danger' value='Submit'>
                </form>
            </div>
        </div>
    </div>
    <?php
    $count = sizeof($row);
    if ($count >= 1)
    {
        foreach ($row as $key => $value)
        {
            ?>
            <div class='row'>
            <div class='col-md-8'>
                <section class='comment-list'>
                    <!-- First Comment -->
                    <article class='row'>
                        <div class='col-md-2 col-sm-2 hidden-xs'>
                            <figure class='thumbnail'>
                                <img class='img-responsive' src='download.png' />
                            </figure>
                        </div>
                        <div class='col-md-10 col-sm-10'>
                            <div class='panel panel-default arrow left'>
                                <div class='panel-body'>
                                    <header class='text-left'>
                                        <div class='comment-user'><i class='fa fa-user'></i><?php echo $value['name'] ?></div>
                                        <time class='comment-date' ><i class='fa fa-clock-o'></i><?php $date =date("d-m-Y",$value['date']); echo $date; ?></time>
                                    </header>
                                    <div class='comment-post'>
                                        <p>
                                            <?php echo $value['body'] ?>
                                        </p>
                                    </div>
                                    <p class='text-right'><a href='javascript:void(0)' class='btn btn-default btn-sm' onclick='reply("<?php echo $key ?>")';><i class='fa fa-reply'></i> reply</a></p>

                                    <?php
                                    $replies = $obj-> reply_comment($key);
                                    $rcount = sizeof($replies);
                                    if ($rcount >= 1)
                                    {
                                        foreach ($replies as $rkey => $rvalue)
                                        {

                                            ?>
                                            <div class='col-md-2 col-sm-2 hidden-xs'>
                                                <figure class='thumbnail'>
                                                    <img class='img-responsive' src='download.png' />
                                                </figure>
                                            </div>
                                            <div class='col-md-10 col-sm-10'>
                                                <div class='panel panel-default arrow left'>
                                                    <div class='panel-body'>
                                                        <header class='text-left'>
                                                            <div class='comment-user'><i class='fa fa-user'></i><?php echo $value['name'] ?></div>
                                                            <time class='comment-date' ><i class='fa fa-clock-o'></i><?php $date =date("d-m-Y H:i:s",$value['date']); echo $date ?></time>
                                                        </header>
                                                        <div class='comment-post'>
                                                            <p>
                                                                <?php echo $rvalue['reply'] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php }}?>

                                    <div class='col-md-8' id='<?php echo $key ?>' style="display:none;">
                                        <form method='POST' action=''>
                                            <input name="pid" value="<?php echo $key ?>" type="hidden"/>
                                            <input type='text' name='rurlId'  value="<?php echo $_GET['id'] ?>" style="display: none;">
                                            <textarea name='creply' id='comment' class='form-control' cols='25' rows='8' maxlength='300' required></textarea>
                                            <br>
                                            <input type='submit' name='reply' class='btn btn-danger' value='Submit'>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
            </div>
            </div><?php }} ?>
</div>

</body>
<script src='https://www.google.com/recaptcha/api.js'></script>
</html>
</body>
</html>