<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];

require('coneccion.php');

$maquina = gethostname();
date_default_timezone_set('America/Guatemala');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
function SetProporcion(){
var relacion =document.getElementById("Relacion").value;
document.getElementById("Proporcion").value= 1/ relacion;
	}
</script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon -Nuevo detalle de medida</title>
<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	color: #000;
}
body {
	background-color: #FFFFFF;
}
.titulo {
	background-color:#CCC;
	}
</style>
</head>

<body>
<div class="titulo">
<center>
  <h1>Nuevo detalle de medida</h1></center>
</div>
<hr/>
<form id="formmarcanueva" name="formmarcanueva" method="POST" action=""> 
<table width="34%">
  <tr>
	<td width="65">Nombre</td>
	<td width="180">Relacion</td>
    <td width="65">Precio Costo</td>
	<td width="180">Precio Venta</td>
    <td width="180">Proporcion</td>
    </tr>
    <tr>
	<td width="65" height="27">
    <input value="" name="Nombre" type="text" /></td>  
	<td width="180">
    <input value="" name="Relacion" type="text" onblur="SetProporcion();" id="Relacion"/> </td>
    <td width="65" height="27">
    <input value="" name="PC" type="text" /></td>  
	<td width="180">
    <input value="" name="PV" type="text" /> </td>
    <td width="180">
    <input value="" name="Pr" type="text" disabled="disabled" id="Proporcion"/> </td>
    </tr>
</table>
   

<table width="987">
      <tr>
      <td><label for="Usuario">Usuario</label></td>
      <td>  <input readonly="readonly" value="<?php echo $usuario; ?>" name="Usuario" type="text" /> </td>
      <td><label for="Fecha de Creacion">Fecha de Creacion</label> </td>
      <td><input value="<?php $fecha = date('y-m-d h:i:s'); echo $fecha;
?>" name="FechaCreacion" type="datetime" readonly /> </td>
      <td><label for="MaqCrea">MaqCrea</label> </td>
      <td><input value="<?php echo $maquina; ?>" name="MaqCreacion" type="text" readonly/></td>
      </tr>
      </table>
      <p></p>
      <center><input class="bordes" type="submit" name="btn1" id="add" value="Agregar" /></center>
      </form>
      
      <?php 
	  $codigopr=$_GET["codigo"];
	  if(isset($_POST["btn1"])){
		 
	$btn=$_POST["btn1"];
	 if($btn=="Agregar"){
		$Nombre=$_POST["Nombre"];
		$Relacion=$_POST["Relacion"];	
		$PC=$_POST["PC"];
		$PV=$_POST["PV"];
		
		
		
		if ($Nombre != "" && $Relacion !="" && $PC!="" && $PV!=""){	
		$PR=1/$Relacion;
		
		$sqlIDdm = "SELECT max(Codigo_DetUniMed)+1 as codigo from ent_detunimed where IdPais_DetUniMedida='$paisEmpresa' and IdEmpr_DetUniMedida='$empresaID'";
		$maxM1=$mysqli->query($sqlIDdm); 
		while($row= $maxM1->fetch_assoc()){$bin = $row['codigo']; 
		if ($bin!=""){
			$Id = $row['codigo'];}
		else{$Id=1;}
		$Id;
		}
		 $AgregarQuery = "INSERT INTO `ent_detunimed`(`IdPais_DetUniMedida`, `IdEmpr_DetUniMedida`, `Id_DetUniMedida`, `Codigo_DetUniMed`, `Nombre_DetUniMed`, `Relacion_DetUniMed`, `ValUniCo_DetUniMed`, `ValUniVe_DetUniMed`, `Proporcion_DetUniMed`, `UsuarioCreacion_DetUniMed`, `MaquinaCrea_DetUniMed`, `FechaCreacion_DetUniMed`) VALUES ('$paisEmpresa','$empresaID','$Id','$codigopr','$Nombre','$Relacion','$PC','$PV','$PR','$usuario','$fecha','$maquina')";
     $respuestaInsert=$mysqli->query($AgregarQuery)or die ("Aun no se ha insertado ningun dato") ; 
	if ($respuestaInsert !=False ){
   
   echo "<script> alert('Éxito al Insertar')</script>";
	
}else{ 
    echo "Falló al Insertar "; 
}   
		}else{echo "LLene todos los campos";}
	 }
 
	  }
	 
	 ?>
</body>
</html>
<?php  
}
else
{
	 echo "<script> alert('Debes iniciar secion primero.')</script>";
	echo'<script> window.location="Index.HTML"</script>';
		
}

?>