
<div class="content-wrapper">
<title>Analisis</title>
<section class="content-header">
    <h1>
        Dashboard

        <small>Página de control</small>

    </h1>

    <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

        <li class="active">Dashboard</li>

    </ol>

</section>


<section class="content">

    <div class="col-lg-12">

        <?php


            echo '<div class="box box-success">

                    <div class="box-header">

                        <h1>Bienvenid@ ' .$_SESSION["nombre"].'</h1>

                    </div>

                 </div>';


        ?>

    </div>    

    <div class="row">

        <div class="col-lg-6">

            <?php

                include "reportes/vtas-ano.php";

            ?>

        </div>




        <div class="col-lg-6">

            <?php

                include "reportes/pagos-ano.php";

            ?>

        </div>


    </div>
    
    
</section>

</div>

<script>
window.document.title = "Analisis"
</script>


