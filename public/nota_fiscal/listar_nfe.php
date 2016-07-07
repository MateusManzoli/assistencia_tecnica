<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../../PDO/conexao.php';
include_once '../../funcoes/func_nota_fiscal.php';

try {
    $retorno = "";

if (!empty($_POST['deletar'])) {
    excluirNotaFiscal($_POST['nota_id']);
        $retorno = "Nota fiscal deletada com sucesso";
    }
} catch (Exception $e) {
    $retorno = $e->getMessage();
}

$data = date("d-m-Y");
$nota = buscarNotasFiscais();

renderTemplate('listar_nfe', array(
    "mensagem" => $retorno,
    "nota" => $nota,
    "data" => $data
));
