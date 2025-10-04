<?php
// Lê cookie anterior
$ultimo_cookie = null;
if (isset($_COOKIE["ex10_data"])) {
    $ultimo_cookie = $_COOKIE["ex10_data"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num = intval($_POST["mes"]);

    switch ($num) {
        case 1:  $mes_nome = "Janeiro"; break;
        case 2:  $mes_nome = "Fevereiro"; break;
        case 3:  $mes_nome = "Março"; break;
        case 4:  $mes_nome = "Abril"; break;
        case 5:  $mes_nome = "Maio"; break;
        case 6:  $mes_nome = "Junho"; break;
        case 7:  $mes_nome = "Julho"; break;
        case 8:  $mes_nome = "Agosto"; break;
        case 9:  $mes_nome = "Setembro"; break;
        case 10: $mes_nome = "Outubro"; break;
        case 11: $mes_nome = "Novembro"; break;
        case 12: $mes_nome = "Dezembro"; break;
        default: $mes_nome = null; break;
    }

    if ($mes_nome) {
        $mensagem = "O número $num corresponde ao mês de $mes_nome.";
        $classe = "mes-valido";
    } else {
        $mensagem = "Não existe mês com o número $num.";
        $classe = "mes-invalido";
    }

    // Salva cookie
    setcookie("ex10_data", "$num", time() + 3600);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Resultado Exercício 10</title>
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
      <p><strong>Última verificação:</strong> <?php echo ($ultimo_cookie); ?></p>
    <?php endif; ?>

    <a href="ex10_form.html" class="btn-secundario">Nova verificação</a><br>
    <a href="index.php" class="btn-secundario">Voltar ao início</a>
  </div>
</body>
</html>