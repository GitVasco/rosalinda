<?php

header('Content-Type: text/html; charset=ISO-8859-1');

/* 
* RECIBIMOS VARIABLE DESDE LA VISTA
*/

$id = $_GET["codigo"];


/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";

/* 
* LLAMAMOS A LA CONEXION
*/
$conexion = mysql_connect("192.168.1.2", "jesus", "admin123") or die("No se pudo conectar: " . mysql_error());
mysql_select_db("new_vasco", $conexion);

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
$objPHPExcel->getActiveSheet()->setTitle('ARTICULO');

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
$sqlCabecera = mysql_query("SELECT 
                                    CONCAT('OC - ', oc.codigo) AS codigo,
                                    oc.usuario,
                                    FORMAT(oc.total,0) AS total,
                                    FORMAT(oc.saldo,0) AS saldo,
                                    oc.estado,
                                    DATE(oc.fecha) AS fecha 
                                    FROM
                                    ordencortejf oc 
                                    WHERE oc.codigo = 6 ") or die(mysql_error());

$respCabecera = mysql_fetch_array($sqlCabecera);

$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Corporación Vasco S.A.C');
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "K$fila:M$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$fila = 5 ;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ORDEN DE CORTE:');
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "B$fila:C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respCabecera["codigo"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'ESTADO:');
$objPHPExcel->getActiveSheet()->mergeCells("F$fila:G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "F$fila:G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respCabecera["estado"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "H$fila");

$fila = 6 ;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'FECHA:');
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "B$fila:C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respCabecera["fecha"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "D$fila");

$fila = 7 ;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Cantidad Total:');
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "B$fila:C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respCabecera["total"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Pendiente:');
$objPHPExcel->getActiveSheet()->mergeCells("F$fila:G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "F$fila:G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respCabecera["saldo"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "H$fila");

/* 
todo: FIN CABECERA
*/

/* 
todo: INICIO DE DETALLE
*/

$fila = 9;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "B$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'S');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'M');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'L');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'XL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'XXL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'XS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "K$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "L$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "M$fila");

$fila = 10;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'ID');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'MODELO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'NOMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '28');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '30');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '32');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '34');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '36');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '38');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '40');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '42');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila = 11;
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

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '3');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '4');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '6');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '8');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '10');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '12');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '14');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '16');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

#query para sacar los datos deL detalle
$sqlCabecera = mysql_query("SELECT 
                                    doc.ordencorte,
                                    a.modelo,
                                    a.nombre,
                                    a.color,
                                    SUM(
                                      CASE
                                        WHEN a.cod_talla = '1' 
                                        THEN doc.saldo 
                                        ELSE 0 
                                      END
                                    ) AS t1,
                                    SUM(
                                      CASE
                                        WHEN a.cod_talla = '2' 
                                        THEN doc.saldo 
                                        ELSE 0 
                                      END
                                    ) AS t2,
                                    SUM(
                                      CASE
                                        WHEN a.cod_talla = '3' 
                                        THEN doc.saldo 
                                        ELSE 0 
                                      END
                                    ) AS t3,
                                    SUM(
                                      CASE
                                        WHEN a.cod_talla = '4' 
                                        THEN doc.saldo 
                                        ELSE 0 
                                      END
                                    ) AS t4,
                                    SUM(
                                      CASE
                                        WHEN a.cod_talla = '5' 
                                        THEN doc.saldo 
                                        ELSE 0 
                                      END
                                    ) AS t5,
                                    SUM(
                                      CASE
                                        WHEN a.cod_talla = '6' 
                                        THEN doc.saldo 
                                        ELSE 0 
                                      END
                                    ) AS t6,
                                    SUM(
                                      CASE
                                        WHEN a.cod_talla = '7' 
                                        THEN doc.saldo 
                                        ELSE 0 
                                      END
                                    ) AS t7,
                                    SUM(
                                      CASE
                                        WHEN a.cod_talla = '8' 
                                        THEN doc.saldo 
                                        ELSE 0 
                                      END
                                    ) AS t8,
                                    SUM(doc.saldo) AS subtotal 
                                    FROM
                                    detalles_ordencortejf doc 
                                    LEFT JOIN articulojf a 
                                      ON doc.articulo = a.articulo 
                                    WHERE doc.ordencorte = $id
                                    GROUP BY doc.ordencorte,
                                    a.modelo,
                                    a.nombre,
                                    a.color") or die(mysql_error());

$cont = 0;
while($respCabecera = mysql_fetch_array($sqlCabecera)){

  if($respCabecera["t1"] > 0){

    $t1 = $respCabecera["t1"];

  }else{

    $t1 = "";

  }

  if($respCabecera["t2"] > 0){

    $t2 = $respCabecera["t2"];

  }else{

    $t2 = "";

  }
  
  if($respCabecera["t3"] > 0){

    $t3 = $respCabecera["t3"];

  }else{

    $t3 = "";

  }
  
  if($respCabecera["t4"] > 0){

    $t4 = $respCabecera["t4"];

  }else{

    $t4 = "";

  }
  
  if($respCabecera["t5"] > 0){

    $t5 = $respCabecera["t5"];

  }else{

    $t5 = "";

  }
  
  if($respCabecera["t6"] > 0){

    $t6 = $respCabecera["t6"];

  }else{

    $t6 = "";

  }

  if($respCabecera["t7"] > 0){

    $t7 = $respCabecera["t7"];

  }else{

    $t7 = "";

  }
  
  if($respCabecera["t8"] > 0){

    $t8 = $respCabecera["t8"];

  }else{

    $t8 = "";

  }  



  $cont+=1;

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respCabecera["modelo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respCabecera["nombre"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respCabecera["color"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $t1);
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $t2);
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $t3);
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $t4);
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $t5);
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $t6);
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $t7);
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $t8);
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($respCabecera["subtotal"]));

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

}

