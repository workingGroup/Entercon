<?php  

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];

$Opcion8 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='9'");
	
			if(mysqli_num_rows($Opcion8) > 0){
			$_SESSION['MAESTRO DE CLIENTES']=1;
		}else { $_SESSION['MAESTRO DE CLIENTES']=0; }
	if($_SESSION['MAESTRO DE CLIENTES']==1){

$querySeleccion="SELECT * FROM ent_maessocio where Id_MaesEmpr='$empresaID' && Id_MaesPais	 ='$paisEmpresa' && Tipo_MaesSocio= '1'  ORDER BY Id_Socio asc LIMIT 1 ";	
$resultadoSeleccion=$mysqli->query($querySeleccion);
$rowSeleccion=$resultadoSeleccion->fetch_assoc();

			 
$id = $rowSeleccion['Id_Socio'];
$nit = $rowSeleccion['Nit_MaesSociocol'];
$Razon = $rowSeleccion['RazonSocial_MaesSocio'];
$direccion = $rowSeleccion['Direccion_MaesSocio'];	
$telefonos= $rowSeleccion['Telefono_MaesSocio'];
$Fax ="";
$Email=$rowSeleccion['Email_MaesSocio'];
$usuario= $rowSeleccion['Usuario_MaesSocio'];
$Fecha=$rowSeleccion['FechaCreacion_MaesSocio'];
$maquina= $rowSeleccion['MaqCreacion_MaesSocio'];

if(isset($_POST["btn2"])){
$buscar=$_POST["btn2"];

///Buscar
 if ($buscar=="Buscar"){
	 
	 $idbuscar =$_POST["Buscar"];
$query="SELECT * FROM ent_maessocio where Id_MaesEmpr='$empresaID' && Id_MaesPais	 ='$paisEmpresa' && Tipo_MaesSocio= '1' && Id_Socio='$idbuscar' or   Id_MaesEmpr='$empresaID' && Id_MaesPais	 ='$paisEmpresa' && Tipo_MaesSocio= '1'&& RazonSocial_MaesSocio ='$idbuscar'  ";	
$resultado=$mysqli->query($query);
$row=$resultado->fetch_assoc();
if ($row !=""){
$id = $row['Id_Socio'];
$nit = $row['Nit_MaesSociocol'];
$Razon = $row['RazonSocial_MaesSocio'];
$direccion = $row['Direccion_MaesSocio'];	
$telefonos= $row['Telefono_MaesSocio'];
$Fax ="";
$Email=$row['Email_MaesSocio'];
$usuario= $row['Usuario_MaesSocio'];
$Fecha=$row['FechaCreacion_MaesSocio'];
$maquina= $row['MaqCreacion_MaesSocio'];
}else {echo "<script> alert('No hay resultados para tu busqueda')</script>"; }

		 }
}
 
 

 if(isset($_POST["btn1"])){
$accion=$_POST["btn1"];
///////////final
if ($accion=="Final"){
$FinalQuery = "SELECT MAX(Id_Socio)as idmax FROM ent_maessocio where Id_MaesPais='$paisEmpresa' && Id_MaesEmpr= '$empresaID' && Tipo_MaesSocio= '1'";
$respuestaFinal=$mysqli->query($FinalQuery);
$rowFinal=$respuestaFinal->fetch_assoc();
$maxID= $rowFinal['idmax'];

$query="SELECT * FROM ent_maessocio where Id_MaesEmpr='$empresaID' && Id_MaesPais ='$paisEmpresa' && Id_Socio = '$maxID' && Tipo_MaesSocio= '1'";	
$resultado=$mysqli->query($query);
$rowf=$resultado->fetch_assoc();

$id = $rowf['Id_Socio'];
$nit = $rowf['Nit_MaesSociocol'];
$Razon = $rowf['RazonSocial_MaesSocio'];
$direccion = $rowf['Direccion_MaesSocio'];	
$telefonos= $rowf['Telefono_MaesSocio'];
$Fax ="";
$Email=$rowf['Email_MaesSocio'];
$usuario= $rowf['Usuario_MaesSocio'];
$Fecha=$rowf['FechaCreacion_MaesSocio'];
$maquina= $rowf['MaqCreacion_MaesSocio'];

}


///Siguiente	
 if ($accion=="Siguiente"){
			$valorIdSiguiente = $_POST["ID"];
			 $SiguienteQuery="SELECT * FROM ent_maessocio WHERE Id_Socio > '$valorIdSiguiente' && Id_MaesEmpr='$empresaID' && Tipo_MaesSocio= '1' && Id_MaesPais ='$paisEmpresa' ORDER BY Id_Socio asc LIMIT 1 " ;
	 $respuestaSiguiente=$mysqli->query($SiguienteQuery);
		$rowSiguiente=$respuestaSiguiente->fetch_assoc();
			if ($rowSiguiente['Id_Socio'] !=""){
			
$id = $rowSiguiente['Id_Socio'];
$nit = $rowSiguiente['Nit_MaesSociocol'];
$Razon = $rowSiguiente['RazonSocial_MaesSocio'];
$direccion = $rowSiguiente['Direccion_MaesSocio'];	
$telefonos= $rowSiguiente['Telefono_MaesSocio'];
$Fax ="";
$Email=$rowSiguiente['Email_MaesSocio'];
$usuario= $rowSiguiente['Usuario_MaesSocio'];
$Fecha=$rowSiguiente['FechaCreacion_MaesSocio'];
$maquina= $rowSiguiente['MaqCreacion_MaesSocio'];

			}
			
			
			 }	  
			 
//previo	 
if ($accion=="Previo"){
			$valorIdPrevio = $_POST["ID"];
			 $PrevioQuery="SELECT * FROM ent_maessocio WHERE Id_Socio < '$valorIdPrevio' && Id_MaesEmpr='$empresaID' && Tipo_MaesSocio= '1' && Id_MaesPais ='$paisEmpresa' ORDER BY Id_Socio desc LIMIT 1  ";
			 $respuestaPrevio=$mysqli->query($PrevioQuery);
			 $rowPrevio=$respuestaPrevio->fetch_assoc();
			 
$id = $rowPrevio['Id_Socio'];
$nit = $rowPrevio['Nit_MaesSociocol'];
$Razon = $rowPrevio['RazonSocial_MaesSocio'];
$direccion = $rowPrevio['Direccion_MaesSocio'];	
$telefonos= $rowPrevio['Telefono_MaesSocio'];
$Fax ="";
$Email=$rowPrevio['Email_MaesSocio'];
$usuario= $rowPrevio['Usuario_MaesSocio'];
$Fecha=$rowPrevio['FechaCreacion_MaesSocio'];
$maquina= $rowPrevio['MaqCreacion_MaesSocio'];

			 
			 }
//inicio 
if ($accion =="inicio"){
	$inicioQuery ="SELECT Min(Id_Socio)as idmin FROM ent_maessocio where  Id_MaesPais='$paisEmpresa' && Tipo_MaesSocio= '1' && Id_MaesEmpr= '$empresaID'";
	$respuestaInicio = $mysqli->query($inicioQuery);
	$row=$respuestaInicio->fetch_assoc();
	$minID= $row['idmin'];
	
	
	$queryinicio="SELECT * FROM ent_maessocio where Id_MaesEmpr='$empresaID' && Id_MaesPais ='$paisEmpresa' && Id_Socio = '$minID' && Tipo_MaesSocio= '1' ";	
$resultadoinicio=$mysqli->query($queryinicio);
$rowI=$resultadoinicio->fetch_assoc();

$id = $rowI['Id_Socio'];
$nit = $rowI['Nit_MaesSociocol'];
$Razon = $rowI['RazonSocial_MaesSocio'];
$direccion = $rowI['Direccion_MaesSocio'];	
$telefonos= $rowI['Telefono_MaesSocio'];
$Fax ="";
$Email=$rowI['Email_MaesSocio'];
$usuario= $rowI['Usuario_MaesSocio'];
$Fecha=$rowI['FechaCreacion_MaesSocio'];
$maquina= $rowI['MaqCreacion_MaesSocio'];
	
	}


 }	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon- Mantenimiento Clientes</title>
<link href="css/PlantillaMantenimiento - clientes.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body,td,th {
	color: #373737;
}
</style>
</head>

