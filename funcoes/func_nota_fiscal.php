<?php

function cadastroNotaFiscal($dados) {
    $cadastrar = "
        INSERT INTO assistencia_tecnica.nota_fiscal SET
            nota = '" . addslashes($dados['nota']) . "',
            SR = '" . addslashes($dados['sr']) . "',
            data_emissao = '" . addslashes($dados['emissao']) . "',
            pedido = '" . addslashes($dados['pedido']) . "',
            fornecedor = '" . addslashes($dados['fornecedor']) . "'";
    echo $cadastrar;
    return inserir($cadastrar);
}

function buscarNotasFiscais() {
    $nf = "select * from assistencia_tecnica.nota_fiscal";
    $resultado = pesquisar($nf);
    return $resultado;
}
