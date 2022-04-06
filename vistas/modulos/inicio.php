<?php

#$valor = null;
#$respuesta = ControladorMantenimiento::ctrTraerCalendario($valor);
#var_dump($respuesta);

?>

    
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

                <div class="col-lg-7">

                    <?php

                        include "reportes/vtas-prod.php";

                    ?>

                </div>

            </div>
         
            <div class="row">

                <div class="col-lg-6">

                    <?php

                        //include "reportes/vtas-modA.php";

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

                <div class="col-lg-6">

                    <?php

                        include "reportes/modelos_vdos.php";

                    ?>

                </div>                


            </div>            

        </section>
    

    </div>




<script>

window.document.title = "Inicio"

$(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
        ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            }

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1070,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            })

        })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
        },
        //Random default events
        events: [

            <?php
                foreach ($respuesta as $key => $value) {

                    if($value["tipo"] == "Mantenimiento" || $value["tipo"] == "Cumpleaños"){

                        echo "{
                            title: '".$value["titulo"]."',
                            start: new Date(".$value["yi"].", ".$value["moi"].", ".$value["di"]."),
                            backgroundColor: '".$value["backgroundColor"]."',
                            borderColor: '".$value["borderColor"]."'
                        },";

                    }else if($value["tipo"] == "Capacitacion" || $value["tipo"] == "Reunion" || $value["tipo"] == "Actividades"){

                        echo "{
                            title: '".$value["titulo"]."',
                            start: new Date(".$value["yi"].", ".$value["moi"].", ".$value["di"].", ".$value["hi"].", ".$value["mi"]."),
                            end: new Date(".$value["yf"].", ".$value["mof"].", ".$value["df"].", ".$value["hf"].", ".$value["mf"]."),
                            backgroundColor: '".$value["backgroundColor"]."',
                            borderColor: '".$value["borderColor"]."'
                        },";

                    }
                    

                }

                #var_dump($respuesta);

            ?>
            
        ],

    })

})
</script>