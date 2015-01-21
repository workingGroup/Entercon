<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];

$Opcion8 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='11'");
	
			if(mysqli_num_rows($Opcion8) > 0){
			$_SESSION['MAESTRO DE CLIENTES']=1;
		}else { $_SESSION['MAESTRO DE CLIENTES']=0; }
	if($_SESSION['MAESTRO DE CLIENTES']==1){

	$query="SELECT * FROM ent_maesprod where IdPais_MaesProd ='$paisEmpresa' &&  IdEmpr_MaesProd = '$empresaID' ";
	
	$resultado=$mysqli->query($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon-Manejo de Facturas</title>
<link href="css/PlantillaFacturas.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsFacturas.js"></script>
</head>

<body>

<div class="container">
  <div class="header">
    <h1>Reimprecion y Anulacion de Facturas</h1>
  </div>
  <div class="content">
  <div id="Tabla">
  	
  </div>

  </div>
   
  <div  align="center" class="footer">

    <form id="form2" name="form2" method="post" action="">
      <input class="bordes" type="submit" name="Imprimir" id="Imprimir" value="Reimprimir"  onclick="printcontent('printme')" />
       
        <input class="bordes" type="submit" name="Anular" id="Anular" value="Anular"  />
        
       <input class="bordes" type="submit" name="Salir" id="Salir" value="Salir"  />
      
    </form>
  </div>
  
  <!-- end .container --></div>
</body>
</html>
<?php  

}else{echo '<script> window.location="error.php"</script>'; } 
}
else
{
	 echo "<script> alert('Debes iniciar secion primero.')</script>";
	echo'<script> window.location="Index.HTML"</script>';
		
}

?>