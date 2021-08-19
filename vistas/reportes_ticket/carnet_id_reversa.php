<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket_v3.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
  <?php

    require_once "../../controladores/trabajador.controlador.php";
    require_once "../../modelos/trabajador.modelo.php";

  $codigo = $_GET["codigo"];

    $respuesta = ControladorTrabajador::ctrMostrarTrabajador2($codigo);
    //var_dump($respuesta["pedido"]);
    //var_dump($respuesta);


    date_default_timezone_set("America/Lima");

    //var_dump($respuesta["fecha"]);

    $newDay = date("d");
    $newMonth = date("m");
    $newYear = date("Y");

    if($newMonth == "01"){
        $mes="Enero";
    }if($newMonth == "02"){
        $mes="Febrero";
    }if($newMonth == "03"){
        $mes="Marzo";
    }if($newMonth == "04"){
        $mes="Abril";
    }if($newMonth == "05"){
        $mes="Mayo";
    }if($newMonth == "06"){
        $mes="Junio";
    }if($newMonth == "07"){
        $mes="Julio";
    }if($newMonth == "08"){
        $mes="Agosto";
    }if($newMonth == "09"){
        $mes="Septiembre";
    }if($newMonth == "10"){
        $mes="Octubre";
    }if($newMonth == "11"){
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
        
       echo
      '<tr>
        <div class="carnet" style="text-align:center;font-size:15px;line-height:10px;">
            <br>
            <br>
            <br>
            <br>
            <br>
            <p><b> PERSONAL E INTRANSFERIBLE </b></p>
            <br>
            <br>
            <p><b>EN CASO DE EXTRAVIO,</b></p>
            <p><b>AGRADECEREMOS LLAMAR</b></p>
            <p><b>TELEFONO: 537-2501 / 536-0646</b></p>
            <p><b>AGRADECEREMOS LLAMAR</b></p>
            <p><b>O DEVOLVER A LA EMPRESA:</b></p>
            <p><b>CORPORACION VASCO</b></p>
            <p><b>CALLE SANTO TORIBIO #259 - </b></p>
            <p><b>URB. SANTA LUISA - S.M.P. </b></p>

        </div>
        </tr>';

        ?>
        
      
      

    </thead>

    </table>


  </div>
  <p>&nbsp;</p>

</body>

</html>
