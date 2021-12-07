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
        $this->Cell(0, 5, '        Tipo                                  Nro. doc.                Fecha                                                                          Cliente                                   Total S/.                        ', 0, '1', 'L', 0, '', 0, false, false, false );
        
        $this->Cell(400, 0, '==================================================================================================================', 0, false, 'L', 0, '', 0, false, 'M', 'M' );
        $this->Ln(10); 
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

    $ventas=ControladorFacturacion::ctrMostrarVentaDetalle($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin);

}else{

    $ventas = ControladorFacturacion::ctrMostrarTipoVentaDetalle($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin);

}

    
$suma=0;
foreach ($ventas as $key => $value) {
    // $suma += $value["total"];
if($value["tipo"] == 'A00'){
$bloque3 = <<<EOF

<table  >
<tbody>
    <tr>
        <td style="width:50px"><b>Vendedor: </b></td>
        <td style="width:40px"><b>$value[vendedor]</b></td>
        <td style="width:180px"><b>$value[nombre]</b></td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    
}else if($value["tipo"] == 'S99'){
    
$bloque3 = <<<EOF
<table style="border-top:1px solid #000;width:500px" >
</table>
<table  style="text-align:center;padding-top:5px;padding-bottom:5px">
<tbody>
    <tr>
        
        <td style="width:443px;text-align:right">Total Serie</td>
        <td style="width:59px;text-align:right">$value[total]</td>
    </tr>
</tbody>
</table>
EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
        
}else{   
    if($value["documento"] == 'subtotal'){
    
$bloque3 = <<<EOF
<table style="border-top:1px solid #000;width:500px" >
</table>
<table  style="text-align:center;padding-top:5px;padding-bottom:5px">
<tbody>
    <tr>
        <td style="width:443px;text-align:right">Total Serie </td>
        <td style="width:59px;text-align:right">$value[total]</td>
    </tr>
</tbody>
</table>
EOF;
    }else{
$bloque3 = <<<EOF

<table  >
<tbody>
    <tr>
        <td style="width:42px">$value[tipo_documento]</td>
        <td style="width:85px">$value[documento]</td>
        <td style="width:58px">$value[fecha]</td>
        <td style="width:250px">$value[nombre]</td>
        <td style="width:60px;text-align:right">$value[total]</td>
    </tr>
</tbody>
</table>
EOF;
    }

$pdf->writeHTML($bloque3, false, false, false, false, '');
    }
}

//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('reporte_detalle_venta.pdf');


