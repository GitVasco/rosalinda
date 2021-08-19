<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear Corte

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear corte</li>

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

          <form role="form" method="post" class="formularioAlmacenCorte">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="usuario" name="usuario"
                      value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">                      

                  </div>

                </div>

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>

                    <input type="text" class="form-control" id="nuevaGuia" name="nuevaGuia" placeholder= "Guia de Corte.."required>                  

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CODIGO INTERNO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                      $ult_codigo = ControladorAlmacenCorte::ctrUltimoCodigoAC();

                      /* var_dump("ult_codigo", $ult_codigo); */

                      if(!$ult_codigo){

                        echo '<input type="text" class="form-control" id="nuevaAlmacenCorte" name="nuevaAlmacenCorte" value="1001" readonly>';


                      }else{

                        foreach ($ult_codigo as $key => $value) {
                                            
                        }

                        /* var_dump("prueba", $value["ultimo_codigo"]); */

                        $codigo = $ult_codigo["ultimo_codigo"]+1;

                        /* var_dump("codigo", $codigo); */

                        echo '<input type="text" class="form-control" id="nuevaAlmacenCorte" name="nuevaAlmacenCorte" value="'.$codigo.'" readonly>';


                      }


                  ?>

                  </div>

                </div>

                <!--=====================================
                TITULOS
                ======================================-->
                
                <div class="box box-primary">

                  <div class="row">

                      <div class="col-xs-3">

                          <label>OC</label>

                      </div>

                      <div class="col-xs-5">

                          <label>Artículo</label>

                      </div>

                      <div class="col-xs-2">

                          <label>Cantidad</label>

                      </div>

                      <div class="col-xs-2">

                          <label>Saldo</label>

                      </div>

                  </div>

                </div>
         
                <!--=====================================
                ENTRADA PARA AGREGAR MATERIAPRIMA
                ======================================-->

                <div class="form-group row nuevoArticuloAC">


                </div>

                <input type="hidden" id="listaArticulosAC" name="listaArticulosAC">
                <input type="hidden" id="listArticulo" name="listArticulo">
                <input type="hidden" id="listCantidad" name="listCantidad">                

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                  <div class="col-xs-6 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>Total</th>
                        </tr>

                      </thead>

                      <tbody>

                      <tr>

                        <td style="width: 50%">

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-scissors"></i></span>

                            <input type="text" min="1" class="form-control input-lg" id="nuevoTotalAlmacenCorte" name="nuevoTotalAlmacenCorte" total="" placeholder="0" readonly required>

                            <input type="hidden" name="totalAlmacenCorte" id="totalAlmacenCorte">


                          </div>

                        </td>

                      </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                BOTON GUARDAR
                ======================================-->

                <br>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>  Guardar Corte</button>
              
              <a href="almacencorte" id="cancel" name="cancel" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

          $crearAlmacenCorte = new ControladorAlmacenCorte();
          $crearAlmacenCorte -> ctrCrearAlmacenCorte();

          ?> 
          

        </div>

      </div>

      <!--=====================================
      LA TABLA DE ARTICULOS
      ======================================-->

      <div class="col-lg-5 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped table-condensed tablaArticulosAlmacenCorte" width="100%">

              <thead>

                <tr>
                  <th style="width:10px">Acciones</th>
                  <th>OC</th>
                  <th>Modelo</th>
                  <th>Color</th>
                  <th>Talla</th>
                  <th>Cantidad</th>
                  <th>Saldo</th>
                  <th>Alm. Corte</th>
                  
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
window.document.title = "Crear cortes"
</script>