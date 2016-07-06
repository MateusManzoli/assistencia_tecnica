<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../../PDO/conexao.php';

include_once '../../funcoes/func_produto.php';
include_once '../../funcoes/func_nota_fiscal.php';
$data = date('Y-m-d');
try {
    $retorno = "";

    if ($_POST) {
        cadastroNotaFiscal($_POST);
        $retorno = "Cadastro realizado com sucesso";
    }
} catch (Exception $e) {
    $retorno = $e->getMessage();
}

renderTemplate('cadastro_nfe', array(
    "mensagem" => $retorno,
    "data" => $data
));
