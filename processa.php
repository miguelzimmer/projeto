<?php
require_once 'classes/usuarios.php';
$u = new Usuario();
//conexao com banco de dados
$u->conectar("projeto","localhost","root","");  

$dados = $u->listar();

echo json_encode(["data" => $dados]);
?>
