<?php
session_start();

// Verifica login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$resultado = "";
$classe = "";
$ultimoNumero = isset($_COOKIE['ex03_ultimo']) ? $_COOKIE['ex03_ultimo'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = (int)$_POST["numero"];

    if ($numero < 0 || $numero > 20) {
        $resultado = "Número inválido! Digite um valor entre 0 e 20.";
        $classe = "erro";
    } else {
        // Salva último número em cookie
        setcookie("ex03_ultimo", $numero, time() + 3600);

        // Calcula fatorial
        $fatorial = 1;
        $expressao = "$numero! = ";

        for ($i = $numero; $i > 0; $i--) {
            $fatorial *= $i;
            $expressao .= $i . ($i > 1 ? " × " : " = ");
        }

        $expressao .= $fatorial;

        $resultado = $expressao;
        $classe = "sucesso";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Exercício 3</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Resultado - Fatorial</h2>

        <?php
            if (!empty($resultado)) {
                echo "<p class='$classe'>$resultado</p>";
            }
            if ($ultimoNumero !== null) {
                echo "<p><strong>Último número calculado:</strong> $ultimoNumero</p>";
            }
        ?>

        <div class="botoes-retorno">
            <a class="btn-secundario" href="exercicio3.html"> Tentar novamente</a>
            <a class="btn-secundario" href="index.php"> Voltar ao início</a>
        </div>
    </div>
</body>
</html>