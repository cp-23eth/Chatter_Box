<?php
    session_start();
    require_once('db.php');
    $db = new db("root", "");

    if ($_SESSION['canal'] == "logOut") {
        $canaux = $db->takeCanal($_SESSION['nomUser']);
        $_SESSION['canal'] = $canaux[0]['nomCanal'];
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Home</title>
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
        <link rel="stylesheet" type="text/css" href="home.css" media="all">
        <script src="changeCanal.js"></script>
        <script src="logOut.js"></script>
    </head>

    <body onload="init()">
        <header>
            <h1><?= $_SESSION['canal'] ?></h1>
        </header>
        <main>
            <div class="left-column">
                <h2 class="bold">Home</h2>
                <h2 onclick="window.location.href='myAccount.php'">My account</h2>
                <h2 onclick="window.location.href='newPost.php'">New post</h2>
                <h2 onclick="window.location.href='myLastPosts.php'">My posts</h2>

                <h3 class="logout" onclick="window.location.href='login.php'">Deconnexion</h3>
            </div>
            <div class="middle-column">
                <?php 
                    $posts = $db->takePost($_SESSION['canal']);

                    foreach($posts as $post){
                        for($i = 0; $i <= count($post); $i += 10){
                            echo ""
                ?>
                <div class="post">
                    <h2 class="m-3"><?= $post['nom'] ?> : <?= $post['nomUser'] ?></h2>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                                <p class="description"><?= $post['description'] ?></p>
                            </div>
                            <div class="offset-1 col-4">
                            <img class="imagePost" src="img/Cat.jpg" alt="chat">
                            </div>
                        </div>
						<div class="row">
                                <p class="ms-2"><?= $post['datePost'] ?></p>
                        </div>
                    </div>
                </div>

                <?php
                        }
                    }
                ?>
            </div>
            <div class="right-column">
            <?php
                $canaux = $db->takeCanal($_SESSION['nomUser']);
                for ($i = 0; $i < count($canaux); $i++){
                    foreach($canaux[$i] as $canal){ ?>
                        <div class="channel" channel="<?= $canal ?>">
                            <h2><?= $canal ?></h2>
                        </div>
            <?php
                    } 
                }  
            ?> 

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
    </body>
</html>
