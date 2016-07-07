<head>
    <meta charset="UTF-8">
</head>
<?php
require_once '../../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';
include_once '../../PDO/conexao.php';
include_once '../../funcoes/exportar_arquivo.php';

$excelFile = "../../IMEI_NF_5351_ALLIED.xlsx";

//CRIA O ARRAY COM OS DADOS DO EXCEL
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load($excelFile);
$count = $objPHPExcel->getSheet(0)->getHighestRow();

//Itrating through all the sheets in the excel workbook and storing the array data
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $arrayData[$worksheet->getTitle()] = $worksheet->toArray();
}

foreach ($arrayData as $array) {
    foreach ($array as $arrayData) {
        $stringArray[] = implode(" ", $arrayData);
    }
}
echo '<pre>';
print_r($stringArray);
echo '</pre>';

for ($linha = 0; $linha <= $count; $linha++) {
    $nota = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $linha)->getValue();
    $sr = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $linha)->getValue();
    $data_emissao = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $linha)->getValue();
    $pedido = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $linha)->getValue();
    $fornecedor = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6, $linha)->getValue();
}

if (!empty($arrayData)) {
    cadastroDeDadosNotaFiscal($arrayData);
    echo "Sucesso";
} else {
    echo 'erro';
}

if (!empty($arrayData)) {
    cadastroDadosProduto($arrayData);
    echo "Sucesso";
} else {
    echo 'erro';
}