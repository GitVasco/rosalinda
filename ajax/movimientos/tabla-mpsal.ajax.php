<?php

require_once '../../controladores/movimientos.controlador.php';
require_once '../../modelos/movimientos.modelo.php';

class AjaxTablaMpSal{
	// Mostramos la tabla de Vtauctos
	public function mostrarTablaMpSal(){

		$movimientos=ControladorMovimientos::ctrMovSalMp($_GET["lineaMpSal"]);

		if(count($movimientos)>0){

			$datosJson='{

				"data":[';

					for($i=0;$i<count($movimientos);$i++){

                        /* 
						TODO: TOTALES
						*/
						if($movimientos[$i]["codigofabrica"] == "TOTAL"){

							$total = "<b>".$movimientos[$i]["codigofabrica"]."</b>";
			
							
						}else{
			
							$total = $movimientos[$i]["codigofabrica"];
			
						}
					
						$datosJson.='[

                                        "'.$movimientos[$i]["codsublinea"].'",
										"'.$total.'",
										"'.$movimientos[$i]["codpro"].'",
										"'.$movimientos[$i]["descripcion"].'",
										"'.$movimientos[$i]["color"].'",
										"'.$movimientos[$i]["unidad"].'",
										"'.number_format($movimientos[$i]["1"],2).'",
										"'.number_format($movimientos[$i]["2"],2).'",
										"'.number_format($movimientos[$i]["3"],2).'",
										"'.number_format($movimientos[$i]["4"],2).'",
                                        "'.number_format($movimientos[$i]["5"],2).'",
                                        "'.number_format($movimientos[$i]["6"],2).'",
                                        "'.number_format($movimientos[$i]["7"],2).'",
                                        "'.number_format($movimientos[$i]["8"],2).'",
                                        "'.number_format($movimientos[$i]["9"],2).'",
                                        "'.number_format($movimientos[$i]["10"],2).'",
                                        "'.number_format($movimientos[$i]["11"],2).'",
                                        "'.number_format($movimientos[$i]["12"],2).'",
                                        "'.number_format($movimientos[$i]["total"],2).'"
                                        

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

$movimientos=new AjaxTablaMpSal();
$movimientos->mostrarTablaMpSal();