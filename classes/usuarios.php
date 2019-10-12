<?php
    class Usuario
    {
        private $pdo;
        public $msgErro = "";

        public function __construct()
        {
            
        }

        public function conectar($nome,$host,$usuario,$senha)
        {
            global $pdo;
            try {
                $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
            } catch (PDOException $e) {
                $msgErro = $e->getMessage();
            }
            
        }
        public function cadastrar($nome,$email,$senha,$tipo)
        {
            global $pdo;
            #Verificando se ja existe um email cadastrado
            $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
            #para alterar o (:e) da query utilizei o bindValue
            $sql->bindValue(":e",$email);
            $sql->execute();
            #Contando as linhas que vai vim do banco de dados
            if($sql->rowCount() > 0)
            {
                return false;  // ja esta cadastrado
            }
            else
            {
                // caso nao, Cadastrar
                $sql = $pdo->prepare("INSERT INTO usuarios (nome,email,senha,tipo) VALUES(:n,:e,:s,:t)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",md5($senha));
                $sql->bindValue(":t",$tipo);
                $sql->execute();
                return true;
            }
        }
        public function logar($email,$senha)
        {
            global $pdo;
            //Verificar se o email e senha estao cadastrados,se sim
            $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :e AND senha = :s");
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                //entrar no sistema (sessao)
                $dado = $sql->fetch();// funçao fetch pega o que vem do banco e transforma em array
                session_start();
                $_SESSION['id_usuario'] = $dado['id_usuario'];
                return $dado["tipo"]; //logado com sucesso                
            }
            else
            {
                return false; // nao foi possivel logar
            }
            
        }
        public function listar()
        {
            global $pdo;
            $sql = $pdo->query("SELECT id_usuario, nome, email, tipo FROM usuarios", PDO::FETCH_ASSOC);

            return ($sql->rowCount() > 0) ? $sql->fetchAll() : [];
        }
    }
?>