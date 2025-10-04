<?php
session_start();

// Verifica login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$resultado = "";
$classe = "";
$ultimo = isset($_COOKIE['ex04_ultimo']) ? $_COOKIE['ex04_ultimo'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = (float)$_POST["num1"];
    $num2 = isset($_POST["num2"]) ? (float)$_POST["num2"] : null;
    $op = $_POST["op"];

    switch ($op) {
        case "+":
            $calc = $num1 + $num2;
            $resultado = "$num1 + $num2 = $calc";
            $classe = "sucesso";
            break;
        case "-":
            $calc = $num1 - $num2;
            $resultado = "$num1 - $num2 = $calc";
            $classe = "sucesso";
            break;
        case "*":
            $calc = $num1 * $num2;
            $resultado = "$num1 × $num2 = $calc";
            $classe = "sucesso";
            break;
        case "/":
            if ($num2 == 0) {
                $resultado = "Erro: divisão por zero!";
                $classe = "erro";
            } else {
                $calc = $num1 / $num2;
                $resultado = "$num1 ÷ $num2 = $calc";
                $classe = "sucesso";
            }
            break;
        case "^":
            $calc = pow($num1, $num2);
            $resultado = "$num1 ^ $num2 = $calc";
            $classe = "sucesso";
            break;
        case "√":
            if ($num1 < 0) {
                $resultado = "Erro: não existe raiz quadrada real de número negativo!";
                $classe = "erro";
            } else {
                $calc = sqrt($num1);
                $resultado = "√$num1 = $calc";
                $classe = "sucesso";
            }
            break;
        default:
            $resultado = "Operação inválida!";
            $classe = "erro";
            break;
    }

    // Se não for erro, salva cookie
    if ($classe === "sucesso") {
        setcookie("ex04_ultimo", $resultado, time() + 3600);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Exercício 4</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Resultado da Calculadora</h2>

        <?php
            if (!empty($resultado)) {
                echo "<p class='$classe'>$resultado</p>";
            }

            if ($ultimo !== null) {
                echo "<p><strong>Última operação:</strong> $ultimo</p>";
            }
        ?>

        <div class="botoes-retorno">
            <a class="btn-secundario" href="exercicio4.html"> Nova operação</a>
            <a class="btn-secundario" href="index.php"> Voltar ao início</a>
        </div>
    </div>
</body>
</html>