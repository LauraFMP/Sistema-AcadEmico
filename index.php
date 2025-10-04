<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Sistema</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard">

        <!-- BLOCO EXERCÍCIOS -->
        <div class="welcome-container bloco">
            <h1>Exercícios</h1>
            <ul>
                <li><a href="exercicio1.html">Exercício 1 - Número +, - ou Zero</a></li>
                <li><a href="exercicio2.html">Exercício 2 - Tabuada</a></li>
                <li><a href="exercicio3.html">Exercício 3 - Fatorial</a></li>
                <li><a href="exercicio4.html">Exercício 4 - Calculadora</a></li>
                <li><a href="ex05_form.html">Exercício 5 - Par ou Ímpar</a></li>
                <li><a href="ex06_form.html">Exercício 6 - Ordem Crescente</a></li>
                <li><a href="ex07_form.html">Exercício 7 - Verifica se A > B</a></li>
                <li><a href="ex08_form.html">Exercício 8 - Média com Recuperação</a></li>
                <li><a href="ex09_form.html">Exercício 9 - Faixa Etária</a></li>
                <li><a href="ex10_form.html">Exercício 10 - Mês do Ano</a></li>
            </ul>
        </div>

        <!-- BLOCO HORAS COMPLEMENTARES -->
        <div class="welcome-container bloco">
            <h1>Horas Complementares</h1>
            <p>Adicione suas horas complementares no sistema:</p>
            <a href="horas_form.html" class="btn-secundario">Cadastrar Horas</a>
            <a href="atualizar_carga.html" class="btn-secundario">Atualizar Carga Horária</a>
        </div>
    </div>

    <div class="logout">
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>