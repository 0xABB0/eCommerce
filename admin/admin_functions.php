<?php

function show_products_admin($products) {
    echo "<table>";
    echo"<tr>";
    echo"<th>Codice prodotto</th>";
    echo"<th>Nome prodotto</th>";
    echo"<th>Prezzo</th>";
    echo"<th>Quantita</th>";
    echo"</tr>";
    while ($list = $products->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $list['codice_prodotto'] . "</td>";
        echo "<td>" . $list['nome_prodotto'] . "</td>";
        echo "<td>" . $list['prezzo'] . "</td>";
        echo "<td>" . $list['quantita'] . "</td>";
        echo "<td>";
        echo "<form method=GET action='buy_product.php'>";
        echo "<input type='number' name='quantita' length=5>";
        echo "<input type='hidden' value='" . $list['codice_prodotto'] . "' name='id'>";
        echo "<input type='submit' value='Aggiorna'>";
        echo "</td>";
        echo "<td>" . "<a href='remove_product.php?id=" . $list['codice_prodotto'] . "'> <img src='img/delete.jpg'> </a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function add_product($nome_prodotto, $prezzo, $quantita, $descrizione, $categoria, $file_to_upload, $db) {
    $img_path = save_image($file_to_upload);
    $statement = $db->prepare("INSERT INTO `prodotti` (`codice_prodotto`, `nome_prodotto`, `prezzo`, `quantita`, `immagine`, `descrizione`, `categoria`) VALUES (NULL, :nome_prodotto, :prezzo, :quantita, :img, :descrizione, :categoria)");
    $statement->bindParam(':nome_prodotto', $nome_prodotto);
    $statement->bindParam(':prezzo', $prezzo);
    $statement->bindParam(':quantita', $quantita);
    $statement->bindParam(':img', $img_path);
    $statement->bindParam(':descrizione', $descrizione);
    $statement->bindParam(':categoria', $categoria);
    $statement->execute();
    echo "prodotto aggiunto";
}

function save_image($file_to_upload) {
    $target_dir = "img/";
    $target_file = basename($file_to_upload["name"]);
    $target_path = $target_dir . $target_file;
    $errors = check_errors($file_to_upload, $target_path);
    if ($errors == 0) {
        if (move_uploaded_file($file_to_upload["tmp_name"], "../" . $target_path)) {
            echo "The file " . basename($file_to_upload["name"]) . " has been uploaded. <br>";
        } else {
            echo "Errore nel fare l'upload <br>";
        }
    } else {
        die("Errore nel file,<a href='add_product.php'> riprovare</a> o <a href='show_products.php'> torna indietro</a><br>");
    }
    return $target_path;
}

function check_errors($file_to_upload, $target_path) {
    $errors = 0;
    $image_file_type = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
    if (!getimagesize($file_to_upload["tmp_name"])) {
        echo "File non immagine <br>";
        $errors = 1;
    }
    if (file_exists($target_path)) {
        echo "File gia esistente <br>";
        $errors = 1;
    }
    if ($file_to_upload["size"] > 1000000) {
        echo "File troppo grande <br>";
        $errors = 1;
    }
    if ($image_file_type != "jpg" && $image_file_type != "png") {
        echo "Formato immagine non supportato <br>";
        $errors = 1;
    }
    return $errors;
}

function update_product($id_prodotto, $quantita, $db) {
    $statement = $db->prepare("UPDATE `prodotti` SET `quantita` = :quantita WHERE `prodotti`.`codice_prodotto` = :id");
    $statement->bindParam(":id", $id_prodotto);
    $statement->bindParam(":quantita", $quantita);
    $statement->execute();
    echo 'Quantita aggiornata';
}

function edit_amount($numero, $prodotto, $db) {
    $statement = $db->prepare('SELECT quantita FROM prodotti WHERE codice_prodotto = :id');
    $statement->bindParam(':id', $prodotto);
    $statement->execute();
    $l = $statement->fetch(PDO::FETCH_ASSOC);
    $quantita = $l['quantita'] + $numero;
    if ($quantita < 1) {
        remove_product($prodotto, $db);
    } else {
        $update = $db->prepare("UPDATE `prodotti` SET `quantita` = :quantita WHERE `prodotti`.`codice_prodotto` = :id");
        $update->bindParam(':id', $prodotto);
        $update->bindParam(':quantita', $quantita);
        $update->execute();
        header('location: show_products.php');
    }
}

function remove_product($id, $db) {
    $statement = $db->prepare("DELETE FROM `prodotti` WHERE `prodotti`.`codice_prodotto` = :id");
    $statement->bindParam(':id', $id);
    $statement->execute();
    header('Location: show_products.php');
}

function show_orders_admin($db) {
    $statement = $db->prepare("SELECT * FROM `ordini`");
    $statement->execute();
    echo '<table>';
    echo"<tr>";
    echo"<th>Mail</th>";
    echo"<th>id ordine</th>";
    echo"<th>Data ordine</th>";
    echo"<th>Codice prodotto</th>";
    echo"<th>Quantita</th>";
    echo"<th>Spedito</th>";
    echo"</tr>";
    while ($list = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $list['mail'] . "</td>";
        echo "<td>" . $list['id_ordine'] . "</td>";
        echo "<td>" . $list['data_ordine'] . "</td>";
        echo "<td>" . $list['codice_prodotto'] . "</td>";
        echo "<td>" . $list['quantita'] . "</td>";
        if ($list['data_spedizione'] == NULL) {
            echo "<td>Non ancora spedito</td>";
            echo "<td><button type'button' class='cancelbtn' onclick=\"window.location.href='deliver.php?id=" . $list['id_ordine'] . "'\">Spedisci</button>";
        } else {
            echo "<td>" . $list['data_spedizione'] . "</td>";
        }
        echo "</tr>";
    }
}

function deliver_order($db, $id_ordine) {
    $statement = $db->prepare("UPDATE `ordini` SET `data_spedizione` = now() WHERE `ordini`.`id_ordine` = :id_ordine");
    $statement->bindParam(":id_ordine", $id_ordine);
    $statement->execute();
    echo "Ordine spedito";
    header("Location: show_orders_admin.php");
}