/* 
todo: FIN DE DETALLE
*/

/* 
todo: INICIO DEL RELLENO
*/

$fila = 12;
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

$fila = 13;
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

$fila = 14;
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

$fila = 15;
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

$fila = 16;
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

$fila = 17;
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

$fila = 18;
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

$fila = 19;
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

$fila = 20;
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

$fila = 21;
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

$fila = 22;
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

$fila = 23;
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

$fila = 24;
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

$fila = 25;
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

$fila = 26;
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

$fila = 27;
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

$fila = 28;
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

$fila = 29;
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

$fila = 30;
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

$fila = 31;
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

/* 
todo: FIN DE RELLENO
*/

/* 
todo: INICIO TOTAL
*/

#query para sacar el total
$sqlTotal = mysql_query("SELECT 
                                    CONCAT('OC - ', oc.codigo) AS codigo,
                                    oc.usuario,
                                    FORMAT(oc.total,0) AS total,
                                    FORMAT(oc.saldo,0) AS saldo,
                                    oc.estado,
                                    DATE(oc.fecha) AS fecha 
                                    FROM
                                    ordencortejf oc 
                                    WHERE oc.codigo = $id ") or die(mysql_error());

$respTotal = mysql_fetch_array($sqlTotal);

$fila = 32;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '');
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde7, "A$fila:D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->mergeCells("E$fila:L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde7, "E$fila:L$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $respTotal["total"]);
$objPHPExcel->getActiveSheet()->setSharedStyle($borde7, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

/* 
todo: FIN TOTAL
*/

/* 
todo: INICIO FIRMA
*/
$fila = 36;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde8, "C$fila:D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
$objPHPExcel->getActiveSheet()->mergeCells("F$fila:L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde8, "F$fila:L$fila");

$fila = 37;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'RESPONSABLE PRODUCCIÓN');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "C$fila:D$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'RESPONSABLE ÁREA DE CORTE');
$objPHPExcel->getActiveSheet()->mergeCells("F$fila:L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "F$fila:L$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

/* 
todo: FIN FIRMA
*/

# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(21.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(7.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(14.29);


/* 
* CONFIGURAMOS LA 2DA HOJA
*/
$objPHPExcel->createSheet(1);
$objPHPExcel->setActiveSheetIndex(1);

# Titulo de la hoja
$objPHPExcel->getActiveSheet()->setTitle("MATERIA PRIMA");

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
$sqlCabecera = mysql_query("SELECT 
                                    CONCAT('OC - ', oc.codigo) AS codigo,
                                    oc.usuario,
                                    FORMAT(oc.total,0) AS total,
                                    CONCAT('SALDO:      ',FORMAT(oc.saldo, 0)) AS saldo,
                                    CONCAT('ESTADO:     ',oc.estado) AS estado,
                                    DATE(oc.fecha) AS fecha 
                                    FROM
                                    ordencortejf oc 
                                    WHERE oc.codigo = $id ") or die(mysql_error());

$respCabecera = mysql_fetch_array($sqlCabecera);

$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Corporación Vasco S.A.C');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$fila = 4 ;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'OC:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respCabecera["codigo"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "B$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respCabecera["estado"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "C$fila");

$fila = 5 ;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'FECHA:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respCabecera["fecha"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "B$fila");

$fila = 6 ;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Cantidad Total:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respCabecera["total"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "B$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respCabecera["saldo"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "C$fila");

/* 
todo: FIN CABECERA
*/

/* 
todo: INICIO DE DETALLE
*/

$fila = 9;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'MODELO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde9, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ARTÍCULO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde9, "B$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'MATERIA PRIMA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde9, "C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'CANT.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde9, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'CONSUMO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde9, "E$fila");

#query para sacar los datos del detalle
$sqlDetalle = mysql_query("SELECT 
                                    a.modelo,
                                    CONCAT(
                                      a.nombre,
                                      ' - ',
                                      a.color,
                                      ' - T',
                                      a.talla
                                    ) AS articulo,
                                    mp.descripcion AS materiaprima,
                                    doc.cantidad,
                                    ROUND((doc.cantidad * dt.consumo), 2) AS consumo 
                                    FROM
                                    detalles_ordencortejf doc 
                                    LEFT JOIN detalles_tarjetajf dt 
                                      ON doc.articulo = dt.articulo 
                                    LEFT JOIN 
                                      (SELECT DISTINCT 
                                        p.codpro,
                                        CONCAT(p.DesPro, ' - ', tb.Des_Larga) AS descripcion 
                                      FROM
                                        producto AS p,
                                        Tabla_M_Detalle AS tb 
                                      WHERE tb.Cod_Tabla IN ('TCOL') 
                                        AND tb.Cod_Argumento = p.ColPro 
                                        AND p.estpro = '1' 
                                      ORDER BY SUBSTRING(CodFab, 1, 6) ASC) AS mp 
                                      ON dt.mat_pri = mp.codpro 
                                    LEFT JOIN articulojf a 
                                      ON doc.articulo = a.articulo 
                                    WHERE doc.ordencorte = $id 
                                    AND dt.tej_princ = 'si' 
                                    ORDER BY doc.articulo") or die(mysql_error());

while($respDetalle = mysql_fetch_array($sqlDetalle)){

$fila+= 1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", utf8_encode($respDetalle["modelo"]));
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["articulo"]));
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["materiaprima"]));
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["cantidad"]));
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["consumo"]));

