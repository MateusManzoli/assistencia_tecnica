<?php

function buscarProdutos() {
    //metodo para buscar noticas
    $sql = "SELECT  * FROM assistencia_tecnica.produto";
    //retorna resultados da busca
    return pesquisar($sql);
}

function buscarProduto($id) {
    //metodo para buscar noticas
    $sql = "SELECT  * FROM assistencia_tecnica.produto where id = $id";
    $produto = pesquisar($sql);
    return $produto[0];
}

function buscarProdutoImei($imei) {
    //metodo para buscar noticas
    $sql = "select * from assistencia_tecnica.produto where imei like '{$imei}';";
    return pesquisar($sql);
}

function cadastroProduto($dados) {
    if (verificar($dados['imei'])) {
        throw new Exception("O serial informado ja esta sendo utilizado em nosso sistema, Verifique e tente novamente!");
    }
    $cadastrar = "
        INSERT INTO assistencia_tecnica.produto SET
            descricao = '" . addslashes($dados['descricao']) . "',
            imei = '" . addslashes($dados['imei']) . "',
            lote = '" . addslashes($dados['lote']) . "',
            nota_fiscal_id = '" . addslashes($dados['nfe']) . "'";
    return inserir($cadastrar);
}

function verificar($imei) {
    $produto = "select * from assistencia_tecnica.produto where imei = '{$imei}'";
    $verificar = pesquisar($produto);
    return $verificar;
}

function excluirProduto($id) {
    $deletar = "delete from assistencia_tecnica.produto where id = {$id}";
    return excluir($deletar);
}

function editarProduto($dados) {
    $editar = "UPDATE assistencia_tecnica.produto SET 
            descricao = '" . addslashes($dados['descricao']) . "',
            imei = '" . addslashes($dados['imei']) . "',
            lote = '" . addslashes($dados['lote']) . "',
            nota_fiscal_id = '" . addslashes($dados['nfe']) . "'
            where id = {$dados['id']} ";
    return editar($editar);
}