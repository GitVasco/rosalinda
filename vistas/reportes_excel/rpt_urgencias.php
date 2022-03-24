<?php

header('Content-Type: text/html; charset=ISO-8859-1');

/* 
* RECIBIMOS VARIABLE DESDE LA VISTA
*/

#$id = $_GET["codigo"];

date_default_timezone_set('America/Lima');
$dia=date('d/m/Y');
$hora=date('h:i:s');



/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
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
#negrita-subrayado-13-rojo
$texto_1 = new PHPExcel_Style();
$texto_1->applyFromArray(
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

#negrita-11-negro
$texto_2 = new PHPExcel_Style();
$texto_2->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 11
    )
));

#normal-10
$texto_3 = new PHPExcel_Style();
$texto_3->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => false,
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 10
    )
));

#normal-11-azul
$texto_4 = new PHPExcel_Style();
$texto_4->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '0400FF'),
      'size' => 11
    )
));

#negrita-11-rojo
$borde_1 = new PHPExcel_Style();
$borde_1->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => 'FF0008'),
      'size' => 8
    )
));

#negrita-11-azul
$borde_2 = new PHPExcel_Style();
$borde_2->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '0400FF'),
      'size' => 8
    )
));

#negrita-11-negro
$borde_3 = new PHPExcel_Style();
$borde_3->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 8
    )
));

#negrita-11-celeste
$borde_4 = new PHPExcel_Style();
$borde_4->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '0174BB'),
      'size' => 8
    )
));

#negrita-11-verde
$borde_5 = new PHPExcel_Style();
$borde_5->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '00833E'),
      'size' => 8
    )
));

#normal-10-negro
$borde_6 = new PHPExcel_Style();
$borde_6->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => false,
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 8
    )
));

#negrita-10-vino
$borde_7 = new PHPExcel_Style();
$borde_7->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => 'A4001E'),
      'size' => 8
    )
));

#negrita-10-rojo/rosado
$borde_8 = new PHPExcel_Style();
$borde_8->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'EEABAB')
    ),
    'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => 'FF0008'),
      'size' => 8
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
$objPHPExcel->getActiveSheet()->setTitle('Urgencias');

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

# Establecer cabecera de cada Hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 8);
$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(0,9);


# Incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('img/jackyform_letras.png'); //ruta
$objDrawing->setWidthAndHeight(200, 150);
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

/* 
todo: INICIO CABECERA
*/

#query para sacar los datos de la cabecera
$sqlCabecera = mysql_query("SELECT DISTINCT 
ROUND(urgencia, 0) AS urgencia,
p.pedidos,
IFNULL(f.faltantes,0) AS faltantes,
IFNULL(ROUND((f.faltantes * 100 / p.pedidos), 2),0) AS quiebre 
FROM
articulojf a 
JOIN 
  (SELECT 
    SUM(a.pedidos) AS pedidos 
  FROM
    articulojf a 
  WHERE a.estado = 'activo') AS p 
JOIN 
  (SELECT 
    SUM(a.stock - a.pedidos) AS faltantes 
  FROM
    articulojf a 
  WHERE a.pedidos > a.stock 
    AND a.estado = 'activo') AS f") or die(mysql_error());

$respCabecera = mysql_fetch_array($sqlCabecera);

$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'STOCK POR DEBAJO DEL '.utf8_encode($respCabecera["urgencia"]).'% DE LAS VENTAS DE LOS ULTIMOS');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_1, "C$fila:I$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila =3;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '30 DIAS');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_1, "C$fila:I$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'FECHA:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_2, "J$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $dia);
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_2, "K$fila:L$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila =4;
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'HORA:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_2, "J$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $hora);
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_2, "K$fila:L$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila =6;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Prendas Faltantes :');
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "B$fila:C$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respCabecera["faltantes"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respCabecera["quiebre"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Prendas en pedidos :');
$objPHPExcel->getActiveSheet()->mergeCells("H$fila:J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_4, "H$fila:J$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($respCabecera["pedidos"]));
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "K$fila:L$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

