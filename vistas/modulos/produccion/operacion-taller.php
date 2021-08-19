<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Talleres - Operación - Servicios 

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Talleres - Operación - Servicios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <div class="pull-right">
          <button type="button" class="btn btn-default btnReporteTallerOperacion" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Talleres Operacion Servicio</button>
        </div>
        <div class="col-lg-2">
              <select name="selectModeloTallerOp" id="selectModeloTallerOp" class="form-control input-lg selectpicker" data-live-search="true">
              <option value="">--------Seleccionar modelo-------</option>
              <?php 
                  $item=null;
                  $valor=null;
                  $modelos =ControladorModelos::ctrMostrarModelos($item,$valor);
                  foreach ($modelos as $key => $value) {
                    if($value["estado"] == 'Activo'){
                        echo '<option value="'.$value["modelo"].'">'.$value["modelo"]." - ". $value["nombre"].'</option>';
                    }
                  }
              ?>
              </select>
          </div>

          <div class="col-lg-1">
              <button class="btn btn-primary btnLimpiarModeloTallerOp"  name="btnLimpiarModeloTallerOp"><i class="fa fa-refresh"></i> Limpiar</button>
          </div>
      </div>
      <div class="box-body">

        <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">

        <table class="table table-bordered table-striped dt-responsive tablaTalleresOperaciones" width="100%">

          <thead>

            <tr>

              <th>Id</th>
              <th>Cob. Barra</th>
              <th>Modelo</th>
              <th>Color</th>
              <th>Talla</th>
              <th>Operación</th>
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
MODAL EDITAR CANTIDAD
======================================-->

<div id="modalEditarCantidadOperacion" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Cantidad Operacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <input type="hidden" name="editarTaller" id="editarTaller">
            <input type="hidden" name="usuario" value="<?php echo $_SESSION["id"]; ?>">
            <input type="hidden" name="editarCodigo" id="editarCodigo">
            <input type="hidden" name="editarCodOperacion" id="editarCodOperacion">
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

                <input type="text" class="form-control" id="editarCOTO" name="editarCOTO"  readonly>

              </div>

            </div>

            <div class="form-group col-lg-8">

              <label>Operacion</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarOTO" name="editarOTO"  readonly>

              </div>

            </div>


            <div class="form-group col-lg-4">

              <label>Modelo</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarModelo" name="editarModelo" required readonly>

              </div>

            </div>

            <div class="form-group col-lg-4">

              <label>Color</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarColor" name="editarColor" required readonly>

              </div>

            </div>

            <div class="form-group col-lg-4">

              <label>Talla</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                <input type="text" class="form-control" id="editarTalla" name="editarTalla" required readonly>

              </div>

            </div>
            <div class="form-group col-lg-6">

              <label>Cantidad</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                <input type="number" class="form-control" id="cantidad" name="cantidad" required readonly>

              </div>

            </div>

            <div class="form-group col-lg-6">

              <label>Dividir Cantidad</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                <input type="number" class="form-control" id="editarCantidad2" name="editarCantidad2" required >

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

      $editarCantidad = new ControladorTalleres();
      $editarCantidad->ctrEditarCantidadOperacion();

      ?>

    </div>

  </div>

</div>



<script>
window.document.title = "Talleres Op - Ser"
</script>