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

$mes = $_GET["mes"];



date_default_timezone_set('America/Lima');
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

/* 
* FIN DE ESTILOS
*/
/* 
* CONFIGURAMOS LA 1ERA HOJA
*/
$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);

# Titulo de la hoja
$objPHPExcel->getActiveSheet()->setTitle("Registro de Ventas -".$fecha);

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


// TITULO
$fila = 1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'REGISTRO DE VENTAS');
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "A$fila:M$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila = 3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'DIA:');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'TIPO DOC');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "B$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'No. DOC');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'No. RUC');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'CLIENTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "E$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'VTAS. US$');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'T/C');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'VTAS. S/');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'DSCTOS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "I$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'EXONERADO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "J$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'BASE IMP.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "K$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'IMPUESTO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "L$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "M$fila");

$sqlDetalle = mysql_query("SELECT 
DATE_FORMAT(v.fecha, '%d-%m-%Y') AS fecha,
CASE
  WHEN v.tipo = 's03' 
  THEN '1' 
  WHEN v.tipo = 's02' 
  THEN '3' 
  ELSE '7' 
END AS tipo_doc,
CONCAT(
  LEFT(v.documento, 4),
  '-',
  RIGHT(v.documento, 8)
) AS doc,
CASE
  WHEN v.estado = 'ANULADO' 
  THEN '00000000000' 
  ELSE c.documento 
END AS documento,
CASE
  WHEN v.estado = 'ANULADO' 
  THEN 'ANULADO' 
  ELSE c.nombre 
END AS nombre,
v.neto,
v.dscto,
v.neto - v.dscto AS subtotal,
ROUND((v.neto - v.dscto) * 0.18, 2) AS igv,
v.total 
FROM
ventajf v 
LEFT JOIN clientesjf c 
  ON v.cliente = c.codigo 
WHERE MONTH(v.fecha) = $mes
AND YEAR(v.fecha) = YEAR(NOW())
AND v.tipo NOT IN ('S70') 
AND (
  LEFT(v.documento, 2) = 'B0' 
  OR LEFT(v.documento, 2) = 'F0'
) 
ORDER BY v.tipo ASC,
v.fecha,
v.documento") or die(mysql_error());

while($respDetalle = mysql_fetch_array($sqlDetalle)){

  $fila+=1;
  
  $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $respDetalle["fecha"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $respDetalle["tipo_doc"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $respDetalle["doc"]);
  //$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $respDetalle["documento"]);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", utf8_encode($respDetalle["documento"]), PHPExcel_Cell_DataType::TYPE_STRING); 
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["nombre"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", "0");
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "0");
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $respDetalle["neto"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $respDetalle["dscto"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "0");
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $respDetalle["subtotal"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $respDetalle["igv"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $respDetalle["total"]);   

}



$sqlDetalleTotal = mysql_query("SELECT 
            MONTH(v.fecha) AS mes,
            SUM(v.neto) AS neto,
            SUM(v.dscto) AS dscto,
            SUM(v.neto - v.dscto) AS subtotal,
            SUM(ROUND((v.neto - v.dscto) * 0.18, 2)) AS igv,
            SUM(v.total) AS total 
            FROM
            ventajf v 
            LEFT JOIN clientesjf c 
              ON v.cliente = c.codigo 
            WHERE MONTH(v.fecha) = $mes 
            AND YEAR(v.fecha) = YEAR(NOW())
            AND v.tipo NOT IN ('S70') 
            AND (
              LEFT(v.documento, 2)= 'B0'
              OR LEFT(v.documento, 2) = 'F0'
            ) 
            GROUP BY MONTH(v.fecha) 
            ORDER BY v.tipo ASC,
            v.fecha,
            v.documento") or die(mysql_error());

$fila+=1;    
$fila+=1;     

$resTotal=mysql_fetch_array($sqlDetalleTotal);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", "0");
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "0");
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $resTotal["neto"]);
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $resTotal["dscto"]);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "0");
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $resTotal["subtotal"]);
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $resTotal["igv"]);
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $resTotal["total"]);   


# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(45.55);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13.71);

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
header('Content-Disposition: attachment; filename=" Ventas - '.$fecha.'.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');