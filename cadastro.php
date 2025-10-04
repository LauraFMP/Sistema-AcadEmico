<?php
include("conexao.php");

// Verifica se todos os campos foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome          = $_POST['nome'];
    $matricula     = $_POST['matricula'];
    $curso         = $_POST['curso'];
    $email         = $_POST['email'];
    $telefone      = $_POST['telefone'];
    $endereco      = $_POST['endereco'];
    $cep           = $_POST['cep'];
    $cidade        = $_POST['cidade'];
    $uf            = strtoupper($_POST['uf']);
    $curso_horas   = $_POST['curso_horas'];
    $carga_horaria = intval($_POST['carga_horaria']);

    // Prepara e executa a inserção no banco
    $sql = "INSERT INTO alunos 
            (nome, matricula, curso, email, telefone, endereco, cep, cidade, uf, curso_horas, carga_horaria)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssssssi", $nome, $matricula, $curso, $email, $telefone, $endereco, $cep, $cidade, $uf, $curso_horas, $carga_horaria);

    if ($stmt->execute()) {
        $mensagem = "<p class='sucesso'>Aluno cadastrado com sucesso!</p>";
    } else {
        $mensagem = "<p class='erro'>Erro ao cadastrar aluno: " . $conexao->error . "</p>";
    }

    $stmt->close();
    $conexao->close();
} else {
    $mensagem = "<p class='erro'>Método inválido. Use o formulário para enviar os dados.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Resultado do Cadastro</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="welcome-container">
    <h1>Resultado do Cadastro</h1>
    <?php echo $mensagem; ?>
    <a href="horas_form.html" class="btn-secundario">Novo Cadastro</a><br>
    <a href="index.php" class="btn-secundario">Voltar ao Painel</a>
  </div>
</body>
</html>