<?php
$servidor = "localhost";
$usuario = "root";  // altere se seu MySQL tiver outro usuário
$senha = "";        // altere se houver senha
$banco = "sistema_academico";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}
?>