<?php

/* 
* datos para las cajas
*/


if(isset($_GET["mes"]) && $_GET["mes"] != "TODO"){

    $mes = $_GET["mes"];

}else{

    $mes = null;

}

#var_dump($mes);

$totales = ControladorMovimientos::ctrTotalesSoles($mes);
#var_dump($totales);

$pedidos = ControladorMovimientos::ctrTotalesSolesPedidos($mes);
#var_dump($pedidos);

$vencidos = ControladorMovimientos::ctrTotalVencidos();
#var_dump($vencidos["saldo"]);


?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3>S/ <?php echo number_format($totales["vtas_soles"],0); ?></h3>

      <p>Ventas - Soles</p>
    
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

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3>S/ <?php echo number_format($pedidos["total"],0); ?></h3>

      <p>Pedidos - Soles</p>
  
    </div>
    
    <div class="icon">
    
      <i class="fa fa-id-card-o"></i>
    
    </div>
    
    <a href="#" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3>S/<?php echo number_format($totales["pagos_soles"],0); ?></h3>

      <p>Cobranza - Soles</p>
    
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

  <div class="small-box bg-red">
    
    <div class="inner">
    
      <h3>S/<?php echo number_format($vencidos["saldo"],0); ?></h3>

      <p>Documentos Vencidos - Soles</p>
    
    </div>
    
    <div class="icon">
    
      <i class="fa fa-exclamation-circle"></i>
    
    </div>
    
    <a href="#" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>
