<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Producción Brasieres

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Producción Brasieres</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">


          <button type="button" class="btn btn-default pull-right " id="daterange-btnBrasieres">
          <span>
            <i class="fa fa-calendar"></i>

            <?php

              if(isset($_GET["fechaInicial"])){

                echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];

              }else{
              
                echo 'Rango de fecha';

              }

            ?>

          </span>

          <i class="fa fa-caret-down"></i>

        </button>

        <button class="btn btn-outline-success btnReporteProduccionBrasier" fechaInicial="" fechaFinal="" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Producción Brasier  
        </button>
         

        </div>
    
      <div class="box-body">

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">
        <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">
        
       <table class="table table-bordered table-striped dt-responsive tablaProduccionBrasier" width="100%">
         
        <thead>
            
            <tr>

                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="text-align: center">28</th>
                <th style="text-align: center">30</th>
                <th style="text-align: center">32</th>
                <th style="text-align: center">34</th>
                <th style="text-align: center">36</th>
                <th style="text-align: center">38</th>
                <th style="text-align: center">40</th>
                <th style="text-align: center">42</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>

            </tr> 

            <tr>

                <th></th>
                <th></th>
                <th>Cod.</th>
                <th>Tipo</th>
                <th></th>
                <th>Cod.</th>
                <th></th>
                <th></th>
                <th>Cod.</th>
                <th></th>
                <th style="text-align: center">3</th>
                <th style="text-align: center">4</th>
                <th style="text-align: center">6</th>
                <th style="text-align: center">8</th>
                <th style="text-align: center">10</th>
                <th style="text-align: center">12</th>
                <th style="text-align: center">14</th>
                <th style="text-align: center">16</th>
                <th>Total</th>
                <th>Total</th>
                <th>Tiem.</th>
                <th>Acum.</th>


            </tr> 

            <tr>

                <th>Mes</th>
                <th>Día</th>
                <th>Trab.</th>
                <th>Trab.</th>
                <th>Trabajador</th>
                <th>Ope.</th>
                <th>Operación</th>
                <th>Modelo</th>
                <th>Col.</th>
                <th>Color</th>
                <th style="text-align: center">S</th>
                <th style="text-align: center">M</th>
                <th style="text-align: center">L</th>
                <th style="text-align: center">XL</th>
                <th style="text-align: center">XXL</th>
                <th style="text-align: center">XS</th>
                <th style="text-align: center"></th>
                <th style="text-align: center"></th>
                <th>Tallas</th>
                <th>S/</th>
                <th>Disp.</th>
                <th>Eficiencia</th>
                

            </tr>

        </thead>
        <tfoot>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tfoot>
       </table>

      </div>

    </div>

  </section>

</div>


<script>
window.document.title = "Produccion brasier"
</script>