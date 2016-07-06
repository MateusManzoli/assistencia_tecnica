<?php

//Nota fiscal
function cadastroDeDadosNotaFiscal($dados) {
    $date = DateTime::createFromFormat('d/m/Y', $dados[2]);
    $cadastrar = "
        INSERT INTO assistencia_tecnica.nota_fiscal SET
            nota = '" . addslashes($dados[0]) . "',
            SR = '" . addslashes($dados[1]) . "',
            data_emissao = '" . $date->format('Y-m-d') . "',
            pedido = '" . addslashes($dados[5]) . "',
            fornecedor = '" . addslashes($dados[6]) . "'";
    echo $cadastrar;
    return inserir($cadastrar);
}
//Dados produtos por array
function cadastroDadosProduto($dados) {
    $cadastrar = "
        INSERT INTO assistencia_tecnica.produto SET
            descricao = '" . addslashes($dados[4]) . "',
            imei = '" . addslashes($dados[3]) . "',
            lote = '" . addslashes($dados[7]) . "',
            nota_fiscal_id = '1'";
    echo $cadastrar;
    return inserir($cadastrar);
}
