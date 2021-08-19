<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Producción Vasco

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Producción Vasco</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

              <select class="form-control selectpicker input-lg" id="mesV" name="mesV" data-live-search="true">

              <option value="">Seleccione Mes</option>

                  <?php

                  $mes = ControladorTalleres::ctrMes();
                  //var_dump($mes);

                  foreach ($mes as $key => $value) {
                  
                  echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';
                  }

                  ?>

              </select>

          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          
              <button class="btn btn-primary btnCargarVasco">CARGAR MES</button>
              
          </div>
          <div class=" pull-right ">
            <button class="btn btn-outline-success " modelo="" style="border:green 1px solid">
              <img src="vistas/img/plantilla/excel.png" width="20px"> Producción Vasco  </button>
          </div>

        </div>
    
      <div class="box-body">

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">
        
       <table class="table table-bordered table-striped dt-responsive tablaProduccionVasco" width="100%">
         
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

       </table>

      </div>

    </div>

  </section>

</div>


<script>
window.document.title = "Produccion Vasco"
</script>