<?php
session_start();

// Verifica login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$resultado_cookie = null;

if (isset($_COOKIE["ex06_resultado"])) {
    $resultado_cookie = $_COOKIE["ex06_resultado"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nums = $_POST["nums"];
    sort($nums);

    $menor = $nums[0];
    $maior = end($nums);
    $medio = $nums[floor(count($nums)/2)];

    // Cria string para o cookie
    $novo_resultado = "Maior: $maior, Médio: $medio, Menor: $menor";
    setcookie("ex06_resultado", $novo_resultado, time() + 3600);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Resultado - Exercício 6</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h2>Resultado da Ordenação</h2>

    <?php if (isset($nums)): ?>
      <ul>
        <?php foreach ($nums as $n): ?>
          <?php 
            if ($n == $menor) {
              $classe = "menor";
            } elseif ($n == $maior) {
              $classe = "maior";
            } elseif ($n == $medio) {
              $classe = "medio";
            } else {
              $classe = "";
            }
          ?>
          <li class="<?php echo $classe; ?>"><?php echo $n; ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if ($resultado_cookie): ?>
      <p><strong>Resultado da operação anterior:</strong><br>
        <?php echo htmlspecialchars($resultado_cookie); ?>
      </p>
    <?php else: ?>
      <p><em>Nenhum resultado anterior encontrado.</em></p>
    <?php endif; ?>

    <div class="botoes-retorno">
      <a class="btn-secundario" href="ex06_form.html"> Nova operação</a>
      <a class="btn-secundario" href="index.php"> Voltar ao início</a>
    </div>
  </div>
</body>
</html>