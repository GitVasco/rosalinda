<?php

header('Content-Type: text/html; charset=ISO-8859-1');



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
date_default_timezone_set('America/Lima');
$fechaactual = getdate();
$modelo=$_GET["modelo"];
$fecha = date("d-m-Y");

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
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
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
$objPHPExcel->getActiveSheet()->setTitle("REPORTE PRODUCCION -".$fecha);

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

// TITULO
$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'TOTAL DE PRODUCCION POR MODELO');
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto3, "D$fila:E$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'fecha:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $fecha);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "G$fila");

/* 
todo: INICIO DE DETALLE
*/

$fila = 6;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'MODELO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'ARTICULO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'NOMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'TALLA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'ESTADO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'ENERO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'FEBRERO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'MARZO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'ABRIL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'MAYO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'JUNIO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'JULIO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'AGOSTO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "O$fila");
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'SEPTIEMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "P$fila");
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'OCTUBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "Q$fila");
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'NOVIEMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "R$fila");
$objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'DICIEMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "S$fila");
$objPHPExcel->getActiveSheet()->getStyle("S$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "T$fila");
$objPHPExcel->getActiveSheet()->getStyle("T$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


if($modelo == null){
  
#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
a1.modelo AS modelo,
a1.articulo AS articulo,
a1.nombre AS nombre,
a1.cod_color,
a1.color,
a1.talla,
a1.estado AS estado,
SUM(
CASE
   WHEN MONTH(m.fecha) = '1' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '1',
SUM(
CASE
   WHEN MONTH(m.fecha) = '2' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '2',
SUM(
CASE
   WHEN MONTH(m.fecha) = '3' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '3',
SUM(
CASE
   WHEN MONTH(m.fecha) = '4' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '4',
SUM(
CASE
   WHEN MONTH(m.fecha) = '5' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '5',
SUM(
CASE
   WHEN MONTH(m.fecha) = '6' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '6',
SUM(
CASE
   WHEN MONTH(m.fecha) = '7' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '7',
SUM(
CASE
   WHEN MONTH(m.fecha) = '8' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '8',
SUM(
CASE
   WHEN MONTH(m.fecha) = '9' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '9',
SUM(
CASE
   WHEN MONTH(m.fecha) = '10' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '10',
SUM(
CASE
   WHEN MONTH(m.fecha) = '11' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '11',
SUM(
CASE
   WHEN MONTH(m.fecha) = '12' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '12',
ROUND(SUM(m.cantidad)) AS total 
FROM
movimientosjf m 
LEFT JOIN articulojf a1 
ON m.articulo = a1.articulo 
WHERE YEAR(m.fecha) = YEAR(NOW()) 
AND m.tipo = 'E20' 
GROUP BY a1.modelo,
a1.articulo,
a1.nombre,
a1.cod_color,
a1.color,
a1.talla,
a1.estado 
UNION
SELECT 
mo.modelo AS modelo,
'TOTAL' AS articulo,
mo.nombre AS nombre,
'-',
'-',
'-',
mo.estado AS estado,
SUM(
CASE
   WHEN MONTH(m.fecha) = '1' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '1',
SUM(
CASE
   WHEN MONTH(m.fecha) = '2' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '2',
SUM(
CASE
   WHEN MONTH(m.fecha) = '3' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '3',
SUM(
CASE
   WHEN MONTH(m.fecha) = '4' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '4',
SUM(
CASE
   WHEN MONTH(m.fecha) = '5' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '5',
SUM(
CASE
   WHEN MONTH(m.fecha) = '6' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '6',
SUM(
CASE
   WHEN MONTH(m.fecha) = '7' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '7',
SUM(
CASE
   WHEN MONTH(m.fecha) = '8' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '8',
SUM(
CASE
   WHEN MONTH(m.fecha) = '9' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '9',
SUM(
CASE
   WHEN MONTH(m.fecha) = '10' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '10',
SUM(
CASE
   WHEN MONTH(m.fecha) = '11' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '11',
SUM(
CASE
   WHEN MONTH(m.fecha) = '12' 
   THEN ROUND(m.cantidad, 0) 
   ELSE 0 
END
) AS '12',
ROUND(SUM(m.cantidad)) AS total 
FROM
movimientosjf m 
LEFT JOIN articulojf a2 
ON m.articulo = a2.articulo 
LEFT JOIN modelojf mo 
ON a2.modelo = mo.modelo 
WHERE YEAR(m.fecha) = YEAR(NOW()) 
AND m.tipo = 'E20' 
GROUP BY mo.modelo,
mo.nombre,
mo.estado 
ORDER BY modelo ASC,
articulo ASC") or die(mysql_error());

$cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
    
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["modelo"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["articulo"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["nombre"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["color"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["talla"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["estado"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["1"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["2"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["3"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($respDetalle["4"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($respDetalle["5"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($respDetalle["6"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($respDetalle["7"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($respDetalle["8"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($respDetalle["9"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($respDetalle["10"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($respDetalle["11"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($respDetalle["12"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", utf8_encode($respDetalle["total"]));
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "A$fila");
    $objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
    $objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
    $objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
    $objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "E$fila");
    $objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "F$fila");
    $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "G$fila");
    $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "H$fila");
    $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "I$fila");
    $objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "J$fila");
    $objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "K$fila");
    $objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "L$fila");
    $objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "M$fila");
    $objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "N$fila");
    $objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "O$fila");
    $objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "P$fila");
    $objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "Q$fila");
    $objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "R$fila");
    $objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "S$fila");
    $objPHPExcel->getActiveSheet()->getStyle("S$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "T$fila");
    $objPHPExcel->getActiveSheet()->getStyle("T$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  }
}else{
  $sqlDetalle2 = mysql_query("SELECT 
  a1.modelo AS modelo,
  a1.articulo AS articulo,
  a1.nombre AS nombre,
  a1.cod_color,
  a1.color,
  a1.talla,
  a1.estado AS estado,
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '1' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '1',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '2' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '2',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '3' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '3',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '4' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '4',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '5' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '5',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '6' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '6',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '7' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '7',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '8' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '8',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '9' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '9',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '10' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '10',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '11' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '11',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '12' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '12',
  ROUND(SUM(m.cantidad)) AS total 
FROM
  movimientosjf m 
  LEFT JOIN articulojf a1 
  ON m.articulo = a1.articulo 
WHERE YEAR(m.fecha) = YEAR(NOW()) 
  AND m.tipo = 'E20' 
  AND a1.modelo = '".$modelo."'
GROUP BY a1.modelo,
  a1.articulo,
  a1.nombre,
  a1.cod_color,
  a1.color,
  a1.talla,
  a1.estado 
UNION
SELECT 
  mo.modelo AS modelo,
  'TOTAL' AS articulo,
  mo.nombre AS nombre,
  '-',
  '-',
  '-',
  mo.estado AS estado,
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '1' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '1',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '2' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '2',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '3' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '3',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '4' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '4',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '5' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '5',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '6' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '6',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '7' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '7',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '8' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '8',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '9' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '9',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '10' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '10',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '11' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '11',
  SUM(
  CASE
     WHEN MONTH(m.fecha) = '12' 
     THEN ROUND(m.cantidad, 0) 
     ELSE 0 
  END
  ) AS '12',
  ROUND(SUM(m.cantidad)) AS total 
FROM
  movimientosjf m 
  LEFT JOIN articulojf a2 
  ON m.articulo = a2.articulo 
  LEFT JOIN modelojf mo 
  ON a2.modelo = mo.modelo 
WHERE YEAR(m.fecha) = YEAR(NOW()) 
  AND m.tipo = 'E20' 
  AND a2.modelo = '".$modelo."' 
GROUP BY mo.modelo,
  mo.nombre,
  mo.estado 
ORDER BY modelo ASC,
  articulo ASC");
  $cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle2)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
    
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["modelo"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["articulo"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["nombre"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["color"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["talla"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["estado"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["1"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["2"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["3"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($respDetalle["4"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($respDetalle["5"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($respDetalle["6"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($respDetalle["7"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($respDetalle["8"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($respDetalle["9"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($respDetalle["10"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($respDetalle["11"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($respDetalle["12"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", utf8_encode($respDetalle["total"]));
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "A$fila");
    $objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
    $objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
    $objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
    $objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "E$fila");
    $objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "F$fila");
    $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "G$fila");
    $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "H$fila");
    $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "I$fila");
    $objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "J$fila");
    $objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "K$fila");
    $objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "L$fila");
    $objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "M$fila");
    $objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "N$fila");
    $objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "O$fila");
    $objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "P$fila");
    $objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "Q$fila");
    $objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "R$fila");
    $objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "S$fila");
    $objPHPExcel->getActiveSheet()->getStyle("S$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "T$fila");
    $objPHPExcel->getActiveSheet()->getStyle("T$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}
}



# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(18.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(18.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(18.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(18.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(18.29);
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
header('Content-Disposition: attachment; filename=" TOTAL PRODUCCION - '.$fecha.'.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');