<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
     Notas de crédito / débito, facturas y boletas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Notas de crédito / débito, facturas y boletas</li>
    
    </ol>

  </section>
    <section class="container-fluid col-lg-4">
        <div class="box">
            <div class="box-body">
                <form method="post">
                    <div class="form-check">
                    <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input optNotas1" id="radio1" name="optNotas1" value="credito" > Notas de Crédito
                    </label>
                    </div>
                    <br>
                    <div class="form-check">
                    <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input optNotas1" id="radio2" name="optNotas1" value="debido"> Notas de Débito
                    </label>
                    </div>
                </form>
            </div>
        
        </div>

    </section>

    <section class="container-fluid col-lg-4">
                 
        <div class="box">
            <div class="box-body">
            
                <div class="form-group">
                <label for=""  class="col-form-label col-lg-4">N° Serie</label>
                <div class="col-lg-8">
                <select class="form-control input-md selectpicker" id="tipoNotaSerie" name="tipoNotaSerie" data-live-search="true">
                    <option value="">Seleccionar serie</option>

                    </select>
                </div>
                    
                </div>

                <div class="form-group" style="padding-top:25px">
                    <label for="" class="col-form-label col-lg-4">N° Documento</label>
                    <div class="col-lg-8">
                    <input type="text" name="tipoNotaDocumento" id="tipoNotaDocumento"  class="form-control input-md" value="0" readonly>
                    </div>
                    
                </div>
            </div>  

        </div>

    </section>

    

    <section class="container-fluid col-lg-4 text-center">
        <div class="box">
            <div class="box-body">
                <div  style="border:2px solid darkred">
                <img src="vistas/img/plantilla/jackyform_paloma.png" width="300px" height="80px">
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid">
    <div class="col-lg-9">
        <div class="box box-danger col-lg-6">
            <div class="form-group col-lg-6" style="margin-top:23px">
            <label for="" class="col-form-label col-lg-2">Cliente</label>
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <select class="form-control input-md selectpicker" data-live-search="true" name="selectNotaCliente" id="selectNotaCliente">
                    <option value="">Seleccionar cliente</option>

                        <?php

                        $item=null;
                        $valor = null;

                        $clientes = ControladorClientes::ctrMostrarClientes($item,$valor);
                        foreach ($clientes as $key => $value) {
                            echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " .$value["nombre"]. '</option>';
                        }

                        ?>
                    </select>

                </div>
            </div>

            <?php 
            date_default_timezone_set("America/Lima");
            $fecha= new Datetime();
            $fechaActual = $fecha->format("Y-m-d");
            
            ?>           
            <div class="form-group  col-lg-offset-2 col-lg-4" style="margin-top:23px">
            <label for="" class="col-form-label col-lg-3">Fecha</label>
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                    <input type="date"  class="form-control input-md" name="notaFecha" id="notaFecha" value="<?php echo $fechaActual?>" required>

                </div>
            </div>
            <div class="col-lg-12"></div>

            <div class="form-check col-lg-2">
                <label class="form-check-label" for="radioCtaCte">
                    Genera cta. cte. <input type="checkbox" class="form-check-input generaCtaCte" id="radioCtaCte" name="generaCtaCte" value="generaCta" disabled> 
                </label>
            </div>            

            <div class="form-group col-lg-4">
            <label for=" " class="col-form-label col-lg-3">Vendedor</label>
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <select class="form-control input-md selectpicker" data-live-search="true" name="selectNotaVendedor" id="selectNotaVendedor">
                    <option value="">Seleccionar vendedor</option>
                    <?php

                        $item=null;
                        $valor = null;

                        $clientes = ControladorVendedores::ctrMostrarVendedores($item,$valor);
                        foreach ($clientes as $key => $value) {
                            echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " .$value["descripcion"]. '</option>';
                        }

                        ?>
                    </select>

                </div>
            </div>

            <div class="form-group col-lg-4 col-lg-offset-2">
            <label for="" class="col-form-label col-lg-3">Tipo Doc</label>
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <select class="form-control input-md selectpicker" data-live-search="true" name="selectNotaDocumento" id="selectNotaDocumento">
                    <option value="">Seleccionar documento</option>

                    <?php
                      $item= "tipo_dato";
                      $valor = "tdoc";

                    $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);

                    foreach ($documentos as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                    }

                    ?>   
                    </select>

                </div>
            </div>
            

            <div class="form-group col-lg-3">
            <label for="">N° Fact/Bol</label>
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                    <input type="text"  class="form-control input-md" name="notaNroFactura" id="notaNroFactura" required>

                </div>
            </div>

            <div class="form-group col-lg-3">
            <label for="">Fecha fact.</label>
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                    <input type="date"  class="form-control input-md" name="notaFechaFactura" id="notaFechaFactura" required>

                </div>
            </div>

            <div class="form-group col-lg-3">
            <label for="">Motivo</label>
                

                    <select  class="form-control input-md selectpicker" name="notaMotivo" id="notaMotivo" data-live-search="true" style="width:200px !important" required>
                    <option value="">Seleccionar motivo</option>
                    <?php
                    //   $item= "tipo_dato";
                    //   $valor = "TMOT";

                    // $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);

                    // foreach ($documentos as $key => $value) {
                    //   echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                    // }

                    ?>   
                    </select>

            </div>

            
            <div class="form-group col-lg-3">
            <label for="">Tipo cont.</label>
                

                    <select  class="form-control input-md selectpicker" name="notaTipoCont" id="notaTipoCont" data-live-search="true" required>
                    <option value="">Seleccionar tipo contable</option>
                    <?php
                      $item= "tipo_dato";
                      $valor = "TCON";

                    $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);

                    foreach ($documentos as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                    }

                    ?>   
                    </select>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="box col-lg-4 ">

            <div class="  col-lg-12" style="margin-top:23px">
                <label for="" class="col-form-label col-lg-6">Sub - Total: </label>
                <div class="input-group">
                    <input type="number"  class="form-control input-sm text-right" name="notaSubTotal" id="notaSubTotal" step ="any" min="0">

                </div>
            </div>

            <div class="  col-lg-12">
                <label for="" class="col-form-label col-lg-6">Descuentos: </label>
                <div class="input-group">
                    <input type="number"  class="form-control input-sm text-right" name="notaDsctos" id="notaDsctos" step ="any" min="0" value="0.00">

                </div>
            </div>
            <div class=" col-lg-12">
                <label for="" class="col-form-label col-lg-6">Flete: </label>
                <div class="input-group">
                    <input type="number"  class="form-control input-sm text-right" name="notaFlete" id="notaFlete" step ="any" min="0" value="0.00">

                </div>
            </div>
            <div class="col-lg-12">
                <label for="" class="col-form-label col-lg-6">Otros:</label>
                <div class="input-group">
                    <input type="number"  class="form-control input-sm text-right" name="notaOtros" id="notaOtros" step ="any" min="0" value="0.00">

                </div>
            </div>

            <div class=" col-lg-12">
                <label for="" class="col-form-label col-lg-4">IGV: </label>
                <div class="input-group">
                <div class="col-lg-5">
                  <input type="number"  class="form-control input-sm text-right" name="IGV" id="IGV" value="18.00" step ="any" min="0" readonly>
                </div>

                <div class="col-lg-6">
                <input type="number"  class="form-control input-sm text-right" name="notaIGV" id="notaIGV" step ="any" min="0" value="0.00" readonly>
                </div>
                </div>
            </div>

            <div class=" col-lg-12">
                <label for="" class="col-form-label col-lg-6">No afecto: </label>
                <div class="input-group">
                    <input type="number"  class="form-control input-sm text-right" name="notaNoAfecto" id="notaNoAfecto" step ="any" min="0" value="0.00">

                </div>
            </div>
            <hr>
            <div class=" col-lg-12" style="margin-bottom:23px">
                <label for="" class="col-form-label col-lg-6">Total:</label>
                <div class="input-group">
                    <input type="number"  class="form-control input-sm text-right" name="notaTotal" id="notaTotal" step ="any" min="0" value="0.00" readonly>
                    <input type="hidden" name="notaUsuario" id ="notaUsuario" value="<?php echo $_SESSION["id"]?>">
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 " style="position:relative;bottom:70px">
        <div class="box col-lg-9 ">

            <div class="form-group">
            <label for="">Detalle</label>
                <textarea class="form-control" rows="8" name="notaTexto" id="notaTexto"></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
    </div>
    <div class="col-lg-12" style="position:relative;bottom:60px">
        <div class="col-lg-3"></div>
        <div class="form-group col-lg-1">
            <button class="btn btn-success btn-lg btnGuardarNotaCredito"><i class="fa fa-save"></i> Guardar</button>
        </div>

        <div class="form-group col-lg-1">
            <button class="btn btn-warning btn-lg  btnAnularNotaCredito"><i class="fa fa-window-close-o"></i> Anular</button>
        </div>

        <div class="form-group col-lg-1">
            <button class="btn btn-danger btn-lg  btnEliminarNotaCredito"><i class="fa fa-times"></i> Eliminar</button>
        </div>

        <div class="form-group col-lg-1">
            <button class="btn btn-success btn-lg  btnImprimirNotaCredito" tipo="" documento="" disabled><i class="fa fa-print" ></i> Imprimir</button>
        </div>

        <div class="form-group col-lg-1">
            <button class="btn btn-danger btn-lg  btnTerminarNotaCredito"><i class="fa fa-play-circle-o"></i> Terminar</button>
        </div>
    </div>
    </section>
</div>


<script>
window.document.title = "Notas de crédito"
</script>