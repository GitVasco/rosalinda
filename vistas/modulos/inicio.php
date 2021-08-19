    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Dashboard Mes Actual

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

                <?php

                    include "inicio/cajas-superiores.php";

                ?>

            </div>

            <div class="row">

                <div class="col-lg-12">

                    <?php

                        include "reportes/vtas-prod.php";

                    ?>

                </div>


            </div>
         
            <div class="row">

                <div class="col-lg-6">

                    <?php

                        include "reportes/vtas-modA.php";

                    ?>

                </div>


            </div>


        </section>
    
        <section class="content-header">

            <h1>
                Dashboard Mes Pasado
            </h1>
       
        </section>

        <section class="content">


            <div class="row">

                <?php

                    include "inicio/cajas-inferiores.php";

                ?>

            </div> 

            <div class="row">

                <div class="col-lg-6">

                    <?php

                        include "reportes/vtas-modP.php";

                    ?>

                </div>


            </div>            

        </section>
    

    </div>




