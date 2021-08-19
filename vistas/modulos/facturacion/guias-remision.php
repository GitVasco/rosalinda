<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar Guias de Remisión

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar Guias de Remisión</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaGuiasRemision" width="100%">

                    <thead>

                        <tr>

                            <th>Tipo Documento</th>
                            <th>Documento</th>
                            <th>Total</th>
                            <th>Cod. Cliente</th>
                            <th>Nombre</th>
                            <th>Vendedor</th>
                            <th>Fec. Emisión</th>
                            <th>Doc. Destino</th>
                            <th>Estado</th>
                            <th>Agencia</th>
                            <th>Destino</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL FACTURAR A
======================================-->

<div id="modalFacturarA" class="modal fade" role="dialog">

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

                                <label>Guia de Remisión</label>

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
                                    <input type="hidden" class="form-control input-sm" name="codVen" id="codVen"
                                        readonly>
                                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                                </div>

                            </div>

                        </div>

                        <div class="box box-success col-lg-12 ">

                            <div class="box-header">

                                <b>Documento Destino</b>

                            </div>
                            <!-- ENTRADA PARA EL CODIGO DEL PEDIDO-->

                            <div class="form-group col-lg-3">

                                <label>Serie</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-sm" id="serieDest" name="serieDest" readonly>

                                </div>

                            </div>

                            <!-- ENTRADA PARA EL NOMBRE DEL CLIENTE-->

                            <div class="form-group col-lg-4">

                                <label>Número</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-sm" id="docDest" name="docDest" readonly>

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

            $guiaRemision = new controladorFacturacion();
            $guiaRemision->ctrFacturarGuia();

            ?>

        </div>

    </div>

</div>

<!--=====================================
MODAL FACTURAR B
======================================-->

<div id="modalFacturarB" class="modal fade" role="dialog">

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

                      <input type="text" class="form-control input-sm" id="codPedidoB" name="codPedidoB" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL NOMBRE DEL CLIENTE-->

              <div class="form-group col-lg-9">

                  <label>Cliente</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="nomCliB" name="nomCliB" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL codigo DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Cod. Cliente</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="codCliB" name="codCliB" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL TIPO DOCUMENTO DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Tipo Documento</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="tipDocB" name="tipDocB" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL NUMERO DOCUMENTO DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Nro. Documento</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="nroDocB" name="nroDocB" readonly>
                      <input type="hidden" class="form-control input-sm" name="codVenB" id="codVenB" readonly>
                      <input type="hidden" name="idUsuarioB" id="idUsuarioB" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

              </div>

            </div>

          <div class="box box-success col-lg-12 ">

            <div class="box-header">

              <b>Documento Destino</b>

            </div>

            <!-- CHECKBOX PARA SEPARAR DOCUMENTO -->

            <div class="form-group col-lg-6">

              <div class="form-group">

                <label>
                  <input class="chkFacturaB" type="checkbox" id="chkFacturaB" name="chkFacturaB">
                  Separar Factura
                </label>

                <label>
                  <input class="chkBoletaB" type="checkbox" id="chkBoletaB" name="chkBoletaB">
                  Separar Boleta
                </label>

              </div>

            </div>

            <!-- ENTRADA PARA NUMERO DE SERIE DEL DOCUMENTO SEPARADO-->

            <div class="form-group col-lg-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <select type="text" class="form-control input-md" name="serieSeparadoB" id="serieSeparadoB" required disabled>
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

      $facturarB = new controladorFacturacion();
      $facturarB->ctrFacturarB();

      ?>

    </div>

  </div>

</div>

<script>
    window.document.title = "Guias de Remisión"
</script>