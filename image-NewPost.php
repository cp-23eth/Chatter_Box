<?php
session_start();
require_once('db.php');
$db = new db("root", "");

$_SESSION['imgSrc'] = $_GET['source'];