<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Procesar comprobante electronico

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Procesar comprobante electronico</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <div class="col-md-2">
                    <select class="form-control selectpicker " data-live-search="true" name="selectDocumentoCE" id="selectDocumentoCE">
                        <option value="">SELECCIONAR DOCUMENTO</option>
                        <option value="E05">NOTAS CREDITO</option>
                        <option value="S02">BOLETAS VENTAS</option>
                        <option value="S03">FACTURAS</option>
                        <option value="S99">NOTAS DEBITO</option>
                    </select>
                </div>

                    
                <button class="btn btn-info btnVerToken" data-toggle="modal" data-target="#modalGenerarToken" onclick="showTime()">
                    <i class="fa fa-key"></i>
                    Generar token

                </button>

                <button class="btn btn-primary btnNuevaConsultaSunat" data-toggle="modal" data-target="#modalConsultarSunat" >
                    <i class="fa fa-search"></i>
                    Consulta SUNAT

                </button>
                                    
                <button type="button" class="btn btn-default pull-right" id="daterange-btnProcesarCE">
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


                    <button type="button" class="btn btn-success" id="regMesM" name="regMesM" data-toggle="modal" data-target="#modalRegMEs">Registro Ventas
                    </button>


            </div>

            <div class="box-body">
                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
                <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">

                <table class="table table-bordered table-hover dt-responsive tablaProcesarCE" width="100%">

                    <thead>

                        <tr>

                            <th>Tipo Documento</th>
                            <th>Documento</th>
                            <th>Total</th>
                            <th>Cod. Cliente</th>
                            <th>Nombre</th>
                            <th>Vendedor</th>
                            <th>Fec. Emisión</th>
                            <th>Doc. Origen</th>
                            <th>Estado</th>
                            <th>Agencia</th>
                            <th>Destino</th>
                            <th style="width:70px">Est. Envio</th>
                            <th style="width:102px">Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL GENERAR TOKEN
======================================-->

<div id="modalGenerarToken" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="formularioToken">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Generar token</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <div class="box-body" >

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              <label>RUC</label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" min="0" class="form-control input-md" name="nuevoRuc"  value="10472810371" readonly>

              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              <label>SERIE</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-md" name="nuevaSerie" value="af1e8535-d99a-4915-b515-91e36d9f71ae" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-6" style="padding-left:0px !important">
              <label>HORA INICIAL</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-md" name="nuevoInicio" id="nuevoInicio"  readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-6" style="padding-right:0px !important">
              <label>HORA FINAL</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-md" name="nuevoFin" id="nuevoFin"  readonly>

                <input type="hidden" id ="nuevaFechaToken" value="<?php echo date("d-m-Y");?>">
              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            <label>SERIE SECRET</label>
            <div class="form-group ">
              
              <div class="col-md-8"  style="padding-left:0px !important">
                <div class="input-group ">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-md" name="nuevaContrasena" value="MepGYmNzOeZ6EMMr2i0t4A==" readonly>
                

                </div>

              </div>
              

              <div class="col-md-4">
                <button type="button" class="btn btn-success btnGenerarToken" onclick="stopTime()"><i class="fa fa-play-circle-o"></i> Generar</button>
              </div>

              

            </div>


            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              <label>TOKEN</label>

            <textarea class="form-control input-md" name="nuevoCodigoToken" id = "nuevoCodigoToken" rows="12" readonly></textarea>


            </div>

            <!-- ENTRADA PARA LA DURACCION -->
            
            <div class="form-group ">
              <label>DURACIÓN</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-md" name="nuevaDuracion" id="nuevaDuracion"  readonly>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>


        </div>

      </form>


    </div>

  </div>

</div>


<!--=====================================
MODAL CONSULTAR SUNAT
======================================-->

