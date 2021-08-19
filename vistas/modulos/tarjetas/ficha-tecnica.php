<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar fichas tecnicas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Fichas tecnicas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <button type="button" class="btn btn-default pull-right" id="daterange-btnFichas">
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
        <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
        <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">
        <table class="table table-bordered table-striped dt-responsive tablaFichaTecnica" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Ficha tecnica</th>
           <th>Codigo</th>
           <th>Modelo</th>
           <th>Archivo</th>
           <th>Fecha de Cambio</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>


        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<script>
window.document.title = "Fichas tecnicas"
</script>