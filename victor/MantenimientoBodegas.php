<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');
$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];

$Opcion4 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='4'");
	$rowOpcion4=$Opcion4->fetch_assoc();
	
			if(mysqli_num_rows($Opcion4) > 0){
			$_SESSION['Permiso4']=$rowOpcion4['TipoPermiso_RoleXOpcion'];
			$_SESSION['MAESTRO DE BODEGAS']=1;
		}else { $_SESSION['MAESTRO DE BODEGAS']=0; }

if($_SESSION['MAESTRO DE BODEGAS']==1){

$querySeleccion="SELECT * FROM ent_maesbode where Id_MaesEmpr='$empresaID' && Id_MaesPais ='$paisEmpresa' ORDER BY Id_MaesBode asc LIMIT 1 ";	
$resultadoSeleccion=$mysqli->query($querySeleccion);
$rowSeleccion=$resultadoSeleccion->fetch_assoc();

$id = $rowSeleccion['Id_MaesBode'];
$nombre = $rowSeleccion['Nombre_MaesBode'];
$direccion = $rowSeleccion['Direccion_MaesBode'];
$telefonos = $rowSeleccion['Telefono_MaesBode'];	
$fax = $rowSeleccion['Fax_MaesBode'];
$email= $rowSeleccion['Email_MaesBode'];
$encargado = $rowSeleccion['Encargado_MaesBode'];

$usuario = $rowSeleccion['Usuario_MaesBode'];
$fecha = $rowSeleccion['FechaCreacion_MaesBode'];	
$maquina= $rowSeleccion['MaquinaCreacion_MaesBode'];
$estado=$rowSeleccion['Estatus_MaesBode'];

if(isset($_POST["btn2"])){
$buscar=$_POST["btn2"];

//////////Buscar

if ($buscar=="Buscar"){
$idbuscar =$_POST["Buscar"];
$querySeleccion="SELECT * FROM ent_maesbode where Id_MaesEmpr='$empresaID' && Id_MaesPais ='$paisEmpresa' && Id_MaesBode ='$idbuscar'  or  Id_MaesEmpr='$empresaID' && Id_MaesPais ='$paisEmpresa' && Nombre_MaesBode ='$idbuscar'  ";	
$resultadoSeleccion=$mysqli->query($querySeleccion);
$rowSeleccion=$resultadoSeleccion->fetch_assoc();
if ($rowSeleccion !=""){
$id = $rowSeleccion['Id_MaesBode'];
$nombre = $rowSeleccion['Nombre_MaesBode'];
$direccion = $rowSeleccion['Direccion_MaesBode'];
$telefonos = $rowSeleccion['Telefono_MaesBode'];	
$fax = $rowSeleccion['Fax_MaesBode'];
$email= $rowSeleccion['Email_MaesBode'];
$encargado = $rowSeleccion['Encargado_MaesBode'];

$usuario = $rowSeleccion['Usuario_MaesBode'];
$fecha = $rowSeleccion['FechaCreacion_MaesBode'];	
$maquina= $rowSeleccion['MaquinaCreacion_MaesBode'];
$estado=$rowSeleccion['Estatus_MaesBode'];

}else {echo "<script> alert('No hay resultados para tu busqueda')</script>"; }
}

}

 if(isset($_POST["btn1"])){
$accion=$_POST["btn1"];


///////////final
if ($accion=="Final"){
$FinalQuery = "SELECT MAX(Id_MaesBode)as idmax FROM ent_maesbode where Id_MaesEmpr='$empresaID' && Id_MaesPais ='$paisEmpresa'";
$respuestaFinal=$mysqli->query($FinalQuery);
$rowFinal=$respuestaFinal->fetch_assoc();
$maxID= $rowFinal['idmax'];

$query="SELECT * FROM ent_maesbode where Id_MaesEmpr='$empresaID' && Id_MaesPais ='$paisEmpresa' && Id_MaesBode = '$maxID' ";	
$resultado=$mysqli->query($query);
$row=$resultado->fetch_assoc();


$id = $row['Id_MaesBode'];
$nombre = $row['Nombre_MaesBode'];
$direccion = $row['Direccion_MaesBode'];
$telefonos = $row['Telefono_MaesBode'];	
$fax = $row['Fax_MaesBode'];
$email= $row['Email_MaesBode'];
$encargado = $row['Encargado_MaesBode'];

$usuario = $row['Usuario_MaesBode'];
$fecha = $row['FechaCreacion_MaesBode'];	
$maquina= $row['MaquinaCreacion_MaesBode'];
$estado=$row['Estatus_MaesBode'];	
}


///Siguiente	
 if ($accion=="Siguiente"){
			$valorIdSiguiente = $_POST["ID"];
			 $SiguienteQuery="SELECT * FROM ent_maesbode WHERE Id_MaesBode > '$valorIdSiguiente' && Id_MaesEmpr='$empresaID' && Id_MaesPais ='$paisEmpresa' ORDER BY Id_MaesBode asc LIMIT 1 " ;
	 $respuestaSiguiente=$mysqli->query($SiguienteQuery);
		$rowSiguiente=$respuestaSiguiente->fetch_assoc();
			if ($rowSiguiente['Id_MaesBode'] !=""){
			
$id = $rowSiguiente['Id_MaesBode'];
$nombre = $rowSiguiente['Nombre_MaesBode'];
$direccion = $rowSiguiente['Direccion_MaesBode'];
$telefonos = $rowSiguiente['Telefono_MaesBode'];	
$fax = $rowSiguiente['Fax_MaesBode'];
$email= $rowSiguiente['Email_MaesBode'];
$encargado = $rowSiguiente['Encargado_MaesBode'];

$usuario = $rowSiguiente['Usuario_MaesBode'];
$fecha = $rowSiguiente['FechaCreacion_MaesBode'];	
$maquina= $rowSiguiente['MaquinaCreacion_MaesBode'];
 $estado=$rowSiguiente['Estatus_MaesBode']; 
			
			}
	}	  
			 
//previo	 
if ($accion=="Previo"){
			$valorIdPrevio = $_POST["ID"];
			 $PrevioQuery="SELECT * FROM ent_maesbode WHERE Id_MaesBode < '$valorIdPrevio' && Id_MaesEmpr='$empresaID' && Id_MaesPais ='$paisEmpresa' ORDER BY Id_MaesBode desc LIMIT 1 ";
			 $respuestaPrevio=$mysqli->query($PrevioQuery);
			 $rowPrevio=$respuestaPrevio->fetch_assoc();
			 
$id = $rowPrevio['Id_MaesBode'];
$nombre = $rowPrevio['Nombre_MaesBode'];
$direccion = $rowPrevio['Direccion_MaesBode'];
$telefonos = $rowPrevio['Telefono_MaesBode'];	
$fax = $rowPrevio['Fax_MaesBode'];
$email= $rowPrevio['Email_MaesBode'];
$encargado = $rowPrevio['Encargado_MaesBode'];

$usuario = $rowPrevio['Usuario_MaesBode'];
$fecha = $rowPrevio['FechaCreacion_MaesBode'];	
$maquina= $rowPrevio['MaquinaCreacion_MaesBode'];
$estado=$rowPrevio['Estatus_MaesBode'];
			 
			 }
//inicio 
if ($accion =="inicio"){
	$inicioQuery ="SELECT Min(Id_MaesBode)as idmin FROM ent_maesbode where Id_MaesPais='$paisEmpresa' && Id_MaesEmpr= '$empresaID'";
	$respuestaInicio = $mysqli->query($inicioQuery);
	$row=$respuestaInicio->fetch_assoc();
	$minID= $row['idmin'];
	
	
	$queryinicio="SELECT * FROM ent_maesbode where Id_MaesEmpr='$empresaID' && Id_MaesPais ='$paisEmpresa' && Id_MaesBode = '$minID' ";	
$resultadoinicio=$mysqli->query($queryinicio);
$rowinicio=$resultadoinicio->fetch_assoc();

$id = $rowinicio['Id_MaesBode'];
$nombre = $rowinicio['Nombre_MaesBode'];
$direccion = $rowinicio['Direccion_MaesBode'];
$telefonos = $rowinicio['Telefono_MaesBode'];	
$fax = $rowinicio['Fax_MaesBode'];
$email= $rowinicio['Email_MaesBode'];
$encargado = $rowinicio['Encargado_MaesBode'];

$usuario = $rowinicio['Usuario_MaesBode'];
$fecha = $rowinicio['FechaCreacion_MaesBode'];	
$maquina= $rowinicio['MaquinaCreacion_MaesBode'];
$estado=$rowinicio['Estatus_MaesBode'];	
	}


 }



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon-Mantenimiento Bodegas</title>
<link href="css/PlantillaMantenimiento - Bodegas.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
</head>
<script> 
  function printcontent(el){
	  var resetearpagina  = document.body.innerHTML;
	  var Printcontent = document.getElementById(el).innerHTML;
	  document.body.innerHTML = Printcontent;
	  window.print();
	  document.body.innerHTML = restorepage;
  }
  </script>
  
<body>

<div class="container">
  <div class="header">
    <h2> Mantenimiento de Bodegas</h2>
    <h6 align="right">
     <form id="form3" name="form3" method="POST" action=""> 
    <input value="" name="Buscar" type="text" />
    <input type="submit" name="btn2"  value="Buscar" />
    </form>
    </h6>
    </div>
  <div class="content">
<div class="content" id="printme" >
  <form id="form3" name="form3" method="POST" action=""> 
<table width="34%">
	<tr>
	<td width="20"> <label for="ID Marca">ID </label></td>
	<td width="30"> <input value="<?php echo $id; ?>" name="ID" type="text" readonly/> </td>
    </tr>
    <tr>
	<td width="20" height="27"><label for="Nombre">Nombre</label></td>
	<td width="30"> <input value="<?php echo $nombre;?>" name="Nombre" type="text" readonly /> </td>
    <tr>
	<td width="20"> <label for="ID Marca">Direccion</label></td>
	<td width="30"> <input value="<?php echo $direccion ;?>" name="Direccion" type="text" readonly/> </td>
    </tr>
    <tr>
	<td width="20" height="27">Telefonos</td>
	<td width="30"> <input value="<?php echo $telefonos ; ?>" name="Telefonos" type="text" readonly /> </td>
    <tr>
	<td width="20"><label for="Fax">Fax</label></td>
	<td width="30"> <input value="<?php echo $fax ; ?>" name="Fax" type="text" readonly/> </td>
    </tr>
    <tr>
	<td width="20" height="27"><label for="Email">Email</label></td>
	<td width="30"> <input value="<?php echo $email ; ?>" name="Email" type="text" readonly /> </td>
    <tr>
	<td width="20"><label for="Email">Encargado</label></td>
	<td width="30"> <input value="<?php echo $encargado; ?>" name="Encargado" type="text" readonly/> </td>
    
    <td width="30"> Estado </td>
    <td width="30"> <input value="<?php echo $estado; ?>" name="Estado" type="text" readonly/>     
    </td>
    </tr>
    </table>
   <p>&nbsp;</p>

      <table width="987">
      <tr>
      <td><label for="Usuario">Usuario</label></td>
      <td>  <input value="<?php echo $usuario ?>" name="Usuario" type="text" readonly/> </td>
      
      <td><label for="Fecha de Creacion">Fecha de Creacion</label> </td>
      <td><input value="<?php echo $fecha ; ?>" name="FechaCreacion" type="datetime" readonly/> </td>
      
      <td><label for="MaqCrea">MaqCrea</label> </td>
      <td><input value="<?php echo $maquina ; ?>" name="MaqCreacion" type="text" readonly/></td>
      </tr>
      </table>
      </div>   
<div  align="center" class="footer">
      <p> </p>
      <p > </p>
      <table width="auto" height="36" bgcolor="#CCCCCC">
      <tr>
       
      <td width="224" align="right"><input class="bordes" type="submit" name="btn1" id="Inicio" value="inicio" /></td>
      <td width="51"><input class="bordes" type="submit" name="btn1" id="Previo" value="Previo" /></td>
      <td width="69"><input class="bordes" type="submit" name="btn1" id="Siguiente" value="Siguiente" /></td>
      <td width="43"><input class="bordes" type="submit" name="btn1" id="Final" value="Final" /></td>
      
      <td width="65"><input class="bordes" type="submit" name="btn1" id="Imprimir" value="Imprimir" onclick="printcontent('printme')" /></td>
      <td width="62"><input class="bordes" type="submit" name="btn1" id="Agregar" value="Agregar"/></td>
      <td width="68"><input class="bordes" type="submit" name="btn1" id="Modificar" value="Modificar" /></td>
      <td width="62"><input class="bordes" type="submit" name="btn1" id="Eliminar" value="Eliminar" /></td>
      <td width="248"><input class="bordes"  type="submit"   name="btn1" id="Salir" value="Salir" /></td>
      </tr>
      </table>
  </form>


 <?php 

 if(isset($_POST["btn1"])){
$accion=$_POST["btn1"];

$idBODEGAModificar = $_POST["ID"];
$nombreBODEGAModificar= $_POST["Nombre"];
$direccionBODEGAModificar = $_POST["Direccion"];
$telefonosBODEGAModificar = $_POST["Telefonos"];
$faxBODEGAModificar= $_POST["Fax"];
$emailBODEGAModificar = $_POST["Email"];
$encargadoBODEGAModificar = $_POST["Encargado"];
$estadoBodegaModificar = $_POST["Estado"];
///Salir	
if($accion=="Salir"){
echo '<script> window.location="PaginaPrincipla.php"</script>';}
///Eliminar
$valorIdELiminar = $_POST["ID"];
if($accion=="Eliminar"){
		if($valorIdELiminar !=""){
		   $EliminarQuery = "Delete from  ent_maesbode where Id_MaesBode= '$valorIdELiminar' && Id_MaesPais='$paisEmpresa' && Id_MaesEmpr= '$empresaID'" ;
		$respuestaDelete=$mysqli->query($EliminarQuery)or die ("No se pudo Eliminar marca") ;
		if($respuestaDelete!==False){ 
	 echo "<script> alert('Éxito al eliminar bodega')</script>";
	echo '<script> window.location ="MantenimientoBodegas.php"</script> ' ; 
}else{ 
    echo "Falló al eliminar bodega"; 
}   
		}else{echo "No hay bodega para Eliminar";}
		}	
///Modificar  
if($accion == "Modificar"){
	if($idBODEGAModificar !=""){
		echo "<script> window.open('ModificarBodega.php?id=$idBODEGAModificar  & nombre=$nombreBODEGAModificar &Estado=$estadoBodegaModificar & direccion=$direccionBODEGAModificar & telefonos=$telefonosBODEGAModificar & fax=$faxBODEGAModificar & email=$emailBODEGAModificar & encargado=$encargadoBODEGAModificar', 'Modificar-Bodega','width=1100, height=500')</script> " ;}else {echo "No hay Bodega para Modificar";}
		}		
   
///agregar
if($accion=="Agregar"){
	echo "<script> window.open('NuevaBodega.php', 'Nueva-Bodega','width=1100, height=500')</script> ";
}


 			
	  

 }
?>

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
