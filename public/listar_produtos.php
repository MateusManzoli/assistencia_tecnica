<?php

include_once '../PDO/conexao.php';
include_once '../funcoes/func_produto.php';

try {
    $retorno = "";

    if (!empty($_POST['deletar'])) {
        excluirProduto($_POST['produto_id']);
        $retorno = "Produto deletado com sucesso";
    }
} catch (Exception $e) {
    $retorno = $e->getMessage();
}

$produto = buscarProdutos();

renderTemplate('listar_produtos', array(
    "mensagem" => $retorno,
    "produto" => $produto
));