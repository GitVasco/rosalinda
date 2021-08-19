<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket_v3.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
  <?php

    require_once "../../controladores/trabajador.controlador.php";
    require_once "../../modelos/trabajador.modelo.php";

    /* 
    * TRAEMOS LOS DATOS DEL PEDIDO
    */
    //var_dump($codigo);

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

    <?php 

     foreach ($respuesta as $key => $value) {
    ?>
    <table border="0" align="left" width="1000px" style="padding-left:100px">

    <thead>

      <tr style="height:100px">
      </tr>
      <tr style="height:200px">
        <td style="width:30%;text-align:left;"><?php echo "Lima: ".$newDay." de ".$mes." de ".$newYear; ?></td>
      </tr>

      <tr style="height:30px">
        <th style="width:20%;text-align:left;">Señor(a):</th>
      </tr>

      <tr>
        <td style="width:30%">A quien corresponda el presente.</td>
      </tr>

      <tr style="height:100px">

        <td style="width:60%;text-align:left;"><u>Referencia:</u> pase laboral para transitar a nivel nacional</td>

      </tr>

      <tr style="height:100px">

        <td style="width:50%;text-align:left;">Por medio de la presente, aprovechamos para saludarlo y comunicarle lo siguiente:</td>

      </tr>

      <tr>

        <td style="width:100%;text-align:justify;line-height:35px">Nuestra empresa CORPORACION VASCO con RUC N° 20513613939, pertenece al rubro de manufactura no primaria, cuyo objeto social es la producción textil, por lo que nuestra empresa se encuentra legalmente autorizada a continuar con la prestación de servicios, que encuentra respaldo en el <b>DECRETO SUPREMO N° 008-2021-PCM</b> norma, que en el segundo articulo resuelve que "las actividades económicas no contempladas en el presente articulo y sus aforos, se rigen según lo establecido en las fases de la reanudación de actividades económicas vigentes", considerando que la actividad desarrollada por nuestra empresa se encuentra incluida en la Reanudación de Actividades y cuenta con la autorización automática para iniciar operaciones, se emite el presente pase laboral para garantizar el libre tránsito del personal minimo que requerimos para continuar con nuestras operaciones. </td>
        
      </tr>

      <tr style="height:200px">
        <td style="width:100%;text-align:justify;line-height:35px">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp El portador del presente es un trabajador de nuestra Empresa <?php echo "<b>". $value["nombres"]." ".$value["ape_pat"]." ".$value["ape_mat"]."</b>"; ?>, quien esta facultado por las leyes del Estado de Emergencia como personal minimo e indispensable que nuestra Empresa ha determinado que necesita para mantener las operaciones indispensables de nuestra actividad empresarial.</td>
      </tr>

      <tr style="height:100px">
        <td style="width:100%;text-align:justify;">Atentamente.</td>
      </tr>
    </thead>

    </table>

<?php 
}
?>
  </div>
  <p>&nbsp;</p>

</body>

</html>
