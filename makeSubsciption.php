<?php
session_start();
require_once('db.php');
$db = new db("root", "1234");

$sub = $_GET['sub'];

$db->makeSubscription($sub);
// echo "Vous vous êtes abonnés au canal {$sub}";