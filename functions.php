<?php

function show_navbar() {
    echo "<div class='navbar'>
            <a href='/index.php'>Home</a>";
    if (isset($_SESSION['mail'])) {
        $account = $_SESSION['mail'];
        echo "<div class='dropdown'>
                <button class='dropbtn'> $account 
                    <i class='fa fa-caret-down'></i>
                </button>
                <div class='dropdown-content'>";
        if ($_SESSION['is_magazine'] == 1) {
            echo "<a href='admin/add_product.php'> Aggiungi prodotto</a>";
            echo "<a href='/admin/show_products.php'> Mostra prodotti</a>";
            echo "<a href='/admin/show_orders_admin.php'> Spedisci ordini</a>";
        }
        echo "<a href='/show_orders.php'>Mostra acquisti</a>
                <a href='/logout.php'>Logout</a>
            </div>
        </div> 
    </div>";
    } else {
        echo "<a href='/login.php' style='float:right'>Login</a>";
    }
    echo '</div>';
}

function connect() {
    $servername = "localhost";
    $username = "user";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=ecommerce", $username, $password);
    } catch (PDOException $e) {
        die("error " . $e->getMessage() . "<br>");
    }
    return $conn;
}

function login($mail, $password, $db) {
    $statement = $db->prepare("SELECT * FROM users WHERE mail = :mail AND passw = :passw");
    $statement->bindParam(':mail', $mail);
    $statement->bindParam(':passw', $password);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        echo "errore";
        header('Location: login.php');
    } else {
        $_SESSION['nome_utente'] = $user['nome'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['is_admin'] = $user['is_admin'];
        $_SESSION['is_magazine'] = $user['is_magazine'];
        header('Location: index.php');
    }
}

function logout() {
    $_SESSION['nome_utente'] = null;
    $_SESSION['mail'] = null;
    $_SESSION['is_admin'] = null;
    $_SESSION['is_magazine'] = null;
}

function register($nome, $cognome, $indirizzo, $mail, $password, $db) {
    $statement = $db->prepare("SELECT * FROM users WHERE mail = :mail");
    $statement->bindParam(':mail', $mail);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if ($row === true) {
        die('Gia iscritto');
    }
    $registration_statement = $db->prepare("INSERT INTO `users` (`nome`, `cognome`, `indirizzo`, `mail`, `passw`) VALUES(:nome, :cognome, :indirizzo, :mail, :password)");
    $registration_statement->bindParam(':nome', $nome);
    $registration_statement->bindParam(':cognome', $cognome);
    $registration_statement->bindParam(':indirizzo', $indirizzo);
    $registration_statement->bindParam(':mail', $mail);
    $registration_statement->bindParam(':password', $password);
    $registration_statement->execute();
    echo "registrazione effetuata";
}

function show_products($products) {
    while ($list = $products->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='product_container'>";
        echo "<div class='product_specs'>";
        echo "<h5>" . $list['nome_prodotto'] . "</h5>";
        echo '</div>';
        echo "<a href='product.php?id=" . $list['codice_prodotto'] . "'>";
        echo "<img src='" . $list['immagine'] . "'>";
        echo "</a>";
        echo '</div>';
    }
}

function show_product($product) {
    $disponibilita = $product['quantita'];
    echo "<div class='product'>";
    echo "<div class=''>";
    echo "<h3>" . $product['nome_prodotto'] . "</h3>";
    echo "<img src='" . $product['immagine'] . "'>";
    echo "</div>";
    echo "<p>" . $product['descrizione'] . "</p>";
    echo "</div>";
    echo "<div class='buy_bar'>";
    echo "<p>Prezzo: " . $product['prezzo'] . "$</p>";
    echo "<p>Quantita: $disponibilita</p>";
    if (isset($_SESSION['mail'])) {
        echo "<form method=GET action='buy_product.php'>";
        echo "<input type='number' name='quantita' value=1 min=1 max=$disponibilita>";
        echo "<input type='hidden' value='" . $product['codice_prodotto'] . "' name='id'>";
        echo "<input type='submit' value='Compra'>";
    }
    echo "</form>";
    echo "</div>";
}

function get_products($db) {
    $statement = $db->prepare("SELECT * FROM prodotti");
    $statement->execute();
    return $statement;
}

function get_product($db, $prodotto) {
    $statement = $db->prepare("SELECT * FROM prodotti WHERE codice_prodotto = :id");
    $statement->bindParam(":id", $prodotto);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function buy_product($id_prodotto, $quantita, $db) {
    $statement = $db->prepare("INSERT INTO `ordini` (`id_ordine`, `data_ordine`, `mail`, `data_spedizione`, `codice_prodotto`, `quantita`) VALUES (NULL, now(), :mail, NULL, :id, :quantita);");
    $statement->bindParam(":id", $id_prodotto);
    $statement->bindParam(":quantita", $quantita);
    $statement->bindParam(":mail", $_SESSION['mail']);
    $statement->execute();
    $new_statement = $db->prepare('SELECT quantita FROM prodotti WHERE codice_prodotto = :id');
    $new_statement->bindParam(':id', $id_prodotto);
    $new_statement->execute();
    $l = $new_statement->fetch(PDO::FETCH_ASSOC);
    $new_quantita = $l['quantita'] - $quantita;
    $update = $db->prepare("UPDATE `prodotti` SET `quantita` = :quantita WHERE `prodotti`.`codice_prodotto` = :id");
    $update->bindParam(':id', $id_prodotto);
    $update->bindParam(':quantita', $new_quantita);
    $update->execute();
    header('location: show_products.php');
}

function show_orders($db) {
    $statement = $db->prepare("SELECT * FROM `ordini` WHERE mail=:mail");
    $statement->bindParam(":mail", $_SESSION['mail']);
    $statement->execute();
    echo '<table>';
    echo"<tr>";
    echo"<th>id ordine</th>";
    echo"<th>Data ordine</th>";
    echo"<th>Codice prodotto</th>";
    echo"<th>Quantita</th>";
    echo"<th>Spedito</th>";
    echo"</tr>";
    while ($list = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $list['id_ordine'] . "</td>";
        echo "<td>" . $list['data_ordine'] . "</td>";
        echo "<td>" . $list['codice_prodotto'] . "</td>";
        echo "<td>" . $list['quantita'] . "</td>";
        if ($list['data_spedizione'] == NULL) {
            echo "<td>Non ancora spedito</td>";
        } else {
            echo "<td>" . $list['data_spedizione'] . "</td>";
        }
        echo "</tr>";
    }
}