/* 
todo: FIN CABECERA
*/

/* 
todo: INICIO DETALLE
*/
$fila = 8;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(38.06);
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'ARTICULO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'NOMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'TALLA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'PROYEC');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_4, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '% AVANCE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_5, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'MAT. FALTANTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'STOCK');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_4, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'PEDIDOS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'EN TALLER');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'ALM. CORTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'ORD. CORTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'VTAS. ULT. 30 DIAS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_4, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setWrapText(true);

#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
                  a.articulo,
                  a.id_marca,
                  m.marca,
                  a.modelo,
                  a.nombre,
                  a.cod_color,
                  a.color,
                  a.cod_talla,
                  a.talla,
                  a.estado,
                  a.urgencia,
                  a.mp_faltante,
                  ROUND(
                    (
                      IFNULL(a.ult_mes, 0) * a.urgencia / 100
                    ),
                    0
                  ) AS configuracion,
                  CASE
                    WHEN a.stock < 0 
                    THEN 0 
                    ELSE a.stock 
                  END AS stock,
                  (a.stock - a.pedidos) AS stockB,
                  a.pedidos,
                  (a.taller + a.servicio) AS taller,
                  a.alm_corte,
                  a.ord_corte,
                  a.proyeccion,
                  IFNULL(a.prod, 0) AS prod,
                  IFNULL(
                    ROUND(
                      (IFNULL(a.prod, 0) / a.proyeccion) * 100,
                      2
                    ),
                    0
                  ) AS avance,
                  IFNULL(a.ult_mes, 0) AS ult_mes 
                  FROM
                  articulojf a 
                  LEFT JOIN marcasjf m 
                    ON a.id_marca = m.id 
                  WHERE a.estado = 'Activo' 
                  AND a.marca = 'ROSALINDA' 
                  AND ROUND(
                    (
                      IFNULL(a.ult_mes, 0) * a.urgencia / 100
                    ),
                    0
                  ) > (a.stock - a.pedidos)") or die(mysql_error());


while($respDetalle = mysql_fetch_array($sqlDetalle)){

    $fila+= 1;
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", utf8_encode($respDetalle["modelo"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["nombre"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["color"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "T".utf8_encode($respDetalle["talla"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["proyeccion"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["avance"])." %");
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["mp_faltante"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["stockB"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["pedidos"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["taller"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($respDetalle["alm_corte"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($respDetalle["ord_corte"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($respDetalle["ult_mes"]));


    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "A$fila");
    $objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "B$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "C$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "D$fila");
    $objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_5, "E$fila");

    if(utf8_encode($respDetalle["avance"]) < 90){

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "F$fila");
        $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    }else{

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_5, "F$fila");
        $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    }

    if(utf8_encode($respDetalle["mp_faltante"]) == "F/TELA"){

      $objPHPExcel->getActiveSheet()->setSharedStyle($borde_8, "G$fila");

  }else{

      $objPHPExcel->getActiveSheet()->setSharedStyle($borde_7, "G$fila");

  }

    if(utf8_encode($respDetalle["stockB"]) < 0){

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_8, "H$fila");

    }else{

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_7, "H$fila");

    }

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "I$fila");

    if(utf8_encode($respDetalle["taller"]) <= 0){

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_8, "J$fila");

    }else{

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "J$fila");

    }

    if(utf8_encode($respDetalle["alm_corte"]) <= 0){

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_8, "K$fila");

    }else{

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "K$fila");

    }
    
    if(utf8_encode($respDetalle["ord_corte"]) <= 0){

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "L$fila");

    }else{

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "L$fila");

    }

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_4, "M$fila");

}




/* 
todo: FIN DETALLE
*/


# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12.86);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);



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
header('Content-Disposition: attachment; filename="Urgencias.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');
