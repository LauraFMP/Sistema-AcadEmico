<?php
session_start();

// Verifica login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$media_cookie = null;
if (isset($_COOKIE["ex08_media"])) {
    $media_cookie = $_COOKIE["ex08_media"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Se for cálculo normal
    if (isset($_POST["nota1"])) {
        $a1 = floatval($_POST["nota1"]);
        $a2 = floatval($_POST["nota2"]);
        $a3 = floatval($_POST["nota3"]);

        // Fórmula: ((A1*2)+(A2*2)+(A3*1))/5
        $media = (($a1 * 2) + ($a2 * 2) + ($a3 * 1)) / 5;

        if ($media >= 7) {
            $mensagem = "Média: " . number_format($media, 1) . " → ✅ Aprovado!";
            $classe = "maior";
        } elseif ($media >= 5) {
            $mensagem = "Média: " . number_format($media, 1) . " → ⚠️ Recuperação! Digite sua nota de REC abaixo.";
            $classe = "medio";
            $mostrarRec = true;
        } else {
            $mensagem = "Média: " . number_format($media, 1) . " → ❌ Reprovado!";
            $classe = "menor";
        }

        setcookie("ex08_media", $media, time() + 3600);
    }

    // Se for cálculo de recuperação
    if (isset($_POST["rec"])) {
        $media_anterior = isset($_COOKIE["ex08_media"]) ? floatval($_COOKIE["ex08_media"]) : 0;
        $rec = floatval($_POST["rec"]);
        $nova_media = ($media_anterior + $rec) / 2;

        if ($nova_media >= 7) {
            $mensagem = "Nova média: " . number_format($nova_media, 1) . " → ✅ Aprovado na recuperação!";
            $classe = "maior";
        } else {
            $mensagem = "Nova média: " . number_format($nova_media, 1) . " → ❌ Reprovado!";
            $classe = "menor";
        }

        setcookie("ex08_media", $nova_media, time() + 3600);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Resultado - Exercício 8</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h2>Resultado da Média</h2>

    <?php if (isset($mensagem)): ?>
      <p class="<?php echo $classe; ?>"><?php echo htmlspecialchars($mensagem); ?></p>
    <?php endif; ?>

    <?php if (!empty($mostrarRec)): ?>
      <form action="ex08_resultado.php" method="post">
        <label for="rec">Nota da Recuperação:</label>
        <input type="number" step="0.1" name="rec" id="rec" required>
        <button type="submit">Calcular Nova Média</button>
      </form>
    <?php endif; ?>

    <?php if ($media_cookie): ?>
      <p><strong>Média anterior:</strong> <?php echo htmlspecialchars(number_format($media_cookie, 1)); ?></p>
    <?php else: ?>
      <p><em>Nenhuma média anterior registrada.</em></p>
    <?php endif; ?>

    <div class="botoes-retorno">
      <a class="btn-secundario" href="ex08_form.html"> Nova operação</a>
      <a class="btn-secundario" href="index.php"> Voltar ao início</a>
    </div>
  </div>
</body>
</html>