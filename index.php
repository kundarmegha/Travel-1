<html>
    <head>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="ckeditor/ckeditor.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <div class="col-md-8" style="border:1px solid;">
        <form action="storiesphp.php">
        <label for="title">Title of story</label>
            <input type="text" id="title" name="title" placeholder="Title of stroy.." ><br>
            <label for="image">Image*</label>
            <input type="file" name="file"  >
            <label for="description">Write your travelling story</label>
            <textarea name="description" class="ckeditor" ></textarea>
            <input type="submit" name="submit" id="submit" class="form-control btn btn-success"><br><br>
        </form>
        </div>
    </body>
    </html>
