<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar notas de credito/debito
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar notas de credito/debito</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a class="btn btn-primary" href="notas-credito">
          
          Agregar notas de credito/debito

        </a>

        <button type="button" class="btn btn-default pull-right" id="daterange-btnNotasCD">
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
        
       <table class="table table-bordered table-striped dt-responsive tablaNotaCredito" width="100%">
         
        <thead>
         
         <tr>
           <th>N° </th>
           <th>Tipo doc.</th>
           <th>documento</th>
           <th>Total</th>
           <th>Cliente</th>
           <th>Fecha</th>
           <th>Usuario</th>
           <th>Estado</th>
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
window.document.title = "Notas de credito/debito"
</script>