<?php
session_start();

// Verifica login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$resultado = "";
$ultimoNumero = isset($_COOKIE['ex02_numero']) ? $_COOKIE['ex02_numero'] : null;
$ultimoFormato = isset($_COOKIE['ex02_formato']) ? $_COOKIE['ex02_formato'] : "lista";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = (int)$_POST["numero"];
    $formato = $_POST["formato"];

    // Salva cookies
    setcookie("ex02_numero", $numero, time() + 3600);
    setcookie("ex02_formato", $formato, time() + 3600);

    // Monta a tabuada
    if ($formato === "lista") {
        $resultado .= "<ul class='tabuada'>";
        for ($i = 0; $i <= 10; $i++) {
            $resultado .= "<li>$numero × $i = " . ($numero * $i) . "</li>";
        }
        $resultado .= "</ul>";
    } else {
        $resultado .= "<table class='tabuada'>";
        for ($i = 0; $i <= 10; $i++) {
            $resultado .= "<tr><td>$numero × $i</td><td>" . ($numero * $i) . "</td></tr>";
        }
        $resultado .= "</table>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Exercício 2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Resultado - Exercício 2</h2>

        <?php
            if (!empty($resultado)) {
                echo $resultado;
            }
            if ($ultimoNumero !== null) {
                echo "<p><strong>Último número:</strong> $ultimoNumero (Formato: $ultimoFormato)</p>";
            }
        ?>

        <div class="botoes-retorno">
            <a class="btn-secundario" href="exercicio2.html"> Tentar novamente</a>
            <a class="btn-secundario" href="index.php"> Voltar ao início</a>
        </div>
    </div>
</body>
</html>