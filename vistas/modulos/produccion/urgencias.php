<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Urgencias Articulos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Urgencias</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      <div class="col-lg-2">
                <select name="selectArticuloUrgencia" id="selectArticuloUrgencia" class="form-control input-lg selectpicker" data-live-search="true" data-size="10">
                <option value="">--------Seleccionar articulo-------</option>
                <?php
                    $modelos =controladorModelos::ctrMostrarModelosActivos();
                    // var_dump($modelos);
                    foreach ($modelos as $key => $value) {
                            echo '<option value="'.$value["modelo"].'">'.$value["nombre"].'</option>';

                    }

                ?>
                </select>
            </div>

            <div class="col-lg-1">
                <button class="btn btn-primary btnLimpiarArticuloUrgencia"  name="btnLimpiarArticuloUrgencia"><i class="fa fa-refresh"></i> Limpiar</button>
            </div>
      <?php
      
      if( $_SESSION["perfil"] == 'Supervisores' ||
          $_SESSION["perfil"] == 'Sistemas'){

        
  
        echo '<button class="btn btn-success" data-toggle="modal" data-target="#modalConfigurarUrgencia">

                Configuracion Actual: ';

                $configuracion = controladorArticulos::ctrConfiguracion();

                #var_dump("configuracion", $configuracion);
        
                $urgencia = $configuracion["urgencia"];

                $urgencia;

                echo $urgencia;

        echo ' %</button>

                  <a href="vistas/reportes_excel/rpt_urgencias.php" class="btn btn-default pull-right" style="border:green 1px solid">

                    <img src="vistas/img/plantilla/excel.png" width="20px"> URGENCIAS
                  
                  </a>

               </div>';

      }else{

        echo '<div class="box-header with-border">

                <a href="vistas/reportes_excel/rpt_urgencias.php" class="btn btn-default pull-right" style="border:green 1px solid">

                  <img src="vistas/img/plantilla/excel.png" width="20px"> URGENCIAS
                
                </a>
  
            </div>';

      }

      ?>




      <div class="box-body">

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto"> 

       <table class="table table-bordered table-striped dt-responsive tablaUrgencias" width="100%">
         
        <thead>

          <tr>
           
           <th>Modelo</th>
           <th>Nombre</th>
           <th>Color</th>
           <th>Talla</th>
           <th>Estado</th>
           <th>Proyección</th>
           <th>% Avance</th>
           <th>Stock</th>
           <th>Pedidos</th>
           <th>En Taller</th>
           <th>Alm. Corte</th>
           <th>Ord. Corte</th>
           <th>Ult 30d</th>
           <th>MP Faltante</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

        
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL CONFIGURAR % DE URGENCIAS
======================================-->

<div id="modalConfigurarUrgencia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Configurar Porcentaje</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA PORCENTAJE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tag"></i></span> 

                <select class="form-control input-lg" id="urgencia" name="urgencia" required>

                  <option value="">Selecionar Porcentaje</option>

                  <option value="100">100 %</option>

                  <option value="90">90 %</option>

                  <option value="80">80 %</option>

                  <option value="70">70 %</option>

                  <option value="60">60 %</option>

                  <option value="50">50 %</option>

                  <option value="40">40 %</option>

                  <option value="30">30 %</option>

                  <option value="20">20 %</option>

                  <option value="10">10 %</option>

                  <option value="0">0 %</option>
                
                </select>

              </div>

            </div>       

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Confirmar Porcentaje</button>

        </div>

      </form>

      <?php

        $configurarUrgenciaLista = new controladorArticulos();
        $configurarUrgenciaLista -> ctrConfigurarUrgenciaLista();

      ?>  


    </div>

  </div>

</div>

<!--=====================================
MODAL VISUALIZAR MP URGENCIA
======================================-->

