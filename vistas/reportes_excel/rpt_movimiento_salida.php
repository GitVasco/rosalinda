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
$linea=$_GET["linea"];
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
$objPHPExcel->getActiveSheet()->setTitle("REPORTE SALIDAS -".$fecha);

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
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'TOTAL DE SALIDAS POR LINEA');
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

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'COD. SUBLINEA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'COD. FAB');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'COD. PRO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'UNIDAD');
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


if($linea == null){
  
#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
mp.codsublinea,
mp.codigofabrica,
vd.codpro,
mp.codlinea,
mp.linea,
mp.descripcion,
mp.color,
mp.unidad,
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '1' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '1',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '2' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '2',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '3' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '3',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '4' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '4',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '5' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '5',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '6' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '6',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '7' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '7',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '8' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '8',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '9' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '9',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '10' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '10',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '11' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '11',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '12' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '12',
SUM(vd.canvta) AS total 
FROM
venta_det vd 
LEFT JOIN 
(SELECT DISTINCT 
   p.Codpro AS Codigo,
   SUBSTRING(p.CodFab, 1, 3) AS codlinea,
   Tb4.Des_larga AS Linea,
   p.CodFab AS CodigoFabrica,
   p.DesPro AS Descripcion,
   p.CodAlm01 AS Stk_Actual,
   Tabla_M_Detalle.Des_Larga AS Color,
   Tb2.Des_Corta AS Unidad,
   p.CosPro,
   SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
   Tb1.Des_larga AS SubLinea 
FROM
   producto p,
   Tabla_M_Detalle,
   Tabla_M_Detalle AS Tb1,
   Tabla_M_Detalle AS Tb2,
   Tabla_M_Detalle AS Tb4 
WHERE Tabla_M_Detalle.Cod_Tabla IN ('TCOL') 
   AND Tb2.Cod_Tabla IN ('TUND') 
   AND tB4.Cod_Tabla IN ('TLIN') 
   AND Tb1.Cod_Tabla IN ('TSUB') 
   AND Tabla_M_Detalle.Cod_Argumento = p.ColPro 
   AND Tb2.Cod_Argumento = p.UndPro 
   AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
   AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
   AND Tb4.Des_Corta = Tb1.Des_Corta 
ORDER BY p.CodPro ASC) AS mp 
ON vd.codpro = mp.codigo 
WHERE vd.EstVta = 'P' 
AND vd.canvta > 0 
AND YEAR(vd.fecemi) = YEAR(NOW()) 
GROUP BY vd.codpro 
UNION
SELECT 
mp.codsublinea,
'TOTAL',
'-',
mp.codlinea,
mp.linea,
'-',
'-',
'-',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '1' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '1',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '2' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '2',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '3' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '3',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '4' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '4',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '5' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '5',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '6' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '6',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '7' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '7',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '8' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '8',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '9' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '9',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '10' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '10',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '11' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '11',
SUM(
CASE
   WHEN MONTH(vd.fecemi) = '12' 
   THEN vd.canvta 
   ELSE 0 
END
) AS '12',
SUM(vd.canvta) AS total 
FROM
venta_det vd 
LEFT JOIN 
(SELECT DISTINCT 
   p.Codpro AS Codigo,
   SUBSTRING(p.CodFab, 1, 3) AS codlinea,
   Tb4.Des_larga AS Linea,
   p.CodFab AS CodigoFabrica,
   p.DesPro AS Descripcion,
   p.CodAlm01 AS Stk_Actual,
   Tabla_M_Detalle.Des_Larga AS Color,
   Tb2.Des_Corta AS Unidad,
   p.CosPro,
   SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
   Tb1.Des_larga AS SubLinea 
FROM
   producto p,
   Tabla_M_Detalle,
   Tabla_M_Detalle AS Tb1,
   Tabla_M_Detalle AS Tb2,
   Tabla_M_Detalle AS Tb4 
WHERE Tabla_M_Detalle.Cod_Tabla IN ('TCOL') 
   AND Tb2.Cod_Tabla IN ('TUND') 
   AND tB4.Cod_Tabla IN ('TLIN') 
   AND Tb1.Cod_Tabla IN ('TSUB') 
   AND Tabla_M_Detalle.Cod_Argumento = p.ColPro 
   AND Tb2.Cod_Argumento = p.UndPro 
   AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
   AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
   AND Tb4.Des_Corta = Tb1.Des_Corta 
ORDER BY p.CodPro ASC) AS mp 
ON vd.codpro = mp.codigo 
WHERE vd.EstVta = 'P' 
AND vd.canvta > 0 
AND YEAR(vd.fecemi) = YEAR(NOW()) 
GROUP BY mp.codsublinea 
ORDER BY codsublinea,
codigofabrica") or die(mysql_error());

$cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
    
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["codsublinea"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["codigofabrica"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["codpro"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["descripcion"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["color"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["unidad"]));

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
  mp.codsublinea,
  mp.codigofabrica,
  vd.codpro,
  mp.codlinea,
  mp.linea,
  mp.descripcion,
  mp.color,
  mp.unidad,
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '1' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '1',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '2' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '2',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '3' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '3',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '4' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '4',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '5' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '5',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '6' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '6',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '7' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '7',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '8' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '8',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '9' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '9',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '10' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '10',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '11' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '11',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '12' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '12',
  SUM(vd.canvta) AS total 
FROM
  venta_det vd 
  LEFT JOIN 
  (SELECT DISTINCT 
     p.Codpro AS Codigo,
     SUBSTRING(p.CodFab, 1, 3) AS codlinea,
     Tb4.Des_larga AS Linea,
     p.CodFab AS CodigoFabrica,
     p.DesPro AS Descripcion,
     p.CodAlm01 AS Stk_Actual,
     Tabla_M_Detalle.Des_Larga AS Color,
     Tb2.Des_Corta AS Unidad,
     p.CosPro,
     SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
     Tb1.Des_larga AS SubLinea 
  FROM
     producto p,
     Tabla_M_Detalle,
     Tabla_M_Detalle AS Tb1,
     Tabla_M_Detalle AS Tb2,
     Tabla_M_Detalle AS Tb4 
  WHERE Tabla_M_Detalle.Cod_Tabla IN ('TCOL') 
     AND Tb2.Cod_Tabla IN ('TUND') 
     AND tB4.Cod_Tabla IN ('TLIN') 
     AND Tb1.Cod_Tabla IN ('TSUB') 
     AND Tabla_M_Detalle.Cod_Argumento = p.ColPro 
     AND Tb2.Cod_Argumento = p.UndPro 
     AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
     AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
     AND Tb4.Des_Corta = Tb1.Des_Corta 
  ORDER BY p.CodPro ASC) AS mp 
  ON vd.codpro = mp.codigo 
WHERE vd.EstVta = 'P' 
  AND vd.canvta > 0 
  AND YEAR(vd.fecemi) = YEAR(NOW()) 
  AND mp.codlinea = '".$linea."' 
GROUP BY vd.codpro 
UNION
SELECT 
  mp.codsublinea,
  'TOTAL',
  '-',
  mp.codlinea,
  mp.linea,
  '-',
  '-',
  '-',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '1' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '1',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '2' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '2',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '3' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '3',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '4' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '4',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '5' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '5',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '6' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '6',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '7' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '7',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '8' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '8',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '9' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '9',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '10' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '10',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '11' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '11',
  SUM(
  CASE
     WHEN MONTH(vd.fecemi) = '12' 
     THEN vd.canvta 
     ELSE 0 
  END
  ) AS '12',
  SUM(vd.canvta) AS total 
FROM
  venta_det vd 
  LEFT JOIN 
  (SELECT DISTINCT 
     p.Codpro AS Codigo,
     SUBSTRING(p.CodFab, 1, 3) AS codlinea,
     Tb4.Des_larga AS Linea,
     p.CodFab AS CodigoFabrica,
     p.DesPro AS Descripcion,
     p.CodAlm01 AS Stk_Actual,
     Tabla_M_Detalle.Des_Larga AS Color,
     Tb2.Des_Corta AS Unidad,
     p.CosPro,
     SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
     Tb1.Des_larga AS SubLinea 
  FROM
     producto p,
     Tabla_M_Detalle,
     Tabla_M_Detalle AS Tb1,
     Tabla_M_Detalle AS Tb2,
     Tabla_M_Detalle AS Tb4 
  WHERE Tabla_M_Detalle.Cod_Tabla IN ('TCOL') 
     AND Tb2.Cod_Tabla IN ('TUND') 
     AND tB4.Cod_Tabla IN ('TLIN') 
     AND Tb1.Cod_Tabla IN ('TSUB') 
     AND Tabla_M_Detalle.Cod_Argumento = p.ColPro 
     AND Tb2.Cod_Argumento = p.UndPro 
     AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
     AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
     AND Tb4.Des_Corta = Tb1.Des_Corta 
  ORDER BY p.CodPro ASC) AS mp 
  ON vd.codpro = mp.codigo 
WHERE vd.EstVta = 'P' 
  AND vd.canvta > 0 
  AND YEAR(vd.fecemi) = YEAR(NOW()) 
  AND mp.codlinea = '".$linea."'
GROUP BY mp.codsublinea 
ORDER BY codsublinea,
  codigofabrica");
  $cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle2)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
    
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["codsublinea"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["codigofabrica"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["codpro"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["descripcion"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["color"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["unidad"]));

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
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25.29);
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
header('Content-Disposition: attachment; filename=" TOTAL SALIDAS - '.$fecha.'.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');