<?php
    session_start();
    require_once('db.php');
    $db = new db("root", "");
    $_SESSION['errorMyAccount'] = "";

    if ($_SESSION['user'] == ""){
        header("Location: login.php");
        exit();
    }

    $infoUser = $db->takeInfosUser();
    $nom = $infoUser['nom'];

    if ($nom !== null){
        $_SESSION['nom'] = $infoUser['nom'];
        $_SESSION['prenom'] = $infoUser['prenom'];
        $_SESSION['pays'] = $infoUser['pays'];
        $_SESSION['age'] = $infoUser['age'];
        $_SESSION['description'] = $infoUser['description'];
        header("Location: myAccount-complete.php");
        exit();
    }

    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pays']) && isset($_POST['age']) && isset($_POST['description'])){
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pays']) && !empty($_POST['age']) && !empty($_POST['description'])){
            $_SESSION['nom'] = $_POST['nom'];
            $_SESSION['prenom'] = $_POST['prenom'];
            $_SESSION['pays'] = $_POST['pays'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['description'] = $_POST['description'];

            if($db->addInfosUser($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['pays'], $_SESSION['age'], $_SESSION['description'])){
                header("Location: myAccount-complete.php");
                exit();
            }  
        }
        else if (isset($_POST['bouton'])) {
            $_SESSION['errorMyAccount'] = "Veuillez renseigner tous les champs";
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
            <div class="container" style="margin-top: 100px;">
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
                <form method="post">
                    <div class="row mt-3">
                        <div style="margin-left: 330px;">
                            <h3>Nom : <span><input type="text" name="nom" class="rounded-4 border-0 text-center"></span></h3>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div style="margin-left: 330px;">
                            <h3>Prénom : <span><input type="text" name="prenom" class="rounded-4 border-0 text-center"></span></h3>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div style="margin-left: 330px;">
                            <h3>Pays : <span><input type="text" name="pays" class="rounded-4 border-0 text-center" pattern="^(Afghanistan|Afrique du Sud|Albanie|Algérie|Allemagne|Andorre|Angola|Antigua-et-Barbuda|Arabie saoudite|Argentine|Arménie|Australie|Autriche|Azerbaïdjan|Bahamas|Bahreïn|Bangladesh|Barbade|Belgique|Belize|Bénin|Bhoutan|Biélorussie|Bolivie|Bosnie-Herzégovine|Botswana|Brésil|Brunei|Bulgarie|Burkina Faso|Burundi|Cabo Verde|Cambodge|Cameroun|Canada|Centrafrique|Chili|Chine|Chypre|Colombie|Comores|Congo|Corée du Nord|Corée du Sud|Costa Rica|Côte d'Ivoire|Croatie|Cuba|Danemark|Djibouti|Dominique|Égypte|Émirats arabes unis|Équateur|Érythrée|Espagne|Estonie|Eswatini|États-Unis|Éthiopie|Fidji|Finlande|France|Gabon|Gambie|Géorgie|Ghana|Grèce|Grenade|Guatemala|Guinée|Guinée-Bissau|Guinée équatoriale|Guyana|Haïti|Honduras|Hongrie|Îles Cook|Îles Marshall|Îles Salomon|Inde|Indonésie|Irak|Iran|Irlande|Islande|Israël|Italie|Jamaïque|Japon|Jordanie|Kazakhstan|Kenya|Kirghizistan|Kiribati|Kosovo|Koweït|Laos|Lesotho|Lettonie|Liban|Liberia|Libye|Liechtenstein|Lituanie|Luxembourg|Madagascar|Malaisie|Malawi|Maldives|Mali|Malte|Maroc|Maurice|Mauritanie|Mexique|Micronésie|Moldavie|Monaco|Mongolie|Monténégro|Mozambique|Namibie|Nauru|Népal|Nicaragua|Niger|Nigeria|Norvège|Nouvelle-Zélande|Oman|Ouganda|Ouzbékistan|Pakistan|Palaos|Panama|Papouasie-Nouvelle-Guinée|Paraguay|Pays-Bas|Pérou|Philippines|Pologne|Portugal|Qatar|République Dominicaine|République Démocratique du Congo|République du Congo|République Tchèque|Roumanie|Royaume-Uni|Russie|Rwanda|Saint-Kitts-et-Nevis|Saint-Vincent-et-les-Grenadines|Sainte-Lucie|Saint-Marin|Salvador|Samoa|São Tomé-et-Principe|Sénégal|Serbie|Seychelles|Sierra Leone|Singapour|Slovaquie|Slovénie|Somalie|Soudan|Soudan du Sud|Sri Lanka|Suède|Suisse|Suriname|Syrie|Tadjikistan|Tanzanie|Tchad|Thaïlande|Timor oriental|Togo|Tonga|Trinité-et-Tobago|Tunisie|Turkménistan|Turquie|Tuvalu|Ukraine|Uruguay|Vanuatu|Vatican|Venezuela|Vietnam|Yémen|Zambie|Zimbabwe)$"></span></h3>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div style="margin-left: 330px;">
                            <h3>Age : <span><input type="number" name="age" class="rounded-4 border-0 text-center"></span></h3>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div style="margin-left: 330px;">
                            <h3>Description : <span><textarea style="vertical-align: top;" name="description" class="rounded-4 border-0 text-center"></textarea></span></h3>
                        </div>
                    </div>
                    <div class="row-3">
                        <div style="margin-left: 510px; margin-top: 50px">
                            <button type="submit" name="bouton" class="button-pswd rounded-4 border-0 fs-5">Confirmer</button>
                        </div>
                    </div>
                    <div class="row-3">
                        <div style="margin-left: 300px; margin-top: 20px">
                            <h2 class="text-danger"><?= $_SESSION['errorMyAccount'] ?></h2>
                        </div>
                    </div>
                </form>
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
