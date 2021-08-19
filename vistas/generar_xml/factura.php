<?php 
require_once ("../../controladores/facturacion.controlador.php");
require_once ("../../modelos/facturacion.modelo.php");
require_once("../../extensiones/cantidad_en_letras.php");
require_once('signature.php'); // permite firmar xml

$tipo = $_GET["tipo"];

$documento = $_GET["documento"];
$venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);

$modelos = ControladorFacturacion::ctrMostrarModeloImpresion($documento,$tipo);
// var_dump($modelos);
$emisor = 	array(
			'tipodoc'		=> '6',
			'ruc' 			=> '20513613939', 
            'nombre_comercial'=> 'JACKY FORM',
			'razon_social'	=> 'Corporacion Vasco S.A.C.', 
			'referencia'	=> 'URB.SANTA LUISA 1RA ETAPA', 
			'direccion'		=> 'CAL.SANTO TORIBIO NRO. 259',
			'pais'			=> 'PE', 
			'departamento'  => 'LIMA',
			'provincia'		=> 'LIMA',
			'distrito'		=> 'SAN MARTIN DE PORRES'
			);


$cliente = array(
			'tipodoc'		=> '6',//6->ruc, 1-> dni 
			'ruc'			=> $venta["dni"], 
			'razon_social'  => $venta["nombre"], 
			'cliente'       => $venta["cliente"],
			'direccion'		=> $venta["direccion"],
			'pais'			=> 'PE'
			);	

$vendedor = array(
			"codigo"		=> $venta["vendedor"],
			"nombre"		=> $venta["nom_vendedor"]
			);

$comprobante =	array(
			'tipodoc'		=> '01', //01->FACTURA, 03->BOLETA, 07->NC, 08->ND
			'serie'			=> substr($venta["documento"],0,4),
			'correlativo'	=> substr($venta["documento"],4,12),
			'fecha_emision' => $venta["fecha"],
			'moneda'		=> 'PEN', //PEN->SOLES; USD->DOLARES
			'total_opgravadas'=> 0, //OP. GRAVADAS
			'total_opexoneradas'=>0,
			'total_opinafectas'=>0,
			'igv'			=> 0,
			'total'			=> 0,
			'total_texto'	=> ''
		);



$op_gravadas = 0;
$op_inafectas = 0;
$op_exoneradas = 0;

$comprobante['total_opgravadas'] = $venta["neto"];
$comprobante['total_opexoneradas'] = $op_exoneradas;
$comprobante['total_opinafectas'] = $op_inafectas;
$comprobante['igv'] = $venta["igv"];
$comprobante['total'] = $venta["total"];
$comprobante['total_texto'] = CantidadEnLetra($venta["total"]);

//CREAR XML INICIO
require_once("xml.php");

$xml = new GeneradorXML();

//RUC DEL EMISOR - TIPO DE COMPROBANTE - SERIE DEL DOCUMENTO - CORRELATIVO
//01-> FACTURA, 03-> BOLETA, 07-> NOTA DE CREDITO, 08-> NOTA DE DEBITO, 09->GUIA DE REMISION
$nombrexml = $emisor['ruc'].'-'.$comprobante['tipodoc'].'-'.$comprobante['serie'].'-'.$comprobante['correlativo'];

$ruta = "archivos_xml/".$nombrexml;
$xml->CrearXMLFactura($ruta, $emisor, $cliente,$vendedor, $comprobante, $modelos);

echo 'XML CREADO';
//CREAR XML FIN

$objfirma = new Signature();
$flg_firma = 1; //Posicion del XML: 0 para firma
// $ruta_xml_firmar = $ruta . '.XML'; //es el archivo XML que se va a firmar
$ruta = $ruta . '.XML';
$rutacertificado = "";

$ruta_firma = $rutacertificado. 'certificado_prueba.pfx'; //ruta del archivo del certicado para firmar
$pass_firma = 'ceti';

$resp = $objfirma->signature_xml($flg_firma, $ruta, $ruta_firma, $pass_firma);

echo '</br> XML FIRMADO';




?>