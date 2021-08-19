<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Registro de quincenas

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Registro de quincenas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
    
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarQuincena">

          Agregar Quincena

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaQuincena" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Año</th>
              <th>Mes</th>
              <th>Quincena</th>
              <th>Inicio</th>
              <th>Fin</th>
              <th>Usuario</th>
              <th>Fecha Creacion</th>
              <th>Acciones</th>
              <th>Pagos Trusas</th>
              <th>Pagos Brasier</th>

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
MODAL AGREGAR QUINCENA
======================================-->

<div id="modalAgregarQuincena" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Quincena</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MES -->
            
            <div class="form-group">

                <?php

                  date_default_timezone_set('America/Lima');
                  $año= date("Y");

                  echo '<input type="hidden" id="año" name="año" value="'.$año.'">';

                ?>
              
                <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION["id"]; ?>">
              
                <select class="form-control selectpicker input-lg" id="mes" name="mes" data-live-search="true">

                <option value="">Seleccione Mes</option>

                    <?php

                    $mes = ControladorTalleres::ctrMes();

                    foreach ($mes as $key => $value) {
                    
                    echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';
                    }

                    ?>

                </select>



            </div>

            <!-- ENTRADA PARA LA QUINCENA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-tag"></i></span>

                <select class="form-control input-lg" id="quincena" name="quincena" required>

                  <option value="">Selecionar Quincena</option>

                  <option value="1">1era Quincena</option>

                  <option value="2">2da Quincena</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL INICIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" id="inicio" name="inicio" placeholder="Fecha de inicio" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL FIN -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" id="fin" name="fin" placeholder="Fecha de fin" required>

              </div>

            </div>            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Quincena</button>

        </div>

      </form>

      <?php

      $crearQuincena = new ControladorProduccion();
      $crearQuincena->ctrCrearQuincenas();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR QUINCENA
======================================-->

<div id="modalEditarQuincena" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Edtar Quincena</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MES -->
            
            <div class="form-group">

                <?php

                  date_default_timezone_set('America/Lima');
                  $año= date("Y");

                  echo '<input type="hidden" id="editarAño" name="editarAño" value="'.$año.'">';

                ?>

                <input type="hidden" id="id" name="id">
              
                <input type="hidden" id="editarUsuario" name="editarUsuario" value="<?php echo $_SESSION["id"]; ?>">
              
                <select class="form-control selectpicker input-lg" id="editarMes" name="editarMes" data-live-search="true">

                <option value="">Seleccione Mes</option>

                    <?php

                    $mes = ControladorTalleres::ctrMes();

                    foreach ($mes as $key => $value) {
                    
                    echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';
                    }

                    ?>

                </select>



            </div>

            <!-- ENTRADA PARA LA QUINCENA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-tag"></i></span>

                <select class="form-control input-lg" id="editarQuincena" name="editarQuincena" required readonly>

                  <option value="">Selecionar Quincena</option>

                  <option value="1">1era Quincena</option>

                  <option value="2">2da Quincena</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL INICIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" id="editarInicio" name="editarInicio" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL FIN -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" id="editarFin" name="editarFin" placeholder="Fecha de fin" required>

              </div>

            </div>            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Quincena</button>

        </div>

      </form>

      <?php

      $editarQuincena = new ControladorProduccion();
      $editarQuincena->ctrEditarQuincenas();

      ?>

    </div>

  </div>

  <?php

  $eliminarQuincena = new ControladorProduccion();
  $eliminarQuincena -> ctrEliminarQuincena();

?>

</div>
<script>
window.document.title = "Quincenas"
</script>