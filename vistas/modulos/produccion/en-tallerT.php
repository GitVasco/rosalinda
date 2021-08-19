<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Talleres - TERMINADO

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Talleres - TERMINADO</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-12 col-md-12 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border">
            <button type="button" class="btn btn-info" id="asddadad" name="asddadad" data-toggle="modal" data-target="#fsdfsfsd">Asignar Trabajador
            </button>
            <button type="button" class="btn btn-outline-success btnReporteTallerTerminado" linea="" style="border:green 1px solid">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Taller Terminados</button>
            <button type="button" class="btn btn-default pull-right" id="daterange-btnTallerT">

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
          </div>

          <div class="box-body">
            <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
            <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">
            <table class="table table-bordered table-striped dt-responsive tablaTalleresT" width="100%">

              <thead>

                <tr>

                  <th>Id</th>
                  <th>Cod. Barra</th>
                  <th>Modelo</th>
                  <th>Color</th>
                  <th>Talla</th>
                  <th>Operación</th>
                  <th>Trabajador</th>
                  <th>Cantidad</th>
                  <th>Fecha Proceso</th>
                  <th>Fecha Terminado</th>
                  <th>Estado</th>
                  <th>Tiempo real</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>

      </div>

    </section>

  </div>

     

<!--=====================================
MODAL CONFIGURAR Trabajador
======================================-->

<div id="fsdfsfsd" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Asignar Trabajador</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group" align="center">

              <img src="vistas/img/plantilla/jackyform_paloma.png" width="400px" height="300px">

            </div>
            <!-- ENTRADA PARA PORCENTAJE -->

            <div class="form-group">
              
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>

                  <select class="form-control input-sm selectpicker" id="cod_tra" name="cod_tra" data-live-search="true" required>

                    <option value="">Seleccionar Trabajador</option>

                    <?php

                    $trabajador = ControladorTrabajador::ctrMostrarTrabajadorActivo();
                    #var_dump("trabajador", $trabajador);

                    foreach ($trabajador as $key => $value) {

                      echo '<option value="' . $value["cod_tra"] . '">' . $value["cod_tra"] . ' - ' . $value["nom_tra"] . ', ' . $value["ape_pat_tra"] . ' ' . $value["ape_mat_tra"] . '</option>';
                    }

                    ?>

                  </select>

              </div>

            </div>       

            <div class="form-group">

              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-barcode"></i></span>

                  <input type="text" class="form-control" id="codigoBarra" name="codigoBarra" placeholder="Ingresar Código" autofocus>

              </div>

            </div>                

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Asignar Trabajador</button>

        </div>

      </form>

        <?php

          $asignarTrabajador = new ControladorTalleres();
          $asignarTrabajador -> ctrAsignarTrabajador();

        ?>  


    </div>

  </div>

</div>


