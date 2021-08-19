<?php

/* 
todo: traemmos los meses en letras
*/
  $nombre_mes = ControladorMovimientos::ctrMesesMov();

  $arrayMeses = array();

  /* var_dump("nombre_mes", $nombre_mes); */

  foreach ($nombre_mes as $key => $value) {

    $mes = $value["nom_mes"];

    array_push($arrayMeses, $mes);

  }

  /* 
  todo: traemos el total de ventas por mes
  */

  $venta_mes = ControladorMovimientos::ctrTotalMesVent();

  /* var_dump("venta_mes", $venta_mes); */

  $arrayVentas = array();

  foreach ($venta_mes as $key => $value) {

    $vta = $value["total_mesV"];

    array_push($arrayVentas, $vta);

  }

  /* 
  todo: traemos el total de produccion por mes
  */

  $produccion_mes = ControladorMovimientos::ctrTotalMesProd();

  // var_dump("produccion_mes", count($produccion_mes)); 

  $arrayProduccion = array();

  foreach ($produccion_mes as $key => $value) {

    $prod = $value["total_mesP"];

    array_push($arrayProduccion, $prod);

  }  

  if(count($produccion_mes) != 0){

?>


<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Ventas vs Producción</h3>

  </div>

  <div class="box-body">

    <div class="chart">
      <canvas id="areaChart" style="height:250px"></canvas>
    </div>

  </div>

</div>
<?php }?>
<script>

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : [

        <?php

          $conteoM = count($arrayMeses);

          foreach($arrayMeses as $numeroM => $key){
            
            if($numeroM != $conteoM-1){

              echo "'$key',";

            }else {

              echo "'$key'";

            }

          }

        ?>
         
      ],
      datasets: [
        {
          label               : 'Producción',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
          
          <?php
          
            $conteoP = count($arrayProduccion);
            
            foreach($arrayProduccion as $numeroP => $key){

              if($numeroP != $conteoP-1){

                echo "$key,";

              }else{

                echo "$key";

              }

            }
          
          ?>          
          
          ]
        },
        {
          label               : 'Ventas',
          fillColor           : 'rgba(210, 214, 222, 0.7)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [
          
          <?php
          
            $conteoV = count($arrayVentas);
            
            foreach($arrayVentas as $numeroV => $key){

              if($numeroV != $conteoV-1){

                echo "$key,";

              }else{

                echo "$key";

              }

            }
          
          ?>
          
          ]
        }

      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : true,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true,
      // obtener las leyendas en el grafico
      multiTooltipTemplate    : '<%= datasetLabel %> - <%= value %>'
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

   
</script>