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
$fechaactual = getdate();
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
$objPHPExcel->getActiveSheet()->setTitle("TARJETA ARTICULOS LISTOS -".$fecha);

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
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// TITULO
$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'TARJETAS DE ARTICULO LISTOS');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto3, "C$fila:F$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'fecha:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "I$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $fecha);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "J$fila");

/* 
todo: INICIO DE DETALLE
*/


$fila = 5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'ARTICULO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'MARCA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'MODELO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'NOMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'TALLA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'TIPO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'ESTADO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'STOCK');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'TARJETA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
a.id,
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
a.stock,
(a.stock - a.pedidos) AS stockB,
IFNULL(v.ult_mes, 0) AS ventas,
a.urgencia,
ROUND(
  (
    IFNULL(v.ult_mes, 0) * a.urgencia / 100
  ),
  0
) AS configuracion,
mo.tipo,
CASE
  WHEN a.tarjeta = 'si' 
  AND a.estado IN ('activo', 'campañad') 
  THEN 'Listo' 
  WHEN a.tarjeta = 'no' 
  AND a.estado = 'descontinuado' 
  THEN 'No Necesario' 
  WHEN a.tarjeta = 'si' 
  AND a.estado = 'descontinuado' 
  THEN 'Listo' 
  ELSE 'Pendiente' 
END AS tarjeta 
FROM
articulojf a 
LEFT JOIN marcasjf m 
  ON a.id_marca = m.id 
LEFT JOIN 
  (SELECT 
    m.articulo,
    SUM(m.cantidad) AS ult_mes 
  FROM
    movimientosjf m 
  WHERE m.tipo IN ('S02', 'S03', 'S70') 
    AND DATEDIFF(DATE(NOW()), m.fecha) <= 31 
  GROUP BY m.articulo) v 
  ON a.articulo = v.articulo 
LEFT JOIN 
  (SELECT 
    modelo,
    tipo
  FROM
    modelojf) mo 
  ON a.modelo = mo.modelo WHERE a.estado = 'activo' AND  a.marca NOT IN('MEDIAS','ELÁSTICOS') AND CASE
  WHEN a.tarjeta = 'si' 
  AND a.estado IN ('activo', 'campañad') 
  THEN 'Listo' 
  WHEN a.tarjeta = 'no' 
  AND a.estado = 'descontinuado' 
  THEN 'No Necesario' 
  WHEN a.tarjeta = 'si' 
  AND a.estado = 'descontinuado' 
  THEN 'Listo' 
  ELSE 'Pendiente' 
END ='Listo'
ORDER BY a.articulo ASC") or die(mysql_error());

$cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila",utf8_encode($respDetalle["articulo"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["marca"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["modelo"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["nombre"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["color"]));

    
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["talla"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["tipo"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["estado"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["stockB"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["tarjeta"]));
    
    
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
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
}

# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10.87);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(6.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20.29);

//segunda pestaña
$objPHPExcel->createSheet(1);
$objPHPExcel->setActiveSheetIndex(1);

# Titulo de la hoja
$objPHPExcel->getActiveSheet()->setTitle("TARJETA DE ARTICULOS PENDIENTES -".$fecha);

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
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());


// TITULO
$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'TARJETAS DE ARTICULOS PENDIENTES ');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto3, "C$fila:F$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'fecha:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "I$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $fecha);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "J$fila");

/* 
todo: INICIO DE DETALLE
*/


$fila = 5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'ARTICULO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'MARCA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'MODELO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'NOMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'TALLA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'TIPO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'ESTADO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'STOCK');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'TARJETA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


#query para sacar los datos deL detalle
$sqlDetalle2 = mysql_query("SELECT 
a.id,
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
a.stock,
(a.stock - a.pedidos) AS stockB,
IFNULL(v.ult_mes, 0) AS ventas,
a.urgencia,
ROUND(
  (
    IFNULL(v.ult_mes, 0) * a.urgencia / 100
  ),
  0
) AS configuracion,
mo.tipo,
CASE
  WHEN a.tarjeta = 'si' 
  AND a.estado IN ('activo', 'campañad') 
  THEN 'Listo' 
  WHEN a.tarjeta = 'no' 
  AND a.estado = 'descontinuado' 
  THEN 'No Necesario' 
  WHEN a.tarjeta = 'si' 
  AND a.estado = 'descontinuado' 
  THEN 'Listo' 
  ELSE 'Pendiente' 
END AS tarjeta 
FROM
articulojf a 
LEFT JOIN marcasjf m 
  ON a.id_marca = m.id 
LEFT JOIN 
  (SELECT 
    m.articulo,
    SUM(m.cantidad) AS ult_mes 
  FROM
    movimientosjf m 
  WHERE m.tipo IN ('S02', 'S03', 'S70') 
    AND DATEDIFF(DATE(NOW()), m.fecha) <= 31 
  GROUP BY m.articulo) v 
  ON a.articulo = v.articulo 
LEFT JOIN 
  (SELECT 
    modelo,
    tipo
  FROM
    modelojf) mo 
  ON a.modelo = mo.modelo WHERE a.estado = 'activo'AND a.marca NOT IN('MEDIAS','ELÁSTICOS') AND CASE
  WHEN a.tarjeta = 'si' 
  AND a.estado IN ('activo', 'campañad') 
  THEN 'Listo' 
  WHEN a.tarjeta = 'no' 
  AND a.estado = 'descontinuado' 
  THEN 'No Necesario' 
  WHEN a.tarjeta = 'si' 
  AND a.estado = 'descontinuado' 
  THEN 'Listo' 
  ELSE 'Pendiente' 
END ='Pendiente'
ORDER BY a.articulo ASC") or die(mysql_error());

$cont = 0;
while($respDetalle2 = mysql_fetch_array($sqlDetalle2)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila",utf8_encode($respDetalle2["articulo"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle2["marca"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle2["modelo"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle2["nombre"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle2["color"]));

    
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle2["talla"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle2["tipo"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle2["estado"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle2["stockB"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle2["tarjeta"]));
    
    
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "A$fila");
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
}

# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10.87);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(6.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20.29);

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
header('Content-Disposition: attachment; filename=" TARJETAS DE ARTICULOS- '.$fecha.'.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');