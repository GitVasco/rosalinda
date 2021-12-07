<?php

require_once "../../../controladores/facturacion.controlador.php";
require_once "../../../modelos/facturacion.modelo.php";


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');
$fecha=new Datetime();
$fechaActual=$fecha->format("d / m / Y");
$fechaCabecera= "Fecha:".$fechaActual;



class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Set font
        $fecha=new Datetime();
        $fechaActual=$fecha->format("d/m/Y");
        $fechaCabecera= "Fecha: ".$fechaActual;
        $impuesto = $_GET["impuesto"];
        $inicio =$_GET["inicio"];
        $fin = $_GET["fin"];
        if($impuesto == '0'){
            $igv= 'NO';
        }else{
            $igv = 'SI';
        }
       
        if($inicio != 'todos'){
             //damos formato a la fecha de inicio
            $date=date_create($inicio);
            $inicio2= date_format($date,"d/m/Y");
            $fechaInicial = ' desde '.$inicio2. ' - ';
        }else{
            $fechaInicial = "";
        }

        if($fin != 'todos'){
            //damos formato a la fecha final
            $date2=date_create($fin);
            $fin2= date_format($date2,"d/m/Y");
            $fechaFinal = ' hasta '.$fin2;
        }else{
            $fechaFinal =  "";
        }


        $this->SetFont('helvetica', 'B', 9);
        // Title
        $this->Cell(0, 8, 'CORPORACIÓN VASCO S.A.C.', 0, false, 'L', 0, '', 0, false, false, false );
        $this->Cell(9, 8, $fechaCabecera, 0, false, 'R', 0, '', 0, false, false, false );
        
        $this->Ln(4);
        $this->Cell(177, 8, 'IGV:    '.$igv, 0, false, 'R', 0, '', 0, false, false, false );
        $this->Ln(2);
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 15, 'VENTAS POR VENDEDOR '.$fechaInicial.$fechaFinal, 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(10); 
        $this->SetFont('helvetica', '', 8);
        $this->Cell(0, 5, '        Tipo                                  Nro. doc.                Fecha                                                                          Cliente                                               Total S/.                        ', 0, '1', 'L', 0, '', 0, false, false, false );
        
        $this->Cell(400, 0, '==================================================================================================================', 0, false, 'L', 0, '', 0, false, 'M', 'M' );

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('Helvetica', '', 8);
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
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

$optipo= $_GET["optipo"];
$opdocumento= $_GET["opdocumento"];
$impuesto= $_GET["impuesto"];
$vend= $_GET["vend"];
$inicio= $_GET["inicio"];
$fin= $_GET["fin"];



$pdf->SetFont('Helvetica', '', 8);

if($opdocumento == 'todos'){

    $ventas=ControladorFacturacion::ctrMostrarVentaResumen($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin);

}else{

    $ventas = ControladorFacturacion::ctrMostrarTipoVentaResumen($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin);

}

    
$suma=0;
foreach ($ventas as $key => $value) {
    $suma += $value["total"];
$bloque3 = <<<EOF

<table style="border-bottom:1px solid black;padding:10px 0px" >
    <tbody>
        <tr>
         <td style="width:60px"><strong>Vendedor  :</strong></td>
         <td style="width:60px"><strong>$value[vendedor]</strong></td>
         <td style="width:330px"><strong>$value[descripcion]</strong></td>
         <td style="width:80px;text-align:right">$value[total]</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
}

$bloque4 = <<<EOF
<table style="border-top:1px solid #000;width:500px" >
</table>
<table style="padding-top:20px;text-align:right">
    <tbody>
        <tr >
        
         <td  style="width:455px" ><b>Total General:</b></td>   
         <td  style="width:80px;text-align:right ">$suma</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');
// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('reporte_resumen_venta.pdf');


