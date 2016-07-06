<?php
require_once __DIR__ . '/../vendor/autoload.php';

function conectar() {
    return new PDO('mysql:host=localhost;dbname=assistencia_tecnica', 'root', 'mateus2025');
}

function pesquisar($sql) {
    $conexao = conectar();
    $statement = $conexao->query($sql, PDO::FETCH_ASSOC);
    return $statement->fetchAll();
}

function inserir($sql) {
    $conexao = conectar();
    $statement = $conexao->exec($sql);
    return $conexao->lastInsertId();
}

function excluir($sql) {
    $conexao = conectar();
    $statement = $conexao->query($sql);
    return $statement->execute();
}

function editar($sql) {
    $conexao = conectar();
    $statement = $conexao->query($sql);
}

Twig_Autoloader::register();
function renderTemplate($nomeTemplate, $dados = []) {
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate($nomeTemplate . '.html.twig');
    echo $template->render($dados);
}