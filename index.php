<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Benvenuto</title>
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/navbar.css">
        <style>
            .product_container img{
                height: 250px;
                width: 250px;
            }
            .product_container{
                float: left;
                margin: 10px 10px 10px 10px;
            }
        </style>
    </head>
    <body>
        <?php
        require_once 'functions.php';
        session_start();
        $db = connect();
        show_navbar();
        show_products(get_products($db));
        ?>
    </body>
</html>
