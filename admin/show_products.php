<link rel="stylesheet" href="../css/global.css">
<link rel="stylesheet" href="../css/navbar.css">
<style>
    img{
        width: 40px;
        height: 40px;
    }
</style>
<?php
require_once '../functions.php';
require_once 'admin_functions.php';
session_start();
show_navbar();
$db = connect();
if ($_SESSION['is_magazine'] == 0) {
    echo "Non hai i permessi per accedere a questa pagina";
}
show_products_admin(get_products($db));
?>
<a href="add_product.php"> aggiungi un prodotto</a>