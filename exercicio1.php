<?php
session_start();

// Verifica login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$resultado = "";
$ultimoNumero = isset($_COOKIE['ex01_ultimo']) ? $_COOKIE['ex01_ultimo'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = (int)$_POST["numero"];

    // Grava último número em cookie
    setcookie("ex01_ultimo", $numero, time() + 3600);

    if ($numero > 0) {
        $resultado = "<p class='resultado-pos'>Valor positivo</p>";
    } elseif ($numero < 0) {
        $resultado = "<p class='resultado-neg'>Valor negativo</p>";
    } else {
        $resultado = "<p class='resultado-zero'>Igual a zero</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Exercício 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Resultado - Exercício 1</h2>

        <?php
            if (!empty($resultado)) {
                echo $resultado;
            }
            if ($ultimoNumero !== null) {
                echo "<p><strong>Último número digitado:</strong> $ultimoNumero</p>";
            }
        ?>

        <div class="botoes-retorno">
            <a class="btn-secundario" href="exercicio1.html"> Tentar novamente</a>
            <a class="btn-secundario" href="index.php"> Voltar ao início</a>
        </div>
    </div>
</body>
</html>