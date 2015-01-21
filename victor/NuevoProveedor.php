<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];

$Opcion8 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='14'");
	
			if(mysqli_num_rows($Opcion8) > 0){
			$_SESSION['PROVEEDORES']=1;
		}else { $_SESSION['PROVEEDORES']=0; }
	if($_SESSION['PROVEEDORES']==1){
require('coneccion.php');
$maquina = gethostname();
date_default_timezone_set('America/Guatemala');

$sqlIDdm = "SELECT max(Id_Socio)+1 as codigo from ent_maessocio where Id_MaesPais='$paisEmpresa' and Id_MaesEmpr='$empresaID' && Tipo_MaesSocio=1";
		$maxM1=$mysqli->query($sqlIDdm); 
		while($row= $maxM1->fetch_assoc()){$bin = $row['codigo']; 
		if ($bin!=""){
			$Id = $row['codigo'];}
		else{$Id=1;}
		$Id;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon- Nuevo Cliente</title>
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
  <h1>Nuevo Proveedor</h1></center>
</div>
<hr/>
    <form id="form1" name="form1" method="post" action="">
<table>
	 <tr> 
         <td> <label for="ID">ID</label></td>
         <td> <input type="text" name="ID" id="ID"  value="<?php echo $Id ;?>" disabled="disabled"/></td>
  	 <tr>        
         <td> <label for="Nit">Nit</label></td>
         <td> <input type="text" name="Nit" id="Nit" /></td>
     <tr>      
         <td> <label for="Razon">Razon</label></td>
         <td> <input type="text" name="Razon" id="Razon" /></td>
     <tr>      
         <td> <label for="Direccion">Direccion</label></td>
         <td> <input type="text" name="Direccion" id="Direccion" /></td>
     <tr>     
         <td> <label for="Telefonos">Telefonos</label></td>
         <td> <input type="text" name="Telefonos" id="Telefonos" /></td>
         
         <td> <label for="Fax">Fax</label></td>
         <td> <input type="text" name="Fax" id="Fax" /></td>
     <tr>  
         <td height="27">  <label for="email">email</label></td>
         <td> <input type="text" name="email" id="email" />    </td> 
     <tr>
     </tr>
     </table>
     <p>&nbsp;</p>
     <table width="987">
     <tr>
         <td width="77">  <label for="Usuario">Usuario</label></td>
         <td width="178"> <input type="text" name="Usuario" id="Usuario" value ="<?php echo $usuario ; ?>" readonly/></td>
      
         <td width="104"> <label for="FechaCrea">FechaCrea</label></td>
         <td width="203"> <input type="text" name="FechaCrea" id="FechaCrea" value = "<?php $fecha = date('y-m-d h:i:s'); echo $fecha; ?>" readonly/></td>
       
        <td width="115"> <label for="MaqCrea">MaqCrea</label></td>
        <td width="282">  <input type="text" name="MaqCrea" id="MaqCrea"
        value="<?php  echo $maquina;  ?>" readonly/></td>
    </tr>
    </table> 
      <p></p>
      <center><input class="bordes" type="submit" name="btn1" id="add" value="Agregar"/></center>
      </form>
      
      <?php if(isset($_POST["btn1"])){
		
	$btn=$_POST["btn1"];
	 if($btn=="Agregar"){
		$id=$Id;
		$nit=$_POST["Nit"];	
		$razon=$_POST["Razon"];
		$dicerrion=$_POST["Direccion"];	
		$telefonos=$_POST["Telefonos"];
		$fax=$_POST["Fax"];	
		$email=$_POST["email"];
		
	
	
			if ($id != "" && $nit !="" && $razon != "" && $dicerrion !="" && $telefonos != "" && $fax !="" && $email !=""){	$AgregarQuery = "insert into ent_maessocio(Id_MaesPais,Id_MaesEmpr,Id_Socio,RazonSocial_MaesSocio,Nit_MaesSociocol,Direccion_MaesSocio,Telefono_MaesSocio,Email_MaesSocio,Tipo_MaesSocio,Usuario_MaesSocio,FechaCreacion_MaesSocio,MaqCreacion_MaesSocio,Fax_MaesSocio) values ('$paisEmpresa' , '$empresaID' ,'$id' , '$razon' , '$nit' , '$dicerrion' , '$telefonos' , '$email', '2','$usuario' , '$fecha' , '$maquina','$fax')";
echo $AgregarQuery;
     $respuestaInsert=$mysqli->query($AgregarQuery)or die ("Aun no se ha insertado ningun dato") ; 
	if ($respuestaInsert !=False ){
   
   echo "<script> alert('Éxito al Insertar')</script>";
	 echo "<script>window.close</script>";
}else{ 
    echo "Falló al Insertar Cliente"; 
}   
		}else{echo "LLene todos los campos";}

	 }	

	  }
	  ?>
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