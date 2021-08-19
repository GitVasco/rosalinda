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

$fecha = date("d-m-Y");

$inicio=$_GET["inicio"];
$fin=$_GET["fin"];
$quincena=$_GET["quincena"];
$id=$_GET["id"];
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
$objPHPExcel->getActiveSheet()->setTitle("EFICIENCIA -".$fecha);

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
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'EFICIENCIA');
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto3, "D$fila:E$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'fecha:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $fecha);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "G$fila");



if($quincena == 1){

  
$fila = 7;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'COD. TRA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'TRABAJADOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '28');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '29');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '30');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '31');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '1');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '2');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '3');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '4');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '5');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '6');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", '7');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '8');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "O$fila");
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", '9');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "P$fila");
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", '10');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "Q$fila");
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '11');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "R$fila");
$objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '12');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "S$fila");
$objPHPExcel->getActiveSheet()->getStyle("S$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", '13');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "T$fila");
$objPHPExcel->getActiveSheet()->getStyle("T$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", '14');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "U$fila");
$objPHPExcel->getActiveSheet()->getStyle("U$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", '15');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "V$fila");
$objPHPExcel->getActiveSheet()->getStyle("V$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", '16');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "W$fila");
$objPHPExcel->getActiveSheet()->getStyle("W$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  #query para sacar los datos deL detalle
  $sqlDetalle = mysql_query("SELECT 
  et.trabajador,
  CONCAT(t.nom_tra,' ', t.ape_pat_tra) AS nom_tra,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '1' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d1,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '2' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d2,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '3' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d3,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '4' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d4,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '5' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d5,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '6' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d6,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '7' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d7,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '8' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d8,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '9' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d9,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '10' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d10,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '11' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d11,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '12' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d12,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '13' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d13,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '14' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d14,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '15' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d15,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '16' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d16,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '28' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d28,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '29' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d29,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '30' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d30,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '31' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d31 
FROM
  entallerjf et 
  LEFT JOIN 
    (SELECT DISTINCT 
      et.trabajador,
      DATE(a.fecha) AS fecha,
      a.minutos 
    FROM
      asistenciasjf a 
      LEFT JOIN entallerjf et 
        ON a.id_trabajador = et.trabajador 
        AND DATE(a.fecha) = DATE(et.fecha_terminado) 
    WHERE et.trabajador IS NOT NULL) AS asi 
    ON et.trabajador = asi.trabajador 
    AND DATE(fecha_terminado) = asi.fecha 
  LEFT JOIN trabajadorjf t 
    ON et.trabajador = t.cod_tra,
  (SELECT 
    inicio,
    fin 
  FROM
    quincenasjf q 
  WHERE q.id = ".$id.") AS q 
WHERE DATE(et.fecha_terminado) BETWEEN '".$inicio."'
  AND '".$fin."'
GROUP BY et.trabajador") or die(mysql_error());

$cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
    
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["trabajador"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["nom_tra"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["d28"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["d29"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["d30"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["d31"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["d1"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["d2"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["d3"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($respDetalle["d4"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($respDetalle["d5"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($respDetalle["d6"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($respDetalle["d7"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($respDetalle["d8"]));
                
    $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($respDetalle["d9"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($respDetalle["d10"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($respDetalle["d11"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($respDetalle["d12"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", utf8_encode($respDetalle["d13"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", utf8_encode($respDetalle["d14"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", utf8_encode($respDetalle["d15"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", utf8_encode($respDetalle["d16"]));



    
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

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "U$fila");
    $objPHPExcel->getActiveSheet()->getStyle("U$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "V$fila");
    $objPHPExcel->getActiveSheet()->getStyle("V$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "W$fila");
    $objPHPExcel->getActiveSheet()->getStyle("W$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


}

}else{
  
$fila = 7;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'N°');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'COD. TRA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'TRABAJADOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '13');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '14');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '15');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '16');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '17');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '18');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '19');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '20');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '21');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '22');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", '23');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '24');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "O$fila");
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", '25');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "P$fila");
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", '26');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "Q$fila");
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '27');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "R$fila");
$objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '28');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "S$fila");
$objPHPExcel->getActiveSheet()->getStyle("S$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", '29');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "T$fila");
$objPHPExcel->getActiveSheet()->getStyle("T$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", '30');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "U$fila");
$objPHPExcel->getActiveSheet()->getStyle("U$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", '31');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "V$fila");
$objPHPExcel->getActiveSheet()->getStyle("V$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", '1');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "W$fila");
$objPHPExcel->getActiveSheet()->getStyle("W$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $sqlDetalle = mysql_query("SELECT 
  et.trabajador,
  CONCAT(t.nom_tra,' ', t.ape_pat_tra) AS nom_tra,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '1' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d1,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '13' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d13,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '14' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d14,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '15' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d15,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '16' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d16,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '17' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d17,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '18' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d18,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '19' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d19,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '20' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d20,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '21' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d21,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '22' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d22,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '23' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d23,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '24' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d24,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '25' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d25,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '26' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d26,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '27' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d27,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '28' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d28,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '29' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d29,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '30' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d30,
  SUM(
    CASE
      WHEN DAY(fecha_terminado) = '31' 
      THEN et.total_tiempo / asi.minutos * 100 
      ELSE 0 
    END
  ) AS d31 
FROM
  entallerjf et 
  LEFT JOIN 
    (SELECT DISTINCT 
      et.trabajador,
      DATE(a.fecha) AS fecha,
      a.minutos 
    FROM
      asistenciasjf a 
      LEFT JOIN entallerjf et 
        ON a.id_trabajador = et.trabajador 
        AND DATE(a.fecha) = DATE(et.fecha_terminado) 
    WHERE et.trabajador IS NOT NULL) AS asi 
    ON et.trabajador = asi.trabajador 
    AND DATE(fecha_terminado) = asi.fecha 
  LEFT JOIN trabajadorjf t 
    ON et.trabajador = t.cod_tra,
  (SELECT 
    inicio,
    fin 
  FROM
    quincenasjf q 
  WHERE q.id = ".$id.") AS q 
WHERE DATE(et.fecha_terminado) BETWEEN '".$inicio."' 
  AND '".$fin."' 
GROUP BY et.trabajador") or die(mysql_error());

$cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
    
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["trabajador"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["nom_tra"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["d13"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["d14"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["d15"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["d16"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["d17"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["d18"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["d19"]));
                
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($respDetalle["d20"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($respDetalle["d21"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($respDetalle["d22"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($respDetalle["d23"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($respDetalle["d24"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($respDetalle["d25"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($respDetalle["d26"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($respDetalle["d27"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($respDetalle["d28"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", utf8_encode($respDetalle["d29"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", utf8_encode($respDetalle["d30"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", utf8_encode($respDetalle["d31"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", utf8_encode($respDetalle["d1"]));

    
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

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "U$fila");
    $objPHPExcel->getActiveSheet()->getStyle("U$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "V$fila");
    $objPHPExcel->getActiveSheet()->getStyle("V$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "W$fila");
    $objPHPExcel->getActiveSheet()->getStyle("W$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  }
}






# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(12.29);
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
header('Content-Disposition: attachment; filename=" EFICIENCIA - '.$fecha.'.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');