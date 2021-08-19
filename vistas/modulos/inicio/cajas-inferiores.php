<?php

/* 
* datos para las cajas
*/

$valor = 1;

$ventasA = ControladorMovimientos::ctrTotUndVen($valor);

/* var_dump("ventasA", $ventasA["total_venta"]); */
if($ventasA["total_venta"] != 0){
$produccionA = ControladorMovimientos::ctrTotUndProd($valor);

/* var_dump("produccionA", $produccionA["total_produccion"]); */

$dias = ControladorMovimientos::ctrTotDiasProd($valor);


$promedio = number_format( $produccionA["total_produccion"] / $dias["dias_produccion"] ,0);

/* var_dump("promedio", $promedio); */



?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3><?php echo number_format($ventasA["total_venta"],0); ?> und</h3>

      <p>Unidades Vendidas</p>
    
    </div>
    
    <div class="icon">
      
      <i class="fa fa-cart-arrow-down"></i>
    
    </div>
    
    <a href="#" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3><?php echo number_format($produccionA["total_produccion"],0); ?> und</h3>

      <p>Unidades Producidas</p>
    
    </div>
    
    <div class="icon">
    
      <i class="fa fa-tags"></i>
    
    </div>
    
    <a href="#" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-blue">
    
    <div class="inner">
    
      <h3><?php echo $promedio; ?> und</h3>

      <p>Promedio Produccion por Día</p>
    
    </div>
    
    <div class="icon">
    
      <i class="fa fa-bolt"></i>
    
    </div>
    
    <a href="#" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>
<?php }?>