<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../PDO/conexao.php';
include_once '../funcoes/func_produto.php';
try {
    $retorno = "";
    if ($_POST) {
        editarProduto($_POST);
        $retorno = "Produto editado com sucesso";
    }
} catch (Exception $e) {
    $retorno = $e->getMessage();
}

$produto = buscarProduto($_GET['id']);

renderTemplate('editar_produto', array(
    "mensagem" => $retorno,
    "produto" => $produto
));
