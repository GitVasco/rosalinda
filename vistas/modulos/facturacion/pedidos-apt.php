<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Pedidos General

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Pedidos General</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="btn-group pull-left">

        <?php

          #$numero = ControladorMovimientos::ctrMostrarTalonario();

          $pedido = "";
          #$pedido = $numero["pedido"] + 1;
          #var_dump("pedido", $pedido);

          echo '<button class="btn btn-primary  btnCrearPedido" pedido="'.$pedido.'" title="Crear Pedido">

                  Crear Pedido

                </button>';


        ?>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class="btn btn-success  btnFacturados"  title="Ver Pedidos FACTURADOS">

            FACTURADOS

          </button>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class="btn btn-info  btnConfirmados"  title="Ver Pedidos CONFIRMADOS">

            CONFIRMADOS

          </button>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class="btn btn-default  btnAPT"  title="Ver Pedidos EN APT">

            EN APT

          </button>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class="btn btn-warning  btnAprobados" title="Ver Pedidos APROBADOS">

            APROBADOS

          </button>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class="btn btn-basic  btnGenerados" title="Ver Pedidos Generados">

            GENERADOS

          </button>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class='btn btnInicioPed' style='background-color:DarkSlateGray' title='inicio'>
            <i style='color:white'  class='fa fa-home'></i>
          </button>

        </div>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaPedidosAPT" width="100%">

          <thead>

            <tr>
              <th>Id</th>
              <th>Código</th>
              <th>Cod. Cliente</th>
              <th>Cliente</th>
              <th>Vendedor</th>
              <th>Total</th>
              <th>Condición de Venta</th>
              <th>Estado</th>
              <th>Usuario</th>
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
MODAL FACTURAR
======================================-->

<div id="modalFacturar" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 50% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Pasar Pedido a:</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="box box-primary col-lg-12 ">

            <div class="box-header">

              <b>Datos Principales</b>

            </div>

              <!-- ENTRADA PARA EL CODIGO DEL PEDIDO-->

              <div class="form-group col-lg-3">

                  <label>Cod. Pedido</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="codPedido" name="codPedido" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL NOMBRE DEL CLIENTE-->

              <div class="form-group col-lg-9">

                  <label>Cliente</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="nomCli" name="nomCli" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL codigo DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Cod. Cliente</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="codCli" name="codCli" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL TIPO DOCUMENTO DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Tipo Documento</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="tipDoc" name="tipDoc" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL NUMERO DOCUMENTO DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Nro. Documento</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="nroDoc" name="nroDoc" readonly>

                      <input type="hidden" class="form-control input-sm" name="dscto" id="dscto" readonly>
                      <input type="hidden" class="form-control input-sm" name="codVen" id="codVen" readonly>
                      <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

              </div>

            </div>

          <div class="box box-success col-lg-12 ">

            <div class="box-header">

              <b>Documento Destino</b>

            </div>

            <!-- ENTRADA PARA TIPO DE DOCUMENTO -->

            <div class="form-group col-lg-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-share-square-o"></i></span>
                <select type="text" class="form-control input-sm selectpicker" name="tdoc" id="tdoc" data-live-search="true"  required>
                  <option value="">Seleccionar tipo de documento</option>

                    <?php

                      $item="tipo_dato";
                      $valor = "tdoc";

                      $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);
                      foreach ($documentos as $key => $value) {
                        echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                      }

                    ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA NUMERO DE SERIE-->

            <div class="form-group col-lg-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <select type="text" class="form-control input-md" name="serie" id="serie" required>
                  <option value="">Seleccionar Serie</option>

                </select>

              </div>

            </div>

            <!-- CHECKBOX PARA SEPARAR DOCUMENTO -->

            <div class="form-group col-lg-6">

              <div class="form-group">

                <label>
                  <input class="chkFactura" type="checkbox" id="chkFactura" name="chkFactura" disabled>
                  Separar Factura
                </label>

                <label>
                  <input class="chkBoleta" type="checkbox" id="chkBoleta" name="chkBoleta" disabled>
                  Separar Boleta
                </label>

              </div>

            </div>

            <!-- ENTRADA PARA NUMERO DE SERIE DEL DOCUMENTO SEPARADO-->

            <div class="form-group col-lg-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <select type="text" class="form-control input-md" name="serieSeparado" id="serieSeparado" required disabled>
                  <option value="">Seleccionar Serie</option>

                </select>

              </div>

            </div>

          </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Generar Documento</button>

        </div>

      </form>

      <?php

      $facturar = new controladorFacturacion();
      $facturar->ctrFacturar();

      ?>

    </div>

  </div>

</div>

<script>
window.document.title = "Pedidos"
</script>