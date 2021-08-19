<?php

require_once '../../controladores/movimientos.controlador.php';
require_once '../../modelos/movimientos.modelo.php';

class AjaxTablaMProd{
	// Mostramos la tabla de Productos
	public function mostrarTablaMProd(){

		$movimientos=ControladorMovimientos::ctrMovProdMod($_GET["modeloP"]);

		if(count($movimientos)>0){

			$datosJson='{

				"data":[';

					for($i=0;$i<count($movimientos);$i++){

						$bgnegro= "black";
						$bgblanco = "white";
						$bgplomo = "gray";
						$bglanvanda = "lavender";
						$bgrosado = "pink";
			
						$blanco = "#FFFFFF";
						$negro = "#000000";
						$beige = "#F5F5DC";
						$plomo = "#808080";
						$turquesa = "#40E0D0";
						$chicle = "#FF69B4";
						$coral = "#FF7F50";
						$celeste = "#ADD8E6";
						$rosado = "#FFC0CB";
						$rojo = "#FF0000";
						$azalea = "#FF00FF"; //fucsia
						$perla = "#FAFAD2"; //crema
						$verdeLima = "#32CD32";
						$vaqua = "#66CDAA";
						$lila = "#9370DB";
						$marron ="#A52A2A";
						$vino = "#8B0000";
						$uva = "#800080";
						$azulino = "#0000FF";
						$amarillo = "#FFFF00";
						$melon = "#FA8072";
						$cobalto = "#008080";
						$verde = "#008000";            
			
						$neutro = "#000000";

						/* 
						todo> COLORES
						*/    

						if($movimientos[$i]["cod_color"] == "01"){

							$colores = "<b><span style='color:".$blanco."; background-color:".$bgplomo." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "02"){

							$colores = "<b><span style='color:".$beige."; background-color:".$bgnegro." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "03"){

							$colores = "<b><span style='color:".$negro."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "04"){

							$colores = "<b><span style='color:".$plomo."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "05"){

							$colores = "<b><span style='color:".$turquesa."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "06"){  

							$colores = "<b><span style='color:".$chicle."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "07"){  

							$colores = "<b><span style='color:".$coral."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "08"){  

							$colores = "<b><span style='color:".$celeste."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "09"){  

							$colores = "<b><span style='color:".$rosado."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "10"){  

							$colores = "<b><span style='color:".$rojo."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "11" || $movimientos[$i]["cod_color"] == "26"){  

							$colores = "<b><span style='color:".$azalea."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "12" || $movimientos[$i]["cod_color"] == "14"){  

							$colores = "<b><span style='color:".$perla."; background-color:".$bgnegro." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "13"){  

							$colores = "<b><span style='color:".$verdeLima."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "18"){  

							$colores = "<b><span style='color:".$vaqua."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "19"){  

							$colores = "<b><span style='color:".$lila."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "20"){  

							$colores = "<b><span style='color:".$marron."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "21"){  

							$colores = "<b><span style='color:".$vino."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "22"){  

							$colores = "<b><span style='color:".$uva."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "23"){  

							$colores = "<b><span style='color:".$azulino."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "28"){  

							$colores = "<b><span style='color:".$amarillo."; background-color:".$bgnegro." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "29"){  

							$colores = "<b><span style='color:".$melon."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}else if($movimientos[$i]["cod_color"] == "30"){  

							$colores = "<b><span style='color:".$cobalto."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						} 
						else{

							//blanco 2 - naranja - platano - surtido - perico 
							$colores = "<b><span style='color:".$negro."; background-color:".$bgblanco." ;'>".$movimientos[$i]["color"]."</span></b>";

						}

						/* 
						todo: ESTADOS
						*/

						if($movimientos[$i]["estado"] == "Descontinuado"){

							$estado = "<span style='font-size:85%' class='label label-danger'>Inactivo</span>";
			
							
						}else if($movimientos[$i]["estado"] == "CampañaD"){
			
							$estado = "<span style='font-size:85%' class='label label-warning'>CampañaD</span>";
			
						}else{
			
							$estado = "<span style='font-size:85%' class='label label-success'>Activo</span>";
			
						}

						/* 
						TODO: TOTALES
						*/
						if($movimientos[$i]["articulo"] == "TOTAL"){

							$total = "<b>".$movimientos[$i]["articulo"]."</b>";
			
							
						}else{
			
							$total = $movimientos[$i]["articulo"];
			
						}


						
						$datosJson.='[

										"<b><center>'.$movimientos[$i]["modelo"].'</center></b>",
										"'.$total.'",
										"'.$movimientos[$i]["nombre"].'",
										"'.$colores.'",
										"T'.$movimientos[$i]["talla"].'",
										"'.$estado.'",
										"<center>'.number_format($movimientos[$i]["1"],0).'</center>",
										"<center>'.number_format($movimientos[$i]["2"],0).'</center>",
										"<center>'.number_format($movimientos[$i]["3"],0).'</center>",
                                        "<center>'.number_format($movimientos[$i]["4"],0).'</center>",
                                        "<center>'.number_format($movimientos[$i]["5"],0).'</center>",
                                        "<center>'.number_format($movimientos[$i]["6"],0).'</center>",
                                        "<center>'.number_format($movimientos[$i]["7"],0).'</center>",
                                        "<center>'.number_format($movimientos[$i]["8"],0).'</center>",
                                        "<center>'.number_format($movimientos[$i]["9"],0).'</center>",
                                        "<center>'.number_format($movimientos[$i]["10"],0).'</center>",
                                        "<center>'.number_format($movimientos[$i]["11"],0).'</center>",
                                        "<center>'.number_format($movimientos[$i]["12"],0).'</center>",
                                        "<b><center>'.number_format($movimientos[$i]["total"],0).'</center></b>"
                                        

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

$movimientos=new AjaxTablaMProd();
$movimientos->mostrarTablaMProd();