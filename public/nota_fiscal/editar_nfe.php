<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../../PDO/conexao.php';
include_once '../../funcoes/func_nota_fiscal.php';
try {
    $retorno = "";
    if ($_POST) {
        editarNotaFiscal($_POST);
        $retorno = "Nota fiscal editada com sucesso";
    }
} catch (Exception $e) {
    $retorno = $e->getMessage();
}

$nota = buscarNotaFiscal($_GET['id']);

renderTemplate('editar_nfe', array(
    "mensagem" => $retorno,
    "nota" => $nota
));
