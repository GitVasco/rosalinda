<?php

require_once "../../../controladores/facturacion.controlador.php";
require_once "../../../modelos/facturacion.modelo.php";

require_once "../../cantidad_en_letras.php";


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');
$fecha=new Datetime();
$fechaActual=$fecha->format("d / m / Y");
$fechaCabecera= "Fecha:".$fechaActual;

//parametros GET
$tipo = $_GET["tipo"];
$documento = $_GET["documento"];
$venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);
$modelo = ControladorFacturacion::ctrMostrarModeloProforma($documento,$tipo);
// var_dump($modelo);



class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Set font
        $fecha=new Datetime();
        $fechaActual=$fecha->format("d/m/Y");
        $fechaCabecera= "Fecha:".$fechaActual;
        $this->SetFont('helvetica', 'B', 9);
        $tipo = $_GET["tipo"];
        $documento = $_GET["documento"];
        $venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);


        $this->SetFont('helvetica', 'B', 9);
        
        $this->Cell(90, 10, 'Proforma:           '.$venta["documento"], 0, false, 'L', 0, '', 0, false, false, false );
        $this->SetFont('helvetica', 'A', 9);
        $this->Cell(100, 10, $fechaActual.'   Página 1', 0, false, 'L', 0, '', 0, false, false, false );
        $this->Ln(8);
        $this->Cell(40, 10, 'Cliente:          '.$venta["nombre"], 0, false, 'L', 0, '', 0, false, false, false );
        $this->Ln(8);
        $this->MultiCell(20, 5, 'Dirección:    ', 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(66, 5, $venta["direccion"], 0, 'L', 0, 0, '', '', true);
        $this->Ln(4);
        $this->Cell(40, 10, 'RUC:         '.$venta["dni"], 0, false, 'L', 0, '', 0, false, false, false );
        $this->Cell(90, 10, 'Forma de pago: '.$venta["descripcion"], 0, false, 'L', 0, '', 0, false, false, false );
        $this->Ln(4);
        $this->Cell(40, 10, '', 0, false, 'L', 0, '', 0, false, false, false );
        $this->Cell(90, 10, 'Vendedor:          '.$venta["vendedor"]."-".$venta["nom_vendedor"], 0, false, 'L', 0, '', 0, false, false, false );
        $this->Ln(0);
        $image_file = K_PATH_IMAGES.'borde7.png';
        $this->Image($image_file, 15, 37, 186, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Ln(0); 
        $this->Cell(35, 7, '.', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Cell(57, 7, '', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Cell(30, 7, '', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Cell(34, 7, 'Precio ', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Cell(40, 7, '', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(4);  
        $this->Cell(35, 7, 'Cod', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Cell(57, 7, 'Descripción', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Cell(30, 7, 'Cantidad', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Cell(34, 7, 'Unitario S/', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Cell(40, 7, 'Total S/', 0, false, 'C', 0, '', 0, false, false, false );


    }

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->AddPage('P','A4');
$pdf->setPage(1, true);
$pdf->SetFont('helvetica', 'A', 8);
$pdf->Ln(16);
foreach ($modelo as $key => $value) {
    $pdf->Ln(5);
    $pdf->Cell(35, 5, $value["modelo"], 0, false, 'C', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(47, 5, $value["nombre"], 0, false, 'L', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(30, 5, $value["cantidad"], 0, false, 'R', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(34, 5, $value["precio"], 0, false, 'R', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(37, 5, $value["total"], 0, false, 'R', 0, '', 0, false, 'T', 'M' );
    
}
    $image_file2 = K_PATH_IMAGES.'borde2.png';
    $pdf->Ln(5);
    $pdf->Cell(0,11, $pdf->Image($image_file2, $pdf->GetX(), $pdf->GetY(),185),0);
    $pdf->Ln(0);  
    $pdf->Cell(110, 7, '', 0, false, 'C', 0, '', 0, false, false, false );
    $pdf->Cell(44, 7, 'Total General S/', 0, false, 'R', 0, '', 0, false, false, false );
    $pdf->Cell(29, 7, $venta["total"], 0, false, 'R', 0, '', 0, false, false, false );
// convert TTF font to TCPDF format and store it on the fonts folder




// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('reporte_proforma.pdf');


