<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaueOrder</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main class="LoginMain">
        <div class="LoginBox">
            <div class="LoginFormDiv">
                <form id="AuthOrde" action="" method="POST">
                    <div class="InputLogin">
                        <label>Usuario:</label> 
                        <input type="text" name="User"/>
                    </div>
                    <div class="InputLogin">
                        <label>Senha:</label>
                        <input type="password" name="Password"  />
                    </div>
                    <div class="ErrorLogin" id="ErrorLogin">
                    </div>
                    <button type="submit" id="BtnEntrar" class="btn font-1 red" value="Entrar" >Entrar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>