<body>

<div class="container">
  <div class="header">
    <h1> Mantenimiento de Clientes</h1>
     <h2 align="right">
     <form id="form3" name="form3" method="POST" action=""> 
    <input value="" name="Buscar" type="text" />
    <input type="submit" name="btn2"  value="Buscar" />
    </form>
    </h2>
    </div>
  <div class="content">
    <form id="form1" name="form1" method="post" action="">
<table>
	 <tr> 
         <td> <label for="ID">ID</label></td>
         <td> <input type="text" name="ID" id="ID" value="<?php echo $id ; ?>" readonly="readonly"/></td>
  	 <tr>        
         <td> <label for="Nit">Nit</label></td>
         <td> <input type="text" name="Nit" id="Nit" value="<?php echo $nit; ?>" readonly="readonly"/></td>
     <tr>      
         <td> <label for="Razon">Razon</label></td>
         <td> <input type="text" name="Razon" id="Razon" value="<?php echo $Razon ; ?>" readonly="readonly"/></td>
     <tr>      
         <td> <label for="Direccion">Direccion</label></td>
         <td> <input type="text" name="Direccion" id="Direccion" value="<?php echo $direccion ; ?>"readonly="readonly"/></td>
     <tr>     
         <td> <label for="Telefonos">Telefonos</label></td>
         <td> <input type="text" name="Telefonos" id="Telefonos" value="<?php echo $telefonos ; ?>"readonly="readonly"/></td>
         
         <td> <label for="Fax">Fax</label></td>
         <td> <input type="text" name="Fax" id="Fax" value="<?php echo $Fax ; ?>"readonly="readonly"/></td>
     <tr>  
         <td height="27">  <label for="email">email</label></td>
         <td> <input type="text" name="email" id="email" value="<?php echo $Razon ; ?>"readonly="readonly"/>    </td> 
     <tr>
     </tr>
     </table>
     <p>&nbsp;</p>
     <table width="987">
     <tr>
         <td width="77">  <label for="Usuario">Usuario</label></td>
         <td width="178"> <input value="<?php echo  $usuario; ?>" type="text" name="Usuario" id="Usuario" readonly="readonly"/></td>
      
         <td width="104"> <label for="FechaCrea">FechaCrea</label></td>
         <td width="203"> <input type="text" name="FechaCrea" id="FechaCrea" value="<?php echo $Fecha ; ?>" readonly="readonly"/></td>
       
        <td width="115"> <label for="MaqCrea">MaqCrea</label></td>
        <td width="282">  <input type="text" name="MaqCrea" id="MaqCrea" value="<?php $maquina ; ?>"readonly="readonly"/></td>
    </tr>
    </table>
    </div> 
      <p> </p>
    <div  align="center" class="footer">
      <table width="auto" height="36" bgcolor="#CCCCCC">
      <tr>
       
      <td width="224" align="right"><input class="bordes" type="submit" name="btn1" id="Inicio" value="inicio" /></td>
      <td width="51"><input class="bordes" type="submit" name="btn1" id="Previo" value="Previo" /></td>
      <td width="69"><input class="bordes" type="submit" name="btn1" id="Siguiente" value="Siguiente" /></td>
      <td width="43"><input class="bordes" type="submit" name="btn1" id="Final" value="Final" /></td>
      
      <td width="65"><input class="bordes" type="submit" name="btn1" id="Imprimir" value="Imprimir" /></td>
      <td width="62"><input class="bordes" type="submit" name="btn1" id="Agregar" value="Agregar"/></td>
      <td width="68"><input class="bordes" type="submit" name="btn1" id="Modificar" value="Modificar" /></td>
      <td width="62"><input class="bordes" type="submit" name="btn1" id="Eliminar" value="Eliminar" /></td>
      <td width="248"><input class="bordes" type="submit"   name="btn1" id="Salir" value="Salir" /></td>
      </tr>
      </table>
    </form>

