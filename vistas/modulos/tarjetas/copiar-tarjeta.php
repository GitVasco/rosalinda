<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Editar tarjeta

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Editar tarjeta</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-7 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioMateriaPrima">

            <div class="box-body">

              <div class="box">

              <?php

                    $item = "id";
                    $valor = $_GET["idTarjeta"];

                    $tarjeta = ControladorTarjetas::ctrMostrarTarjetas($item, $valor);

                    /* 
                    ! ver que trae tarjeta
                    */
                    /* var_dump("tarjeta", $tarjeta); */
   
                    
                    $porcentajeImpuesto = number_format($tarjeta["impuesto"] * 100 / $tarjeta["neto"],0);
                    
                    date_default_timezone_set('America/Lima');
                    $ahora=date('Y/m/d h:i:s');
                    
                    
                ?>              

                <!--=====================================
                ENTRADA DEL USUARIO
                ======================================-->

                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoUsuario" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                    <input type="hidden" name="fechaActual" value="<?php echo $ahora; ?>">

                    <input type="hidden" name="tarjetaOrigen" value="<?php echo $tarjeta["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CODIGO
                ======================================-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php


                      $ult_codigo = ControladorTarjetas::ctrUltimoCodigoTarjeta();

                      if(!$ult_codigo){

                        echo '<input type="text" class="form-control" id="copiarTarjeta" name="copiarTarjeta" value="10001" readonly>';


                      }else{

                        foreach ($ult_codigo as $key => $value) {
                          
                          
                        
                        }

                        $codigo = $value["ultimo_codigo"]+1;

                        /* 
                        ! como esta sumando el codigo
                        */

                        /* var_dump("ultimo_codigo", $ult_codigo);
                        var_dump("ultimo_codigo", $codigo); */



                        echo '<input type="text" class="form-control" id="copiarTarjeta" name="copiarTarjeta" value="'.$codigo.'" readonly>';


                      }

                  ?>
               
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL ARTICULO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon" id="spanAddon"><i class="fa fa-users"></i></span>

                    <select class="form-control selectpicker" id="seleccionarArticulo" name="seleccionarArticulo" data-live-search="true" required>

                      <option value="">Seleccionar articulo</option>

                      <?php

                        $articulos = controladorArticulos::ctrMostrarSinTarjeta();

                        foreach ($articulos as $key => $value) {

                          echo '<option value="'.$value["articulo"].'">'.$value["packing"].'</option>';

                        }

                      ?>                      

                    </select>

                  </div>

                </div>

                <!--=====================================
                TITULOS
                ======================================-->
                
                <div class="box box-primary">

                  <div class="row">

                    <div class="col-xs-6">

                      <label>Materia Prima</label>

                    </div>

                    <div class="col-xs-2">

                      <label for="">Tej. Principal</label>

                    </div>

                    <div class="col-xs-2">

                      <label for="">Consumo</label>

                    </div>

                    <div class="col-xs-2">

                      <label for="">Costo</label>

                    </div>

                  </div>

                </div>
             

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                <div class="form-group row nuevaMateriaPrima">

                <?php

                # Traemos los detalles de la venta que se desea editar
                $listaProductos=ControladorTarjetas::ctrMostrarDetallesTarjetas("articulo",$tarjeta["articulo"]);

                /* 
                ! ver si llegar el codigo del articulo y que trae lista productos
                */
                /* var_dump("articulo", $tarjeta["articulo"]); */
                /* var_dump("listaProductos", $listaProductos); */
                
                foreach($listaProductos as $key=>$value){

                  # Traemos el dato de cada producto
                  $infoProducto=ControladorMateriaPrima::ctrMostrarMateriaPrima($value["mat_pri"]);

                  /* 
                  ! que captura infoproducto
                  */

                  /* var_dump("infoproducto", $infoProducto); */
                   
                 
                  echo '<div class="row" style="padding:5px 15px">

                  <div class="col-xs-6" style="padding-right:0px">

                    <div class="input-group">
 
                      <span class="input-group-addon input-sm"><button type="button" class="btn btn-danger btn-xs quitarMP" idMateriaPrima="'.$infoProducto["codpro"].'"><i class="fa fa-times"></i></button></span>

                      <input type="text" class="form-control input-sm nuevaDescripcionProducto" idMateriaPrima="'.$infoProducto["codpro"].'" name="agregarProducto" value="'.$infoProducto["descripcion"].'" codigoP="'.$infoProducto["codpro"].'" readonly required>

                    </div>

                  </div>

                  <div class="col-xs-2">

                    <input type="text" class="form-control input-sm tejidoPrincipal" name="tejidoPrincipal" min="0" value="'.$value["tej_princ"].'" required>

                  </div>                  

                  <div class="col-xs-2">

                    <input type="number" class="form-control input-sm nuevaCantidadProducto" name="nuevaCantidadProducto" min="0" value="'.$value["consumo"].'" step="any" required>

                  </div>

                  <div class="col-xs-2 ingresoPrecio" style="padding-left:0px">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-money"></i></span>

                      <input type="text" class="form-control input-sm nuevoPrecioProducto" precioReal="'.$value["precio_mp"].'" name="nuevoPrecioProducto" value="'.$value["total_detalle"].'" readonly required>

                    </div>

                  </div>

                </div>';                  


                }


                ?>


                </div>

                <input type="hidden" id="listaMP" name="listaMP">   

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 50%">

                          <div class="input-group">
                           
                           <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoTarjeta" name="nuevoImpuestoTarjeta" value="<?php echo $porcentajeImpuesto; ?>" required>

                            <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $tarjeta["impuesto"]; ?>" required>

                            <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $tarjeta["neto"]; ?>" required>

                           <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                     
                         </div>

                          </td>

                          <td style="width: 50%">

                          <div class="input-group">
                           
                           <span class="input-group-addon"><i class="fa fa-money"></i></span>

                           <input type="text" class="form-control input-lg" id="nuevoTotalTarjeta" name="nuevoTotalTarjeta" total="<?php echo $tarjeta["neto"]; ?>"  value="<?php echo $tarjeta["total"]; ?>" readonly required>

                           <input type="hidden" name="totalTarjeta" value="<?php echo $tarjeta["total"]; ?>" id="totalTarjeta">
                           
                     
                         </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <br>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>  Guardar Cambios</button>

              <a href="tarjetas" id="cancel" name="cancel" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>

            </div>

          </form>

          <?php

            $copiarTarjeta = new ControladorTarjetas();
            $copiarTarjeta -> ctrCopiarTarjetas();

          ?>                 

     

        </div>

      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-5 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped table-condensed tablaMateriaPrimaTarjetas" width="100%">

              <thead>

                <tr>
                  <th>Cod. Línea</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Color</th>
                  <th>Unidad</th>
                  <th>Acciones</th>
                </tr>

              </thead>


            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>

<script>
window.document.title = "Copiar tarjetas"
</script>