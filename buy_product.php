<?php
require_once 'functions.php';
session_start();
$db = connect();
buy_product($_GET['id'], $_GET['quantita'], $db);
header('Location: index.php');