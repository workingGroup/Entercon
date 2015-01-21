<?php
require('coneccion.php');
$filename = "C:\\\\reporte\\\Marcas" . time() . ".CSV";
try

       { $sqldata = "SELECT * FROM ent_maesmarca into outfIle'$filename' FIELDS TERMINATED BY ',' ENCLOSED BY '' LINES TERMINATED BY '\n'" ;
  $resultado= $mysqli->query($sqldata);
}catch(Exception $e)
        {
 echo 'este es el puto error por el que me desvele'.$e;
 }
echo $sqldata;

?>