$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

}

/* 
todo: FIN DE DETALLE
*/

$fila = 10;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 11;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 12;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 13;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 14;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 15;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 16;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 17;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 18;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 19;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 20;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 21;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 22;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 23;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 24;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 25;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 26;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 27;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 28;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 29;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 30;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 31;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 32;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 33;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 34;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 35;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 36;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 37;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");

$fila = 38;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "E$fila");


/* 
todo: INICIO TOTAL
*/

#query para sacar el total
$sqlTotal = mysql_query("SELECT 
                                doc.ordencorte,
                                SUM(doc.cantidad) AS cantidad,
                                SUM(ROUND((doc.cantidad * dt.consumo), 2)) AS consumo 
                                FROM
                                detalles_ordencortejf doc 
                                LEFT JOIN detalles_tarjetajf dt 
                                  ON doc.articulo = dt.articulo 
                                WHERE doc.ordencorte = $id
                                AND dt.tej_princ = 'si' 
                                GROUP BY doc.ordencorte 
                                ORDER BY doc.articulo") or die(mysql_error());

$respTotal = mysql_fetch_array($sqlTotal);

$fila = 39;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde7, "A$fila:C$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $respTotal["cantidad"]);
$objPHPExcel->getActiveSheet()->setSharedStyle($borde7, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $respTotal["consumo"]);
$objPHPExcel->getActiveSheet()->setSharedStyle($borde7, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

/* 
todo: FIN TOTAL
*/

/* 
todo: INICIO DEL RESUMEN
*/

$fila = 41;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'RESUMEN: Consumo de Telas');
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde7, "B$fila:D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$fila = 42;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'FECHA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde9, "B$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'MATERIA PRIMA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde9, "C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'CONS.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde9, "D$fila");

