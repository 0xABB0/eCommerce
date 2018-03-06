<?php
require_once '../functions.php';
require_once 'admin_functions.php';
session_start();
$db = connect();
if($_SESSION['is_magazine']==0){
	echo "Non hai i permessi per accedere a questa pagina";
	die();
}
$prodotto = $_GET['id'];
$numero = $_GET['number'];
edit_amount($numero, $prodotto, $db);