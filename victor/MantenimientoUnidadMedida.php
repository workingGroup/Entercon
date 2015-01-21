<?php  

session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuarioLog=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];

require('coneccion.php');

	
	$Opcion6 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='6'");
	$rowOpcion6=$Opcion6->fetch_assoc();
			if(mysqli_num_rows($Opcion6) > 0){
			$_SESSION['Permiso6']=$rowOpcion6['TipoPermiso_RoleXOpcion'];
			$_SESSION['UNIDAD DE MEDIDA']=1;
		}else { $_SESSION['UNIDAD DE MEDIDA']=0; }
		
if($_SESSION['UNIDAD DE MEDIDA']==1){
	
$QueryMedida="SELECT * FROM ent_maesunidmedida where  IdPais_MaesUnidMedida ='$paisEmpresa' && IdEmpr_MaesUnidMedida='$empresaID' ORDER BY Id_MaesUnidMedida asc LIMIT 1 ";	
$resultado=$mysqli->query($QueryMedida);
$row=$resultado->fetch_assoc();
	$id=$row['Id_MaesUnidMedida']; 
	$nombre = $row['Nombre_MaesUnidMedida'];
	$usuario =$row['Usuario_MaesUnidMedida'];
	$Fecha = $row['FechaCreacion_MaesUnidMedida'];
	$maquina=$row['MaqCreacion_MaesUnidMedida'];
	
	
if(isset($_POST["btn2"])){
$buscar=$_POST["btn2"];

///Buscar
 if ($buscar=="Buscar"){
	 
	 $idbuscar =$_POST["Buscar"];
$query="SELECT * FROM ent_maesunidmedida where IdPais_MaesUnidMedida ='$paisEmpresa' && IdEmpr_MaesUnidMedida='$empresaID' && Id_MaesUnidMedida='$idbuscar' or  IdPais_MaesUnidMedida ='$paisEmpresa' && IdEmpr_MaesUnidMedida='$empresaID' && Nombre_MaesUnidMedida ='$idbuscar'  ";	
$resultado=$mysqli->query($query);
$row=$resultado->fetch_assoc();
if ($row !=""){
	$id=$row['Id_MaesUnidMedida']; 
	$nombre = $row['Nombre_MaesUnidMedida'];
	$usuario =$row['Usuario_MaesUnidMedida'];
	$Fecha = $row['FechaCreacion_MaesUnidMedida'];
	$maquina=$row['MaqCreacion_MaesUnidMedida'];
}else {echo "<script> alert('No hay resultados para tu busqueda')</script>"; }
		 }
}	
	
	
	
	
if (isset($_POST['btn1'])){
$accion = $_POST['btn1'];

////////////final 
if ($accion=="Final"){
$FinalQuery = "SELECT MAX(Id_MaesUnidMedida)as idmax FROM ent_maesunidmedida where IdPais_MaesUnidMedida='$paisEmpresa' && IdEmpr_MaesUnidMedida= '$empresaID'";
$respuestaFinal=$mysqli->query($FinalQuery);
$rowFinal=$respuestaFinal->fetch_assoc();
$maxid=$rowFinal['idmax'];
; 

$FinalSelectQuery = "SELECT * FROM ent_maesunidmedida where IdPais_MaesUnidMedida='$paisEmpresa' && IdEmpr_MaesUnidMedida= '$empresaID' && Id_MaesUnidMedida ='$maxid'";
$respuestaFinalSelect=$mysqli->query($FinalSelectQuery);
$rowFinalSelect=$respuestaFinalSelect->fetch_assoc();
	
	$id=$rowFinalSelect['Id_MaesUnidMedida']; 
	$nombre = $rowFinalSelect['Nombre_MaesUnidMedida'];
	$usuario =$rowFinalSelect['Usuario_MaesUnidMedida'];
	$Fecha = $rowFinalSelect['FechaCreacion_MaesUnidMedida'];
	$maquina=$rowFinalSelect['MaqCreacion_MaesUnidMedida'];
	
}	

////////////siguiente
 if ($accion=="Siguiente"){
			$valorIdSiguiente = $_POST["UnidadMedida"];
			 $SiguienteQuery="SELECT * FROM ent_maesunidmedida WHERE Id_MaesUnidMedida > '$valorIdSiguiente' && IdEmpr_MaesUnidMedida='$empresaID' && IdPais_MaesUnidMedida ='$paisEmpresa' ORDER BY Id_MaesUnidMedida asc LIMIT 1 " ;
	 $respuestaSiguiente=$mysqli->query($SiguienteQuery);
		$rowSiguiente=$respuestaSiguiente->fetch_assoc();
			if ($rowSiguiente['Id_MaesUnidMedida'] !=""){
			
$id = $rowSiguiente['Id_MaesUnidMedida'];
$nombre = $rowSiguiente['Nombre_MaesUnidMedida'];
$usuario = $rowSiguiente['Usuario_MaesUnidMedida'];
$fecha = $rowSiguiente['FechaCreacion_MaesUnidMedida'];	
$maquina= $rowSiguiente['MaqCreacion_MaesUnidMedida'];}   
			 }	
//////////////////////previo	 
if ($accion=="Previo"){
			$valorIdPrevio = $_POST["UnidadMedida"];
			 $PrevioQuery="SELECT * FROM ent_maesunidmedida WHERE Id_MaesUnidMedida < '$valorIdPrevio' && IdEmpr_MaesUnidMedida='$empresaID' && IdPais_MaesUnidMedida ='$paisEmpresa' ORDER BY Id_MaesUnidMedida desc LIMIT 1 ";
			 $respuestaPrevio=$mysqli->query($PrevioQuery);
			 $rowPrevio=$respuestaPrevio->fetch_assoc();
			 
	if ($rowPrevio['Id_MaesUnidMedida'] !=""){
			
$id = $rowPrevio['Id_MaesUnidMedida'];
$nombre = $rowPrevio['Nombre_MaesUnidMedida'];
$usuario = $rowPrevio['Usuario_MaesUnidMedida'];
$fecha = $rowPrevio['FechaCreacion_MaesUnidMedida'];	
$maquina= $rowPrevio['MaqCreacion_MaesUnidMedida'];}   
			 }		
			 
//inicio 
if ($accion =="inicio"){
	$inicioQuery ="SELECT Min(Id_MaesUnidMedida)as idmin FROM ent_maesunidmedida where IdPais_MaesUnidMedida='$paisEmpresa' && IdEmpr_MaesUnidMedida= '$empresaID'";
	$respuestaInicio = $mysqli->query($inicioQuery);
	$rowInicioId=$respuestaInicio->fetch_assoc();
	$minID= $rowInicioId['idmin'];
	
	
	$queryinicio="SELECT * FROM ent_maesunidmedida where IdEmpr_MaesUnidMedida='$empresaID' && IdPais_MaesUnidMedida ='$paisEmpresa' && Id_MaesUnidMedida = '$minID' ";	
$resultadoinicio=$mysqli->query($queryinicio);
$rowInicio=$resultadoinicio->fetch_assoc();
$id = $rowInicio['Id_MaesUnidMedida'];
$nombre = $rowInicio['Nombre_MaesUnidMedida'];
$usuario = $rowInicio['Usuario_MaesUnidMedida'];
$fecha = $rowInicio['FechaCreacion_MaesUnidMedida'];	
$maquina= $rowInicio['MaqCreacion_MaesUnidMedida'];
	}			 
}?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon- Mantenimiento Unidad de Medida</title>
<link href="css/PlantillaMantenimiento - UnidadMedida.css" rel="stylesheet" type="text/css" />
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
    <h1> Mantenimiento Unidades de Medida</h1>
     <h2 align="right">
     <form id="form1" name="form1" method="POST" action=""> 
    <input value="" name="Buscar" type="text" />
    <input type="submit" name="btn2"  value="Buscar" />
    </form>
    </h2>
    
  </div>
  <div id ="printme" class="content">
 
  <form id="form1" name="form1" method="POST" action=""> 
    <table>
    <tr>
      <td><label for="Unidad Medida">Unidad Medida</label></td>
      <td><input name="UnidadMedida" type="text" value ="<?php echo $id;?>" /></td>
     <tr>
      <td> <label for="Nombre">Nombre</label></td>
       <td><input name="Nombre" type="text" value ="<?php echo $nombre;?>"/></td>  
      </tr>
    </table>
        <p> </p>
        <table width="987">
      <tr>
      <td><label for="Usuario">Usuario</label></td>
      <td><input name="Usuario" type="text" value ="<?php echo $usuario;?>" readonly /></td>
      
      <td><label for="Fecha de Creacion">Fecha de Creacion</label> </td>
      <td><input name="FechaCreacion" type="datetime" value ="<?php echo $Fecha;?>" readonly/> </td>
      
      <td><label for="MaqCrea">MaqCrea</label> </td>
      <td><input  name="MaqCreacion" type="text" value ="<?php echo $maquina;?>" readonly/></td>
      </tr>
      </table>
     
     
        <p></p>
        </div>
         <div  align="center" class="footer">
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
if (isset($_POST["btn1"])){
$accion = $_POST["btn1"];
$IdeBorrar = $_POST["UnidadMedida"];
/////////////salir
	if ($accion=="Salir"){
		echo '<script> window.location="PaginaPrincipla.php"</script>';
		}
///////////eliminar
	if ($accion=="Eliminar"){
		if($IdeBorrar !=""){
		$borrarQuery="delete from ent_maesunidmedida where Id_MaesUnidMedida='$IdeBorrar' &&  IdPais_MaesUnidMedida ='$paisEmpresa' && IdEmpr_MaesUnidMedida='$empresaID' " ;
		$resultadoBorrar = $mysqli->query($borrarQuery)or die ("No se ah podido Eliminar la marca");
		if($resultadoBorrar!==False){ 
	 echo "<script> alert('Éxito al eliminar medida')</script>";
	echo '<script> window.location ="MantenimientoUnidadMedida.php"</script> ' ; 
}else{ 
    echo "Falló al eliminar medida"; 
}   
		}else{echo "No hay Medida para Eliminar";}
		}	
///////////////modificar
	if($accion == "Modificar"){
		if($id !=""){
			$idModicar= $_POST["UnidadMedida"];
			$nombreModificar=$_POST["Nombre"];
		echo "<script> window.open('ModificarMedida.php?id=$idModicar  & nombre=$nombreModificar', 'Modificar-Medida','width=1100, height=350')</script> " ;}else {echo "No hay Medida para Modificar";}
		}		
/////////////////agregar
		if($accion == "Agregar"){
		
		echo "<script> window.open('NuevaMedida.php', 'Nueva-Medida','width=1100, height=350')</script> " ;
		}
/////////////Imprimir
	if ($accion =="Imprimir"){

		}
/////////////Buscar


	
}?>    
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