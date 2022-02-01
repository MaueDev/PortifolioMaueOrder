<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Home</title>
</head>
<body>
    <?php require_once("componentes/header.php"); ?>
<main class="MenuPrincipalContent">
    <ul>
        <li class="itemMenu">
            <a href="<?php echo URL_BASE; ?>/produtos"> 
                <label>Produtos</label>
            </a>
        </li>
        <li class="itemMenu">
            <a href="<?php echo URL_BASE; ?>/clientes"> 
                <label>Clientes</label>
            </a>
        </li>
        <li class="itemMenu">
            <a href="<?php echo URL_BASE; ?>/newpedido"> 
                <label>Novo Pedido</label>
            </a>
        </li>
        <li class="itemMenu">
            <a href="<?php echo URL_BASE; ?>/historico"> 
                <label>Historico Pedido</label>
            </a>
        </li>
    </ul>
</main>
</body>
</html>