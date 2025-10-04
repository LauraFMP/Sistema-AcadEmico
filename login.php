<?php
session_start();
include("banco_dados.php");

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Busca usuário
$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Senha incorreta!'); window.location.href='login.html';</script>";
    }
} else {
    echo "<script>alert('Usuário não encontrado!'); window.location.href='login.html';</script>";
}
?>