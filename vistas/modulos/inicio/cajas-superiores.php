<?php

/* 
* datos para las cajas
*/

$valor = null;

$ventas = ControladorMovimientos::ctrTotUndVen($valor);
if($ventas["total_venta"] != 0){
$produccion = ControladorMovimientos::ctrTotUndProd($valor);

$articulosP = controladorArticulos::ctrArticulosPedidos();

$articulosF = controladorArticulos::ctrArticulosFaltantes();

$porcentaje =number_format($articulosF["faltantes"]*100/$articulosP["pedidos"],2) ;


?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3><?php echo number_format($ventas["total_venta"],0); ?> und</h3>

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
    
      <h3><?php echo number_format($produccion["total_produccion"],0); ?> und</h3>

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

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?php echo number_format($articulosP["pedidos"],0); ?></h3>

      <p>Unidades en Pedidos</p>
  
    </div>
    
    <div class="icon">
    
      <i class="fa fa-id-card-o"></i>
    
    </div>
    
    <a href="tarjetas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">
  
    <div class="inner">
    
      <h3><?php echo number_format($articulosF["faltantes"],0); ?></h3>

      <p>Unidades faltantes: <?php echo $porcentaje; ?> %</p>
    
    </div>
    
    <div class="icon">
      
      <i class="fa fa-check-circle-o"></i>
    
    </div>
    
    <a href="articulos" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>
<?php }?>