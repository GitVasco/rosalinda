<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Talleres - GENERADOS

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Talleres - GENERADOS</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header width-border">
            <div class="col-lg-2">
                <select name="selectArticuloTallerP" id="selectArticuloTallerP" class="form-control input-lg selectpicker" data-live-search="true" data-size="10">
                <option value="">--------Seleccionar articulo-------</option>
                <?php 
                    $articulos =controladorArticulos::ctrMostrarArticulosTallerP();
                    foreach ($articulos as $key => $value) {
                            echo '<option value="'.$value["articulo"].'">'.$value["modelo"]." - ". $value["color"]." - " .$value["talla"].'</option>';
                       
                    }
                ?>
                </select>
            </div>

            <div class="col-lg-1">
                <button class="btn btn-primary btnLimpiarArticuloTallerP"  name="btnLimpiarArticuloTallerP"><i class="fa fa-refresh"></i> Limpiar</button>
            </div>
            <div class="col-lg-2">
            <a href="operacion-taller"  class="btn btn-success"><i class="fa fa-text-height"></i> Talleres Operaciones Ser.</a>
            </div>
            <div class="pull-right">
              <button type="button" class="btn btn-outline-success btnReporteTallerGenerado" linea="" style="border:green 1px solid">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Taller Generados</button>
            </div>
      </div>

      <div class="box-body">

        <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">

        <table class="table table-bordered table-striped dt-responsive tablaTalleresGenerado" width="100%">

          <thead>

            <tr>

            <th>Id</th>
            <th>Cod. Barra</th>
            <th>Modelo</th>
            <th>Color</th>
            <th>Talla</th>
            <th>Operación</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Acciones</th>

            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL EDITAR CANTIDAD
======================================-->

<div id="dividirTallerGenerado" class="modal fade" role="dialog">

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

                <input type="text" class="form-control" id="editarCOTP" name="editarCOTP"  readonly>

              </div>

            </div>

            <div class="form-group col-lg-8">

              <label>Operacion</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarOTP" name="editarOTP"  readonly>

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

      $editarCantidadGenerado = new ControladorTalleres();
      $editarCantidadGenerado->ctrEditarCantidadGenerado();

      ?>

    </div>

  </div>

</div>

<div id="regresarTallerGenerado" class="modal fade" role="dialog">

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

            <input type="hidden" name="regresarTaller" id="regresarTaller">
            <input type="hidden" name="usuario" value="<?php echo $_SESSION["id"]; ?>">
            <input type="hidden" name="regresarCodigo" id="regresarCodigo">
            <input type="hidden" name="regresarCodOperaciones" id="regresarCodOperaciones">
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group col-lg-6">

              <label>Articulo</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="regresarArticulo" name="regresarArticulo" required readonly>

              </div>

            </div>

            <div class="form-group col-lg-6">

              <label>Nombre</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="regresarNombre" name="regresarNombre" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA OPERACION -->
            <div class="form-group col-lg-4">

              <label>Cod. Op</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="regresarCOTP" name="regresarCOTP"  readonly>

              </div>

            </div>

            <div class="form-group col-lg-8">

              <label>Operacion</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="regresarOTP" name="regresarOTP"  readonly>

              </div>

            </div>

            <div class="form-group col-lg-4">

              <label>Modelo</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="regresarModelos" name="regresarModelos" required readonly>

              </div>

            </div>

            <div class="form-group col-lg-4">

              <label>Color</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="regresarColores" name="regresarColores" required readonly>

              </div>

            </div>

            <div class="form-group col-lg-4">

              <label>Talla</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="regresarTallas" name="regresarTallas" required readonly>
                

              </div>

            </div>
            <div class="form-group col-lg-6">

              <label>Origen</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                <input type="text" class="form-control" id="regresarBarra" name="regresarBarra" required readonly>
                <input type="hidden"  id="regresarBarraAntigua" name="regresarBarraAntigua"  >
              </div>

            </div>

            <div class="form-group col-lg-6">

              <label>Cantidad</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                <input type="number" class="form-control" id="regresarCantidades" name="regresarCantidades" readonly >

              </div>

            </div>

          </div>

        </div>

          <!--=====================================
        PIE DEL MODAL
        ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Regresar Cantidad</button>

          </div>

      </form>

      <?php

      $regresarCantidadGenerado = new ControladorTalleres();
      $regresarCantidadGenerado->ctrRegresarCantidadGenerado();


      ?>

    </div>

  </div>

</div>
<script>
window.document.title = "Talleres generados"
</script>