<?php

$valor = null;

$modelos = ControladorMovimientos::ctrMovMes($valor);

/* var_dump("modelos",$modelos["modelo"]); */

$colores = array("red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold");

$sumaUnd = ControladorMovimientos::ctrSumaUnd($valor);

/* var_dump("sumaUnd", $sumaUnd["sumaUnd"]); */


?>

<!--=====================================
MODELOS MÁS VENDIDOS
======================================-->
<?php
if($sumaUnd["sumaUnd"]!=0){
?>
<div class="box box-default">
	
	<div class="box-header with-border">
  
      <h3 class="box-title">Modelos más Vendidos del Mes</h3>

    </div>

	<div class="box-body">
    
      	<div class="row">

	        <div class="col-md-7">

	 			<div class="chart-responsive">
	            
	            	<canvas id="pieChart" height="150"></canvas>
	          
	          	</div>

	        </div>

		    <div class="col-md-5">
		      	
		  	 	<ul class="chart-legend clearfix">

		  	 	<?php

					for($i = 0; $i < 10; $i++){

					echo ' <li><i class="fa fa-circle-o text-'.$colores[$i].'"></i> '.$modelos[$i]["modelo"].'</li>';

					}


		  	 	?>


		  	 	</ul>

		    </div>

		</div>

    </div>

    <div class="box-footer no-padding">
    	
		<ul class="nav nav-pills nav-stacked">
			
			 <?php

          	for($i = 0; $i <5; $i++){
              
          		echo '<li>
						 
                      <a>

                      '.$modelos[$i]["modelo"].'

                      <span class="pull-right text-'.$colores[$i].'">   
                      '.ceil($modelos[$i]["ventas"]*100/$sumaUnd["sumaUnd"]).'%
                      </span>
                        
                  </a>

                    </li>';
              

			}

			?>


		</ul>

    </div>

</div>
<?php
}
?>

<script>
	

  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [

  <?php

  for($i = 0; $i < 10; $i++){

  	echo "{
      value    : ".$modelos[$i]["ventas"].",
      color    : '".$colores[$i]."',
      highlight: '".$colores[$i]."',
      label    : '".$modelos[$i]["modelo"]."'
    },";

  }
    
   ?>
  ];
  var pieOptions     = {
    
    showScale            : true,
    segmentShowStroke    : true,
    segmentStrokeColor   : '#fff',
    segmentStrokeWidth   : 1,
    percentageInnerCutout: 50, // This is 0 for Pie charts
    animationSteps       : 100,
    animationEasing      : 'easeOutBounce',
    animateRotate        : true,
    animateScale         : false,
    responsive           : true,
    maintainAspectRatio  : false,
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  pieChart.Doughnut(PieData, pieOptions);

</script>