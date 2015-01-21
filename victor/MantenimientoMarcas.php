<?php  

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];

	$Opcion3 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='3'");
	$rowOpcion3=$Opcion3->fetch_assoc();
	
			if(mysqli_num_rows($Opcion3) > 0){
		    $_SESSION['Permiso3']=$rowOpcion3['TipoPermiso_RoleXOpcion'];
			$_SESSION['MAESTROMARCAS']=1;
		}else { $_SESSION['MAESTROMARCAS']=0; }

if ($_SESSION['MAESTROMARCAS']==1){

$query="SELECT * FROM ent_maesmarca where IdEmpr_MaesMarca='$empresaID' && IdPais_MaesMarca ='$paisEmpresa' ORDER BY Id_MaesMarca asc LIMIT 1 ";	
$resultado=$mysqli->query($query);
$row=$resultado->fetch_assoc();
$id = $row['Id_MaesMarca'];
$nombre = $row['Nombre_MaesMarca'];
$usuario = $row['Usuario_MaesMarca'];
$fecha = $row['FechaCreacion_MaesMarca'];	
$maquina= $row['MaqCreacion_MaesMarca'];
$estado=$row['Estatus_MaesMarca'];

if(isset($_POST["btn2"])){
$buscar=$_POST["btn2"];

///Buscar
 if ($buscar=="Buscar"){
	 
	 $idbuscar =$_POST["Buscar"];
$query="SELECT * FROM ent_maesmarca where IdEmpr_MaesMarca='$empresaID' && IdPais_MaesMarca ='$paisEmpresa' && Id_MaesMarca='$idbuscar' or  IdEmpr_MaesMarca='$empresaID' && IdPais_MaesMarca ='$paisEmpresa' && Nombre_MaesMarca ='$idbuscar'  ";	
$resultado=$mysqli->query($query);
$row=$resultado->fetch_assoc();
if ($row !=""){
$id = $row['Id_MaesMarca'];
$nombre = $row['Nombre_MaesMarca'];
$usuario = $row['Usuario_MaesMarca'];
$fecha = $row['FechaCreacion_MaesMarca'];	
$maquina= $row['MaqCreacion_MaesMarca'];
$estado=$row['Estatus_MaesMarca'];
}else {echo "<script> alert('No hay resultados para tu busqueda')</script>"; }		
		 }

}

 if(isset($_POST["btn1"])){
$accion=$_POST["btn1"];

///////////final
if ($accion=="Final"){
$FinalQuery = "SELECT MAX(Id_MaesMarca)as idmax FROM ent_maesmarca where IdPais_MaesMarca='$paisEmpresa' && IdEmpr_MaesMarca= '$empresaID'";
$respuestaFinal=$mysqli->query($FinalQuery);
$rowFinal=$respuestaFinal->fetch_assoc();
$maxID= $rowFinal['idmax'];

$query="SELECT * FROM ent_maesmarca where IdEmpr_MaesMarca='$empresaID' && IdPais_MaesMarca ='$paisEmpresa' && Id_MaesMarca = '$maxID' ";	
$resultado=$mysqli->query($query);
$row=$resultado->fetch_assoc();
$id = $row['Id_MaesMarca'];
$nombre = $row['Nombre_MaesMarca'];
$usuario = $row['Usuario_MaesMarca'];
$fecha = $row['FechaCreacion_MaesMarca'];	
$maquina= $row['MaqCreacion_MaesMarca'];	
$estado=$row['Estatus_MaesMarca'];
}


///Siguiente	
 if ($accion=="Siguiente"){
			$valorIdSiguiente = $_POST["IDMarca"];
			 $SiguienteQuery="SELECT * FROM ent_maesmarca WHERE Id_MaesMarca > '$valorIdSiguiente' && IdEmpr_MaesMarca='$empresaID' && IdPais_MaesMarca ='$paisEmpresa' ORDER BY Id_MaesMarca asc LIMIT 1 " ;
	 $respuestaSiguiente=$mysqli->query($SiguienteQuery);
		$rowSiguiente=$respuestaSiguiente->fetch_assoc();
			if ($rowSiguiente['Id_MaesMarca'] !=""){
			
$id = $rowSiguiente['Id_MaesMarca'];
$nombre = $rowSiguiente['Nombre_MaesMarca'];
$usuario = $rowSiguiente['Usuario_MaesMarca'];
$fecha = $rowSiguiente['FechaCreacion_MaesMarca'];	
$maquina= $rowSiguiente['MaqCreacion_MaesMarca'];}   
$estado=$rowSiguiente['Estatus_MaesMarca'];
			
			 }	  
			 
//previo	 
if ($accion=="Previo"){
			$valorIdPrevio = $_POST["IDMarca"];
			 $PrevioQuery="SELECT * FROM ent_maesmarca WHERE Id_MaesMarca < '$valorIdPrevio' && IdEmpr_MaesMarca='$empresaID' && IdPais_MaesMarca ='$paisEmpresa' ORDER BY Id_MaesMarca desc LIMIT 1 ";
			 $respuestaPrevio=$mysqli->query($PrevioQuery);
			 $rowPrevio=$respuestaPrevio->fetch_assoc();
			 
$id = $rowPrevio['Id_MaesMarca'];
$nombre = $rowPrevio['Nombre_MaesMarca'];
$usuario = $rowPrevio['Usuario_MaesMarca'];
$fecha = $rowPrevio['FechaCreacion_MaesMarca'];	
$maquina= $rowPrevio['MaqCreacion_MaesMarca'];
$estado=$rowPrevio['Estatus_MaesMarca'];			 
			 }
//inicio 
if ($accion =="inicio"){
	$inicioQuery ="SELECT Min(Id_MaesMarca)as idmin FROM ent_maesmarca where IdPais_MaesMarca='$paisEmpresa' && IdEmpr_MaesMarca= '$empresaID'";
	$respuestaInicio = $mysqli->query($inicioQuery);
	$row=$respuestaInicio->fetch_assoc();
	$minID= $row['idmin'];
	
	
	$queryinicio="SELECT * FROM ent_maesmarca where IdEmpr_MaesMarca='$empresaID' && IdPais_MaesMarca ='$paisEmpresa' && Id_MaesMarca = '$minID' ";	
$resultadoinicio=$mysqli->query($queryinicio);
$row=$resultadoinicio->fetch_assoc();
$id = $row['Id_MaesMarca'];
$nombre = $row['Nombre_MaesMarca'];
$usuario = $row['Usuario_MaesMarca'];
$fecha = $row['FechaCreacion_MaesMarca'];	
$maquina= $row['MaqCreacion_MaesMarca'];	
$estado=$row['Estatus_MaesMarca'];	
	}


 }
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon -Mantenimiento de Marcas</title>
<link href="css/PlantillaMantenimiento - Marcas.css" rel="stylesheet" type="text/css" />
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
    <h2 align="center"> Mantenimiento de Marcas </h2>
     <h3 align="right">
     <form id="form3" name="form3" method="POST" action=""> 
    <input value="" name="Buscar" type="text" />
    <input type="submit" name="btn2"  value="Buscar" />
    </form>
    </h3>
    </div>
  <div class="content" id="printme" >
  <form id="form3" name="form3" method="POST" action=""> 
<table width="34%">
	<tr>
	<td width="20"> <label for="ID Marca">ID Marca</label></td>
	<td width="30"> <input value="<?php echo $id;?>" name="IDMarca" type="text" readonly/> </td>

    </tr>
    <tr>
	<td width="20" height="27"><label for="Nombre">Nombre</label></td>
    
	<td width="30"> <input value="<?php echo $nombre;?>" name="Nombre" type="text" readonly /> </td>
    
    <td width="30"> Estado </td>
    
    <td width="30"> <input value="<?php echo $estado;?>" name="Estado" type="text" readonly /> </td>
    </tr>
    </table>
   
    
      
      <p>&nbsp;</p>

      <table width="987">
      <tr>
      <td><label for="Usuario">Usuario</label></td>
      <td>  <input value="<?php  echo $usuario ; ?>" name="Usuario" type="text" readonly/> </td>
      
      <td><label for="Fecha de Creacion">Fecha de Creacion</label> </td>
      <td><input value="<?php echo $fecha;?>" name="FechaCreacion" type="datetime" readonly/> </td>
      
      <td><label for="MaqCrea">MaqCrea</label> </td>
      <td><input value="<?php echo $maquina; ?>" name="MaqCreacion" type="text" readonly/></td>
      </tr>
      </table>
      </div>   
<div  align="center" class="footer">
      <p> </p>
   
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
$idMarcaModificar = $_POST["IDMarca"];
$nombreMarcaModificar= $_POST["Nombre"];
$Estadomodificar=$_POST["Estado"];
///Salir	
if($accion=="Salir"){
echo '<script> window.location="PaginaPrincipla.php"</script>';}
///Eliminar
$valorIdELiminar = $_POST["IDMarca"];
if($accion=="Eliminar"){
		if($valorIdELiminar !=""){
		   $EliminarQuery = "Delete from  ent_maesmarca where Id_MaesMarca= '$valorIdELiminar' && IdPais_MaesMarca='$paisEmpresa' && IdEmpr_MaesMarca= '$empresaID'" ;
		$respuestaDelete=$mysqli->query($EliminarQuery)or die ("No se pudo Eliminar marca") ;
		if($respuestaDelete!==False){ 
	 echo "<script> alert('Éxito al eliminar Marca')</script>";
	echo '<script> window.location ="MantenimientoMarcas.php"</script> ' ; 
}else{ 
    echo "Falló al eliminar Marca"; 
}   
		}else{echo "No hay Marca para Eliminar";}
		}	
///Modificar  
if($accion == "Modificar"){
	if($idMarcaModificar !=""){
		echo "<script> window.open('ModificarMarca.php?id=$idMarcaModificar &Estado=$Estadomodificar  &nombre=$nombreMarcaModificar', 'Modificar-Marca','width=1100, height=350')</script> " ;}else {echo "No hay Medida para Modificar";}
		}		
   
///agregar
if($accion=="Agregar"){
	echo "<script> window.open('NuevaMarca.php', 'Nueva-Marca','width=1100, height=350')</script> ";
}
///Imprimir
if ($accion == "Imprimir"){
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
