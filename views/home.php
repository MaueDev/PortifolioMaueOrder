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
    <div class="itemMenuPrincipal">
        <ul>
            <li class="itemMenu">
                <a href="<?php echo URL_BASE; ?>/produtos"> 
                    <AiFillCreditCard/>
                    <label>Produtos</label>
                </a>
            </li>
            <li class="itemMenu">
                <a href="<?php echo URL_BASE; ?>/clientes"> 
                    <AiFillGolden/>
                    <label>Clientes</label>
                </a>
            </li>
            <li class="itemMenu">
                <a href="<?php echo URL_BASE; ?>/.newpedido"> 
                    <AiFillShop/>
                    <label>Novo Pedido</label>
                </a>
            </li>
            <li class="itemMenu">
                <a href="<?php echo URL_BASE; ?>/historico"> 
                    <AiFillReconciliation/>
                    <label>Historico Pedido</label>
                </a>
            </li>
        </ul>
    </div>
</main>
</body>
</html>