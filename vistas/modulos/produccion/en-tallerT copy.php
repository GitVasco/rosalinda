<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Talleres - TERMINADO

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Talleres - TERMINADO</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">
    

      <div class="box-body">

        <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">

        <table class="table table-bordered table-striped dt-responsive tablaTalleresT">

          <thead>

            <tr>

              <th>Id</th>
              <th>Cob. Barra</th>
              <th>Modelo</th>
              <th>Color</th>
              <th>Talla</th>
              <th>Operación</th>
              <th>Trabajador</th>
              <th>Cantidad</th>
              <th>Fecha</th>
              <th>Estado</th>
              <th>Acciones</th>

            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL ASIGNAR TRABAJADOR
======================================-->

<div id="modalAsignarTrabajador" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

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

            <input type="hidden" name="usuario" value="<?php echo $_SESSION["id"]; ?>">

            <!-- ENTRADA PARA SELECCIONAR TRABAJADOR -->

            <div class="form-group col-lg-7">

              <label>Trabajador</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>

                <select class="form-control input-sm selectpicker" id="nuevoTrabajador" name="nuevoTrabajador" data-live-search="true" required>

                  <option value="">Seleccionar Trabajador</option>

                  <?php

                  $trabajador = ControladorTrabajador::ctrMostrarTrabajadorActivo();
                  #var_dump("trabajador", $trabajador);

                  foreach ($trabajador as $key => $value) {

                    echo '<option value="' . $value["cod_tra"] . '">' . $value["nom_tra"] . ', ' . $value["ape_pat_tra"] . ' ' . $value["ape_mat_tra"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL ARITCULO -->

            <div class="form-group col-lg-4">

              <label>Articulo</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control input-sm" id="nuevoArticulo" name="nuevoArticulo" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group col-lg-8">

              <label>Nombre</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control input-sm" id="nuevoNombre" name="nuevoNombre" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO -->

            <div class="form-group col-lg-4">

              <label>Modelo</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control input-sm" id="nuevoModelo" name="nuevoModelo" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL COLOR -->

            <div class="form-group col-lg-4">

              <label>Color</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control input-sm" id="nuevoColor" name="nuevoColor" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA TALLA -->

            <div class="form-group col-lg-4">

              <label>Talla</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control input-sm" id="nuevaTalla" name="nuevaTalla" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA CODIGO OPERACION -->

            <div class="form-group col-lg-4">

              <label>Cod. Operación</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                <input type="text" class="form-control input-sm" id="nuevoCodOperacion" name="nuevoCodOperacion" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA OPERACION -->

            <div class="form-group col-lg-8">

              <label>Operación</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                <input type="text" class="form-control input-sm" id="nuevaOperacion" name="nuevaOperacion" required readonly>

              </div>

            </div>

          </div>

          <!--=====================================
        PIE DEL MODAL
        ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Mandar</button>

          </div>

      </form>



    </div>

  </div>

</div>