<?php
    session_start();
    require_once('db.php');
    $db = new db("root", "");
?>

<!doctype html>
<html lang="en">
    <head>
        <title>My account</title>
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
    </head>

    <body>
        <header>
            <h1>Me</h1>
        </header>
        <main>
        <div class="left-column">
            <h2 onclick="window.location.href='home.php'" class="side">🏠 Home</h2>
            <h2 style="font-weight: 900;" class="side">👤 My account</h2>
            <h2 onclick="window.location.href='newPost.php'" class="side">🆕 New post</h2>
            <h2 onclick="window.location.href='myLastPosts.php'" class="side">💬 My posts</h2>
            <h2 onclick="window.location.href='createCanal.php'" class="side">✏️ New Canal</h2>
            <h2 onclick="window.location.href='subscribe.php'" class="side">➕ Subscribe</h2>

            <h3 class="logout" onclick="window.location.href='login.php'">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </h3>
        </div>
        <div class="middle-column text-light">
            <div class="container space">
                <div class="row mt-5">
                    <div  style="margin-left: 330px;">
                        <h3>Nom d'utilisateur : <span class="bold"><?= $_SESSION['nomUser'] ?></span></h3>
                    </div>
                </div>
                <div class="row mt-3">
                    <div style="margin-left: 330px;">
                        <h3>Adresse mail : <span class="bold"><?= $_SESSION['adresseMail'] ?></span></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-column">
                <h2 class="bold">My account</h2>
                <h2 onclick="window.location.href='changePswd.php'" class="side">Change pswd</h2>

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
