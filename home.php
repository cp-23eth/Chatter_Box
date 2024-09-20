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
                <h2 class="bold">Home</h2>
                <h2 onclick="window.location.href='myAccount.php'">My account</h2>
                <h2 onclick="window.location.href='newPost.php'">New post</h2>
                <h2 onclick="window.location.href='myLastPosts.php'">My posts</h2>

                <h3 class="logout" onclick="window.location.href='login.php'">Deconnexion</h3>
            </div>
            <div class="middle-column">
                <!-- post 1 -->
                <div class="post">
                    <h2 class="m-3">Titre : $user</h2>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nec  commodo purus. Nam a est ac diam commodo bibendum. Vestibulum et risus  et urna maximus pulvinar. Proin efficitur lorem fringilla libero  volutpat, ac eleifend tellus rutrum. Sed accumsan dui eu tortor  condimentum, a auctor lectus semper. Donec cursus vestibulum justo ut  tempor. Vestibulum turpis sem, tempor eget libero id, facilisis dapibus  lorem. Vivamus nibh neque, euismod ut magna porta, fermentum rutrum  augue. Nullam vel felis ac purus tempus mollis ac ultrices dui. Nam  aliquam aliquet arcu dictum malesuada. Nam porta vestibulum magna  feugiat lobortis. Integer luctus ut est vitae interdum. Duis varius id  eros in consequat. Vestibulum iaculis ultrices dolor, vitae cursus est.  Pellentesque faucibus turpis vitae diam lobortis, ac ullamcorper neque  scelerisque.</p>
                            </div>
                            <div class="offset-1 col-4">
                            <img class="imagePost" src="img/Cat.jpg" alt="chat">
                            </div>
                        </div>
                    </div>
                    <!-- post 2 -->
                    <div class="post">
                    <h2 class="m-3">Titre 2 : $user</h2>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nec  commodo purus. Nam a est ac diam commodo bibendum. Vestibulum et risus  et urna maximus pulvinar. Proin efficitur lorem fringilla libero  volutpat, ac eleifend tellus rutrum. Sed accumsan dui eu tortor  condimentum, a auctor lectus semper. Donec cursus vestibulum justo ut  tempor. Vestibulum turpis sem, tempor eget libero id, facilisis dapibus  lorem. Vivamus nibh neque, euismod ut magna porta, fermentum rutrum  augue. Nullam vel felis ac purus tempus mollis ac ultrices dui. Nam  aliquam aliquet arcu dictum malesuada. Nam porta vestibulum magna  feugiat lobortis. Integer luctus ut est vitae interdum. Duis varius id  eros in consequat. Vestibulum iaculis ultrices dolor, vitae cursus est.  Pellentesque faucibus turpis vitae diam lobortis, ac ullamcorper neque  scelerisque.</p>
                            </div>
                            <div class="offset-1 col-4">
                            <img class="imagePost" src="img/Cat.jpg" alt="chat">
                            </div>
                        </div>
                    </div>
                    <!-- post 3 -->
                    <div class="post">
                    <h2 class="m-3">Titre 3 : $user</h2>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nec  commodo purus. Nam a est ac diam commodo bibendum. Vestibulum et risus  et urna maximus pulvinar. Proin efficitur lorem fringilla libero  volutpat, ac eleifend tellus rutrum. Sed accumsan dui eu tortor  condimentum, a auctor lectus semper. Donec cursus vestibulum justo ut  tempor. Vestibulum turpis sem, tempor eget libero id, facilisis dapibus  lorem. Vivamus nibh neque, euismod ut magna porta, fermentum rutrum  augue. Nullam vel felis ac purus tempus mollis ac ultrices dui. Nam  aliquam aliquet arcu dictum malesuada. Nam porta vestibulum magna  feugiat lobortis. Integer luctus ut est vitae interdum. Duis varius id  eros in consequat. Vestibulum iaculis ultrices dolor, vitae cursus est.  Pellentesque faucibus turpis vitae diam lobortis, ac ullamcorper neque  scelerisque.</p>
                            </div>
                            <div class="offset-1 col-4">
                            <img class="imagePost" src="img/Cat.jpg" alt="chat">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <h2 class="bold">My canal</h2>
                <h2>Mafille's canal</h2>
                <h2>Golay's canal</h2>
                <h2>Da cruz's canal</h2>

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
