<?php
session_start();
require_once('db.php');
$db = new db("root", "1234");

$sub = $_GET['sub'];

$db->makeUnsubscription($sub);
$_SESSION['canal'] = $db->takeFirstCanal();
// echo "Vous vous êtes désabonnés au canal {$sub}";