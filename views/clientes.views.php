<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/clientes.css">
    <title>Clientes</title>
</head>
<body>
<?php require_once("componentes/header.php"); ?>
<main class="ItemClienteContent">
    <table id="lista ">
        <thead>
            <tr>
                <th colSpan="5">
                    <div class="PesquisaClienteContent">
                        <input type="text" id="ClientesSearch" onkeyup="filterFunction('ClientesSearch','BodyAllTd','tr')"/>
                    </div>
                </th>
                <th>
                <a href="./clientes/create" class="btn h-1 white">Criar</a>
                </th>
            </tr>
            <tr id="TrTitles">
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Cidade</th>
                <th>E-mail</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="BodyAllTd">
            <?php while($c = $Clientes->fetch(PDO::FETCH_ASSOC)){?>
            <tr class='ClientesTr' id="<?php echo $c['id'] ?>" >
                <td><?php echo $c['id'] ?></td>
                <td><?php echo $c['Nome'] ?></td>
                <td><?php echo $c['CPF'] ?></td>
                <td><?php echo $c['E_Cidade'] ?></td>
                <td><?php echo $c['Email'] ?></td>
                <td ><a href="./clientes/<?php echo $c['id'] ?>" class="btn h-1 green">Ver</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<script src="./js/script.js"></script>
</body>
</html>