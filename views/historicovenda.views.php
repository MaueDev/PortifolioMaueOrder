<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/historico.css">
    <title>Historico</title>
</head>
<body>
<?php require_once("componentes/header.php"); ?>
    <div class="CreateContent">
        <table>
            <thead>
                <tr>
                    <th>ID VENDA</th>
                    <th>CLIENTE</th>
                    <th>VALOR</th>
                    <th>DATA CONCLUSAO</th>
                    <th>DATA INICIO</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($Pedido as $chave) 
                {?>
                    <tr>
                        <td><?php echo $chave['id']?></td>
                        <td><?php echo $chave['Nome']?></td>
                        <td><?php echo $chave['VrPedido']?></td>
                        <td><?php echo $chave['DataConclusao']?></td>
                        <td><?php echo $chave['DataInicioPedido']?></td>
                        <?php if($chave['Status'] == 1)
                        {
                            echo "<td class=''><a href=''> FINALIZADO</a></td>";
                        }
                        else
                        {
                            echo "<td class=''><a href='".URL_BASE."/newpedido/".$chave['id']."'> AGUARDO</a> </td>";
                        }
                        ?>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
<script src="./js/script.js"></script>
</body>
</html>