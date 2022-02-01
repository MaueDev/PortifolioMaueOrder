<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/findcliente.css">
    <title>Cliente </title>
</head>
<body>
<?php require_once("componentes/header.php"); ?>
<div class='ConteinerFinCliente'>
    <div class="date">
        <table>
            <thead>
                <tr>
                    <th>Nome:</th>
                    <th colSpan="5"><?php echo $Cliente["Nome"]; ?></th>
                </tr>
                <tr>
                    <th>CPF:</th>
                    <th colSpan="5"><?php echo $Cliente["CPF"]; ?></th>
                </tr>
                <tr>
                    <th>E-Mail:</th>
                    <th colSpan="5"><?php echo $Cliente["Email"]; ?></th>
                </tr>
                <tr>
                    <th>Data de Nascimento:</th>
                    <th colSpan="5"><?php echo $Cliente["Data_Nascimento"]; ?></th>
                </tr>
                <tr>
                    <th>Endereço</th>
                    <th colSpan="5"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CEP:</td>
                    <td>Logradouro:</td>
                    <td>Número:</td>
                    <td>Bairro:</td>
                    <td>Completo:</td>
                    <td>Cidade:</td>
                </tr>
                <tr>
                    <td><?php echo $Cliente["E_CEP"]; ?></td>
                    <td><?php echo $Cliente["E_Logradouro"]; ?></td>
                    <td><?php echo $Cliente["E_Numero"]; ?></td>
                    <td><?php echo $Cliente["E_Bairro"]; ?></td>
                    <td><?php echo $Cliente["E_Complemento"]; ?></td>
                    <td><?php echo $Cliente["E_Cidade"]; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script src="./js/script.js"></script>
</body>
</html>