<div id="editarTallerT" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Asignar Trabajador</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group" align="center">
            

              <img src="vistas/img/plantilla/jackyform_paloma.png" width="400px" height="300px">

            </div>
            <div class="form-group col-lg-4">
            <label for="">Modelo</label>
              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                  <input type="text" class="form-control" id="editarModelo" readonly>

              </div>

            </div>  
            <div class="form-group col-lg-4">
            <label for="">Color</label>
              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                  <input type="text" class="form-control" id="editarColor" readonly>

              </div>

            </div>  
            <div class="form-group col-lg-4">
            <label for="">Talla</label>
              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                  <input type="text" class="form-control" id="editarTalla"  readonly>

              </div>

            </div>

            <div class="form-group col-lg-4">
            <label for="">Operacion</label>
              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                  <input type="text" class="form-control" id="editarCodOperacion"  readonly>

              </div>

            </div>

            <div class="form-group col-lg-8">
              <div style="margin-bottom:25px"></div>
              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                  <input type="text" class="form-control" id="editarOperacion"  readonly>

              </div>

            </div>  
            <!-- ENTRADA PARA PORCENTAJE -->

            <div class="form-group col-lg-12">
              <label for="">Trabajador</label>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>

                  <select class="form-control input-sm selectpicker" id="editar_cod_tra" name="cod_tra" data-live-search="true" required readonly>

                    <option value="">Seleccionar Trabajador</option>

                    <?php

                    $trabajador = ControladorTrabajador::ctrMostrarTrabajadorActivo();
                    #var_dump("trabajador", $trabajador);

                    foreach ($trabajador as $key => $value) {

                      echo '<option value="' . $value["cod_tra"] . '">' . $value["cod_tra"] . ' - ' . $value["nom_tra"] . ', ' . $value["ape_pat_tra"] . ' ' . $value["ape_mat_tra"] . '</option>';
                    }

                    ?>

                  </select>

              </div>

            </div>       

            <div class="form-group col-lg-12">
              <label for="">Codigo de barra</label>
              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-barcode"></i></span>

                  <input type="text" class="form-control" id="editar_codigoBarra" name="codigoBarra"  readonly>

              </div>

            </div>         
            <div class="form-group col-lg-12">
            <label for="">Fecha Proceso</label>                    
              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                  <input type="datetime" class="form-control" id="editarFechaProceso" name="editarFechaProceso" data-inputmask="'mask':'9999-99-99 99:99:99'" data-mask  required>

              </div>

            </div>       
            <div class="form-group col-lg-12">
            <label for="">Fecha Terminado</label>                    
              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                  <input type="datetime" class="form-control" id="editarFechaTerminado" name="editarFechaTerminado" data-inputmask="'mask':'9999-99-99 99:99:99'" data-mask required>

              </div>

            </div>     

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Asignar Trabajador</button>

        </div>

      </form>

        <?php

          $asignarTrabajador = new ControladorTalleres();
          $asignarTrabajador -> ctrAsignarTrabajador();

        ?>  


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR CANTIDAD
======================================-->

<div id="dividirTallerT" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Cantidad</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <input type="hidden" name="editarTaller" id="editarTaller">
            <input type="hidden" name="usuario" value="<?php echo $_SESSION["id"]; ?>">
            <input type="hidden" name="editarCodigo" id="editarCodigo">
            <input type="hidden" name="editarCodOperaciones" id="editarCodOperaciones">
            <input type="hidden" name="editarBarra" id="editarBarra">
            <input type="hidden" name="trabajador" id="trabajador">
            <input type="hidden" name="fecha_proceso" id="fecha_proceso">
            <input type="hidden" name="fecha_terminado" id="fecha_terminado">
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group col-lg-6">

              <label>Articulo</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarArticulo" name="editarArticulo" required readonly>

              </div>

            </div>

            <div class="form-group col-lg-6">

              <label>Nombre</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarNombre" name="editarNombre" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA OPERACION -->
            <div class="form-group col-lg-4">

              <label>Cod. Op</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarCOTT" name="editarCOTT"  readonly>

              </div>

            </div>

            <div class="form-group col-lg-8">

              <label>Operacion</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarOTT" name="editarOTT"  readonly>

              </div>

            </div>

            <div class="form-group col-lg-4">

              <label>Modelo</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarModelos" name="editarModelos" required readonly>

              </div>

            </div>

            <div class="form-group col-lg-4">

              <label>Color</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarColores" name="editarColores" required readonly>

              </div>

            </div>

            <div class="form-group col-lg-4">

              <label>Talla</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarTallas" name="editarTallas" required readonly>

              </div>

            </div>
            <div class="form-group col-lg-6">

              <label>Cantidad</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                <input type="number" class="form-control" id="cantidades" name="cantidades" required readonly>

              </div>

            </div>

            <div class="form-group col-lg-6">

              <label>Dividir Cantidad</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                <input type="number" class="form-control" id="editarCantidades" name="editarCantidades" required >

              </div>

            </div>

          </div>

        </div>

          <!--=====================================
        PIE DEL MODAL
        ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Editar Cantidad</button>

          </div>

      </form>

      <?php

      $editarCantidadTerminado = new ControladorTalleres();
      $editarCantidadTerminado->ctrEditarCantidadTerminado();

      ?>

    </div>

  </div>

</div>
<script>
window.document.title = "Talleres terminados"
</script>