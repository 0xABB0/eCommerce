<?php
require_once 'functions.php';
session_start();
$db = connect();
if (isset($_POST['register'])) {
	register($_POST['nome'], $_POST['cognome'], $_POST['indirizzo'], $_POST['mail'], $_POST['password'], $db);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/navbar.css">
    </head>
    <body>
        <?php show_navbar(); ?>
        <h1>Register</h1>
        <form class="form" action="register.php" method="post">
            Nome <input type="text" id="nome" name="nome"><br>
            Cognome <input type="text" id="cognome" name="cognome"><br>
            Indirizzo <input type="text" name="indirizzo"><br>
            Mail <input type="text" name="mail"><br>
            Password <input type="text" name="password"><br>
            <input type="submit" name="register" value="Register">
        </form>
    </body>
</html>