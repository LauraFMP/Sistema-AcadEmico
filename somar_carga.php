<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST['matricula'];
    $nova_carga = intval($_POST['nova_carga']);

    // Verifica se a matrícula existe
    $sql_select = "SELECT carga_horaria, nome FROM alunos WHERE matricula = ?";
    $stmt = $conexao->prepare($sql_select);
    $stmt->bind_param("s", $matricula);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $aluno = $resultado->fetch_assoc();
        $carga_atual = intval($aluno['carga_horaria']);
        $nova_total = $carga_atual + $nova_carga;

        // Atualiza a carga horária no banco
        $sql_update = "UPDATE alunos SET carga_horaria = ? WHERE matricula = ?";
        $stmt_update = $conexao->prepare($sql_update);
        $stmt_update->bind_param("is", $nova_total, $matricula);

        if ($stmt_update->execute()) {
            $mensagem = "<p class='sucesso'>Carga horária atualizada com sucesso!<br>
                         Aluno: <strong>{$aluno['nome']}</strong><br>
                         Nova carga total: <strong>{$nova_total}h</strong></p>";
        } else {
            $mensagem = "<p class='erro'>Erro ao atualizar carga horária: " . $conexao->error . "</p>";
        }
        $stmt_update->close();

    } else {
        $mensagem = "<p class='erro'>Matrícula não encontrada no sistema!</p>";
    }

    $stmt->close();
    $conexao->close();

} else {
    $mensagem = "<p class='erro'>Método inválido. Envie o formulário corretamente.</p>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Resultado da Atualização</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="welcome-container">
    <h1>Resultado</h1>
    <?php echo $mensagem; ?>
    <a href="atualizar_carga.html" class="btn-secundario">Nova Atualização</a><br>
    <a href="index.php" class="btn-secundario">Voltar ao Painel</a>
  </div>
</body>
</html>