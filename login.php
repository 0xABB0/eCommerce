<?php
require_once 'functions.php';
session_start();
$db = connect();
if (isset($_POST['submit'])) {
    login($_POST['uname'], $_POST['psw'], $db);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/login.css">

        <style></style>
    </head>
    <body>
        <?php show_navbar(); ?>
        <div class="login-page">
            <div class="form">
                <form class="login-form"  method="POST" action="login.php">
                    <input type="text" placeholder="username" name="uname"/>
                    <input type="password" placeholder="password" name="psw"/>
                    <input type="submit" value="Login" name="submit">
                    <button>login</button>
                    <p class="message">Not registered? <a href="#">Create an account</a></p>
                </form>
            </div>
        </div>
    </body>
</html>