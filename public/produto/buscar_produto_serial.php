<?php

error_reporting(0);
ini_set(display_errors, 0);

include_once '../../PDO/conexao.php';
include_once '../../funcoes/func_produto.php';

$var = isset($_POST['imei']);
$server = $_SERVER['PHP_SELF'];
// Verificamos se a ação é de busca
if ($var) {

    // Verificamos no banco de dados produtos equivalente a palavra digitada
    $sql = buscarProdutoImei($_POST['imei']);
    foreach ($sql as $produto) {
        $string = implode(" ", $produto);
    }
}

renderTemplate('buscar_produto', array(
    "produto" => $produto,
    "server" => $server
));
?>