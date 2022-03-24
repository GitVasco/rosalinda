<?php

require_once "../../../controladores/cuentas.controlador.php";
require_once "../../../modelos/cuentas.modelo.php";

require_once "../../../controladores/vendedor.controlador.php";
require_once "../../../modelos/vendedor.modelo.php";


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
        $this->SetFont('helvetica', 'B', 8);
        // Title
        $this->Cell(0, 8, 'CORPORACIÓN VASCO S.A.C.', 0, false, 'L', 0, '', 0, false, false, false );
        $this->Cell(0, 8, $fechaCabecera, 0, false, 'R', 0, '', 0, false, false, false );
        
        $this->Ln(2);
        $this->Cell(0, 15, 'DOCUMENTOS POR COBRAR - '.$fechaActual, 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(7);
        $this->Cell(0, 9, 'T.     Nro. doc.          F. Emi            F. Ven           Saldo                   Cod.              Cliente                                                 Saldo             Zona                        Prot.  ', 0, 1, 'C', 0, '', 0, false, false, false );
        
        $this->Cell(0, 0, '========================================================================================================================', 0, 1, 'L', 0, '', 0, false, 'M', 'M' );

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
$pdf->SetMargins(5, PDF_MARGIN_TOP, 5);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->AddPage('P','A4');
$pdf->setPage(1, true);


//parametros GET
$vendedor= $_GET["vendedor"];

$cuentas = ControladorCuentas::ctrEstadoCtaVdorVdos($vendedor);
$vendedor = ControladorVendedores::ctrMostrarVendedores("codigo", $vendedor);
#var_dump($cuentas);

// convert TTF font to TCPDF format and store it on the fonts folder
$fontname = TCPDF_FONTS::addTTFfont('../../lucida-console.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, '', 7, '', false);
//---------------------------------------------------------


$pdf->SetFont($fontname, '', 10, '', false);

$bloque1 = '<table style="text-center" >
                <tbody>
                    <tr>
                        <td style="width:26px"></td>
                        <td style="width:60px">Cod: '.$_GET["vendedor"].'</td>
                        <td style="width:242px"><strong>'.$vendedor["descripcion"].'</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="width:27px"></td>
                        <td style="width:50px"></td>
                        <td style="width:35px"></td>
                    </tr>

                    <tr>
                        <td style="width:26px"></td>
                        <td style="width:60px"></td>
                        <td style="width:242px"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="width:27px"></td>
                        <td style="width:50px"></td>
                        <td style="width:35px"></td>
                    </tr>
                                        
                </tbody>
            </table>';

$pdf->writeHTML($bloque1, false, false, false, false, '');   

$pdf->SetFont($fontname, '', 7, '', false);

foreach ($cuentas as $key => $value){

    if($value["tipo_doc"] == "ZZ"){

        $pdf->SetFont($fontname, '', 8, '', false);
        $nombre = substr($value["nombre"],0,30);

        $nom_ubigeo = substr($value["nom_ubigeo"],0,15);

        $bloque3 = '<table style="text-center" >
        <tbody>

            <tr>
                <td style="width:15px"></td>
                <td style="width:60px"></td>
                <td style="width:50px"></td>
                <td style="width:50px"></td>
                <td style="width:60px"></td>
                <td style="width:50px"></td>
                <td style="width:140px"></td>
                <td style="width:55px;text-align:right"></td>
                <td style="width:70px"></td>
                <td style="width:35px"></td>
            </tr>
    
    
            <tr>
                <td style="width:15px"></td>
                <td style="width:60px"></td>
                <td style="width:50px"></td>
                <td style="width:50px"></td>
                <td style="width:60px"></td>
                <td style="width:50px"></td>
                <td style="width:140px"><b>Total Vencidos S/</b></td>
                <td style="width:55px;text-align:right">'.number_format($value["saldo"],2).'</td>
                <td style="width:70px"></td>
                <td style="width:35px"></td>
            </tr>
        </tbody>
    </table>';


        
    }else {
        
        $nombre = substr($value["nombre"],0,30);

        $nom_ubigeo = substr($value["nom_ubigeo"],0,15);

        $bloque3 = '<table style="text-center" >
        <tbody>
            <tr>
                <td style="width:15px">'.$value["tipo_doc"].'</td>
                <td style="width:60px">'.$value["num_cta"].'</td>
                <td style="width:50px">'.$value["fecha"].'</td>
                <td style="width:50px">'.$value["fecha_ven"].'</td>
                <td style="width:60px">'.$value["doc_origen"].'</td>
                <td style="width:55px">'.$value["cliente"].'</td>
                <td style="width:140px">'.$nombre.'</td>
                <td style="width:50px;text-align:right">'.number_format($value["saldo"],2).'</td>
                <td style="width:70px">'.$nom_ubigeo.'</td>
                <td style="width:35px">'.$value["protesta"].'</td>
            </tr>
        </tbody>
    </table>';        


    }





$pdf->writeHTML($bloque3, false, false, false, false, '');





}

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('reporte_cuenta.pdf');

?>