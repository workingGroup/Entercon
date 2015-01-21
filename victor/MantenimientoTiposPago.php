<?php  

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];

$QuerySeleccion ="Select * from ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' && IdEmpresa_MaesTipoPago= '$empresaID' " ;
$respuestaSeleccion = $mysqli->query($QuerySeleccion);
$rowSeleccion = $respuestaSeleccion->fetch_assoc();
$id=$rowSeleccion['Id_MaesTipoPago'];
$descripcion=$rowSeleccion['Nombre_MaesTipoPago'];
$tipoCambio=$rowSeleccion['TasaCambio_MaesTipoPago'];
$calculoComicion=$rowSeleccion['PagaComision_MaesTipoPago'];
$usuario =$rowSeleccion['Usuario_MaesTipoPago'] ; 
$fecha=$rowSeleccion['FechaCreacion_MaesTipoPago']; 
$maquina =$rowSeleccion['MaqCreacion_MaesTipoPago'];




if(isset($_POST["btn2"])){
$buscar=$_POST["btn2"];

///Buscar
 if ($buscar=="Buscar"){
	 
	 $idbuscar =$_POST["Buscar"];
$query="Select * from ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' && IdEmpresa_MaesTipoPago= '$empresaID' && Id_MaesTipoPago='$idbuscar' or IdPais_MaesTipoPago='$paisEmpresa' && IdEmpresa_MaesTipoPago= '$empresaID' && Nombre_MaesTipoPago ='$idbuscar'  ";	
$resultado=$mysqli->query($query);
$row=$resultado->fetch_assoc();

$id=$row['Id_MaesTipoPago'];
$descripcion=$row['Nombre_MaesTipoPago'];
$tipoCambio=$row['TasaCambio_MaesTipoPago'];
$calculoComicion=$row['PagaComision_MaesTipoPago'];
$usuario =$row['Usuario_MaesTipoPago'] ; 
$fecha=$row['FechaCreacion_MaesTipoPago']; 
$maquina =$row['MaqCreacion_MaesTipoPago'];
		 }
}