#query para sacar los datos del resumen
$sqlResumen = mysql_query("SELECT 
                                  DATE(oc.fecha) AS fecha,
                                  mp.descripcion AS materiaprima,
                                  SUM(ROUND((doc.cantidad * dt.consumo), 2)) AS consumo 
                                  FROM
                                  detalles_ordencortejf doc 
                                  LEFT JOIN detalles_tarjetajf dt 
                                    ON doc.articulo = dt.articulo 
                                  LEFT JOIN 
                                    (SELECT DISTINCT 
                                      p.codpro,
                                      CONCAT(p.DesPro, ' - ', tb.Des_Larga) AS descripcion 
                                    FROM
                                      producto AS p,
                                      Tabla_M_Detalle AS tb 
                                    WHERE tb.Cod_Tabla IN ('TCOL') 
                                      AND tb.Cod_Argumento = p.ColPro 
                                      AND p.estpro = '1' 
                                    ORDER BY SUBSTRING(CodFab, 1, 6) ASC) AS mp 
                                    ON dt.mat_pri = mp.codpro 
                                  LEFT JOIN ordencortejf oc 
                                    ON doc.ordencorte = oc.codigo 
                                  WHERE doc.ordencorte = $id
                                  AND dt.tej_princ = 'si' 
                                  GROUP BY mp.descripcion 
                                  ORDER BY doc.articulo") or die(mysql_error());

while($respResumen = mysql_fetch_array($sqlResumen)){

$fila+= 1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respResumen["fecha"]));
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respResumen["materiaprima"]));
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respResumen["consumo"]));

$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

}

/* 
todo: FIN DEL RESUMEN
*/

/* 
todo: INICIO DEL RELLENO
*/

$fila = 43;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

$fila = 44;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

$fila = 45;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

$fila = 46;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

$fila = 47;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

$fila = 48;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

$fila = 49;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

$fila = 50;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

$fila = 51;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

$fila = 52;
$objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde6, "D$fila");

/* 
todo: FIN RELLENO
*/

/* 
todo: INICIO TOTAL RESUMEN
*/

#query para sacar el total
$sqlTotalResumen = mysql_query("SELECT 
                                doc.ordencorte,
                                SUM(doc.cantidad) AS cantidad,
                                SUM(ROUND((doc.cantidad * dt.consumo), 2)) AS consumo 
                                FROM
                                detalles_ordencortejf doc 
                                LEFT JOIN detalles_tarjetajf dt 
                                  ON doc.articulo = dt.articulo 
                                WHERE doc.ordencorte = $id
                                AND dt.tej_princ = 'si' 
                                GROUP BY doc.ordencorte 
                                ORDER BY doc.articulo") or die(mysql_error());

$respTotalResumen = mysql_fetch_array($sqlTotalResumen);

$fila = 53;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde7, "B$fila:C$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $respTotalResumen["consumo"]);
$objPHPExcel->getActiveSheet()->setSharedStyle($borde7, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

/* 
todo: FIN TOTAL RESUMEN
*/

# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(42.87);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(9.29);



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
$sqlArchivo = mysql_query("SELECT 
                                CONCAT('OC - ',codigo) AS codigo
                                FROM
                                ordencortejf oc
                                WHERE oc.codigo= $id") or die(mysql_error());

$respArchivo = mysql_fetch_array($sqlArchivo);


# Nombre del archivo
header('Content-Disposition: attachment; filename="ORDEN DE CORTE.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');
