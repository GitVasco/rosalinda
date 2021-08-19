<?php

header('Content-Type: text/html; charset=ISO-8859-1');

/* 
* RECIBIMOS VARIABLE DESDE LA VISTA
*/

$anoP = $_GET["anoP"];


/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/cuentas.controlador.php";
require_once "../../modelos/cuentas.modelo.php";
/* 
* LLAMAMOS A LA CONEXION
*/
$con=ControladorUsuarios::ctrMostrarConexiones("id",1);

$conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
mysql_select_db($con["db"], $conexion);

/* 
* CONFIGURAMOS LA FECHA ACTUAL
*/
$fechaactual = getdate();
$fecha = "$fechaactual[mday]/$fechaactual[mon]/$fechaactual[year]";

/* 
* INSTANCIAMOS
*/
$objPHPExcel = new PHPExcel();

/* 
* CONFIGURAMOS AL CREADOR DEL ARCHIVO
*/
$objPHPExcel->getProperties()->setCreator("Corp. Vasco"); //autor
$objPHPExcel->getProperties()->setTitle("00000020"); //titulo

/* 
* INICIO DE ESTILOS
*/

#negrita subrayado T-11
$texto1 = new PHPExcel_Style();
$texto1->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'underline' =>true,
      'size' => 11
    )
));

#negrita T-11
$texto2 = new PHPExcel_Style();
$texto2->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'size' => 11
    )
));

#bordes grueso: izquierda-arriba-derecha, color  GRIS NEGRITA T11
$borde1 = new PHPExcel_Style();
$borde1->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'D7DBDD')
    ),
    'borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
      'size' => 11
    )
));

#bordes grueso: izquierda-derecha, color  GRIS NEGRITA T11
$borde2 = new PHPExcel_Style();
$borde2->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'D7DBDD')
    ),
    'borders' => array(
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
      'size' => 11
    )
));

#bordes grueso: izquierda-derecha-abajo, color  GRIS NEGRITA T11
$borde3 = new PHPExcel_Style();
$borde3->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'D7DBDD')
    ),
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
      'size' => 11
    )
));

#bordes derecho delgado / borde izquiedo grueso / borde abajo delgado
$borde4 = new PHPExcel_Style();
$borde4->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => false,
      'size' => 10
    )
));

#bordes derecho delgado / borde izquiedo delgado / borde abajo delgado
$borde5 = new PHPExcel_Style();
$borde5->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
      'font' => array(
      'bold' => false,
      'size' => 10
    )
));

#bordes derecho grueso / borde izquiedo delgado / borde abajo delgado
$borde6 = new PHPExcel_Style();
$borde6->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => false,
      'size' => 10
    )
));

#bordes grueso: izquierda-arriba-derecha, color  GRIS NEGRITA T11
$borde7 = new PHPExcel_Style();
$borde7->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'D7DBDD')
    ),
    'borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
      'size' => 11
    )
));

#bordes grueso: ABAJO
$borde8 = new PHPExcel_Style();
$borde8->applyFromArray(
  array('borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    )
));

#bordes grueso: izquierda-derecha-abajo-arriba, color  GRIS NEGRITA T10
$borde9 = new PHPExcel_Style();
$borde9->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'D7DBDD')
    ),
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
      'size' => 10
    )
));

/* 
* FIN DE ESTILOS
*/

/* 
* CONFIGURAMOS LA 1ERA HOJA
*/

$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);

# Titulo de la hoja
if($anoP=="null"){
  $objPHPExcel->getActiveSheet()->setTitle("REPORTE DE CUENTAS PENDIENTES GENERAL");
}else{
  $objPHPExcel->getActiveSheet()->setTitle("REPORTE DE CUENTAS PENDIENTES ".$anoP);
}


# Orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

# Tipo Papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

# Establecer impresion a pagina completa
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

# Establecer margenes
$marginV = 0.5 / 3.54; // 0.5 centimetros

$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($marginV);


# Incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('img/jackyform_letras.png'); //ruta
$objDrawing->setWidthAndHeight(200, 150);
$objDrawing->setCoordinates('B1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

/* 
todo: INICIO CABECERA
*/

#query para sacar los datos de la cabecera
// $sqlCabecera = mysql_query("SELECT 
//                                     CONCAT('OC - ', oc.codigo) AS codigo,
//                                     oc.usuario,
//                                     FORMAT(oc.total,0) AS total,
//                                     FORMAT(oc.saldo,0) AS saldo,
//                                     oc.estado,
//                                     DATE(oc.fecha) AS fecha 
//                                     FROM
//                                     ordencortejf oc 
//                                     WHERE oc.codigo = $id ") or die(mysql_error());

// $respCabecera = mysql_fetch_array($sqlCabecera);

$fila = 2;
if($anoP=="null"){
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'CUENTAS PENDIENTES GENERAL');
}else{
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'CUENTAS PENDIENTES DEL '.$anoP);
}
$objPHPExcel->getActiveSheet()->mergeCells("F$fila:G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "F$fila:G$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

/* 
todo: FIN CABECERA
*/

/* 
todo: INICIO DE DETALLE
*/

$fila = 5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'TIPO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'NUMERO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "E$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'FECHA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "I$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'ESTADO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'NUMERO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'DOCUMENTO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$fila = 6;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'DOC.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'DOCUMENTO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'CLIENTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'VEND.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'FECHA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'VENCIMIENTO.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'MONTO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'SALDO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'DOC.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'UNICO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'ORIGEN');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila = 7;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

#query para sacar los datos deL detalle
$sqlCabecera = ControladorCuentas::ctrRangoFechasCuentasPendientes($anoP);

$cont = 0;
for($i = 0; $i < count($sqlCabecera); $i++){

  $cont+=1;

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", utf8_encode($sqlCabecera[$i]["tipo_doc"]), PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("C$fila", utf8_encode($sqlCabecera[$i]["num_cta"]), PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", utf8_encode($sqlCabecera[$i]["cliente"]." - ".$sqlCabecera[$i]["nombre"]), PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("E$fila", utf8_encode($sqlCabecera[$i]["vendedor"]), PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $sqlCabecera[$i]["fecha"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $sqlCabecera[$i]["fecha_ven"]);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("H$fila", utf8_encode($sqlCabecera[$i]["monto"]), PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("I$fila", utf8_encode($sqlCabecera[$i]["saldo"]), PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $sqlCabecera[$i]["estado"]);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("K$fila", utf8_encode($sqlCabecera[$i]["num_unico"]), PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("L$fila", utf8_encode($sqlCabecera[$i]["doc_origen"]), PHPExcel_Cell_DataType::TYPE_STRING);

  $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "A$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "L$fila");
}

/* 
todo: FIN DE DETALLE
*/


# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(7.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(18.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18.29);



/* 
* CREAR EL ARCHIVO
*/
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

/* 
* Establecer formado de Excel 2003
*/
header("Content-Type: application/vnd.ms-excel");

/* 
* CONFIGURAR EL NOMBRE DEL ARCHIVO
*/

# Nombre del archivo
if($anoP == "null"){
  header('Content-Disposition: attachment; filename=" CUENTAS PENDIENTES GENERAL.xls"');
  
}else{
  header('Content-Disposition: attachment; filename=" CUENTAS PENDIENTES DEL '.$anoP.'.xls"');
}


//forzar a descarga por el navegador
$objWriter->save('php://output');
