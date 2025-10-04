<?php
$host = "localhost";
$user = "root";      // usuário do MySQL
$pass = "";          // senha do MySQL (padrão no XAMPP é vazio)
$dbname = "sistema_login";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>