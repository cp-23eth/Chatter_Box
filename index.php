<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <?php
        session_start();

        $_SESSION['imgSrc'] = "";
        $_SESSION['user'] = "";

        header("Location: login.php");
        exit();
    ?>
</body>
</html>