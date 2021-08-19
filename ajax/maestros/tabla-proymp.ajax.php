<?php

require_once '../../controladores/materiaprima.controlador.php';
require_once '../../modelos/materiaprima.modelo.php';

class AjaxTablaProyMp{
	// Mostramos la tabla de Vtauctos
	public function mostrarTablaProyMp(){

		$materiaprima=ControladorMateriaPrima::ctrProyMp($_GET["proyMp"]);

		if(count($materiaprima)>0){

			$datosJson='{

				"data":[';

					for($i=0;$i<count($materiaprima);$i++){

                        /*=============================================
                        STOCK
                        =============================================*/ 

                        if($materiaprima[$i]["stock"] <= 0 ){

                            $stock = "<span style='font-size:85%' class='label label-danger'>".number_format($materiaprima[$i]["stock"],2)."</span>";

                        }else{

                            $stock = number_format($materiaprima[$i]["stock"],2);

                        }

                        /*=============================================
                        ORDEN DE COMPRA - PENDIENTE
                        =============================================*/ 

                        if($materiaprima[$i]["saldo_oc"] <= 0 ){

                            $saldo_oc = "<span style='font-size:85%' class='label label-danger'>".number_format($materiaprima[$i]["saldo_oc"],2)."</span>";

                        }else{

                            $saldo_oc = number_format($materiaprima[$i]["saldo_oc"],2);

                        }
                        
                        /*=============================================
                        ORDEN DE SERVICIO - PENDIENTE
                        =============================================*/ 

                        if($materiaprima[$i]["saldo_os"] <= 0 ){

                            $saldo_os = "<span style='font-size:85%' class='label label-danger'>".number_format($materiaprima[$i]["saldo_os"],2)."</span>";

                        }else{

                            $saldo_os = number_format($materiaprima[$i]["saldo_os"],2);

                        }
                        
                        /*=============================================
                        INGRESOS
                        =============================================*/ 

                        if($materiaprima[$i]["ingresos"] > 0 ){

                            $ingresos = "<span style='font-size:85%' class='label label-primary'>".number_format($materiaprima[$i]["ingresos"],2)."</span>";

                        }else{

                            $ingresos = number_format($materiaprima[$i]["ingresos"],2);

                        }
                        
                        /*=============================================
                        PROYECCION
                        =============================================*/ 

                        if($materiaprima[$i]["cons_total"] > 0 ){

                            $proyeccion = "<span style='font-size:85%' class='label label-success'>".number_format($materiaprima[$i]["cons_total"],2)."</span>";

                        }else{

                            $proyeccion = number_format($materiaprima[$i]["cons_total"],2);

                        }
                        
                        /*=============================================
                        Avance
                        =============================================*/ 

                        if($materiaprima[$i]["avance"] > 0 ){

                            $avance = "<span style='font-size:85%' class='label label-info'>".number_format($materiaprima[$i]["avance"],2)." %</span>";

                        }else{

                            $avance = number_format($materiaprima[$i]["avance"],2);

                        }                         


						$datosJson.='[

                                        "'.$materiaprima[$i]["codsublinea"].'",
										"'.$materiaprima[$i]["codpro"].'",
										"'.$materiaprima[$i]["codfab"].'",
										"'.$materiaprima[$i]["descripcion"].'",
										"'.$materiaprima[$i]["color"].'",
										"'.$materiaprima[$i]["unidad"].'",
                                        "<center>'.number_format($materiaprima[$i]["requerimiento"],2).'</center>",
                                        "<center>'.$stock.'</center>",
                                        "<center>'.$saldo_oc.'</center>",
                                        "<center>'.$saldo_os.'</center>",
                                        "<center>'.$ingresos.'</center>",
                                        "<center>'.$proyeccion.'</center>",
                                        "<center>'.$avance.' %</center>"
                                        

									],';
					}

					$datosJson=substr($datosJson,0,-1);
					$datosJson.=']
			}';

			echo $datosJson;

		}else{

			echo '{
				"data":[]
			}';
			return;

		}
	}
}

$materiaprima=new AjaxTablaProyMp();
$materiaprima->mostrarTablaProyMp();