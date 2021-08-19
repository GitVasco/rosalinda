<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Corte

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Corte</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="crear-almacencorte">

          <button class="btn btn-primary">

            Agregar Corte

          </button>

        </a>
        <button class="btn btn-info btnVerCorteDeta"  data-toggle='modal' data-target='#modalVerCorteDeta'><i class="fa fa-eye"> </i> Visualizar Corte</button>
        <button type="button" class="btn btn-default pull-right" id="daterange-btnCortes">
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
      </div>

      <div class="box-body">

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">
        <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">
        
       <table class="table table-bordered table-striped dt-responsive tablaAlmacenCorte" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Corte</th>
           <th>Guia</th>
           <th>Responsable</th>
           <th><center>Cantidad Total</center></th>
           <th>Estado</th>
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
MODAL VISUALIZAR INFORMACION
======================================-->

<div id="modalVisualizarAC" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 55% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalle del Corte</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CODIGO DEL OC-->
            
            <div class="form-group col-lg-2">
              
              <label>Corte</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="almacencorte" id="almacencorte" required readonly></strong>

              </div>

            </div>

            
            <!-- ENTRADA PARA LA FECHA-->
            
            <div class="form-group col-lg-2">

              <label>Creación</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="fecha" id="fecha" required readonly></strong>

              </div>

            </div>   

            <!-- ENTRADA PARA LA GUIA-->
                        
            <div class="form-group col-lg-2">

              <label>N° Guia</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="guia" id="guia"  readonly></strong>

              </div>

            </div>    

            <!-- ENTRADA PARA LA RESPONSABLE-->
            
            <div class="form-group col-lg-2">

              <label>Responsable</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="nombre" id="nombre" required readonly></strong>

              </div>

            </div>            
   
            
            <!-- ENTRADA PARA LA CANTIDAD-->
            
            <div class="form-group col-lg-2">

              <label>Cantidad Total</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="cantidad" id="cantidad" required readonly></strong>

              </div>

            </div>
            
            <!-- ENTRADA PARA EL ESTADO-->
            
            <div class="form-group col-lg-2">

              <label>Estado</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="estado" id="estado" required readonly></strong>

              </div>

            </div>
                       
            <!-- TABLA DE DETALLES -->

            <div class="form-group col-lg-12">
            <label>TABLA DETALLES</label>
            </div>

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablaVerACDetalle" width="100%">

              <thead>

                <tr>
                  <th></th>
                  <th style="width:100px"></th>
                  <th></th>
                  <th style="width:250px"></th>
                  <th></th>
                  <th>S</th>
                  <th>M</th>
                  <th>L</th>
                  <th>XL</th>
                  <th>XXL</th>
                  <th>XS</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>

                <tr>
                  <th></th>
                  <th style="width:100px"></th>
                  <th></th>
                  <th style="width:250px"></th>
                  <th></th>
                  <th>28</th>
                  <th>30</th>
                  <th>32</th>
                  <th>34</th>
                  <th>36</th>
                  <th>38</th>
                  <th>40</th>
                  <th>42</th>
                  <th></th>
                </tr>

                <tr>
                  <th>Corte</th>
                  <th style="width:100px">Fecha</th>
                  <th>Modelo</th>
                  <th style="width:250px">Nombre</th>
                  <th>Color</th>
                  <th>3</th>
                  <th>4</th>
                  <th>6</th>
                  <th>8</th>
                  <th>10</th>
                  <th>12</th>
                  <th>14</th>
                  <th>16</th>
                  <th>Total</th>
                </tr>

                </thead>

                <tbody>



                </tbody>

              </table>

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

<div id="modalVerCorteDeta" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 60% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalle del Corte</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-header width-border">
            <button type="button" class="btn btn-default pull-right" id="daterange-btnVerCortes">
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
            </div>
            <!-- TABLA DE DETALLES -->

            <div class="form-group col-lg-12">
            <label>TABLA DETALLES</label>
            </div>

            <div class="box-body">


              <table class="table table-bordered table-striped dt-responsive tablaDetalleCorteTotal" width="100%">

              <thead>

                <tr>
                  <th></th>
                  <th  style="width:100px"></th>
                  <th ></th>
                  <th style="width:250px"></th>
                  <th></th>
                  <th>S</th>
                  <th>M</th>
                  <th>L</th>
                  <th>XL</th>
                  <th>XXL</th>
                  <th>XS</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>

                <tr>
                  <th></th>
                  <th style="width:100px"></th>
                  <th ></th>
                  <th style="width:250px"></th>
                  <th></th>
                  <th>28</th>
                  <th>30</th>
                  <th>32</th>
                  <th>34</th>
                  <th>36</th>
                  <th>38</th>
                  <th>40</th>
                  <th>42</th>
                  <th></th>
                </tr>

                <tr>
                  <th>Corte</th>
                  <th style="width:100px">Fecha</th>
                  <th>Modelo</th>
                  <th style="width:250px">Nombre</th>
                  <th>Color</th>
                  <th>3</th>
                  <th>4</th>
                  <th>6</th>
                  <th>8</th>
                  <th>10</th>
                  <th>12</th>
                  <th>14</th>
                  <th>16</th>
                  <th>Total</th>
                </tr>

                </thead>

                <tbody>



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
MODAL EDITAR TELA
======================================-->

<div id="modalEditarAC" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 90% !important;" > 

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Corte</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CODIGO DEL OC-->
            
            <div class="form-group col-lg-1">
              
              <label>Corte</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="almacencorteMP" id="almacencorteMP"  readonly></strong>

              </div>

            </div>
            <div class="col-lg-12"></div>
            <div id="telas" >
            </div>

            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
             
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary pull-right" >Guardar cambios</button>  
        </div>

      </form>

      <?php
        $editarTelaCorte = new ControladorAlmacenCorte();
        $editarTelaCorte -> ctrEditarTelaCorte();
      ?>
    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR NOTIFICACION
======================================-->

<div id="modalEditarNotificacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 90% !important;" > 

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar notificaciones corte</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CODIGO DEL OC-->
            
            <div class="form-group col-lg-1">
              
              <label>Corte</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="almacencorteNot" id="almacencorteNot"  readonly></strong>

              </div>

            </div>
            <div class="col-lg-12"></div>
            <div id="notificaciones" >
            </div>

            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
             
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary pull-right" >Guardar cambios</button>  
        </div>

      </form>

      <?php
        $editarNotificacionCorte = new ControladorAlmacenCorte();
        $editarNotificacionCorte -> ctrEditarNotificacionCorte();
      ?>
    </div>

  </div>

</div>

<script>
window.document.title = "Cortes"
</script>