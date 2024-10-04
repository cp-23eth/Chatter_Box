<?php
    $imgPath="";
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_FILES['FileToUpload'])){
        $error = false;
        $finfo = $_FILES['FileToUpload'];
        if($finfo['error']!=0)
            $error=true;
        else{

            if(!move_uploaded_file($finfo['tmp_name'],"./images/".$finfo['name'])){
                $error=true;
            }else{
                $imgPath = "./images/".$finfo['name'];
            }
        }
        if($error)
            echo("erreur à l'upload");
        else    
            echo("upload completed");
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <script src="test.js"></script>
    </head>

    <body>
       <div class="container">
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="FileToUpload" id="FileToUpload" onchange="displayImg(event);">
            <input type="submit" value="Upload Image" name="submit">
        </form>
        <div class="row">
            <img src="<?= $imgPath ?>" class="img-fluid rounded-top" alt="image" id="imgPreview"/>
        </div>
       </div>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
