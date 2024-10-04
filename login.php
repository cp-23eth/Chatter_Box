<?php
    session_start();
    require_once('db.php');
    $db = new db("root", "");
    $_SESSION['errorLogin'] = "";
    $_SESSION['canal'] = "logOut";
    $_SESSION['user'] = "";
    $_SESSION['nom'] = "";
    $_SESSION['prenom'] = "";
    $_SESSION['pays'] = "";
    $_SESSION['age'] = "";
    $_SESSION['description'] = "";
?>

<?php
    if(isset($_POST['nomUser']) && isset($_POST['motDePasse'])){
        $nomUser = htmlspecialchars($_POST['nomUser']);                
        $motDePasse = htmlspecialchars($_POST['motDePasse']);                

        if($db->verifyLogin($nomUser, $motDePasse)){
            $_SESSION['user'] = $_POST['nomUser'];
            header("Location: home.php");
            exit();
        }
        else {
            $_SESSION['errorLogin'] = "Les identifants sont incorrects";
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
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

        <link rel="stylesheet" type="text/css" href="loginSignUp.css" media="all">
    </head>

    <body>
        <header>
            <div class="container-fluid">
                <div class="row">
                    <!-- Côté gauche -->
                    <div class="col-6 half-left text-center">
                        <form action="" method="post">
                            <!-- Login -->
                            <h1 class="mb-5">Login :</h1>

                            <!-- Nom d'utilisateur -->
                            <h3>Nom d'utilisateur :</h3>
                            <input name="nomUser" type="text" required class="p-2 rounded-5 border-0 text-center fs-5 input mb-3">

                            <!-- Mot de passe -->
                            <h3 class="mt-4">Mot de passe :</h3>
                            <input name="motDePasse" type="password" required class="p-2 rounded-5 border-0 text-center fs-5 input mb-4">
                            <br>

                            <!-- Bouton submit -->
                            <button type="submit" class="btn-custom mt-2">Confirmer</button>
                            <hr>
                        </form>

                        <!-- Bouton signUp -->
                        <button class="btn-custom" onclick="window.location.href='signUp.php'">SignUp</button>

                        <h4 class="text-danger text-center mt-3"><?= $_SESSION['errorLogin'] ?></h4>
                    </div>

                    <!-- Côté droit -->
                    <div class="col-6 half-right">
                        <img src="img/Logo - chatterBox - png.png" alt="logo ChatterBox">
                    </div>
                </div>
            </div>
        </header>
        <main></main>
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
