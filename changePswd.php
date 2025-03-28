<?php
    session_start();
    require_once('db.php');
    $db = new db("root", "1234");

    $_SESSION['errorChangePswd'] = "";

    if ($_SESSION['user'] == ""){
        header("Location: login.php");
        exit();
    }

    if(isset($_POST['mdpActuel']) && isset($_POST['nouveauMdp']) && isset($_POST['nouveauMdp2'])){
        $mdpActuel = htmlspecialchars($_POST['mdpActuel']);
        $nouveauMdp = htmlspecialchars($_POST['nouveauMdp']);
        $nouveauMdp2 = htmlspecialchars($_POST['nouveauMdp2']);

        if ($nouveauMdp === $nouveauMdp2){
            if($db->changePassword($mdpActuel, $nouveauMdp)){
                header("Location: myAccount.php");
                exit();
            }
            else {
                $_SESSION['errorChangePswd'] = "Le mot de passe est incorrect";
            }
        }
        else{
            $_SESSION['errorChangePswd'] = "Les mots de passe ne correspondent pas";
        }
    }
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
            <h1>Change your password</h1>
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
        <div class="middle-column">
            <div class="container text-light">
                <form action="" method="post">
                    <div class="row space">
                        <div class="offset-2 col-4 text-end">
                            <h2>Mot de passe actuel :</h2>
                        </div>
                        <div class="col-4">
                            <input name="mdpActuel" type="password" class="inputPswd">
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-2 col-4 text-end">
                            <h2>Nouveau mot de passe :</h2>
                        </div>
                        <div class="col-4">
                            <input name="nouveauMdp" type="password" class="inputPswd">
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-1 col-5 text-end">
                            <h2>Confirmer le mot de passe :</h2>
                        </div>
                        <div class="col-4">
                            <input name="nouveauMdp2" type="password" class="inputPswd">
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-5 col-2 mt-4"> <!-- centrer -->
                            <button type="submit" class="btn-pswd mt-3" style="margin-left: 35px;">Confirmer</button>
                        </div>
                    </div>
                </form>
                <?php
                if($_SESSION['errorChangePswd'] == "Le mot de passe est incorrect"){?>
                    <div class="row">
                        <div class="offset-4 col-6">
                            <h3 class="text-danger mt-4" style="margin-left: 20px"><?= $_SESSION['errorChangePswd'] ?></h3>
                        </div>
                    </div>
                <?php }
                else {?>
                    <div class="row">
                        <div class="offset-3 col-6">
                            <h3 class="text-danger mt-4" style="margin-left: 35px"><?= $_SESSION['errorChangePswd'] ?></h3>
                        </div>
                    </div>
                <?php
                } ?>
                
            </div>
        </div>
        <div class="right-column">
            <h2 onclick="window.location.href='myAccount.php'" class="side">My account</h2>
                <h2 class="bold">Change pswd</h2>

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
