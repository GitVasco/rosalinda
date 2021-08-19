<?php

require_once "../../../controladores/cuentas.controlador.php";
require_once "../../../modelos/cuentas.modelo.php";


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
        $fechaCabecera= "Fecha:".$fechaActual;
        $this->SetFont('helvetica', 'B', 7);
        // Title
        $this->Cell(0, 8, 'CORPORACIÓN VASCO S.A.C.', 0, false, 'L', 0, '', 0, false, false, false );
        $this->Cell(0, 8, $fechaCabecera, 0, false, 'R', 0, '', 0, false, false, false );
        
        $this->Ln(2);
        $this->Cell(0, 15, 'PAGOS EFECTUADOS  - '.$fechaActual, 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(7);
        $this->Cell(0, 9, '              Tipo             Nro. doc.            Fecha            Cliente              Razon social / Nombre cliente           Tipo            Nro.doc                Fact. S/                   Letra S/     ', 0, 1, 'C', 0, '', 0, false, false, false );
        
        $this->Cell(0, 0, '====================================================================================================================================', 0, 1, 'L', 0, '', 0, false, 'M', 'M' );

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


//parametros GET
$consulta= $_GET["consulta"];
$orden1= $_GET["orden1"];
$orden2= $_GET["orden2"];
$inicio= $_GET["inicio"];
$fin= $_GET["fin"];
$canc= $_GET["canc"];
$vend= $_GET["vend"];

// convert TTF font to TCPDF format and store it on the fonts folder
$fontname = TCPDF_FONTS::addTTFfont('../../lucida-console.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, '', 7, '', false);
//---------------------------------------------------------


$pdf->SetFont($fontname, '', 6, '', false);


     
$cuentas=ControladorCuentas::ctrMostrarReportePagos($orden1,$orden2,$canc,$vend,$inicio,$fin);

$total = ControladorCuentas::ctrMostrarReporteTotalPagos($orden1,$orden2,$canc,$vend,$inicio,$fin);


foreach ($cuentas as $key => $value) {
$tamCliente=strlen($value["nombre"]);
if($tamCliente > 31){
    $nomCliente=substr($value["nombre"],0,31);
}else{
    $nomCliente=$value["nombre"];
}

if($value["tipo_doc"] == '-1'){
$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:80px">$value[num_cta]</td>
        <td style="width:130px">$value[fecha]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    
}else if($value["tipo_doc"] == '999'){
    if($orden1 == 'fecha_ven'){
$bloque3 = <<<EOF
<table style="border-top:1px solid #000;width:500px" >
</table>
<table  style="text-align:center;padding-top:5px;padding-bottom:5px">
<tbody>
    <tr>
        <td style="width:403px;text-align:right">Total fecha de pago: </td>
        <td style="width:51px;text-align:right">$value[fact]</td>
        <td style="width:59px;text-align:right">$value[letra]</td>
    </tr>
</tbody>
</table>
EOF;
    }else{
$bloque3 = <<<EOF
<table style="border-top:1px solid #000;width:500px" >
</table>
<table  style="text-align:center;padding-top:5px;padding-bottom:5px">
<tbody>
    <tr>
        <td style="width:403px;text-align:right">Total Tip doc: </td>
        <td style="width:51px;text-align:right">$value[fact]</td>
        <td style="width:59px;text-align:right">$value[letra]</td>
    </tr>
</tbody>
</table>
EOF;
    }

$pdf->writeHTML($bloque3, false, false, false, false, '');
        
}else{   

$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:38px">$value[tipo_doc]</td>
        <td style="width:60px">$value[num_cta]</td>
        <td style="width:42px">$value[fecha]</td>
        <td style="width:45px">$value[cliente]</td>
        <td style="width:130px">$nomCliente</td>
        <td style="width:38px">$value[cod_pago]</td>
        <td style="width:50px">$value[doc_origen]</td>
        <td style="width:50px;text-align:right">$value[fact]</td>
        <td style="width:60px;text-align:right">$value[letra]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    }
}

$bloque4 = <<<EOF
<table style="border-top:1px solid #000;width:500px" >
</table>
<table style="padding-top:20px;text-align:right">
    <tbody>
        <tr >
        
         <td  style="width:394px;" ><b>$total[total_gral]</b></td>   
         <td  style="width:60px; ">$total[fact]</td>
         <td  style="width:60px; ">$total[letra]</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');
// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('reporte_cuenta.pdf');