if (isset($_POST['btn1'])){
$accion = $_POST['btn1'];
$idValor = $_POST["ID"];
////////////final 
if ($accion=="Final"){
$FinalQuery = "SELECT MAX(Id_MaesTipoPago)as idmax FROM ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' && IdEmpresa_MaesTipoPago= '$empresaID'";
$respuestaFinal=$mysqli->query($FinalQuery);
$rowFinal=$respuestaFinal->fetch_assoc();
$maxid=$rowFinal['idmax'];
; 

$FinalSelectQuery = "SELECT * FROM ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' && IdEmpresa_MaesTipoPago= '$empresaID' && Id_MaesTipoPago ='$idValor'";
$respuestaFinalSelect=$mysqli->query($FinalSelectQuery);
$rowFinalSelect=$respuestaFinalSelect->fetch_assoc();
	
$id=$rowSeleccion['Id_MaesTipoPago'];
$descripcion=$rowSeleccion['Nombre_MaesTipoPago'];
$tipoCambio=$rowSeleccion['TasaCambio_MaesTipoPago'];
$calculoComicion=$rowSeleccion['PagaComision_MaesTipoPago'];
$usuario =$rowSeleccion['Usuario_MaesTipoPago'] ; 
$fecha=$rowSeleccion['FechaCreacion_MaesTipoPago']; 
$maquina =$rowSeleccion['MaqCreacion_MaesTipoPago'];

	
}	

////////////siguiente
 if ($accion=="Siguiente"){
			$valorIdSiguiente = $_POST["ID"];
			 $SiguienteQuery="SELECT * FROM ent_maestipopago WHERE Id_MaesTipoPago > '$valorIdSiguiente' && IdEmpresa_MaesTipoPago='$empresaID' && IdPais_MaesTipoPago ='$paisEmpresa' ORDER BY Id_MaesTipoPago asc LIMIT 1 " ;
	 $respuestaSiguiente=$mysqli->query($SiguienteQuery);
		$rowSiguiente=$respuestaSiguiente->fetch_assoc();
			if ($rowSiguiente['Id_MaesTipoPago'] !=""){
			
$id=$rowSiguiente['Id_MaesTipoPago'];
$descripcion=$rowSiguiente['Nombre_MaesTipoPago'];
$tipoCambio=$rowSiguiente['TasaCambio_MaesTipoPago'];
$calculoComicion=$rowSiguiente['PagaComision_MaesTipoPago'];
$usuario =$rowSiguiente['Usuario_MaesTipoPago'] ; 
$fecha=$rowSiguiente['FechaCreacion_MaesTipoPago']; 
$maquina =$rowSiguiente['MaqCreacion_MaesTipoPago'];
  
			 }	
//////////////////////previo	 
if ($accion=="Previo"){
			$valorIdPrevio = $_POST["ID"];
			 $PrevioQuery="SELECT * FROM ent_maestipopago WHERE Id_MaesTipoPago < '$valorIdPrevio' && IdEmpresa_MaesTipoPago='$empresaID' && IdPais_MaesTipoPago ='$paisEmpresa' ORDER BY Id_MaesTipoPago desc LIMIT 1 ";
			 $respuestaPrevio=$mysqli->query($PrevioQuery);
			 $rowPrevio=$respuestaPrevio->fetch_assoc();
			 
	if ($rowPrevio['Id_MaesTipoPago'] !=""){
			
$id=$rowSeleccion['Id_MaesTipoPago'];
$descripcion=$rowSeleccion['Nombre_MaesTipoPago'];
$tipoCambio=$rowSeleccion['TasaCambio_MaesTipoPago'];
$calculoComicion=$rowSeleccion['PagaComision_MaesTipoPago'];
$usuario =$rowSeleccion['Usuario_MaesTipoPago'] ; 
$fecha=$rowSeleccion['FechaCreacion_MaesTipoPago']; 
$maquina =$rowSeleccion['MaqCreacion_MaesTipoPago'];
			 }		
			 
//inicio 
if ($accion =="inicio"){
	$inicioQuery ="SELECT Min(Id_MaesTipoPago)as idmin FROM ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' && IdEmpresa_MaesTipoPago= '$empresaID'";
	$respuestaInicio = $mysqli->query($inicioQuery);
	$rowInicioId=$respuestaInicio->fetch_assoc();
	$minID= $rowInicioId['idmin'];
	
	
	$queryinicio="SELECT * FROM ent_maestipopago where IdEmpresa_MaesTipoPago='$empresaID' && IdPais_MaesTipoPago ='$paisEmpresa' && Id_MaesTipoPago = '$minID' ";	
$resultadoinicio=$mysqli->query($queryinicio);
$rowInicio=$resultadoinicio->fetch_assoc();

$id=$rowSeleccion['Id_MaesTipoPago'];
$descripcion=$rowSeleccion['Nombre_MaesTipoPago'];
$tipoCambio=$rowSeleccion['TasaCambio_MaesTipoPago'];
$calculoComicion=$rowSeleccion['PagaComision_MaesTipoPago'];
$usuario =$rowSeleccion['Usuario_MaesTipoPago'] ; 
$fecha=$rowSeleccion['FechaCreacion_MaesTipoPago']; 
$maquina =$rowSeleccion['MaqCreacion_MaesTipoPago'];
	}
}
 }

 }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon- Tipo Pago</title>
<link href="css/PlantillaMantenimiento -TipPagos.css" rel="stylesheet" type="text/css" />
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

