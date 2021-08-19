<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Listar documentos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Listar documentos General</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaListarDocumentos" width="100%">

          <thead>

            <tr>
              <th>Id</th>
              <th>Tipo</th>
              <th>Documento</th>
              <th>Descripcion</th>
              <th>Origen</th>
              <th>Total</th>
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
MODAL VIZUALIZAR LISTA DE DOCUMENTOS
======================================-->

<div id="modalVisualizarDocumentos" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 70% !important;">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">VISUALIZAR DOCUMENTOS</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <!-- ENTRADA PARA EL TIPO-->

          <div class="form-group col-lg-3">
              
              <label>TIPO</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-text-width"></i></span> 

                <input type="text" class="form-control input-sm" name="tipo" id="tipo"  readonly>

              </div>

            </div>

            

            <!-- ENTRADA PARA EL DOCUMENTO-->
            
            <div class="form-group col-lg-3">

              <label>DOCUMENTO</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

                <input type="text" class="form-control input-sm" name="documento" id="documento"   readonly >

              </div>

            </div>   
        
   
            
            <!-- ENTRADA PARA LA DESCRIPCION -->
            
            <div class="form-group col-lg-3">

            <label>DESCRIPCION</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="descripcion" id="descripcion"  readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL ORIGEN-->
            
            <div class="form-group col-lg-3">

            <label>ORIGEN</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="origen" id="origen"  readonly>

              </div>

            </div>


            <!-- ENTRADA PARA EL TOTAL-->
            
            <div class="form-group col-lg-3">

            <label>TOTAL</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calculator"></i></span> 

                <input type="text" class="form-control input-sm" name="total" id="total"  readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA-->
            
            <div class="form-group col-lg-3">

            <label>FECHA</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-sm" name="fecha" id="fecha"  readonly>

              </div>

            </div>
            
            <!-- ENTRADA PARA EL ESTADO-->
            
            <div class="form-group col-lg-3">

            <label>ESTADO</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="estado" id="estado"  readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA TABLA DETALLE DE LISTAR DOCUMENTO-->
            <div class="form-group col-lg-12">
                <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaDetalleDocumento" width="100%">

                <thead>

                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
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
                    <th></th>
                    <th></th>
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
                    <th>Codigo</th>
                    <th>Modelo</th>
                    <th>Nombre</th>
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

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>


        </div>



    </div>

  </div>

</div>


<script>
window.document.title = "Listar Documentos"
</script>