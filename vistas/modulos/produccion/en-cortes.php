<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Almacén de corte

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Almacén de corte</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <div class="col-lg-2">
          <select name="selectModeloCorte" id="selectModeloCorte" class="form-control input-lg selectpicker" data-live-search="true" data-size="10">
          <option value="">--------Seleccionar modelo-------</option>
          <?php 
            $item=null;
            $valor=null;

            $modelo =ControladorModelos::ctrMostrarModelos($item,$valor);
            foreach ($modelo as $key => $value) {
              echo '<option value="'.$value["modelo"].'">'.$value["modelo"]." - ". $value["nombre"].'</option>';
            }
          ?>
          </select>
        </div>
        <div class="col-lg-2">
        <button class="btn btn-primary btnLimpiarModeloCorte"  name="btnLimpiarModeloCorte"><i class="fa fa-refresh"></i> Limpiar</button>
        </div>
        
        <button class="btn btn-outline-success pull-right btnReporteAlmacen"  style="border:green 1px solid">
                      <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Almacén de corte  </button>
      </div>
      <div class="box-body">

        <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">

        <table class="table table-bordered table-striped dt-responsive tablaCortes" width="100%">

        <thead>

            <tr>

                <th></th>
                <th></th>
                <th></th>
                <th style="text-align: center">S</th>
                <th style="text-align: center">M</th>
                <th style="text-align: center">L</th>
                <th style="text-align: center">XL</th>
                <th style="text-align: center">XXL</th>
                <th style="text-align: center">XS</th>
                <th style="text-align: center"></th>
                <th style="text-align: center"></th>
                <th></th>

            </tr>

            <tr>

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

            </tr>

            <tr>

                <th><center>Modelo</center></th>
                <th>Nombre</th>
                <th>Color</th>
                <th style="text-align: center">3</th>
                <th style="text-align: center">4</th>
                <th style="text-align: center">6</th>
                <th style="text-align: center">8</th>
                <th style="text-align: center">10</th>
                <th style="text-align: center">12</th>
                <th style="text-align: center">14</th>
                <th style="text-align: center">16</th>
                <th><center>Total</center></th>

            </tr>

        </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL MANDAR A TALLER
======================================-->

<div id="modalMandarTaller" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Mandar a Taller</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <input type="hidden" name="usuario" value="<?php echo $_SESSION["id"]; ?>">

            <input type="hidden" name="precio_doc" id="precio_doc">

            <input type="hidden" name="tiempo_stand" id="tiempo_stand">

            <input type="hidden" name="precio_total" id="precio_total">

            <input type="hidden" name="tiempo_total" id="tiempo_total">

            <input type="hidden" name="nuevoCorte" id="nuevoCorte">

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

            <!-- ENTRADA PARA EL TOTAL DEL CORTE -->

            <div class="form-group col-lg-12">

              <div>
                <label >Enviar a talleres</label>
              </div>
              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="almCorte" name="almCorte" min="0" placeholder="Por enviar" required readonly>

                </div>

              </div>

              <!-- ENTRADA PARA EL TOTAL DEL CORTE -->

              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" id="nuevoAlmCorte" name="nuevoAlmCorte" min="0" max="" placeholder="Mandar" required>

                </div>

                

              </div>

              
            </div>

            <div class="form-group col-lg-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="imprimirTicket" name="ticket" checked>
                <label class="form-check-label" for="imprimirTicket">
                  Imprimir Tickets
                </label>
              </div>
            </div>

            <div class="col-lg-12"></div>
            <!--=====================================
            ENTRADA DEL SECTOR
            ======================================-->

            <div class="form-group col-lg-12 campoSector hidden ">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control selectpicker " id="seleccionarSectorServicio" name="seleccionarSectorServicio" data-live-search="true" >

                  <option value="">Seleccionar sector</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $sectores = ControladorSectores::ctrMostrarSectores($item, $valor);

                  foreach ($sectores as $key => $value) {

                    echo '<option value="'.$value["cod_sector"].'">'.$value["cod_sector"]." - ".$value["nom_sector"].'</option>';

                  }

                  ?>

                </select>

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

      <?php

      $mandarTaller = new ControladorCortes();
      $mandarTaller->ctrMandarTaller();

      ?>

    </div>

  </div>

</div>
</div>

<script>
window.document.title = "Almacen de corte"
</script>