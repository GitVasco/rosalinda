<div class="content-wrapper">
    <h2>Ejemplo: Leer Archivos Excel con PHP</h2>   
      <div class="content-header">
        <h3 class="panel-title">Resultados de archivo de Excel.</h3>
      </div>
      <section class="content">
        <div class="box">
          <div class="box-body">
            
<?php
include "/Excel/reader.php";
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$data->read("vistas/cargas/PEDIDOS.xls");
$conexion = mysql_connect("192.168.1.2", "jesus", "admin123") or die("No se pudo conectar: " . mysql_error());
mysql_select_db("new_vasco", $conexion);

echo("<table class='table table-bordered'>");
for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
	echo("<tr>");
	for ($j = 1; $j <= 1; $j++) {
		
		echo("<td>".$data->sheets[0]['cells'][$i][1] ."</td>");
		echo("<td>".$data->sheets[0]['cells'][$i][3] ."</td>");
		echo("<td>".$data->sheets[0]['cells'][$i][6] ."</td>");
		echo("<td>".$data->sheets[0]['cells'][$i][7] ."</td>");
		echo("<td>".$data->sheets[0]['cells'][$i][8] ."</td>");
		echo("<td>".$data->sheets[0]['cells'][$i][14] ."</td>");
		echo("<td>".$data->sheets[0]['cells'][$i][15] ."</td>");
		echo("<td>".$data->sheets[0]['cells'][$i][16] ."</td>");
		$mes=substr($data->sheets[0]['cells'][$i][17],3,3);
		if($mes=="Jan"){
			$num="01";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="Feb"){
			$num="02";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="Mar"){
			$num="03";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="Apr"){
			$num="04";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="May"){
			$num="05";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="Jun"){
			$num="06";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="Jul"){
			$num="07";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="Aug"){
			$num="08";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="Sep"){
			$num="09";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="Oct"){
			$num="10";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="Nov"){
			$num="11";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}else if($mes=="Dec"){
			$num="12";
			echo("<td>".str_replace($mes,$num,$data->sheets[0]['cells'][$i][17]) ."</td>");
		}
		
		echo("<td>".$data->sheets[0]['cells'][$i][25] ."</td>");
		// $total=($data->sheets[0]['cells'][$i][10]*$data->sheets[0]['cells'][$i][15]*((100-$data->sheets[0]['cells'][$i][18])/100))*((100-$data->sheets[0]['cells'][$i][19])/100);
		// echo("<td>".$total ."</td>");
		
	}
	echo("</tr>");

}
echo("</table>");

// echo'<script>

// 					swal({
// 						  type: "success",
// 						  title: "Los articulo han sido actualizados correctamente",
// 						  showConfirmButton: true,
// 						  confirmButtonText: "Cerrar"
// 						  }).then(function(result){
// 									if (result.value) {

// 									window.location = "cargas-automaticas";

// 									}
// 								})

// 					</script>';
?>

  </div>  
 </section>   
</div>