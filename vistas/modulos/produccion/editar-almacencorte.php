<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Editar Corte

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Editar corte</li>

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
                <?php 
                    $valor = $_GET["codigo"];

                    $almacenCorte = ControladorAlmacenCorte::ctrMostrarAlmacenCorte($valor);

                    //var_dump($almacenCorte);
                ?>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="editarUsuario" name="editarUsuario"
                      value="<?php echo $almacenCorte["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">                      

                  </div>

                </div>

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>

                    <input type="text" class="form-control" id="editarGuia" name="editarGuia" value="<?php echo $almacenCorte["guia"]?>" required>                  

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CODIGO INTERNO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

             
                        <input type="text" class="form-control" id="editarAlmacenCorte" name="editarAlmacenCorte" value="<?php echo $almacenCorte["codigo"]?>" readonly>


                  </div>

                  

                </div>

                <!--=====================================
                  ENTRADA BUSCADOR
                  ======================================-->

                  <div class=" form-group buscador" id="elid" style="padding-bottom:25px">
                    <label for="" class="col-form-label col-lg-1">Buscar:</label>
                    <div class="col-lg-11">
                        <div class="input-group">
                            
                            <input type="text" class="form-control " id="buscadorAc" name="buscadorAc"/>
                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        </div>
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
                ENTRADA PARA AGREGAR ARTICULO
                ======================================-->

                <div class="form-group row nuevoArticuloAC" style="height:400px;overflow: scroll; overflow-x:hidden">
                  <?php

                    $item = "almacencorte";
                    $valor = $almacenCorte["codigo"];
                    $listaArticuloCorte= ControladorAlmacenCorte::ctrMostrarDetallesAlmacenCorte($item,$valor);

                    // var_dump($listaArticuloCorte);

                    foreach ($listaArticuloCorte as $key => $value) {

                        $infoProducto=controladorArticulos::ctrMostrarArticulos($value["articulo"]);

                        $saldoAntiguo = $value["saldo"] + $value["cantidad"];
                        $almacenAntiguo = $infoProducto["alm_corte"]-$value["cantidad"];
                        

                        echo '<div class="row munditoAC" style="padding:5px 15px">
    
                        <div class="col-xs-3" style="padding-right:0px">
    
                            <div class="input-group">
                            
                                <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarAC" idCorte="'.$value["detordencorte"].'"><i class="fa fa-times"></i></button></span>
    
                                <input type="text" class="form-control nuevoAlmacenCorte"   name="nrooc" value="N° - '.$value["ordencorte"].'" idCorte="'.$value["detordencorte"].'" ordcorte="'.$value["ordencorte"].'" readonly required>
    
                            </div>
    
                        </div>
    
                        <div class="col-xs-5" style="padding-right:0px">                     
    
                                <input type="text" class="form-control nuevaDescripcionProducto" articuloAC="'.$infoProducto["articulo"].'" name="agregarAC" value="'.$infoProducto["packing"].'" codigoAC="'.$infoProducto["articulo"].'" readonly required>                       
    
                        </div>
    
                        <div class="col-xs-2">
    
                            <input type="number" class="form-control nuevaCantidadArticuloAC" name="nuevaCantidadArticuloAC" min="1" value="'.$value["cantidad"].'" ordcorte="'.$value["ordencorte"].'" saldo="'.$saldoAntiguo.'" nuevoSaldo="'.$value["saldo"].'" alm_corte="'.$almacenAntiguo.'" nuevoAlmCorte="'.$value["cantidad"].'" cantidad = "'.$value["cantidad"].'" nuevaCantidad = "0" required>
    
                        </div>
    
                        <div class="col-xs-2 ingresoSaldo">
    
                            <input type="number" class="form-control nuevaCantidadSaldo" name="nuevaCantidadSaldo" saldoReal="'.$saldoAntiguo.'" nuevoSaldoP="'.$value["saldo"].'" value="'.$value["saldo"].'" readonly required>
    
                        </div>                    
                    
                    </div>';
                    }
                  ?>

                </div>

                <input type="hidden" id="listaArticulosAC" name="listaArticulosAC">
                <input type="hidden" id="listArticulo" name="listArticulo">
                

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

                            <input type="text" min="1" class="form-control input-lg" id="nuevoTotalAlmacenCorte" name="nuevoTotalAlmacenCorte" total="<?php echo $almacenCorte["total"]?>" value="<?php echo $almacenCorte["total"]?>" placeholder="0" readonly required>

                            <input type="hidden" name="totalAlmacenCorte" id="totalAlmacenCorte" value="<?php echo $almacenCorte["total"]?>">


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

          $editarAlmacenCorte = new ControladorAlmacenCorte();
          $editarAlmacenCorte -> ctrEditarAlmacenCorte();

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
window.document.title = "Editar cortes"
</script>

<script>
$('.nuevoArticuloAC').ready(function(){
    $('#buscadorAc').keyup(function(){


    var nombres = $('.nuevaDescripcionProducto');
    //console.log(nombres.val())
    //console.log(nombres.length())

    var buscando = $(this).val();
    //console.log(buscando.length);

    var item='';

       for( var i = 0; i < nombres.length; i++ ){

        item = $(nombres[i]).val();
        item2 = $(nombres[i]).val().toLowerCase();
        // console.log(item);

            for(var x = 0; x < item.length; x++ ){

                if( buscando.length == 0 || item.indexOf( buscando ) > -1 || item2.indexOf( buscando ) > -1 ){

                    $(nombres[i]).parents('.munditoAC').show(); 

                }else{

                    $(nombres[i]).parents('.munditoAC').hide();

                }
            }

          
       }

       
    });
  });

</script>