<div class="container" >
  <div class="header">
    <h1> Mantenimiento Tipos de Pago </h1>
     <h2 align="right">
     <form id="form1" name="form1" method="POST" action=""> 
    <input value="" name="Buscar" type="text" />
    <input type="submit" name="btn2"  value="Buscar" />
    </form>
    </h2>
    
    </div>
  <div class="content" id="printme">
  <form  id="form1" name="form1" method="post" action="" >
     	<table>
        <tr>
        <td><label for="ID">ID </label></td>
        <td><input name="ID" type="text" value="<?php echo $id ;?>" readonly /></td> 
      	<tr>
        <td><label for="Descripcion">Descripcion</label></td>
        <td><input name="Descripcion" type="text" value= "<?php echo $descripcion;?> " readonly/></td>
        <tr>
        <td><label for="Tipo de Cambio">Tipo de Cambio</label></td>
        <td><input name="TipoCambio" type="text"  value="<?php echo $tipoCambio;?>" readonly/></td>
<tr>        
        <td><label for="Calculo de Comicion">Calculo de Comicion</label></td>
        <td><input name="CalculoComicion" type="text" value="<?php echo $calculoComicion ;?>"readonly /></td>
     </tr>
     </table>   
     <p> </p>
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
      <td width="54"><input class="bordes" type="submit" name="btn1" id="Buscar" value="Buscar" /></td>
      <td width="65"><input class="bordes" type="submit" name="btn1" id="Imprimir" value="Imprimir" onclick="printcontent('printme')" /></td>
      <td width="62"><input class="bordes" type="submit" name="btn1" id="Agregar" value="Agregar"/></td>
      <td width="68"><input class="bordes" type="submit" name="btn1" id="Modificar" value="Modificar" /></td>
      <td width="62"><input class="bordes" type="submit" name="btn1" id="Eliminar" value="Eliminar" /></td>
      </tr>
      </table>
      </form>
<?php 

if(isset($_POST["btn1"])){
$accion=$_POST["btn1"];
$idMarcaModificar = $_POST["ID"];
$nombreMarcaModificar= $_POST["Descripcion"];
$TcambioModificar = $_POST['TipoCambio'];
$ComicionModificar=$_POST['CalculoComicion'];
	
///Salir	
if($accion=="Salir"){
echo '<script> window.location="PaginaPrincipla.php"</script>';}
///Eliminar
$valorIdELiminar = $_POST["ID"];
if($accion=="Eliminar"){
	if(($id==1)or($id==2)){echo "<script>alert('Imposible borrar estos datos son creados por el sistema ')</script>";}else{
		if($valorIdELiminar !=""){
		   $EliminarQuery = "Delete from  ent_maestipopago where Id_MaesTipoPago= '$valorIdELiminar' && IdPais_MaesMarca='$paisEmpresa' && IdEmpr_MaesMarca= '$empresaID'" ;
		$respuestaDelete=$mysqli->query($EliminarQuery)or die ("No se pudo Eliminar Tipo de Pago") ;
		if($respuestaDelete!==False){ 
	 echo "<script> alert('Éxito al eliminar tipo de pago')</script>";
	echo '<script> window.location ="MantenimientoTiposPago.php"</script> ' ; 
}else{ 
    echo "Falló al eliminar Tipo de Pago"; 
}   
		}else{echo "No hay Tipo de Pago para Eliminar";}
		}	
}
///Modificar  
if($accion == "Modificar"){
	if(($id==1)or($id==2)){echo "<script>alert('Imposible Modificar estos datos son creados por el sistema ')</script>";}else{
	if($idMarcaModificar !=""){
				echo "<script> window.open('ModificarTpago.php?id=$idMarcaModificar  & descripcion=$nombreMarcaModificar & cambio=$TcambioModificar & Comicion=$ComicionModificar', 'Modificar-Tipo Pago','width=1100, height=350')</script> " ;}else {echo "No hay Tipo Pago para Modificar";}
}		
}
///agregar
if($accion=="Agregar"){
	echo "<script> window.open('NuevaTpago.php', 'Nuevo-Tipo de pago','width=1100, height=350')</script> ";
}
///Imprimir
if ($accion == "Imprimir"){
}
///Buscar
 if ($accion=="Buscar"){
echo "Buscar";
		 }				
	  

 }
?>          
    </div>
  
  <!-- end .container --></div>
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