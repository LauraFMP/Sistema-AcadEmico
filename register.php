<?php
session_start();
include("banco_dados.php");

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Verifica se usuário já existe
$check = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "<script>alert('Esse usuário já existe!'); window.location.href='register.html';</script>";
} else {
    // Criptografa a senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere no banco
    $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario', '$senhaHash')";
    if ($conn->query($sql) === TRUE) {
        // Já faz login automático após cadastro
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>