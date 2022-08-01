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
      ),
      'font' => array(
        'bold' => true,
        'underline' =>false,
        'color' => array('rgb' => 'FF0000'),
        'size' => 8
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

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'TIPO ORI');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'DOC ORI');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "E$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'FEC ORI');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'No. RUC');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'CLIENTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'VTAS. US$');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "I$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'T/C');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "J$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'VTAS. S/');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "K$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'DSCTOS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "L$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'EXONERADO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "M$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'BASE IMP.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "N$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'IMPUESTO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "O$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "P$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'ESTADO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "Q$fila");

$sqlDetalle = mysql_query("SELECT 
DATE_FORMAT(v.fecha, '%d-%m-%Y') AS fecha,
CASE
  WHEN v.tipo = 's03' 
  THEN '1' 
  WHEN v.tipo = 's02' 
  THEN '3' 
  WHEN v.tipo = 'e05' 
  THEN '7' 
  ELSE '8' 
END AS tipo_doc,
CONCAT(
  LEFT(v.documento, 4),
  '-',
  RIGHT(v.documento, 8)
) AS doc,
c.documento,
n.tipo_doc AS tipo_origen,
n.doc_origen AS documento_origen,
DATE(n.fecha_origen) AS fecha_origen,
c.nombre,
CASE
  WHEN v.tipo_moneda = '1' 
  THEN 0 
  ELSE v.neto 
END AS vtausd,
v.tipo_cambio,
CASE
  WHEN v.tipo_moneda = '1' 
  THEN ROUND(v.neto, 2) 
  ELSE ROUND(v.neto * v.tipo_cambio, 2) 
END AS neto,
v.dscto,
CASE
  WHEN v.tipo_moneda = '1' 
  THEN ROUND(v.neto - v.dscto, 2) 
  ELSE ROUND((v.neto - v.dscto) * v.tipo_cambio, 2) 
END AS subtotal,
CASE
  WHEN v.tipo_moneda = '1' 
  THEN ROUND(ROUND((v.neto - v.dscto) * 0.18, 2), 2) 
  ELSE ROUND(
    (v.neto - v.dscto) * 0.18 * v.tipo_cambio,
    2
  ) 
END AS igv,
CASE
  WHEN v.tipo_moneda = '1' 
  THEN ROUND(v.total, 2) 
  ELSE ROUND(
    ROUND((v.neto - v.dscto) * v.tipo_cambio, 2) + ROUND(
      (v.neto - v.dscto) * 0.18 * v.tipo_cambio,
      2
    ),
    2
  ) 
END AS total,
v.estado 
FROM
ventajf v 
LEFT JOIN clientesjf c 
  ON v.cliente = c.codigo 
LEFT JOIN notascd_jf n 
  ON v.tipo = n.tipo 
  AND v.documento = n.documento 
WHERE MONTH(v.fecha) = $mes
AND YEAR(v.fecha) = YEAR(NOW()) 
AND v.tipo NOT IN ('S70', 'S01') 
ORDER BY tipo_doc DESC,
v.fecha,
v.documento") or die(mysql_error());

$vtausd = 0;
$neto = 0;
$dscto = 0;
$base = 0;
$igv = 0;
$total = 0;

while($respDetalle = mysql_fetch_array($sqlDetalle)){

  $fila+=1;
  
  $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $respDetalle["fecha"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $respDetalle["tipo_doc"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $respDetalle["doc"]);

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $respDetalle["tipo_origen"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $respDetalle["documento_origen"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $respDetalle["fecha_origen"]);
  //$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $respDetalle["documento"]);
  $objPHPExcel->getActiveSheet()->setCellValueExplicit("G$fila", utf8_encode($respDetalle["documento"]), PHPExcel_Cell_DataType::TYPE_STRING); 
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["nombre"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $respDetalle["vtausd"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $respDetalle["tipo_cambio"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $respDetalle["neto"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $respDetalle["dscto"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", "0");
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $respDetalle["subtotal"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $respDetalle["igv"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $respDetalle["total"]);   

  if($respDetalle["estado"] == "GENERADO"){

    $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $respDetalle["estado"]);  
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "Q$fila");

  }else if($respDetalle["estado"] == "ANULADO"){

    $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $respDetalle["estado"]);  
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "Q$fila");

  }else{

    $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $respDetalle["estado"]);  
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_5, "Q$fila");

  }
    $vtausd += $respDetalle["vtausd"];
    $neto += $respDetalle["neto"];
    $dscto += $respDetalle["dscto"];
    $base += $respDetalle["subtotal"];
    $igv += $respDetalle["igv"];
    $total += $respDetalle["total"];
}


$fila+=1;    
$fila+=1;     

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $vtausd);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "0");
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $neto);
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $dscto);
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", "0");
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $base);
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $igv);
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $total);   


# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(45.55);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(13.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);

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