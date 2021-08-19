<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Registro de pago de servicios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Registro de pago de servicios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
    
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPagoServicio">

          Agregar Pago servicio

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaPagoServicios" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Año</th>
              <th>Mes</th>
              <th>Inicio</th>
              <th>Fin</th>
              <th>Usuario</th>
              <th>Fecha Creacion</th>
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
MODAL AGREGAR QUINCENA
======================================-->

<div id="modalAgregarPagoServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Pago Servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MES -->
            
            <div class="form-group">
              <label for="">Mes</label>
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


            <!-- ENTRADA PARA EL INICIO -->

             <div class="form-group">
             <label for="">Fecha inicio</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" id="inicio" name="inicio" placeholder="Fecha de inicio" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL FIN -->

            <div class="form-group">
            <label for="">Fecha fin</label>
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

          <button type="submit" class="btn btn-primary">Guardar pago servicio</button>

        </div>

      </form>

      <?php

      $crearPagoServicio = new ControladorServicios();
      $crearPagoServicio->ctrCrearPagoServicios();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR QUINCENA
======================================-->

<div id="modalEditarPagoServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Pago servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MES -->
            
            <div class="form-group">
            <label for="">Mes</label>
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

            <!-- ENTRADA PARA EL INICIO -->

             <div class="form-group">
             <label for="">Fecha inicio</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" id="editarInicio" name="editarInicio" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL FIN -->

            <div class="form-group">
              <label for="">Fecha fin</label>
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

          <button type="submit" class="btn btn-primary">Guardar pago servicio</button>

        </div>

      </form>

      <?php

      $editarPagoServicio = new ControladorServicios();
      $editarPagoServicio->ctrEditarPagoServicio();

      ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL VISUALIZAR INFORMACION
======================================-->

<div id="modalVerPagoServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 80% !important;">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalle del pago servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
    
            <!-- TABLA DE DETALLES -->

            <div class="form-group col-lg-12">
            <label>TABLA DETALLES</label>
            </div>
            <div class="box-header">
              <div class="pull-right">
                <button class="btn btn-outline-success btnReportePagoServicios" style="border:green 1px solid" id="btnReportePagoServicios">
                <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte pago servicios  </button>
              </div>
            </div>

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablaVerPagoSer" width="100%">

              <thead>

                <tr>
                  <th style="width:150px"></th>
                  <th></th>
                  <th style="width:100px"></th>
                  <th></th>
                  <th></th>
                  <th style="width:250px"></th>
                  <th></th>
                  <th style="width:150px"></th>
                  <th>S</th>
                  <th>M</th>
                  <th>L</th>
                  <th>XL</th>
                  <th>XXL</th>
                  <th>XS</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>

                <tr>
                  <th style="width:150px"></th>
                  <th></th>
                  <th style="width:100px"></th>
                  <th></th>
                  <th></th>
                  <th style="width:250px"></th>
                  <th>Codigo</th>
                  <th style="width:150px"></th>
                  <th>28</th>
                  <th>30</th>
                  <th>32</th>
                  <th>34</th>
                  <th>36</th>
                  <th>38</th>
                  <th>40</th>
                  <th>42</th>
                  <th>Total</th>
                  <th></th>
                  <th>Total</th>
                </tr>

                <tr>
                  <th style="width:150px">Taller</th>
                  <th>Guia</th>
                  <th style="width:100px">Fecha</th>
                  <th>Codigo</th>
                  <th>Modelo</th>
                  <th style="width:250px">Nombre</th>
                  <th>Color</th>
                  <th style="width:150px">Color</th>
                  <th>3</th>
                  <th>4</th>
                  <th>6</th>
                  <th>8</th>
                  <th>10</th>
                  <th>12</th>
                  <th>14</th>
                  <th>16</th>
                  <th>doc</th>
                  <th>P/D</th>
                  <th>S/.</th>
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




    </div>

  </div>

</div>

  <?php

  $eliminarPagoServicio = new ControladorServicios();
  $eliminarPagoServicio -> ctrEliminarPagoServicio();

?>


<script>
window.document.title = "Pago servicios"
</script>