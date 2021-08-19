<div class="content-wrapper">
    <h2>Ejemplo: Leer Archivos Excel con PHP</h2>   
      <div class="content-header">
        <h3 class="panel-title">Resultados de archivo de Excel.</h3>
      </div>
      <section class="content">
        <div class="box">
          <div class="box-body">
            
<?php
include "/Classes/PHPExcel.php";
$archivo = "ListaPersonal.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
?>
<table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Area</th>
          <th>Pais</th>
        </tr>
      </thead>
      <tbody>
<?php
$num=0;
for ($row = 2; $row <= $highestRow; $row++){ $num++;?>
       <tr>
          <th scope='row'><?php echo $num;?></th>
          <td><?php echo $sheet->getCell("A".$row)->getValue();?></td>
          <td><?php echo $sheet->getCell("B".$row)->getValue();?></td>
          <td><?php echo $sheet->getCell("C".$row)->getValue();?></td>
          <td><?php echo $sheet->getCell("D".$row)->getValue();?></td>
        </tr>
    <?php    
}
?>
         </tbody>
    </table>
  </div>  
 </section>   
</div>