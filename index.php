<?php
    require_once 'classes/usuarios.php';
    $u = new Usuario;
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
        <h2 class="form-login-heading">Entre com o usuario</h2>
        <div class="form-group">
             <label for="inputEmail" class="sr-only">E-mail</label>
             <input type="email" id="inputEmail"  name="email" class="form-control" placeholder="Email" required autofocus>
        </div>
         <div class="form-group">
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required>
        </div>
        <div class="form-group">
             <a href="cadastrar.php">Clique para casdastrar</a>   
        </div>
        <div class="form-group">
            <input type="submit" value="Acessar" class="btn btn-lg btn-success login_btn">
        </div>
    </form>
</div>
<?php
    if(isset($_POST['email']))
    {
       $email = addslashes($_POST['email']);
       $senha = addslashes($_POST['senha']);
        
       if(!empty($email && !empty($senha))) 
       {
        $u->conectar("projeto","localhost","root","");

        $tipo = $u->logar($email, $senha);
        
        if($tipo == false)
        {   
            ?>
            <script>
                    alert('Error ao pegar dado do banco');
            </script>
        <?php
        }
        else
        {
            switch($tipo) {
                case "D":
                    header('Location:diretor.php');
                break;
                case "G":
                    header('Location:gerente.php');
                break;
                case "C":
                    header('Location:colaborador.php');
                break;
            }
        }
       }else
       {
        ?>
            <script>
                    alert('Preencha todos os campos');
            </script>
        <?php
       }
    }

?>
</body>
</html>