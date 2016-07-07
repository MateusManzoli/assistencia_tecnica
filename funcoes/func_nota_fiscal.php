<?php

function cadastroNotaFiscal($dados) {
    $data = DateTime::createFromFormat('d/m/Y', $dados['emissao']);
    if (verificarNota($dados['pedido'])) {
        throw new Exception("Ja possuimos uma nota fiscal com esse numero de pedido !");
    }
    $cadastrar = "
        INSERT INTO assistencia_tecnica.nota_fiscal SET
            nota = '" . addslashes($dados['nota']) . "',
            SR = '" . addslashes($dados['sr']) . "',
            data_emissao = '" . $data->format('Y-m-d H:i:s') . "',
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

function buscarNotaFiscal($id) {
    //metodo para buscar noticas
    $sql = "SELECT  * FROM assistencia_tecnica.nota_fiscal where id = $id";
    $nota = pesquisar($sql);
    return $nota[0];
}

function excluirNotaFiscal($id) {
    $deletar = "delete from assistencia_tecnica.nota_fiscal where id = {$id}";
    return excluir($deletar);
}

function editarNotaFiscal($dados) {
    $editar = "UPDATE assistencia_tecnica.nota_fiscal SET 
            nota = '" . addslashes($dados['nota']) . "',
            SR = '" . addslashes($dados['sr']) . "',
            data_emissao = '" . addslashes($dados['emissao']) . "',
            pedido = '" . addslashes($dados['pedido']) . "',
            fornecedor = '" . addslashes($dados['fornecedor']) . "'
            where id = {$dados['id']} ";
    echo $editar;
    return editar($editar);
}

function verificarNota($pedido) {
    $notaFiscal = "select * from assistencia_tecnica.nota_fiscal where pedido = '{$pedido}'";
    $verificar = pesquisar($notaFiscal);
    return $verificar;
}

function formatarData($data) {
    $dataFormatada = DateTime::createFromFormat('Y-m-d', $data);
    echo $dataFormatada->format('d/m/Y');
}