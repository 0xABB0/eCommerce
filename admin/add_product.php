<link rel="stylesheet" href="../css/global.css">
<link rel="stylesheet" href="../css/navbar.css">
<?php
require_once '../functions.php';
require_once 'admin_functions.php';
session_start();
$db = connect();
if ($_SESSION['is_magazine'] == 0) {
    die( "Non hai i permessi per accedere a questa pagina");
}
if (isset($_POST['add_product'])) {
    add_product($_POST['nome_prodotto'], $_POST['prezzo'], $_POST['quantita'], $_POST['descrizione'], $_POST['categoria'], $_FILES['file_to_upload'], $db);
}
show_navbar();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Aggiungi un prodotto</title>
    </head>
    <body>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            Nome prodotto <input type="text" name="nome_prodotto"><br>
            Prezzo <input type="number" name="prezzo" step=".01" min="0"><br>
            Quantita <input type="number" name="quantita" min="1"><br>
            Descrizione <input type="text" name="descrizione"><br>
            Categoria <input type="text" name="categoria"><br>
            Immagine <input type="file" name="file_to_upload"><br>
            <input type="submit" name="add_product" value="Aggiungi">
        </form>
        <a href="show_products.php">torna indietro</a>
    </body>
</html>