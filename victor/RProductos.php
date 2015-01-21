<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];

	$query="SELECT * FROM ent_maesprod where IdPais_MaesProd ='$paisEmpresa' &&  IdEmpr_MaesProd = '$empresaID' ";
	$resultado=$mysqli->query($query);
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de Productos</title>
<link href="css/PlantillaRproductos.css" rel="stylesheet" type="text/css" />
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
  
 <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<body>

 <div class="container">
  <div class="header">
    <h1> Reporte de Productos</h1>
  </div>
  <div class="content" id ="printme">
  <table border=1 width="80%"  id="Exportar_a_Excel">
			<thead>
				<tr>
					<td><b>Codigo</b></td>
					<td><b>Nombre</b></td>
					<td><b>Clasificacion</b></td>
					<td><b>Marca </b></td>
                    <td><b>Modelo</b></td>
					<td><b>Proveedor</b></td>
					<td><b>Minimos</b></td>
					<td><b>Valor Compra </b></td>
                    <td><b>Valor Venta</b></td>
					<td><b>Medida </b></td>
					<td><b>Modifcar Precio</b></td>
				
				</tr>
				<tbody>
					<?php while($row=$resultado->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $row['CodigoAlt_MaesProd'];?></td>			
							<td><?php echo $row['Nombre_MaesProd'];?></td>
							<td><?php echo $row['IdTipoProd_MaesProd'];?></td>
							<td><?php echo $row['Id_Marca_MaesProd'];?></td>
                            
                            <td><?php echo $row['Modelo_MaesProd'];?></td>			
							<td><?php echo $row['IdSocio_MaesProd'];?></td>
							<td><?php echo $row['SaldoMinimo_MaesProd'];?></td>
							<td><?php echo $row['ValorCompra_MaesProd'];?></td>
                            
                            <td><?php echo $row['ValorVenta_MaesProd'];?></td>			
							<td><?php echo $row['IdUnidMedida_MaesProd'];?></td>
							<td><?php echo $row['ModificaPrecio_MaesProd'];?></td>
							
						</tr>
					<?php } ?>
				</tbody>
			</table>
  </div>
   
  <div  align="center" class="footer">

    <form id="form2" name="form2" method="post" action="">
      <input class="bordes" type="submit" name="Imprimir" id="Imprimir" value="Imprimir"  onclick="printcontent('printme')" />
       <input class="bordes" type="submit" name="btn1" id="salir" value="Salir" />
    </form>
    <?php 
	 if(isset($_POST["btn1"])){
$accion=$_POST["btn1"];
	 
	if($accion=="Salir"){
echo '<script> window.location="PaginaPrincipla.php"</script>';}
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