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
        $this->Cell(0, 15, 'DOCUMENTOS POR COBRAR - '.$fechaActual, 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(7);
        $this->Cell(0, 9, 'Tipo             Nro. doc.            Fecha        Vencimien  Vend.       Doc. Original               Estado          Banco            Nro. Unico           Total S/       Prot.  ', 0, 1, 'C', 0, '', 0, false, false, false );
        
        $this->Cell(0, 0, '=================================================================================================================================', 0, 1, 'L', 0, '', 0, false, 'M', 'M' );

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
$tip_doc= $_GET["tip_doc"];
$cli= $_GET["cli"];
$vend='';
$banco= $_GET["banco"];
$inicio= $_GET["inicio"];
$fin= $_GET["fin"];

// convert TTF font to TCPDF format and store it on the fonts folder
$fontname = TCPDF_FONTS::addTTFfont('../../lucida-console.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, '', 7, '', false);
//---------------------------------------------------------


$pdf->SetFont($fontname, '', 6, '', false);



if($consulta== 'pendiente'){
    if(empty($cli)){
        
$cuentas=ControladorCuentas::ctrMostrarReporteCobrar($orden1,$orden2,$tip_doc,'todo',$vend,$banco);

foreach ($cuentas as $key => $value) {
if($value["fecha"] == '0000-00-00'){
$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:38px">Cliente: </td>
        <td style="width:38px">$value[cliente]</td>
        <td style="width:130px">$value[tipo_doc]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    
}else if($value["fecha"] == '9999-12-31'){
$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:417px;text-align:right">Total Cliente: </td>
        <td style="width:51px;text-align:right">$value[saldo]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
        
    }else{   

$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:38px">$value[tipo_doc]</td>
        <td style="width:65px">$value[num_cta]</td>
        <td style="width:42px">$value[fecha]</td>
        <td style="width:45px">$value[fecha_ven]</td>
        <td style="width:25px">$value[vendedor]</td>
        <td style="width:50px">$value[doc_origen]</td>
        <td style="width:48px">$value[estado]</td>
        <td style="width:40px">$value[banco]</td>
        <td style="width:60px">$value[num_unico]</td>
        <td style="width:55px;text-align:right">$value[saldo]</td>
        <td style="width:35px">$value[protesta]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    }
    }

        
    }else{
        $cuentas=ControladorCuentas::ctrMostrarReporteCobrar($orden1,$orden2,$tip_doc,$cli,$vend,$banco);
        $cliente=ControladorCuentas::ctrMostrarReporteNombre($cli,$vend);


        $bloque1 = <<<EOF

<table  style="text-align:right">
    <tbody>
        <tr>
         <td style="width:136px;">Cliente:</td>
         <td style="width:38px">$cliente[cliente]</td>
         <td style="width:145px">$cliente[nombre]</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');
foreach ($cuentas as $key => $value) {

$bloque3 = <<<EOF

<table  style="text-align:center">
    <tbody>
        <tr>
         <td style="width:38px">$value[tipo_doc]</td>
         <td style="width:65px">$value[num_cta]</td>
         <td style="width:42px">$value[fecha]</td>
         <td style="width:45px">$value[fecha_ven]</td>
         <td style="width:25px">$value[vendedor]</td>
         <td style="width:50px">$value[doc_origen]</td>
         <td style="width:48px">$value[estado]</td>
         <td style="width:40px">$value[banco]</td>
         <td style="width:70px">$value[num_unico]</td>
         <td style="width:55px">$value[saldo]</td>
         <td style="width:35px">$value[protesta]</td>
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
        
         <td  style="width:397px;" ><b>Total General:</b></td>   
         <td  style="width:70px; ">$cliente[saldo_total]</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');

    }
   
}else if($consulta== 'pendienteVencidoMenor'){
    if(empty($cli)){
        
$cuentas=ControladorCuentas::ctrMostrarReporteVencidos($orden1,$orden2,$tip_doc,'todo',$vend,$banco);

foreach ($cuentas as $key => $value) {
if($value["fecha"] == '0000-00-00'){
$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:38px">Cliente: </td>
        <td style="width:38px">$value[cliente]</td>
        <td style="width:130px">$value[tipo_doc]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    
}else if($value["fecha"] == '9999-12-31'){
$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:417px;text-align:right">Total Cliente: </td>
        <td style="width:51px;text-align:right">$value[saldo]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
        
    }else{   

$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:38px">$value[tipo_doc]</td>
        <td style="width:65px">$value[num_cta]</td>
        <td style="width:42px">$value[fecha]</td>
        <td style="width:45px">$value[fecha_ven]</td>
        <td style="width:25px">$value[vendedor]</td>
        <td style="width:50px">$value[doc_origen]</td>
        <td style="width:48px">$value[estado]</td>
        <td style="width:40px">$value[banco]</td>
        <td style="width:60px">$value[num_unico]</td>
        <td style="width:55px;text-align:right">$value[saldo]</td>
        <td style="width:35px">$value[protesta]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    }
    }

        
    }else{
        $cuentas=ControladorCuentas::ctrMostrarReporteVencidos($orden1,$orden2,$tip_doc,$cli,$vend,$banco);
        $cliente=ControladorCuentas::ctrMostrarReporteNombreVencidos($cli,$vend);


        $bloque1 = <<<EOF

<table  style="text-align:right">
    <tbody>
        <tr>
         <td style="width:136px;">Cliente:</td>
         <td style="width:35px">$cliente[cliente]</td>
         <td style="width:145px">$cliente[nombre]</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');
foreach ($cuentas as $key => $value) {

$bloque3 = <<<EOF

<table  style="text-align:center">
    <tbody>
        <tr>
         <td style="width:38px">$value[tipo_doc]</td>
         <td style="width:65px">$value[num_cta]</td>
         <td style="width:42px">$value[fecha]</td>
         <td style="width:45px">$value[fecha_ven]</td>
         <td style="width:25px">$value[vendedor]</td>
         <td style="width:50px">$value[doc_origen]</td>
         <td style="width:48px">$value[estado]</td>
         <td style="width:40px">$value[banco]</td>
         <td style="width:70px">$value[num_unico]</td>
         <td style="width:55px">$value[saldo]</td>
         <td style="width:35px">$value[protesta]</td>
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
        
         <td  style="width:397px;" ><b>Total General:</b></td>   
         <td  style="width:70px; ">$cliente[saldo_total]</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');

    }
}else if($consulta== 'pendienteVencidoMayor'){
    if(empty($cli)){
        
$cuentas=ControladorCuentas::ctrMostrarReporteNoVencidos($orden1,$orden2,$tip_doc,'todo',$vend,$banco);

foreach ($cuentas as $key => $value) {
if($value["fecha"] == '0000-00-00'){
$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:38px">Cliente: </td>
        <td style="width:38px">$value[cliente]</td>
        <td style="width:130px">$value[tipo_doc]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    
}else if($value["fecha"] == '9999-12-31'){
$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:417px;text-align:right">Total Cliente: </td>
        <td style="width:51px;text-align:right">$value[saldo]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
        
    }else{   

$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:38px">$value[tipo_doc]</td>
        <td style="width:65px">$value[num_cta]</td>
        <td style="width:42px">$value[fecha]</td>
        <td style="width:45px">$value[fecha_ven]</td>
        <td style="width:25px">$value[vendedor]</td>
        <td style="width:50px">$value[doc_origen]</td>
        <td style="width:48px">$value[estado]</td>
        <td style="width:40px">$value[banco]</td>
        <td style="width:60px">$value[num_unico]</td>
        <td style="width:55px;text-align:right">$value[saldo]</td>
        <td style="width:35px">$value[protesta]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    }
    }

        
    }else{
        $cuentas=ControladorCuentas::ctrMostrarReporteNoVencidos($orden1,$orden2,$tip_doc,$cli,$vend,$banco);
        $cliente=ControladorCuentas::ctrMostrarReporteNombreNoVencidos($cli,$vend);


        $bloque1 = <<<EOF

<table  style="text-align:right">
    <tbody>
        <tr>
         <td style="width:136px;">Cliente:</td>
         <td style="width:35px">$cliente[cliente]</td>
         <td style="width:145px">$cliente[nombre]</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');
foreach ($cuentas as $key => $value) {

$bloque3 = <<<EOF

<table  style="text-align:center">
    <tbody>
        <tr>
         <td style="width:38px">$value[tipo_doc]</td>
         <td style="width:65px">$value[num_cta]</td>
         <td style="width:42px">$value[fecha]</td>
         <td style="width:45px">$value[fecha_ven]</td>
         <td style="width:25px">$value[vendedor]</td>
         <td style="width:50px">$value[doc_origen]</td>
         <td style="width:48px">$value[estado]</td>
         <td style="width:40px">$value[banco]</td>
         <td style="width:70px">$value[num_unico]</td>
         <td style="width:55px">$value[saldo]</td>
         <td style="width:35px">$value[protesta]</td>
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
        
         <td  style="width:397px;" ><b>Total General:</b></td>   
         <td  style="width:70px; ">$cliente[saldo_total]</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');

    }
}else if($consulta== 'protestado'){
    if(empty($cli)){
        
$cuentas=ControladorCuentas::ctrMostrarReporteProtestados($orden1,$orden2,$tip_doc,'todo',$vend,$banco);

foreach ($cuentas as $key => $value) {
if($value["fecha"] == '0000-00-00'){
$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:38px">Cliente: </td>
        <td style="width:38px">$value[cliente]</td>
        <td style="width:130px">$value[tipo_doc]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    
}else if($value["fecha"] == '9999-12-31'){
$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:417px;text-align:right">Total Cliente: </td>
        <td style="width:51px;text-align:right">$value[saldo]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
        
    }else{   

$bloque3 = <<<EOF

<table  style="text-align:center">
<tbody>
    <tr>
        <td style="width:38px">$value[tipo_doc]</td>
        <td style="width:65px">$value[num_cta]</td>
        <td style="width:42px">$value[fecha]</td>
        <td style="width:45px">$value[fecha_ven]</td>
        <td style="width:25px">$value[vendedor]</td>
        <td style="width:50px">$value[doc_origen]</td>
        <td style="width:48px">$value[estado]</td>
        <td style="width:40px">$value[banco]</td>
        <td style="width:60px">$value[num_unico]</td>
        <td style="width:55px;text-align:right">$value[saldo]</td>
        <td style="width:35px">$value[protesta]</td>
    </tr>
</tbody>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
    }
    }

        
    }else{
        $cuentas=ControladorCuentas::ctrMostrarReporteProtestados($orden1,$orden2,$tip_doc,$cli,$vend,$banco);
        $cliente=ControladorCuentas::ctrMostrarReporteProtestados($cli,$vend);


        $bloque1 = <<<EOF

<table  style="text-align:right">
    <tbody>
        <tr>
         <td style="width:136px;">Cliente:</td>
         <td style="width:35px">$cliente[cliente]</td>
         <td style="width:145px">$cliente[nombre]</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');
foreach ($cuentas as $key => $value) {

$bloque3 = <<<EOF

<table  style="text-align:center">
    <tbody>
        <tr>
         <td style="width:38px">$value[tipo_doc]</td>
         <td style="width:65px">$value[num_cta]</td>
         <td style="width:42px">$value[fecha]</td>
         <td style="width:45px">$value[fecha_ven]</td>
         <td style="width:25px">$value[vendedor]</td>
         <td style="width:50px">$value[doc_origen]</td>
         <td style="width:48px">$value[estado]</td>
         <td style="width:40px">$value[banco]</td>
         <td style="width:70px">$value[num_unico]</td>
         <td style="width:55px">$value[saldo]</td>
         <td style="width:35px">$value[protesta]</td>
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
        
         <td  style="width:397px;" ><b>Total General:</b></td>   
         <td  style="width:70px; ">$cliente[saldo_total]</td>
        </tr>
    </tbody>
</table>
EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');

    }
}else if($consulta== 'estadoEnvioVacio'){
    
}else if($consulta== 'unicoCartera'){
    
}else if($consulta== 'cancelado'){
    
}else if($consulta== 'fechaSaldo'){
    
}else if($consulta== 'pagos'){
    
}else if($consulta== 'fechaActualSaldo'){
    
}




// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('reporte_cuenta.pdf');


