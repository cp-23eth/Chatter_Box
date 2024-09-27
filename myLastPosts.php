<?php
    session_start();
    require_once('db.php');
    $db = new db("root", "");
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
    </head>

    <body>
        <header>
            <h1>My canal</h1>
        </header>
        <main>
            <div class="left-column">
                <h2 onclick="window.location.href='home.php'" class="side">🏠 Home</h2>
                <h2 onclick="window.location.href='myAccount.php'" class="side">👤 My account</h2>
                <h2 onclick="window.location.href='newPost.php'" class="side">🆕 New post</h2>
                <h2 style="font-weight: 900;"class="side">💬 My posts</h2>
                <h2 onclick="window.location.href='createCanal.php'" class="side">✏️ New Canal</h2>
                <h2 onclick="window.location.href='subscribe.php'" class="side">➕ Subscribe</h2>

                <h3 class="logout" onclick="window.location.href='login.php'">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </h3>
            </div>
            <div class="middle-column">
                <?php 
                    $posts = $db->takeMyPost($_SESSION['user']);
                    $firstPost = 0;
                    foreach($posts as $post){
                        $i = 0;
                        if ($firstPost !== 0){
                           while($i < count($post)){
                                echo str_repeat("<br>", $i);
                                $i++;
                            } 
                            $firstPost++;
                        }
                        else {
                            $firstPost++;
                        }
                        
                ?>
                <div class="post">
                    <h2 class="m-3"><?= $post['nom'] ?> : <?= $post['nomCanal'] ?></h2>
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
                ?>
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

        <script src="https://kit.fontawesome.com/d91a7502cf.js" crossorigin="anonymous"></script>
    </body>
</html>