<?php
 if(isset($_POST["btn1"])){
$accion=$_POST["btn1"];

$IDmodificar=$_POST["ID"];
$Nitmodificar=$_POST["Nit"];
$Razonmodificar=$_POST["Razon"];
$Direccionmodificar=$_POST["Direccion"];
$Telefonosmodificar=$_POST["Telefonos"];
$Faxmodificar = $_POST["Fax"];
$Emailmodificar= $_POST["email"];
$usuariomodificar= $_POST["Usuario"];
$FechaCreamodificar= $_POST["FechaCrea"];
$MaqCramodificar =$_POST["MaqCrea"];

///Salir	
if($accion=="Salir"){
echo '<script> window.location="PaginaPrincipla.php"</script>';}
///Eliminar
$valorIdELiminar = $_POST["ID"];
if($accion=="Eliminar"){
		if($valorIdELiminar !=""){
		   $EliminarQuery = "Delete from  ent_maessocio where 	Id_Socio= '$valorIdELiminar' && Id_MaesPais='$paisEmpresa' && Id_MaesEmpr= '$empresaID'" ;
		$respuestaDelete=$mysqli->query($EliminarQuery)or die ("No se pudo Eliminar Cliente") ;
		if($respuestaDelete!==False){ 
	 echo "<script> alert('Éxito al eliminar Cliente')</script>";
	echo '<script> window.location ="MantenimientoClientes.php"</script> ' ; 
}else{ 
    echo "Falló al eliminar Cliente"; 
}   
		}else{echo "No hay Cliente para Eliminar";}
		}	
///Modificar  
if($accion == "Modificar"){
	if($IDmodificar !=""){
		echo "<script> window.open('ModificarCliente.php?id=$IDmodificar  &nit=$Nitmodificar &razon=$Razonmodificar &direccion=$Direccionmodificar & telefonos=$Telefonosmodificar & fax=$Faxmodificar & email=$Emailmodificar ','Modificar-Bodega','width=1100, height=500')</script> " ;}else {echo "No hay Cliente para Modificar";}
		}		
   
///agregar
if($accion=="Agregar"){
	echo "<script> window.open('NuevoCliente.php', 'Nuevo-Cliente','width=1100, height=500')</script> ";
}
///Imprimir
if ($accion == "Imprimir"){
}
///Buscar
 if ($accion=="Buscar"){

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
