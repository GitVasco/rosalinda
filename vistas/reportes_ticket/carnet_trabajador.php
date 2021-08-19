<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket_v3.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
  <?php

    require_once "../../controladores/trabajador.controlador.php";
    require_once "../../modelos/trabajador.modelo.php";

  

    $respuesta = ControladorTrabajador::ctrMostrarTrabajador2Activo(null);
    //var_dump($respuesta["pedido"]);
    //var_dump($respuesta);


    date_default_timezone_set("America/Lima");

    //var_dump($respuesta["fecha"]);

    $newDay = date("d");
    $newMonth = date("m");
    $newYear = date("Y");

    if($newMonth == "01"){
        $mes="Enero";
    }else if($newMonth == "02"){
        $mes="Febrero";
    }else if($newMonth == "03"){
        $mes="Marzo";
    }else if($newMonth == "04"){
        $mes="Abril";
    }else if($newMonth == "05"){
        $mes="Mayo";
    }else if($newMonth == "06"){
        $mes="Junio";
    }else if($newMonth == "07"){
        $mes="Julio";
    }else if($newMonth == "08"){
        $mes="Agosto";
    }else if($newMonth == "09"){
        $mes="Septiembre";
    }else if($newMonth == "10"){
        $mes="Octubre";
    }else if($newMonth == "11"){
        $mes="Noviembre";
    }else{
        $mes="Diciembre";
    }

    
    //var_dump($newDate);

  ?>
  <div class="zona_impresion">
  <!-- codigo imprimir -->

    <table border="0" align="left" width="1300px">

    <thead>
    <tr style="height:400px;"></tr>
    <?php
        
        foreach ($respuesta as $key => $value) {
       echo
      '<tr>
        <div class="carnet fondo">
            <img src="../../vistas/img/plantilla/jackyform_paloma2.png" width="200px" height="100px">
            <p style="border:1px solid darkred; width:100%"></p>
            <img src="'.$value["imagen"].'" width="100px" height="150px">
            <p><b>'.$value["ape_pat"]." ".$value["ape_mat"].'<br>'.$value["nombres"].'</b></p>
            <p><b>D.N.I: '.$value["dni"].'</b></p>
            <p><b>'.$value["funcion"].'</b></p>

        </div>
        
        </tr>';

        }
        ?>
        
      
      

    </thead>

    </table>


  </div>
  <p>&nbsp;</p>

</body>

</html>
