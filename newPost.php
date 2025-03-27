<?php
    session_start();
    require_once('db.php');
    $db = new db("root", "1234");
    $_SESSION['errorDesc'] = "";

    if ($_SESSION['user'] == ""){
        header("Location: login.php");
        exit();
    }

    // pour le chargement des images
    $imgPath = "";
    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_FILES['fileToUpload'])){
        $error = false;
        $finfo = $_FILES['fileToUpload'];

        if($finfo['error'] != 0){
            $error = true;
        }
        else {
            if (!move_uploaded_file($finfo['tmp_name'], "./images/".$finfo['name'])){
                $error = true;
            }
            else {
                $imgPath = "./images/".$finfo['name'];
                $_SESSION['imagePath'] =  $imgPath;
            }
        }
    }
?>  

<?php
    if(isset($_POST['titre'])  && isset($_POST['description']) && isset($_POST['canaux'])){
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $date = date("Y-m-d");
        $nomUser = $_SESSION['user'];
        $canal = $_POST['canaux'];
        $imgPath = $_SESSION['imagePath'];

        if (strlen($description) < 850){
            if($db->createPost($titre, $description, $date, $nomUser, $canal, $imgPath)){
                header("Location: home.php");
                exit();
            }
        }
        else {
            $_SESSION['errorDesc'] = "Votre description comporte plus que 850 caractères, veuillez la racourcir";
        }
    }            
?>

<!doctype html>
<html lang="en">
    <head>
        <title>New post</title>
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

        <link rel="stylesheet" type="text/css" href="style.css" media="all">
        <link rel="stylesheet" type="text/css" href="newPost.css" media="all">

        <script src="image-NewPost.js"></script>
    </head>

    <body>
        <header>
            <h1>New post</h1>
        </header>
        <main>
        <div class="left-column">
            <h2 onclick="window.location.href='home.php'" class="side">🏠 Home</h2>
            <h2 onclick="window.location.href='myAccount.php'" class="side">👤 My account</h2>
            <h2 style="font-weight: 900;" class="side">🆕 New post</h2>
            <h2 onclick="window.location.href='myLastPosts.php'" class="side">💬 My posts</h2>
            <h2 onclick="window.location.href='createCanal.php'" class="side">✏️ New Canal</h2>
            <h2 onclick="window.location.href='subscribe.php'" class="side">➕ Subscribe</h2>

            <h3 class="logout" onclick="window.location.href='login.php'">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </h3>
        </div>
        <div class="middle-column">
            <form method="post" style="margin-top: 150px;" enctype="multipart/form-data">
                <div class="post">
                    <div class="container">
                        <h2><input type="text" placeholder="Titre" class="title me-5" name="titre"></h2>
                        <label for="canaux"><h2>Canal :</h2></label>
                        <select name="canaux" id="canaux">
                        <?php 
                            $canaux = $db->takeCanal($_SESSION['nomUser']);
                            $i = 1;

                            foreach ($canaux as $canal){
                                $c = $canal['nomCanal'];
                                echo "<option value='$c'>$c</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                                <textarea type="text" placeholder="Description" class="description" name="description"></textarea>
                            </div>
                            <div class="offset-1 col-4">
                                <img class="imagePost" src="img/upload.jpg" alt="upload icon" id="image-preview">
                                <input id="fileToUpload" name="fileToUpload" type="file" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                        <button class="btn-pswd" style="margin-top:650px;margin-left: 510px;" type="submit" name="submit">Confirmer</button>
                </div>
                <div class="row text-center">
                    <h3 class="text-danger mt-3"><?= $_SESSION['errorDesc'] ?></h3>
                </div>
            </form>
        </div>
        <div class="right-column">
            <img class="imgColR" src="img/Logo - chatterBox - png - white.png" alt="logo blanc">
        </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
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

        <script src="newPost.js"></script>

        <script src="https://kit.fontawesome.com/d91a7502cf.js" crossorigin="anonymous"></script>
    </body>
</html>
