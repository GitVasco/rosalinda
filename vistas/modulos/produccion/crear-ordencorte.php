<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear Orden de Corte

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear orden de corte</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioOrdenCorte">

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

                <!--=====================================
                ENTRADA DEL CODIGO INTERNO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php


                      $ult_codigo = ControladorOrdenCorte::ctrUltimoCodigoOC();

                      /* var_dump("ult_codigo", $ult_codigo); */

                      if(!$ult_codigo){

                        echo '<input type="text" class="form-control" id="nuevaOrdenCorte" name="nuevaOrdenCorte" value="1001" readonly>';


                      }else{

                        foreach ($ult_codigo as $key => $value) {
                                             
                        }

                        /* var_dump("prueba", $value["ultimo_codigo"]); */

                        $codigo = $value["ultimo_codigo"]+1;

                        /* var_dump("codigo", $codigo); */

                        echo '<input type="text" class="form-control" id="nuevaOrdenCorte" name="nuevaOrdenCorte" value="'.$codigo.'" readonly>';


                      }

                  ?>

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL ARTICULO
                ======================================-->

                <div class="form-group">

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                        <?php

                            $configuracion = controladorArticulos::ctrConfiguracion();

                            $urgencia = $configuracion["urgencia"];

                            /* var_dump("urgencia", $urgencia); */
                        
                            echo '<input type="number" class="form-control" id="configuracion" name="configuracion" value="'.$urgencia.'" step="any" readonly>';

                        ?>

                        <span class="input-group-addon">

                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalConfigurarUrgencia" data-dismiss="modal">Configurar Porcentaje</button>

                        </span>

                    </div>

                </div>

        
                <!--=====================================
                ENTRADA PARA AGREGAR MATERIAPRIMA
                ======================================-->

                <div class="form-group row nuevoArticuloOC" style="height:500px; overflow: scroll;">

                  <!--=====================================
                  ENTRADA BUSCADOR
                  ======================================-->

                  <span class="buscadorOc" id="elidOc">
                      <label>Buscar:</label>
                      <i class="fa fa-search"></i>
                      <input type="text" class="form-control input-sm" id="buscadorOc" name="buscadorOc">

                  </span>

                  <!--=====================================
                  TITULOS
                  ======================================-->

                  <div class="box box-primary">

                    <div class="row">

                      <div class="col-xs-6">

                        <label>Articulo</label>

                      </div>

                      <div class="col-xs-2">

                        <label for="">Ord. Corte</label>

                      </div>

                      <div class="col-xs-2">

                        <label for="">SinProg</label>

                      </div>

                      <div class="col-xs-2">

                        <label for="">Mes</label>

                      </div>

                    </div>

                  </div>

                </div>

                <input type="hidden" id="listaArticulosOC" name="listaArticulosOC">                

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

                            <input type="text" min="1" class="form-control input-lg" id="nuevoTotalOrdenCorte"
                              name="nuevoTotalOrdenCorte" total="" placeholder="0" readonly required>

                            <input type="hidden" name="totalOrdenCorte" id="totalOrdenCorte">


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

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>  Guardar Orden Corte</button>
              
              <a href="ordencorte" id="cancel" name="cancel" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

            $guardarOrdenCorte = new ControladorOrdenCorte();
            $guardarOrdenCorte -> ctrCrearOrdenCorte();

          ?>            
          

        </div>

      </div>

      <!--=====================================
      LA TABLA DE ARTICULOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped table-condensed tablaArticulosOrdenCorte" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">Add</th>
                  <th>Modelo</th>
                  <th>Color</th>
                  <th>Talla</th>
                  <th>Proy</th>
                  <th>Prod</th>
                  <th>Avance</th>
                  <th>Stock</th>
                  <th>Ped.</th>
                  <th>En Taller</th>
                  <th>Alm. Corte</th>
                  <th>Ord. Corte</th>
                  <th>Vtas 30d</th>
                  <th>Xprog</th>
                  
                </tr>

              </thead>



            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL CONFIGURAR % DE URGENCIAS
======================================-->

<div id="modalConfigurarUrgencia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Configurar Porcentaje</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA PORCENTAJE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tag"></i></span> 

                <select class="form-control input-lg" id="urgencia" name="urgencia" required>

                  <option value="">Selecionar Porcentaje</option>

                  <option value="100">100 %</option>

                  <option value="90">90 %</option>

                  <option value="80">80 %</option>

                  <option value="70">70 %</option>

                  <option value="60">60 %</option>

                  <option value="50">50 %</option>

                  <option value="40">40 %</option>

                  <option value="30">30 %</option>

                  <option value="20">20 %</option>

                  <option value="10">10 %</option>

                  <option value="0">0 %</option>
                
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

          <button type="submit" class="btn btn-primary">Confirmar Porcentaje</button>

        </div>

      </form>

      <?php

        $configurarUrgencia = new controladorArticulos();
        $configurarUrgencia -> ctrConfigurarUrgencia();

      ?>  


    </div>

  </div>

</div>


<script>
window.document.title = "Crear orden de corte"
</script>

<script>
$('.nuevoArticuloOC').ready(function(){
    $('#buscadorOc').keyup(function(){

    console.log("hola mundo");

    var nombres = $('.nuevaDescripcionProducto');
    //console.log(nombres.val())
    //console.log(nombres.length())

    var buscando = $(this).val();
    //console.log(buscando.length);

    var item='';

       for( var i = 0; i < nombres.length; i++ ){

        item = $(nombres[i]).val().toLowerCase();
        console.log(item);

            for(var x = 0; x < item.length; x++ ){

                if( buscando.length == 0 || item.indexOf( buscando ) > -1 ){

                    $(nombres[i]).parents('.munditoOC').show(); 

                }else{

                    $(nombres[i]).parents('.munditoOC').hide();

                }
            }
       }
    });
  });

</script>