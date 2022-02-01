<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/produtos.css">
    <title>Produtos</title>
</head>
<body>
<?php require_once("componentes/header.php"); ?>
<main class="ItemProdutoContent">
        <table id="lista ">
            <thead>
                <tr>
                    <th colSpan="2">
                        <div class="PesquisaProdutoContent">
                            <input type="text" id="ProdutoSearch" onkeyup="filterFunction('ProdutoSearch','BodyAllTd','tr')" />
                        </div>
                    </th>
                    <th>
                    <a href="./produtos/criar" class="btn h-1 white" >Criar</a>
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Nome do Produto</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody id="BodyAllTd">
                <?php while($e = $allProdutos->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr class='ProdutosTr' id="<?php echo $e['id']; ?>" >
                    <td><?php echo $e['id']; ?></td>
                    <td><?php echo $e['Nome']; ?></td>
                    <td><?php echo $e['vr_produto']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
</main>
<script src="./js/script.js"></script>
</body>
</html>