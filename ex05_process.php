<?php
session_start();

// Verifica login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$mensagem = "";
$classe = "";
$ultimo = isset($_COOKIE["ex05_ultimo"]) ? $_COOKIE["ex05_ultimo"] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num = intval($_POST["numero"]);

    if ($num % 2 == 0) {
        $mensagem = "$num é par";
        $classe = "resultado-par";
    } else {
        $mensagem = "$num é ímpar";
        $classe = "resultado-impar";
    }

    // Salvar em cookie
    setcookie("ex05_ultimo", $num, time() + 3600);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Resultado - Exercício 5</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h2>Resultado</h2>

    <?php
      if (!empty($mensagem)) {
          echo "<p class='$classe'>$mensagem</p>";
      }

      if ($ultimo !== null) {
          echo "<p><strong>Último número verificado:</strong> $ultimo</p>";
      }
    ?>

    <div class="botoes-retorno">
      <a class="btn-secundario" href="ex05_form.html"> Nova verificação</a>
      <a class="btn-secundario" href="index.php"> Voltar ao início</a>
    </div>
  </div>
</body>
</html>