<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/produtos.css">
    <title>Criar</title>
</head>
<body>
<?php require_once("componentes/header.php"); ?>
<div class="ModalContent" id="ModalProdutos">
    <form class="FormProdutos" action="" method="POST">
    <div class="Modalheader">
        <label>Cadastro de Produtos</label>
    </div>
    
    <div class="Modalbody">
        
            <div class="itemForm">
                <label htmlFor="">Nome:</label>
                <input type="text" name="nome" id="ProdutoNome"/>
            </div>
            <div class="itemForm">
                <label htmlFor="">Valor:</label>
                <input type="number" name="vr_produto" id="ProdutoValor" />
            </div>
        
    </div>
    <div class="Modalfooter">
        <button type="submit" class="btn green w-2" style="margin: 0 10px 0 10px;" type="submit">Cadastrar </button>
    </div>
    </form>
</div>
</body>
</html>