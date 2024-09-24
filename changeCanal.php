<?php
session_start();
require_once('db.php');
$db = new db("root", "");

$canal = $_GET['channel'];
$_SESSION['canal'] = $canal;