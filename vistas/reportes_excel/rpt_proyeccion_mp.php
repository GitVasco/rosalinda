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
$corte=$_GET["corte"];
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
$objPHPExcel->getActiveSheet()->setTitle("REPORTE PROYECCION DE MATERIA PRIMA -".$fecha);

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
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'TOTAL DE PROYECCION DE MATERIA PRIMA');
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

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'COD. PRO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'COD. FAB');
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

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'REQUERIMIENTO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'STOCK');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'OC. PENDIENTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'OS. PENDIENTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'INGRESOS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'PROYECCION');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'AVANCE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


if($corte == null){
  
#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
mp.linea,
mp.codsublinea,
mp.codpro,
mp.codfab,
mp.descripcion,
mp.color,
mp.unidad,
mp.stock,
SUM(doc.saldo * dt.consumo) AS requerimiento,
IFNULL(oc.saldo, 0) AS saldo_oc,
IFNULL(os.saldo, 0) AS saldo_os,
IFNULL(pr.cons_total, 0) AS cons_total,
IFNULL(i.ing,0) AS ingresos,
IFNULL(
(
IFNULL(i.ing, 0) / IFNULL(pr.cons_total, 0)
) * 100,
0
) AS avance  
FROM
ordencortejf o 
LEFT JOIN detalles_ordencortejf doc 
ON o.codigo = doc.ordencorte 
LEFT JOIN detalles_tarjetajf dt 
ON doc.articulo = dt.articulo 
LEFT JOIN 
(SELECT DISTINCT 
    p.Codpro AS codpro,
    SUBSTRING(p.CodFab, 1, 3) AS codlinea,
    Tb4.Des_larga AS linea,
    SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
    Tb1.Des_larga AS sublinea,
    p.CodFab AS codfab,
    p.DesPro AS descripcion,
    p.CodAlm01 AS stock,
    Tabla_M_Detalle.Des_Larga AS color,
    Tb2.Des_Corta AS unidad 
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
ON dt.mat_pri = mp.codpro 
LEFT JOIN 
(SELECT 
    ocd.codpro,
    ocd.nro,
    DATE(oc.fecemi) AS emision,
    DATE(oc.fecllegada) AS llegada,
    p.razpro,
    ocd.canpro AS cantidad_pedida,
    ocd.cantni AS saldo,
    oc.estac 
FROM
    ocomdet ocd 
    LEFT JOIN ocompra oc 
    ON ocd.nro = oc.nro 
    LEFT JOIN proveedor p 
    ON oc.codruc = p.codruc 
WHERE oc.estac IN ('ABI', 'PAR') 
    AND ocd.estac IN ('ABI', 'PAR') 
    AND oc.estoco = '03' 
    AND ocd.estoco = '03' 
    AND YEAR(oc.fecemi) = YEAR(NOW())) AS oc 
ON dt.mat_pri = oc.codpro 
LEFT JOIN 
(SELECT 
    osd.CodProOrigen,
    osd.CodProDestino AS codpro,
    osd.Saldo 
FROM
    oserviciodet osd 
    LEFT JOIN oservicio os 
    ON os.Nro = osd.Nro 
WHERE osd.EstReg = '1' 
    AND osd.EstOS IN ('ABI', 'PAR') 
    AND YEAR(os.fecent) = YEAR(NOW())) AS os 
ON dt.mat_pri = os.codpro 
LEFT JOIN 
(SELECT 
    dt.mat_pri,
    dt.consumo,
    a.proyeccion,
    SUM(dt.consumo * a.proyeccion) AS cons_total 
FROM
    detalles_tarjetajf dt 
    LEFT JOIN articulojf a 
    ON dt.articulo = a.articulo 
WHERE a.proyeccion > 0 
GROUP BY dt.mat_pri) AS pr 
ON dt.mat_pri = pr.mat_pri 
LEFT JOIN 
(SELECT 
    nd.codpro,
    SUM(nd.cansol) AS ing 
FROM
    neadet nd 
WHERE nd.fecemi > '2020-07-31' 
GROUP BY nd.codpro) AS i 
ON dt.mat_pri = i.codpro 
WHERE o.estado NOT IN ('Cerrado') 
GROUP BY mp.codpro 
ORDER BY mp.linea") or die(mysql_error());

$cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
    
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["codsublinea"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["codpro"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["codfab"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["descripcion"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["color"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["unidad"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["requerimiento"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["stock"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["saldo_oc"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($respDetalle["saldo_os"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($respDetalle["ingresos"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($respDetalle["cons_total"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($respDetalle["avance"]));
    
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
  }
}else{
  $sqlDetalle2 = mysql_query("SELECT 
  mp.linea,
  mp.codsublinea,
  mp.codpro,
  mp.codfab,
  mp.descripcion,
  mp.color,
  mp.unidad,
  mp.stock,
  SUM(doc.saldo * dt.consumo) AS requerimiento,
  IFNULL(oc.saldo, 0) AS saldo_oc,
  IFNULL(os.saldo, 0) AS saldo_os,
  IFNULL(pr.cons_total, 0) AS cons_total,
  IFNULL(i.ing, 0) AS ingresos,
  IFNULL(
    (
      IFNULL(i.ing, 0) / IFNULL(pr.cons_total, 0)
    ) * 100,
    0
  ) AS avance 
FROM
  ordencortejf o 
  LEFT JOIN detalles_ordencortejf doc 
    ON o.codigo = doc.ordencorte 
  LEFT JOIN detalles_tarjetajf dt 
    ON doc.articulo = dt.articulo 
  LEFT JOIN 
    (SELECT DISTINCT 
      p.Codpro AS codpro,
      SUBSTRING(p.CodFab, 1, 3) AS codlinea,
      Tb4.Des_larga AS linea,
      SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
      Tb1.Des_larga AS sublinea,
      p.CodFab AS codfab,
      p.DesPro AS descripcion,
      p.CodAlm01 AS stock,
      Tabla_M_Detalle.Des_Larga AS color,
      Tb2.Des_Corta AS unidad 
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
    ON dt.mat_pri = mp.codpro 
  LEFT JOIN 
    (SELECT 
      ocd.codpro,
      ocd.nro,
      DATE(oc.fecemi) AS emision,
      DATE(oc.fecllegada) AS llegada,
      p.razpro,
      ocd.canpro AS cantidad_pedida,
      ocd.cantni AS saldo,
      oc.estac 
    FROM
      ocomdet ocd 
      LEFT JOIN ocompra oc 
        ON ocd.nro = oc.nro 
      LEFT JOIN proveedor p 
        ON oc.codruc = p.codruc 
    WHERE oc.estac IN ('ABI', 'PAR') 
      AND ocd.estac IN ('ABI', 'PAR') 
      AND oc.estoco = '03' 
      AND ocd.estoco = '03' 
      AND YEAR(oc.fecemi) = YEAR(NOW())) AS oc 
    ON dt.mat_pri = oc.codpro 
  LEFT JOIN 
    (SELECT 
      osd.CodProOrigen,
      osd.CodProDestino AS codpro,
      osd.Saldo 
    FROM
      oserviciodet osd 
      LEFT JOIN oservicio os 
        ON os.Nro = osd.Nro 
    WHERE osd.EstReg = '1' 
      AND osd.EstOS IN ('ABI', 'PAR') 
      AND YEAR(os.fecent) = YEAR(NOW())) AS os 
    ON dt.mat_pri = os.codpro 
  LEFT JOIN 
    (SELECT 
      dt.mat_pri,
      dt.consumo,
      a.proyeccion,
      SUM(dt.consumo * a.proyeccion) AS cons_total 
    FROM
      detalles_tarjetajf dt 
      LEFT JOIN articulojf a 
        ON dt.articulo = a.articulo 
    WHERE a.proyeccion > 0 
    GROUP BY dt.mat_pri) AS pr 
    ON dt.mat_pri = pr.mat_pri 
  LEFT JOIN 
    (SELECT 
      nd.codpro,
      SUM(nd.cansol) AS ing 
    FROM
      neadet nd 
    WHERE nd.fecemi > '2020-07-31' 
    GROUP BY nd.codpro) AS i 
    ON dt.mat_pri = i.codpro 
WHERE o.estado NOT IN ('Cerrado') 
  AND o.codigo = '".$corte."'
GROUP BY mp.codpro 
ORDER BY mp.linea");
  $cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle2)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
    
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["codsublinea"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["codpro"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["codfab"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["descripcion"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["color"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["unidad"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["requerimiento"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["stock"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["saldo_oc"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($respDetalle["saldo_os"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($respDetalle["ingresos"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($respDetalle["cons_total"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($respDetalle["avance"]));
    
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

}
}



# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15.29);
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
header('Content-Disposition: attachment; filename="PROYECCION DE MATERIA PRIMA - '.$fecha.'.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');