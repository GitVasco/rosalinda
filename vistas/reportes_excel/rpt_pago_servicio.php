<?php

header('Content-Type: text/html; charset=ISO-8859-1');



/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/servicio.controlador.php";
require_once "../../modelos/servicio.modelo.php";
/* 
* LLAMAMOS A LA CONEXION
*/
$con=ControladorUsuarios::ctrMostrarConexiones("id",1);

$conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
mysql_select_db($con["db"], $conexion);

/* 
* CONFIGURAMOS LA FECHA ACTUAL
*/
date_default_timezone_set('America/Lima');
$fechaactual = getdate();
$inicio =$_GET["inicio"];
$fin =$_GET["fin"];

$fecha = date("d-m-Y");

$iniciocab=substr($inicio,8,9)."-".substr($inicio,5,2)."-".substr($inicio,0,4);
$fincab=substr($fin,8,9)."-".substr($fin,5,2)."-".substr($fin,0,4);

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
$texto3 = new PHPExcel_Style();
$texto3->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'color' => array('rgb' => 'FF0008'),
      'underline' =>true,
      'size' => 13
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

$borde10 = new PHPExcel_Style();
$borde10->applyFromArray(
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
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
    ),
      'font' => array(
      'bold' => true,
      'size' => 11
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
$objPHPExcel->getActiveSheet()->setTitle("PAGO DE SERVICIO -".$fecha);

# Orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);

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




$fila=2;
$sectores=ControladorServicios::ctrVerSectores($inicio,$fin);
for ($s=0; $s < count($sectores) ; $s++) { 

// TITULO
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Pago por Servicio de Confección');
$objPHPExcel->getActiveSheet()->mergeCells("F$fila:K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto3, "F$fila:K$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila+=1;

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $sectores[$s]["taller"]." - ".$sectores[$s]["nom_completo"]);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "DEL ".$iniciocab." AL ". $fincab);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "G$fila");
$fila+=1;  
$fila+=1;

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "B$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "E$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'COD.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'S');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'M');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'L');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'XL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'XXL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'XS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "N$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "O$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "P$fila");
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "Q$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "R$fila");

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'GUIA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'FECHA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'MODELO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'NOMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '28');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '30');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '32');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '34');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '36');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '38');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", '40');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '42');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "O$fila");
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'DOC');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "P$fila");
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'P/D');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "Q$fila");
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'S/. TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "R$fila");
$objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila+=1;
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

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '3');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '4');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '6');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '8');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '10');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '12');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", '14');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '16');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "O$fila");
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "P$fila");
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "Q$fila");
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "R$fila");
$objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);




#query para sacar los datos deL detalle
$sqlCabecera = ControladorServicios::ctrVerPagoServicioSector($inicio,$fin,$sectores[$s]["taller"]);


$cont = 0;
for ($i=0; $i < count($sqlCabecera) ; $i++) { 
  $cont+=1;
  $fila+=1;

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

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", utf8_encode($sqlCabecera[$i]["guia"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($sqlCabecera[$i]["fec2"]));
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", utf8_encode($sqlCabecera[$i]["modelo"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("E$fila", utf8_encode($sqlCabecera[$i]["nombre"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("F$fila", utf8_encode($sqlCabecera[$i]["cod_color"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($sqlCabecera[$i]["color"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $t1);
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $t2);
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $t3);
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $t4);
    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $t5);
    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $t6);
    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $t7);
    $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $t8);
    $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $sqlCabecera[$i]["total_docenas"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $sqlCabecera[$i]["precio_doc"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $sqlCabecera[$i]["total_soles"]);


    $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "E$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "E$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "F$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "G$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "H$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "I$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "J$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "K$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "L$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "M$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "N$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "O$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "P$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "Q$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "R$fila");
    
    
    }
    for ($f=0; $f <5 ; $f++) { 
        $fila+=1;
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "E$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "E$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "F$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "G$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "H$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "I$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "J$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "K$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "L$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "M$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "N$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "O$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "P$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "Q$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "R$fila");
      

     }
     $sumatorias=ControladorServicios::ctrVerSumaPagos($inicio,$fin,$sectores[$s]["taller"]);
     for ($u=0; $u <count($sumatorias) ; $u++) { 
        $fila+=1;
        $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($sumatorias[$u]["t1"]));
        $objPHPExcel->getActiveSheet()->setCellValue("I$fila", utf8_encode($sumatorias[$u]["t2"]));
        $objPHPExcel->getActiveSheet()->setCellValue("J$fila", utf8_encode($sumatorias[$u]["t3"]));
        $objPHPExcel->getActiveSheet()->setCellValue("K$fila", utf8_encode($sumatorias[$u]["t4"]));
        $objPHPExcel->getActiveSheet()->setCellValue("L$fila", utf8_encode($sumatorias[$u]["t5"]));
        $objPHPExcel->getActiveSheet()->setCellValue("M$fila", utf8_encode($sumatorias[$u]["t6"]));
        $objPHPExcel->getActiveSheet()->setCellValue("N$fila", utf8_encode($sumatorias[$u]["t7"]));
        $objPHPExcel->getActiveSheet()->setCellValue("O$fila", utf8_encode($sumatorias[$u]["t8"]));

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "H$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "I$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "J$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "K$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "L$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "M$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "N$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "O$fila");

        $fila+=1;

        $fila+=1;
        $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "TOTAL UND");
        $objPHPExcel->getActiveSheet()->setCellValue("J$fila", utf8_encode($sumatorias[$u]["total_und"]));
        
        $objPHPExcel->getActiveSheet()->mergeCells("H$fila:I$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde10, "H$fila:I$fila");
        
        $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde10, "J$fila:K$fila");

        $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", "TOTAL DC.");
        $objPHPExcel->getActiveSheet()->setCellValue("P$fila", utf8_encode($sumatorias[$u]["total_docenas"]));

        $objPHPExcel->getActiveSheet()->mergeCells("N$fila:O$fila");
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde10, "N$fila:O$fila");
        
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde10, "P$fila");
        $fila+=1;
        
     }

     $totales= ControladorServicios::ctrVerTotalPagar($inicio,$fin,$sectores[$s]["taller"]);

     for ($t=0; $t <count($totales) ; $t++) { 
        $fila+=1;
        $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "");
        $objPHPExcel->getActiveSheet()->setCellValueExplicit("R$fila", utf8_encode("S/.".$totales[$t]["total_soles"]), PHPExcel_Cell_DataType::TYPE_STRING);

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "R$fila");

        $fila+=1;
        $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "Dscto. Material");
        $objPHPExcel->getActiveSheet()->setCellValueExplicit("R$fila", utf8_encode("S/.0.00"), PHPExcel_Cell_DataType::TYPE_STRING);

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "R$fila");

        $fila+=1;
        $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "");
        $objPHPExcel->getActiveSheet()->setCellValueExplicit("R$fila", utf8_encode("S/.0.00"), PHPExcel_Cell_DataType::TYPE_STRING);

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "R$fila");

        $fila+=1;
        $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "TOTAL A PAGAR");
        $objPHPExcel->getActiveSheet()->setCellValueExplicit("R$fila", utf8_encode("S/.".$totales[$t]["total_soles"]), PHPExcel_Cell_DataType::TYPE_STRING);

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde10, "R$fila");


    
     }

     $fila+=1;


}
# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(7.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(7.23);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8.00);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(8.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(8.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10.29);
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
header('Content-Disposition: attachment; filename=" PAGO DE SERVICIO - '.$fecha.'.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');