<?php
session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];

$Opcion5 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='5'");
	$rowOpcion5=$Opcion5->fetch_assoc();
			if(mysqli_num_rows($Opcion5) > 0){
			$_SESSION['Permiso5']=$rowOpcion5['TipoPermiso_RoleXOpcion'];
			$_SESSION['TIPO DE PRODUCTOS']=1;
		}else { $_SESSION['TIPO DE PRODUCTOS']=0; }

if($_SESSION['TIPO DE PRODUCTOS']==1){
$QuerySeleccion = "Select * from ent_maestipoprod where IdPais_MaesTipoProd = '$paisEmpresa' &&   IdEmpr_MaesTipoProd ='$empresaID' ORDER BY Id_MaesTipoProd asc LIMIT 1   ";
$respuestaSeleccion = $mysqli->query($QuerySeleccion);
$rowSeleccion = $respuestaSeleccion->fetch_assoc() ; 
$id= $rowSeleccion['Id_MaesTipoProd'];
$nombre= $rowSeleccion['Nombre_MaesTipoProd'];
$usuario= $rowSeleccion['Usuario_MaesTipoProd'];
$fecha= $rowSeleccion['FechaCreacion_MaesTipoProd'];
$maquina=   $rowSeleccion['MaqCreacion_MaesTipoProd'];
$Servicio= $rowSeleccion['Inventa_MaesTipoProd'];

if(isset($_POST["btn2"])){
$buscar=$_POST["btn2"];

///Buscar
 if ($buscar=="Buscar"){
	 
	 $idbuscar =$_POST["Buscar"];
$query="select * from ent_maestipoprod where IdPais_MaesTipoProd = '$paisEmpresa' &&   IdEmpr_MaesTipoProd ='$empresaID' && Id_MaesTipoProd='$idbuscar' or IdPais_MaesTipoProd = '$paisEmpresa' &&   IdEmpr_MaesTipoProd ='$empresaID' && Nombre_MaesTipoProd ='$idbuscar'  ";	
$resultado=$mysqli->query($query);
$row=$resultado->fetch_assoc();
if ($row !=""){
$id= $row['Id_MaesTipoProd'];
$nombre= $row['Nombre_MaesTipoProd'];
$usuario= $row['Usuario_MaesTipoProd'];
$fecha= $row['FechaCreacion_MaesTipoProd'];
$maquina=   $row['MaqCreacion_MaesTipoProd'];
$Servicio= $row['Inventa_MaesTipoProd'];
}else {echo "<script> alert('No hay resultados para tu busqueda')</script>"; }		 
		 
		 }
}
if (isset($_POST['btn1'])){
$accion = $_POST['btn1'];

////////////final 
if ($accion=="Final"){
$FinalQuery = "SELECT MAX(Id_MaesTipoProd)as idmax FROM ent_maestipoprod where IdPais_MaesTipoProd='$paisEmpresa' && IdEmpr_MaesTipoProd= '$empresaID'";
$respuestaFinal=$mysqli->query($FinalQuery);
$rowFinal=$respuestaFinal->fetch_assoc();
$maxid=$rowFinal['idmax'];
; 

$FinalSelectQuery = "SELECT * FROM ent_maestipoprod where IdPais_MaesTipoProd='$paisEmpresa' && IdEmpr_MaesTipoProd= '$empresaID' && Id_MaesTipoProd ='$maxid'";
$respuestaFinalSelect=$mysqli->query($FinalSelectQuery);
$rowFinalSelect=$respuestaFinalSelect->fetch_assoc();
	
$id= $rowFinalSelect['Id_MaesTipoProd'];
$nombre= $rowFinalSelect['Nombre_MaesTipoProd'];
$usuario= $rowFinalSelect['Usuario_MaesTipoProd'];
$fecha= $rowFinalSelect['FechaCreacion_MaesTipoProd'];
$maquina=   $rowFinalSelect['MaqCreacion_MaesTipoProd'];
$Servicio= $rowFinalSelect['Inventa_MaesTipoProd'];
}	

////////////siguiente
 if ($accion=="Siguiente"){
			$valorIdSiguiente = $_POST["ID"];
			 $SiguienteQuery="SELECT * FROM ent_maestipoprod WHERE Id_MaesTipoProd > '$valorIdSiguiente' && IdEmpr_MaesTipoProd='$empresaID' && IdPais_MaesTipoProd ='$paisEmpresa' ORDER BY Id_MaesTipoProd asc LIMIT 1 " ;
	 $respuestaSiguiente=$mysqli->query($SiguienteQuery);
		$rowSiguiente=$respuestaSiguiente->fetch_assoc();
			if ($rowSiguiente['Id_MaesTipoProd'] !=""){
			
$id= $rowSiguiente['Id_MaesTipoProd'];
$nombre= $rowSiguiente['Nombre_MaesTipoProd'];
$usuario= $rowSiguiente['Usuario_MaesTipoProd'];
$fecha= $rowSiguiente['FechaCreacion_MaesTipoProd'];
$maquina=   $rowSiguiente['MaqCreacion_MaesTipoProd'];  
$Servicio= $rowSiguiente['Inventa_MaesTipoProd'];
			 }	
//////////////////////previo	 
if ($accion=="Previo"){
			$valorIdPrevio = $_POST["ID"];
			 $PrevioQuery="SELECT * FROM ent_maestipoprod WHERE Id_MaesTipoProd < '$valorIdPrevio' && IdEmpr_MaesTipoProd='$empresaID' && IdPais_MaesTipoProd ='$paisEmpresa' ORDER BY Id_MaesTipoProd desc LIMIT 1 ";
			 $respuestaPrevio=$mysqli->query($PrevioQuery);
			 $rowPrevio=$respuestaPrevio->fetch_assoc();
			 
	if ($rowPrevio['Id_MaesTipoProd'] !=""){
			
$id= $rowSiguiente['Id_MaesTipoProd'];
$nombre= $rowSiguiente['Nombre_MaesTipoProd'];
$usuario= $rowSiguiente['Usuario_MaesTipoProd'];
$fecha= $rowSiguiente['FechaCreacion_MaesTipoProd'];
$maquina=   $rowSiguiente['MaqCreacion_MaesTipoProd'];  
$Servicio= $rowSiguiente['Inventa_MaesTipoProd'];
			 }		
			 
//inicio 
if ($accion =="inicio"){
	$inicioQuery ="SELECT Min(Id_MaesTipoProd)as idmin FROM ent_maestipoprod where IdPais_MaesTipoProd='$paisEmpresa' && IdEmpr_MaesTipoProd= '$empresaID'";
	$respuestaInicio = $mysqli->query($inicioQuery);
	$rowInicioId=$respuestaInicio->fetch_assoc();
	$minID= $rowInicioId['idmin'];
	
	
	$queryinicio="SELECT * FROM ent_maestipoprod where IdEmpr_MaesTipoProd='$empresaID' && IdPais_MaesTipoProd ='$paisEmpresa' && Id_MaesTipoProd = '$minID' ";	
$resultadoinicio=$mysqli->query($queryinicio);
$rowInicio=$resultadoinicio->fetch_assoc();
$id= $rowSiguiente['Id_MaesTipoProd'];
$nombre= $rowSiguiente['Nombre_MaesTipoProd'];
$Servicio= $rowSiguiente['Inventa_MaesTipoProd'];
$usuario= $rowSiguiente['Usuario_MaesTipoProd'];
$fecha= $rowSiguiente['FechaCreacion_MaesTipoProd'];
$maquina=   $rowSiguiente['MaqCreacion_MaesTipoProd']; 
	}
 }
 }
 }?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon-Tipos de Producto</title>
<link href="css/PlantillaMantenimiento - TipProducto.css"  rel="stylesheet" type="text/css" />
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
    <h1> Mantenimiento Tipos de Productos </h1>
     <h2 align="right">
     <form id="form3" name="form3" method="POST" action=""> 
    <input value="" name="Buscar" type="text" />
    <input type="submit" name="btn2"  value="Buscar" />
    </form>
    </h2>
    </div>
  <div class="content" id="printme">
    <form id="form1" name="form1" method="POST" action=""> 
<table width="34%">
	<tr>
	<td width="20"> <label for="ID Marca">ID</label></td>
	<td width="30"> <input value="<?php echo $id;?>" name="ID" type="text" readonly/> </td>

    </tr>
    <tr>
	<td width="20" height="27"><label for="Nombre">Descripcion</label></td>
    
	<td width="30"> <input value="<?php echo $nombre;?>" name="Descripcion" type="text" readonly /> </td>
    </tr>
   <td>Servicio</td>
        <td><?php if($Servicio==1){?><input type="checkbox" name="Chk" readonly="readonly" checked="checked" disabled="disabled"/><?php }else{?><input type="checkbox" name="Chk" readonly="readonly" disabled="disabled"/><?php }?></td>
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
$idProductoModificar = $_POST["ID"];
$DescripcionTipProductoModificar= $_POST["Descripcion"];
	
///Salir	
if($accion=="Salir"){
echo '<script> window.location="PaginaPrincipla.php"</script>';}
///Eliminar

if($accion=="Eliminar"){
	$valorIdELiminar = $_POST["ID"];
		if($id !=""){
		   $EliminarQuery = "Delete from  ent_maestipoprod where Id_MaesTipoProd= '$valorIdELiminar' && IdPais_MaesTipoProd = '$paisEmpresa' &&   IdEmpr_MaesTipoProd ='$empresaID'" ;
		$respuestaDelete=$mysqli->query($EliminarQuery)or die ("No se pudo Eliminar marca") ;
		if($respuestaDelete!==False){ 
	 echo "<script> alert('Éxito al eliminar tipo de Producto')</script>";
	echo '<script> window.location ="MantenimientoTiposProducto.php"</script> ' ; 
}else{ 
    echo "Falló al eliminar tipo de Producto"; 
}   
		}else{echo "No hay tipo de Producto para Eliminar";}
		}	
///Modificar  
if($accion == "Modificar"){
	if($idProductoModificar !=""){
		echo "<script> window.open('ModificarTipProducto.php?id=$idProductoModificar  & descripcion=$DescripcionTipProductoModificar', 'Modificar-Tipo de Producto','width=1100, height=350')</script> " ;}else {echo "No hay ningun tipo de producto para Modificar";}
		}		
   
///agregar
if($accion=="Agregar"){
	echo "<script> window.open('NuevoTipProducto.php', 'Nueva-Tip. Producto','width=1100, height=350')</script> ";
}
///Imprimir
if ($accion == "Imprimir"){
}
///Buscar
 if ($accion=="Buscar"){
echo "Buscar";

echo '<input type="text" value="" name="b"  /> <input type="submit" name="btn1" id="Buscar" value="->" />';
		 }				
	if ($accion=="->"){
	$buscar = $_POST['b'];
	echo $buscar; 	
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