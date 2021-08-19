<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar agencias
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar agencias</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAgencia">
          
          Agregar agencia

        </button>

        <div class="pull-right">
          <button class="btn btn-outline-success btnReporteColor" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Agencias  </button>
        </div>
      </div>
        
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaAgencias" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Codigo</th>
           <th>Nombre</th>
           <th>RUC</th>
           <th>Dirección</th>
           <th>Ubigeo</th>
           <th>Telefono</th>
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
MODAL AGREGAR COLOR
======================================-->

<div id="modalAgregarAgencia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Agencia</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            
          <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodAgencia" placeholder="Ingresar codigo de agencia" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar agencia" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DIRECCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar Dirección" >

              </div>

            </div>

            <!-- ENTRADA PARA EL UBIGEO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map"></i></span> 

                <select  class="form-control input-lg selectpicker" data-live-search="true" name="nuevoUbigeo"  data-size="10">
                  <option value="">Ubigeo</option>

                    <?php
                    
                    $ubigeo = ControladorClientes::ctrMostrarUbigeos();
                    #var_dump("ubigeo", $ubigeo);
                    foreach ($ubigeo as $key => $value) {

                      echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] . ' - ' . $value["ubigeo"] . '</option>';

                    }

                    
                    ?>
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL RUC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="nuevoRUC" placeholder="Ingresar RUC" >

              </div>

            </div>          


            <!-- ENTRADA PARA EL TELEFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar telefono" >

              </div>

            </div>          

 
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar agencia</button>

        </div>

      </form>


      <?php

        $crearAgencia = new ControladorAgencias();
        $crearAgencia -> ctrCrearAgencia();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR AGENCIA
======================================-->

<div id="modalEditarAgencia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar agencia</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodAgencia" id="editarCodAgencia" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>
                <input type="hidden" id="idAgencia" name="idAgencia">
              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" >
              </div>

            </div>

            <!-- ENTRADA PARA EL UBIGEO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map"></i></span> 

                <select  class="form-control input-lg selectpicker" data-live-search="true" name="editarUbigeo" id="editarUbigeo" data-size="10">
                  <option value="">Ubigeo</option>

                    <?php
                    
                    $ubigeo = ControladorClientes::ctrMostrarUbigeos();
                    #var_dump("ubigeo", $ubigeo);
                    foreach ($ubigeo as $key => $value) {

                      echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] . ' - ' . $value["ubigeo"] . '</option>';

                    }

                    
                    ?>
                </select>
              </div>

            </div>

            <!-- ENTRADA PARA EL RUC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="editarRUC" id="editarRUC" >

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO  -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="editarTelefono" id="editarTelefono" >

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

      <?php

        $editarAgencia = new ControladorAgencias();
        $editarAgencia -> ctrEditarAgencia();

      ?>   


    </div>

  </div>

</div>


<?php

  $eliminarAgencia = new ControladorAgencias();
  $eliminarAgencia -> ctrEliminarAgencia();

?>

<script>
window.document.title = "Agencias"
</script>