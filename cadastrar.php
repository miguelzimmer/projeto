<?php
    require_once 'classes/usuarios.php';
    $u = new Usuario();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
<form method="POST" class="form-login">
    <h2 class="form-login-heading">Cadastre seu usuario</h2>
    <div class="form-group">
        <input type="text" placeholder="Nome Completo" class="form-control" maxlength="30" name="nome" required>
    </div>
    <div class="form-group">
        <input type="email" id="inputEmail"  name="email" class="form-control" placeholder="Email" maxlength="40" required autofocus>
    </div>
    <div class="form-group">
        <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" maxlength="32" required>
    </div>
    <div class="form-group"> 
        <input type="password" id="inputPassword" name="confSenha" class="form-control" placeholder="Confirma Senha" maxlength="32" required><br>
    </div>
    
    <label>Escolha seu cargo:</label>
    <p>
        <input type="radio" name="tipo" value="D" required> Diretor
        <input type="radio" name="tipo" value="G"> Gerente
        <input type="radio" name="tipo" value="C"> Colaborador
    </p>
    
    
    <div class="form-group">
        <input type="submit" value="Cadastrar" class="btn  btn-lg btn-success login_btn">
        <button type="button"><a href="index.php">Sair</a></button>
    </div>
</form>
</div>
<?php
// vereficar se a pessa clicou no botao
if(isset($_POST['nome']))
{
   $nome = addslashes($_POST['nome']);
   $email = addslashes($_POST['email']);
   $senha = addslashes($_POST['senha']);
   $confSenha = addslashes($_POST['confSenha']);
   $tipo = addslashes($_POST['tipo']);

   $u->conectar("projeto","localhost","root","");
   if($u->msgErro == "")
   {
        if($senha == $confSenha)
        {
            if($u->cadastrar($nome,$email,$senha,$tipo))
            {   
                ?>
                <script>
                    alert('Cadastrado com Sucesso');
                </script>
                <?php
            }
            else
            {
                ?>
                <script>
                    alert('Email ja cadastrado!');
                </script>
                <?php
            }
        }
        else
        {
            ?>
            <script>
                alert('Senha e confirma senha não correspondem! ');
            </script>
            <?php
        }
    }
     else
    {
    ?>
    <script>
        alert('Senha e confirma senha não correspondem! ');
    </script>
    <?php
   }
}
?>
</body>
</html>