<?php
session_start();
require_once('db.php');
$db = new db("root", "");

$sub = $_GET['sub'];

$db->makeSubscription($sub);
echo "Vous vous êtes abonnés au canal {$sub}";

// if(){
//     // echo '<script type="text/javascript">
//     //     alert("Vous vous êtes abonnés au canal {$sub}");
//     // </script>';

// }
// else {
//     // echo '<script type="text/javascript">
//     //     alert("Vous vous êtes déjà abonnés à ce canal");
//     // </script>';

//     echo "Vous vous êtes déjà abonnés à ce canal";
// }