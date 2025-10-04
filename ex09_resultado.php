<?php
// Lê cookie anterior
$ultimo_cookie = null;
if (isset($_COOKIE["ex09_ultimo"])) {
    $ultimo_cookie = $_COOKIE["ex09_ultimo"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST["nome"]);
    $idade = intval($_POST["idade"]);

    // Define mensagem
    if ($idade >= 18) {
        $mensagem = "$nome é maior de 18 e tem $idade anos.";
    } else {
        $mensagem = "$nome não é maior de 18 e tem $idade anos.";
    }

    // Classificação por faixa etária
    if ($idade >= 0 && $idade <= 12) {
        $classe = "faixa-crianca";
    } elseif ($idade >= 13 && $idade <= 17) {
        $classe = "faixa-adolescente";
    } elseif ($idade >= 18 && $idade <= 59) {
        $classe = "faixa-adulto";
    } else {
        $classe = "faixa-idoso";
    }

    // Salva cookie no formato: Nome,Idade
    setcookie("ex09_ultimo", "$nome,$idade", time() + 3600);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Resultado Exercício 09</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="welcome-container">
    <h1>Resultado</h1>

    <?php if (isset($mensagem)): ?>
      <p class="<?php echo $classe; ?>">
        <?php echo $mensagem; ?>
      </p>
    <?php endif; ?>

    <?php if ($ultimo_cookie): ?>
      <p><strong>Última verificação:</strong> <?php echo htmlspecialchars($ultimo_cookie); ?></p>
    <?php endif; ?>

    <a href="ex09_form.html" class="btn-secundario">Nova verificação</a><br>
    <a href="index.php" class="btn-secundario">Voltar ao início</a>
  </div>
</body>
</html>