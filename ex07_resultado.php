<?php
session_start();

// Verifica login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$resultado_cookie = null;

if (isset($_COOKIE["ex07_resultado"])) {
    $resultado_cookie = $_COOKIE["ex07_resultado"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST["a"];
    $b = $_POST["b"];

    if ($a > $b) {
        $mensagem = "A ($a) é maior que B ($b)";
        $classe = "maior";
    } elseif ($a < $b) {
        $mensagem = "A ($a) é menor que B ($b)";
        $classe = "menor";
    } else {
        $mensagem = "A ($a) é igual a B ($b)";
        $classe = "medio"; // neutro (usando amarelo)
    }

    // Cria string para o cookie
    setcookie("ex07_resultado", $mensagem, time() + 3600);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Resultado - Exercício 7</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h2>Resultado da Comparação</h2>

    <?php if (isset($mensagem)): ?>
      <p class="<?php echo $classe; ?>"><?php echo htmlspecialchars($mensagem); ?></p>
    <?php endif; ?>

    <?php if ($resultado_cookie): ?>
      <p><strong>Resultado da operação anterior:</strong><br>
        <?php echo htmlspecialchars($resultado_cookie); ?>
      </p>
    <?php else: ?>
      <p><em>Nenhum resultado anterior encontrado.</em></p>
    <?php endif; ?>

    <div class="botoes-retorno">
      <a class="btn-secundario" href="ex07_form.html"> Nova comparação</a>
      <a class="btn-secundario" href="index.php"> Voltar ao início</a>
    </div>
  </div>
</body>
</html>