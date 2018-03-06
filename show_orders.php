<link rel="stylesheet" href="css/global.css">
<link rel="stylesheet" href="css/navbar.css">
<?php
require_once 'functions.php';
session_start();
$db = connect();
show_navbar();
show_orders($db);
