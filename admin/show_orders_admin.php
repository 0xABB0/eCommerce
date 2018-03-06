<link rel="stylesheet" href="../css/global.css">
<link rel="stylesheet" href="../css/navbar.css">
<?php
require_once '../functions.php';
require_once 'admin_functions.php';
session_start();
show_navbar();
$db = connect();
show_orders_admin($db);
