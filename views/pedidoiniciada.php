<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pdv.css">
    <title>Novo Pedido</title>
    <script>
       
    </script>
</head>
<body>
<?php require_once("componentes/header.php"); ?>
<div class="PDVContainer">
        <div class="tablepdv">

            <table>
                <thead>
                    <tr>
                        <th >
                            ID: <?php echo $Pedido[0]['id']; ?>
                        </th>
                        <th >
                            <?php echo $Pedido[0]['Nome']; ?>
                        </th>
                        <th >
                            
                        </th>
                        <th>
                            <button class="btn btnIniciarVenda" id="ClienteBtn"> Cliente </button>
                        </th>
                    </tr>
                    <tr>
                        <form action="" method="POST">
                        <th colSpan="2">
                            <input type="hidden" id="IdProdutoAdicionar" name="idProduto" required/>
                            <input type="text" placeholder="Nome Produto" id="ProdutoName" required readonly/>
                        </th>
                        <th colSpan="1">
                            <input type="number" placeholder="Quantidade" value="1" name="qtdProduto" required/>
                        </th>
                        <th colSpan="1">
                            <input type="submit" value="Adicionar" class="btn"/>
                        </th>
                        </form>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>PRODUTOS</th>
                        <th>QUANTIDADE</th>
                        <th>VALOR:</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($Pedido[0]['Produtos'])){
                    foreach ($Pedido[0]['Produtos'] as $chave) 
                    {?>
                    <tr>
                        <td><?php echo $chave['id']?></td>
                        <td><?php echo $chave['Nome']?></td>
                        <td><?php echo $chave['qtdProduto']?></td>
                        <td><?php echo $chave['VrProduto']?></td>
                    </tr>
                <?php }}?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Valor: R$ <?php echo $Pedido[0]['VrPedido']; ?></th>
                        <th></th>
                        <th></th>
                        <th><form action="" method="POST"><button type="submit" name="FinalizarVenda" value="true" class="btn green btnIniciarVenda"/>Concluir Venda</form></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="produtospdv">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Produtos</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colSpan="3">
                            <input type="text" id="ProdutoSearch" placeholder="Buscar Produto" onkeyup="filterFunction('ProdutoSearch','ProdutosSearch','tr')"/>
                        </th>
                    </tr>
                        <tr class="TrClick">
                            <th>ID</th>
                            <th>NOME</th>
                            <th>VALOR</th>
                    </tr>
                </thead>
                <tbody class="ClickTbody" id="ProdutosSearch">
                    <?php while($Produto = $Produtos->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr onclick="SetarCliente('Produto<?php echo $Produto['id']; ?>')" id="Produto<?php echo $Produto['id']; ?>">
                    <td><?php echo $Produto['id']; ?></td>
                    <td><?php echo $Produto['Nome']; ?></td>
                    <td><?php echo $Produto['vr_produto']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="ListClienteModal" id="ListClienteModal" style="display: none;">
        <div id="myDropdown" class="SearchClientecontent">
            <input type="text" placeholder="Pesquisar Cliente" id="SearchCliente" onkeyup="filterFunction('SearchCliente','ClienteContainer','button')">
            <div class="ClienteContainer" id="ClienteContainer">
                <?php while($Cliente = $Clientes->fetch(PDO::FETCH_ASSOC)){ ?>
                <form action="" method="POST"><button type="submit" class="BtnList" name="cliente" value="<?php echo $Cliente["id"] ?>"><?php echo $Cliente["Nome"] ?></button></form>
                <?php } ?>
            </div>
        </div>
    </div>
<script src="../js/script.js"></script>
</body>
</html>