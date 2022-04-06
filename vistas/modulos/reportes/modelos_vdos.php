<?php

$modelos = ControladorMovimientos::ctrMovMesFoto();
#var_dump($modelos);

?>

<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Modelos mas vendidos</h3>
    </div>

    <div class="box-body no-padding">
        <ul class="users-list clearfix">

            <?php
                
                foreach($modelos as $value){

                    echo'<li>
                            <img src="'.$value["imagen"].'" alt="User Image" width="150px">
                            <a class="users-list-name">'.$value["modelo"].'</a>
                            <span class="users-list-date">'.$value["nombre"].'</span>
                        </li>';

                }
            
            ?>

        </ul>

    </div>

</div>