<div id="modalConsultarSunat" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="formularioConsultaSunat" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Consultar SUNAT</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <div class="box-body" >

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group  col-lg-6" style="padding-left:0px">
              <label>TIPO DOCUMENTO</label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span> 

                <select class="form-control selectpicker " data-live-search="true" name="selectDocumentoConsulta" id="selectDocumentoConsulta">
                        <option value="">SELECCIONAR DOCUMENTO</option>
                        <option value="01">01-FACTURAS</option>
                        <option value="03">03-BOLETAS VENTAS</option>
                        <option value="07">07-NOTAS CREDITO</option>
                        <option value="08">08-NOTAS DEBITO</option>
                    </select>

              </div>

            </div>  
            
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-6"  style="padding-right:0px !important">
            <label>RUC</label>
              <div class="input-group ">
              
              <span class="input-group-addon"><i class="fa fa-user"></i></span> 

              <input type="text" maxlength="11" class="form-control input-md" name="nuevoRucConsulta" id="nuevoRucConsulta" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
              

              </div>
          
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-4" style="padding-left:0px">
              <label>SERIE</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-md info-box-text" name="nuevaSerieConsulta" id="nuevaSerieConsulta" maxlength="4">

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-8" style="padding-right:0px">
              <label>CORRELATIVO</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-md" name="nuevoCorrelativoConsulta" id="nuevoCorrelativoConsulta" maxlength="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57' >

              </div>

            </div>

            <div class="form-group col-lg-6" style="padding-left:0px">
              <label>FECHA EMISION</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-md" name="nuevaEmisionConsulta" id="nuevaEmisionConsulta" >

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            <label>MONTO</label>
            <div class="form-group col-lg-6"  style="padding-right:0px !important">
              <div class="input-group ">
              
              <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

              <input type="number" step="any" min="0" class="form-control input-md" name="nuevoMontoConsulta" id="nuevoMontoConsulta" >
              

              </div>
          
            </div>

            <div class="form-group col-lg-12" align="center">
                    

                <button type="button" class="btn btn-primary btnConsultarSunat"><i class="fa fa-search"></i> Consultar</button>
                <button type="button" class="btn btn-danger btnLimpiarConsultaSunat"><i class="fa fa-trash"></i> Limpiar</button>
              
            </div>
            <div class="loadingSunat col-lg-12" align="center"></div>

              <table class="table table-condensed table-bordered  consultaActivo hidden">
                <thead style="background:#3c8dbc; color:white">
                    <tr >
                      <td colspan="3" rowspan="2"><h4>Resultado de la Búsqueda</h4></td>
                    </tr>
                </thead>
                <tbody style="font-size:17px">
                    <tr>
                      <td><b>Estado del comprobante a la fecha de la consulta</b></td>
                      <td> : </td>
                      <td>ACEPTADO</td>
                    </tr>
                    <tr>
                      <td><b>Estado del contribuyente a la fecha de emision</b></td>
                      <td> : </td>
                      <td>ACTIVO</td>
                    </tr>
                    <tr>
                      <td><b>Condición de domicilio a la fecha de emisión</b></td>
                      <td> : </td>
                      <td>HABIDO</td>
                    </tr>

                </tbody>
              </table>

              <table class="table table-condensed table-bordered  consultaError hidden">
                <thead style="background:#3c8dbc; color:white">
                    <tr >
                      <td colspan="3" rowspan="2"><h4>Resultado de la Búsqueda</h4></td>
                    </tr>
                </thead>
                <tbody style="font-size:17px">
                    <tr>
                      <td><b>Estado del comprobante a la fecha de la consulta</b></td>
                      <td> : </td>
                      <td>NO EXISTE</td>
                    </tr>
                    <tr>
                      <td><b>Estado del contribuyente a la fecha de emision</b></td>
                      <td> : </td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <td><b>Condición de domicilio a la fecha de emisión</b></td>
                      <td> : </td>
                      <td>-</td>
                    </tr>

                </tbody>
              </table>
            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>


        </div>

      </form>


    </div>

  </div>

</div>

<!--=====================================
MODAL REGISTRO DE VENTAS
======================================-->

<div id="modalRegMEs" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="formularioRegistro">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Registro del Mes</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA PORCENTAJE -->

            <div class="form-group">
              
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>

                <input type="hidden" id="usuario" name="usuario" value = "<?php echo $_SESSION["id"]?>">

                  <select class="form-control input-sm selectpicker" id="regMes" name="regMes" data-live-search="true" required>

                    <option value="">Seleccionar Mes</option>

                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                    


                  </select>

              </div>

            </div>       

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="button" id="generarReg" name="generarReg" class="btn btn-primary btnGenerarReg">GENERAR</button>

        </div>

      </form>

    </div>

  </div>

</div>


<?php 
    $enviarFacturaXML = new ControladorFacturacion();
    $enviarFacturaXML -> ctrCrearFacturaXML();
?>

<?php
    $enviarNotaCreditoXML = new ControladorFacturacion();
    $enviarNotaCreditoXML -> ctrCrearNotaCreditoXML();
?>

<?php
    $enviarNotaDebitoXML = new ControladorFacturacion();
    $enviarNotaDebitoXML -> ctrCrearNotaDebitoXML();
?>

<script>
    window.document.title = "Procesar CE"
    
  var t;
  function showTime(){
    myDate = new Date();
    hours = myDate.getHours();
    minutes = myDate.getMinutes();
    seconds = myDate.getSeconds();
    if (hours < 10) hours = 0 + hours;
    if (minutes < 10) minutes = "0" + minutes;
    if (seconds < 10) seconds = "0" + seconds;
    $("#nuevoInicio").val(hours+ ":" +minutes+ ":" +seconds);
    $("#nuevoFin").val((hours+1)+ ":" +minutes+ ":" +seconds);
    t = setTimeout("showTime()", 1000);

    }
    function stopTime() {
      clearTimeout(t);
    }

   
</script>