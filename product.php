<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/navbar.css">
        <style>
            img{
                width: 500px;
                height: 500px;
            }
            .buy_bar {
                height: 100%;
                width: 150px;
                position: fixed;
                z-index: 1;
                top: 0;
                right: 0;
                background-color: #111;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
            }
            .product{
                margin-right: 150px;
            }
            .navbar_override{
                margin-right: 150px;
            }
            .buy_bar p {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }
            
        </style>
    </head>
    <body>
        <?php
        require_once 'functions.php';
        session_start();
        $db = connect();
        echo "<div class='navbar_override'>";
        show_navbar();
        echo "</div>";
        show_product(get_product($db, $_GET['id']));
        ?>
    </body>
</html>