<div id="modalVisualizarUrgencias" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 70% !important;">

    <div class="modal-content">

      <form role="form" method="post" class="modalSimulacion">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalle de Tarjeta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CODIGO DEL ARTICULO-->
            
            <div class="form-group col-lg-2">
              
              <label>Artículo</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="articulo" id="articulo" required readonly></b>

              </div>

            </div>          

            <!-- ENTRADA PARA EL MODELO-->
            
            <div class="form-group col-lg-2">
              
              <label>Modelo</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="modelo" id="modelo" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION-->
            
            <div class="form-group col-lg-4">

              <label>Descripción</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="nombre" id="nombre" required readonly></b>

              </div>

            </div>            

            <!-- ENTRADA PARA EL COLOR -->
            
            <div class="form-group col-lg-2">

              <label>Color</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="color" id="color" required readonly></b>

              </div>

            </div>      
            
            <!-- ENTRADA PARA LA TALLA-->
            
            <div class="form-group col-lg-2">

              <label>Talla</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="talla" id="talla" required readonly></b>

              </div>

            </div>
            
            <!-- ENTRADA PARA EL STOCK-->
            
            <div class="form-group col-lg-2">

              <label>Stock</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="stock" id="stock" required readonly></b>

              </div>

            </div>

            <!-- ENTRADA PARA LOS PEDIDOS-->
            
            <div class="form-group col-lg-2">

              <label>Pedidos</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="pedidos" id="pedidos" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EN TALLER-->
            
            <div class="form-group col-lg-2">

              <label>En Taller</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="taller" id="taller" required readonly>

              </div>

            </div>       
            
            <!-- ENTRADA PARA EN ALM. CORTE-->
            
            <div class="form-group col-lg-2">

              <label>Alm. Corte</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="alm_corte" id="alm_corte" required readonly>

              </div>

            </div>                
                       
            <!-- ENTRADA PARA EN ORD. CORTE-->
            
            <div class="form-group col-lg-2">

              <label>Ord. Corte</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="ord_corte" id="ord_corte" required readonly>

              </div>

            </div>     
            
            <!-- ENTRADA PARA ESTADO-->
            
            <div class="form-group col-lg-2">

              <label>Estado</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="estado" id="estado" required readonly></b>

              </div>

            </div>                
            


            <!-- TABLA DE DETALLES -->

            <div class="form-group col-lg-12">
            <label>TABLA DETALLES</label>
            </div>

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablaDetalleUrgencia" width="100%">

                <thead>

                  <tr>

                    <th>CodPro</th>
                    <th>Materia Prima</th>
                    <th>Consumo</th>
                    <th>Unidad</th>
                    <th>Stock</th>
                    <th>Tej. Princ.</th>
                    <th>Urgencia</th>
                    <th>Alerta</th>

                  </tr>

                </thead>

                <tbody>



                </tbody>

              </table>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

        </div>



      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL CONFIGURAR MATERIA PRIMA FALTANTE
======================================-->

<div id="modalMpFaltante" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 70% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Configurar Porcentaje</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CODIGO DEL ARTICULO-->

            <div class="form-group col-lg-2">

              <label>Artículo</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="articuloA" id="articuloA" required readonly></b>

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO-->

            <div class="form-group col-lg-2">

              <label>Modelo</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="modeloA" id="modeloA" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION-->

            <div class="form-group col-lg-4">

              <label>Descripción</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="nombreA" id="nombreA" required readonly></b>

              </div>

            </div>

            <!-- ENTRADA PARA EL COLOR -->

            <div class="form-group col-lg-2">

              <label>Color</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="colorA" id="colorA" required readonly></b>

                <input type="hidden" class="form-control input-sm" name="cod_color" id="cod_color" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA TALLA-->

            <div class="form-group col-lg-2">

              <label>Talla</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="tallaA" id="tallaA" required readonly></b>

              </div>

            </div>

            <!-- ENTRADA PARA EL STOCK-->

            <div class="form-group col-lg-2">

              <label>Stock</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="stockA" id="stockA" required readonly></b>

              </div>

            </div>

            <!-- ENTRADA PARA LOS PEDIDOS-->

            <div class="form-group col-lg-2">

              <label>Pedidos</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="pedidosA" id="pedidosA" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA ESTADO-->

            <div class="form-group col-lg-2">

              <label>Estado</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="estadoA" id="estadoA" required readonly></b>

              </div>

            </div>

            <!-- ENTRADA PARA MATERIA PRIMA FALTANTE-->

            <div class="form-group col-lg-6">

              <label>Mp Faltante</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <b><input type="text" class="form-control input-sm" name="mpFaltante" id="mpFaltante"></b>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Mp Faltante</button>

        </div>

      </form>

      <?php

      $mpFaltante = new controladorArticulos();
      $mpFaltante -> ctrMpFaltante();

      ?>  


    </div>

  </div>

</div>

<script>
window.document.title = "Urgencias APT"
</script>