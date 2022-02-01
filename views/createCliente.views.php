<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/produtos.css">
    <title>Criar Cliente</title>
</head>
<body>
<?php require_once("componentes/header.php"); ?>

<div class="CreateContent" id="ModalClientes">
            <div class="Createheader">
                <label>Cadastro de Clientes</label>
            </div>
            <form id="FormCadastroClientes" action="" method="POST">
            <div class="Createbody">
                
                    <div class="CreateDadosInicial">
                    <div class="itemFormCreate">
                            <b>Dados Principais:</b>
                        </div>
                        <div class="itemFormCreate">
                            <label For="ClienteNome">Nome Completo:</label>
                            <input type="text" name="Nome" id="ClienteNome" required/>
                        </div>
                        <div class="itemFormCreate">
                            <label For="ClienteCPF">CPF:</label>
                            <input type="text" name="CPF" id="ClienteCPF" required/>
                        </div>
                        <div class="itemFormCreate">
                            <label For="Email">E-Mail:</label>
                            <input type="email" name="Email" id="Email" required/>
                        </div>
                        <div class="itemFormCreate">
                            <label >Data de Nascimento:</label>
                            <input type="date" name="Data_Nascimento"  required/>
                        </div>
                    </div>
                    <div class="CreateEnderecos">

                        <div class="itemFormCreate">
                            <b>Endereço:</b>
                        </div>
                        <div class="itemFormCreate">
                            <label For="eCEP">CEP:</label>
                            <input type="text" name="E_CEP" id="eCEP" />
                        </div>
                        <div class="itemFormCreate">
                            <label For="eLogradour">Logradouro:</label>
                            <input type="text" name="E_Logradouro" id="eLogradour" />
                        </div>
                        <div class="itemFormCreate">
                            <label For="eNumero">Número:</label>
                            <input type="text" name="E_Numero" id="eNumero" />
                        </div>
                        <div class="itemFormCreate">
                            <label For="eBairro">Bairro:</label>
                            <input type="text" name="E_Bairro" id="eBairro" />
                        </div>
                        <div class="itemFormCreate">
                            <label For="eComplemento">Complemento:</label>
                            <input type="text" name="E_Complemento" id="eComplemento" />
                        </div>
                        <div class="itemFormCreate">
                            <label For="eCidade">Cidade:</label>
                            <input type="text" name="E_Cidade" id="eCidade" required/>
                        </div>
                    </div>
                
            </div>
            <div class="CreateFooter">
                <a href="<?php echo URL_BASE; ?>/clientes" class="red w-2 BtnCreate">Cancelar</a>
                <button type="submit" class="green w-2 BtnCreate" >Cadastrar</button>
            </div>
            </form>
        </div>
        <script src="./js/script.js"></script>
</body>
</html>