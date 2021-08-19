<?php

header('Content-Type: text/html; charset=ISO-8859-1');

/* 
* RECIBIMOS VARIABLE DESDE LA VISTA
*/

$inicio = $_GET["inicio"];
$fin = $_GET["fin"];


/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/talleres.controlador.php";
require_once "../../modelos/talleres.modelo.php";
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
$objPHPExcel->getActiveSheet()->setTitle("PRODUCION TRUSAS DE ".$inicio, " - ".$fin);

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
todo: INICIO DE DETALLE
*/
$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'PRODUCCION TRUSAS');
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "K$fila:M$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$fila = 3 ;
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'FECHA DE INICIO:');
$objPHPExcel->getActiveSheet()->mergeCells("F$fila:G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "F$fila:G$fila");
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $inicio);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'FECHA DE FIN:');
$objPHPExcel->getActiveSheet()->mergeCells("O$fila:P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "O$fila:P$fila");
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $fin);
$objPHPExcel->getActiveSheet()->mergeCells("Q$fila:R$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "Q$fila:R$fila");


$fila = 5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "B$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'COD.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'TIPO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'COD.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "I$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'COD.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "K$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'S');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'M');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'L');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'XL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "O$fila");
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'XXL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "P$fila");
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'XS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "Q$fila");
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "R$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "S$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "T$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "U$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "V$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "W$fila");

$fila = 6;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'MES');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'DIA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'TRAB.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'TRAB.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'TRABAJADOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'OPE.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'OPERACIÓN');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'MODELO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'COL.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '28');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '30');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", '32');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '34');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "O$fila");
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", '36');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "P$fila");
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", '38');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "Q$fila");
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '40');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "R$fila");
$objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '42');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "S$fila");
$objPHPExcel->getActiveSheet()->getStyle("S$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "T$fila");
$objPHPExcel->getActiveSheet()->getStyle("T$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "U$fila");
$objPHPExcel->getActiveSheet()->getStyle("U$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'TIEM.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "V$fila");
$objPHPExcel->getActiveSheet()->getStyle("V$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", 'ACUM.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "W$fila");
$objPHPExcel->getActiveSheet()->getStyle("W$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

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

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '3');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '4');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", '6');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '8');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "O$fila");
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", '10');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "P$fila");
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", '12');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "Q$fila");
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '14');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "R$fila");
$objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '16');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "S$fila");
$objPHPExcel->getActiveSheet()->getStyle("S$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'TALLAS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "T$fila");
$objPHPExcel->getActiveSheet()->getStyle("T$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'S/.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "U$fila");
$objPHPExcel->getActiveSheet()->getStyle("U$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'DISP.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "V$fila");
$objPHPExcel->getActiveSheet()->getStyle("V$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", 'EFICIENCIA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "W$fila");
$objPHPExcel->getActiveSheet()->getStyle("W$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

#query para sacar los datos deL detalle
$sqlCabecera = ControladorTalleres::ctrMostrarProduccionTrusas($inicio,$fin);

$cont = 0;
for($i = 0; $i < count($sqlCabecera); $i++){

    /* 
    * QUITAMOS LOS CEROS - T1
    */
    if( $sqlCabecera[$i]["t1"] <= 0){

        $t1 = '';
        
    }else{

        $t1 = $sqlCabecera[$i]["t1"];

    }

    /* 
    * QUITAMOS LOS CEROS - T2
    */
    if( $sqlCabecera[$i]["t2"] <= 0){

        $t2 = '';
        
    }else{

        $t2 = $sqlCabecera[$i]["t2"];

    }

    /* 
    * QUITAMOS LOS CEROS - T3
    */
    if( $sqlCabecera[$i]["t3"] <= 0){

        $t3 = '';
        
    }else{

        $t3 = $sqlCabecera[$i]["t3"];

    }

    /* 
    * QUITAMOS LOS CEROS - T4
    */
    if( $sqlCabecera[$i]["t4"] <= 0){

        $t4 = '';
        
    }else{

        $t4 = $sqlCabecera[$i]["t4"];

    }

    /* 
    * QUITAMOS LOS CEROS - T5
    */
    if( $sqlCabecera[$i]["t5"] <= 0){

        $t5 = '';
        
    }else{

        $t5 = $sqlCabecera[$i]["t5"];

    }

    /* 
    * QUITAMOS LOS CEROS - T6
    */
    if( $sqlCabecera[$i]["t6"] <= 0){

        $t6 = '';
        
    }else{

        $t6 = $sqlCabecera[$i]["t6"];

    }

    /* 
    * QUITAMOS LOS CEROS - T7
    */
    if( $sqlCabecera[$i]["t7"] <= 0){

        $t7 = '';
        
    }else{

        $t7 = $sqlCabecera[$i]["t7"];

    }

    /* 
    * QUITAMOS LOS CEROS - T8
    */
    if( $sqlCabecera[$i]["t8"] <= 0){

        $t8 = '';
        
    }else{

        $t8 = $sqlCabecera[$i]["t8"];

    }

  $cont+=1;

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $sqlCabecera[$i]["mes"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $sqlCabecera[$i]["fecha"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $sqlCabecera[$i]["cod_trab"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $sqlCabecera[$i]["nom_tip_trabajador"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $sqlCabecera[$i]["trabajador"]);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("G$fila", utf8_encode($sqlCabecera[$i]["cod_operacion"]), PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $sqlCabecera[$i]["nombre"]);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("I$fila", utf8_encode($sqlCabecera[$i]["modelo"]), PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("J$fila", utf8_encode($sqlCabecera[$i]["cod_color"]), PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($sqlCabecera[$i]["color"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $t1);
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $t2);
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $t3);
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $t4);
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $t5);
  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $t6);
  $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $t7);
  $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $t8);
  $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $sqlCabecera[$i]["total"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", number_format($sqlCabecera[$i]["total_precio"],2));
  $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $sqlCabecera[$i]["minutos"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", number_format($sqlCabecera[$i]["eficiencia"],2)." %");

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
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "O$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "P$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "Q$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "R$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "S$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "T$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "U$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "V$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "W$fila");
}

/* 
todo: FIN DE DETALLE
*/

/* 
todo: INICIO DEL RELLENO
*/


/* 
todo: FIN DE RELLENO
*/



# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(7.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(7.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(7.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(7.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(9.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(18.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(14.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(14.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(14.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(14.29);


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
header('Content-Disposition: attachment; filename=" PRODUCCION TRUSAS DE '.$inicio." - ".$fin.'.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');
