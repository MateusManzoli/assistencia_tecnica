<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../PDO/conexao.php';

include_once '../funcoes/func_produto.php';
include_once '../funcoes/func_nota_fiscal.php';

try {
    $retorno = "";

    if ($_POST) {
        cadastroProduto($_POST);
        $retorno = "Cadastro realizado com sucesso";
    }
} catch (Exception $e) {
    $retorno = $e->getMessage();
}

$buscar_nf = buscarNotasFiscais();

renderTemplate('cadastro_produto', array(
    "mensagem" => $retorno,
    "nfe" => $buscar_nf
));
