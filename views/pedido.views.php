<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/pdv.css">
    <title>Novo Pedido</title>
</head>
<body>
<?php require_once("componentes/header.php"); ?>
<div class="PDVContainer">
            <div class="tablepdv">

                <table>
                    <thead>
                        <tr>
                            <th >
                                ID:
                            </th>
                            <th >
                                CLIENTE:
                            </th>
                            <th >
                                Mauricio Rodrigues
                            </th>
                            <th>
                                <button class="btn btnVenda"> Cliente </button>
                            </th>
                        </tr>
                        <tr>
                            <th colSpan="2">
                                <input type="text" />
                            </th>
                            <th colSpan="1">
                                <input type="number" />
                            </th>
                            <th colSpan="1">
                                <Button value="Adicionar" class="btn"></Button>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>PRODUTOS</th>
                            <th>QUANTIDADE</th>
                            <th>VALOR:</th>
                        </tr>
                    </thead>
                    <tbody>
                        

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Valor</th>
                            <th></th>
                            <th></th>
                            <th><button class="btn green btnVenda"/>Concluir Venda</th>
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
                                <input type="text" />
                            </th>
                        </tr>
                        <tr>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>VALOR</th>
                            </tr>
                        </tr>
                    </thead>
                    <tbody>
                        

                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <div class="ContainerAllPedidos">
            </div>
            <form action="" method="POST">
            <div class="bodyAllPedidos">
                    <input type="hidden"  name="NewVenda" value="true"/>
                    <button class="btnIniciarVenda btn red ">Iniciar Venda</button>
                    <a href="./home" class="btnIniciarVenda btn green"> Cancelar </a>
            </div>
            </form>
        </div>
        <script src="./js/script.js"></script>

</body>
</html>