<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];

$IDocumento=$_GET['id']; 
$fecha=$_GET['fecha']; 
$Serie=$_GET['Series']; 
$Factura=$_GET['Factura']; 
$NIT=$_GET['NIT']; 
$Cliente=$_GET['Cliente']; 
$Direccion=$_GET['Direccion']; 
$TDoc=$_GET['TDoc'];
$Tpago=$_GET['Tpago'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if($TDoc==1){?>
<script>
function printcontent(el){
	DEscuento();
imprimir(el);
 
}

</script>
<?php }?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tipo De Pago</title>
<link href="css/PlantillaDetalleTipoPago.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<?php if($TDoc==1){?>
 <script>
  function DEscuento(){
var Documento ="<?php echo $IDocumento; ?>"; 
var fecha ="<?php echo $fecha; ?>"; 
var Serie ="<?php echo $Serie; ?>"; 
var Factura ="<?php echo $Factura; ?>"; 
var NIT ="<?php echo $NIT; ?>"; 
var Cliente ="<?php echo $Cliente; ?>"; 
var Tpago ="<?php echo $Tpago; ?>"; 
var TDoc="<?php echo $TDoc; ?>"; 

	  	$.ajax({
          type:"post",
          url:"ajax/AJCPuntoVenta.php",
          dataType:"json",
		  async:false,
          data:"Insertar="+"&IDDOC="+Documento+"&Fecha="+fecha+"&Serie="+Serie+"&Factura="+Factura+"&NIT="+NIT+"&Tpago="+Tpago+"&TDoc="+TDoc,
          success:function (data){
          }
        });
window.opener.location.reload();
window.close();
  }
  
  function imprimir(el){
	  var resetearpagina  = document.body.innerHTML;
	  var Printcontent = document.getElementById(el).innerHTML;
	  document.body.innerHTML = Printcontent;
	  window.print();
	  document.body.innerHTML = resetearpagina;
	  
  }
  </script>
<?php }?>
</head>

<body>

<div class="container">
  
  <div class="header">
  <h1><center>Tipo de pago</center></h1></div>
  <div class="content">
  <div id="Panel">
  <div id="TabbedPanels1" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
       <li class="TabbedPanelsTab" tabindex="0">Efectivo</li>
       <li class="TabbedPanelsTab" tabindex="0">Targeta</li>
       <li class="TabbedPanelsTab" tabindex="0">Efectivo y targeta</li>
    </ul>
  <div class="TabbedPanelsContentGroup">
      <div class="TabbedPanelsContent">
        <div id="Efectivo">
        <form action="" id="efectivo" method="post">
        <div id="EfectivoFactura">
        <center>
        <table>
        	<tr>
            	<td>Documento</td>
                <td id="DocumentoID"><?php
				 $IDDocumento=$_GET['id']; 
				echo $IDDocumento ;?></td>
            </tr>
        </table>
        
        <table class="tabla" border="1" bordercolor="#000000" bgcolor="#ccc">
            <tr>
            	<th bgcolor="#FFFFFF">Cantidad</th>  
                <th bgcolor="#FFFFFF">Descripcion</th>  
                <th bgcolor="#FFFFFF">Precio</th>  
            </tr>  
          <?php 
		  	$sql="Select * From ent_detalletemporal where IdPais_DetalleDocumento='$paisEmpresa' AND IdEmpr_DetalleDocumento ='$empresaID' AND 
Documento_DetalleDocumento='$IDDocumento'";
			$Result=$mysqli->query($sql);
				while($row=$Result->fetch_assoc()){
		  ?><tr>
          	    <td bgcolor="#FFFFFF"><?php echo $row['Cantidad_DetalleDocumento']; ?></td>  
               <td bgcolor="#FFFFFF"><?php echo $row['Descripcion_DetalleDocumentoT']; ?></td>
               <td bgcolor="#FFFFFF"><?php  echo $row['total']; ?></td>  
            </tr>
          <?php }?>
          <?php $sqlsum="SELECT SUM(total) as total_DOC,SUM(Cantidad_DetalleDocumento) as total_U FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$IDDocumento'";
			$Resultsum=$mysqli->query($sqlsum);
			while($rowTOTALU = $Resultsum->fetch_assoc())
				{
					$totalTT = $rowTOTALU['total_DOC'];
					$totalU= $rowTOTALU['total_U'];
					
				};
	
			
			?><center>
        <tr><td bgcolor="#FFFFFF"><?php echo $totalU ;?></td><td bgcolor="#FFFFFF">Total</td><td bgcolor="#FFFFFF"><?php echo $totalTT;?></td></tr>
        </center>
   		</table>
          </center>
           </div>
        <center>
       	 	<table>
            	<tr>
                	<td>Efectivo</td>
                    <td><input type="text" id="Efectivo-Efectivo"  /></td>
                	
                </tr>
                <tr>
                	<td>Efectivo a pagar</td>
                	<td><input type="text" id="Efectivo-Total"  disabled="disabled" value="<?php echo $totalTT;?>"/></td>
                </tr>
            </table>
             
            <table>
             <tr>
                	<center><td><input type="button" id="Efectivo-Pagar" onclick="printcontent('EfectivoFactura');" value="Pagar"/></td>
                      </center>  
                   
                
                </tr>
            </table>
           </center>
       	</form>
       </div>
       </div>
       <div class="TabbedPanelsContent">
          <div id="Tarjeta">
        <form action="" id="Tarjeta" method="post">
        <center>
        <div id="FacturaTarjeta">
        <table>
        	<tr>
            	<td>Documento</td>
                <td id="DocumentoID"><?php
				 $IDDocumento=$_GET['id']; 
				echo $IDDocumento ;?></td>
            </tr>
        </table>
        
        <table class="tabla" border="1" bordercolor="#000000" bgcolor="#ccc">
            <tr>
            	<th bgcolor="#FFFFFF">Cantidad</th>  
                <th bgcolor="#FFFFFF">Descripcion</th>  
                <th bgcolor="#FFFFFF">Precio</th>  
            </tr>
         
          <?php 
		  	$sql="Select * From ent_detalletemporal where IdPais_DetalleDocumento='$paisEmpresa' AND IdEmpr_DetalleDocumento ='$empresaID' AND 
Documento_DetalleDocumento='$IDDocumento'";
			$Result=$mysqli->query($sql);
				while($row=$Result->fetch_assoc()){
		  ?><tr>
          	    <td bgcolor="#FFFFFF"><?php echo $row['Cantidad_DetalleDocumento']; ?></td>  
               <td bgcolor="#FFFFFF"><?php echo $row['Descripcion_DetalleDocumentoT']; ?></td>
               <td bgcolor="#FFFFFF"><?php  echo $row['total']; ?></td>  
            </tr>
          <?php }?>
          <?php $sqlsum="SELECT SUM(total) as total_DOC,SUM(Cantidad_DetalleDocumento) as total_U FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$IDDocumento'";
			$Resultsum=$mysqli->query($sqlsum);
			while($rowTOTALU = $Resultsum->fetch_assoc())
				{
					$totalTT = $rowTOTALU['total_DOC'];
					$totalU= $rowTOTALU['total_U'];
					
				};
	
			
			?><center>
        <tr><td bgcolor="#FFFFFF"><?php echo $totalU;?></td><td bgcolor="#FFFFFF">Total</td><td bgcolor="#FFFFFF"><?php echo $totalTT;?></td></tr>
        </center>
   		</table>
        </div>
          </center>
        <center>
       	 	<table>
            	<tr>
   					<td>Cargo en tarjeta</td>             	
                    <td><input type="text" id="Tarjeta-Total"  disabled="disabled" value="<?php echo $totalTT;?>"/></td>
                </tr>
                <tr>
                	<td>Targetas</td>
                	<td><select id="Tarjeta-Tarjeta">
                    <option value="1">Visa</option>
                    <option value="2">Master Card</option>
                    </select>
                    </td>
                </tr>
                <tr>
                	<td>Numero:</td>
                	<td><input type="text" id="Tarjeta-Numero" value=""/></td>
                    <td>Nombre:</td>
                	<td><input type="text" id="Tarjeta-Nombre" value=""/></td>
                </tr>
            </table>
             
            <table>
             <tr>
                	<center><td><input type="button" id="Tarjeta-Pagar"  onclick="printcontent('FacturaTarjeta');" value="Pagar"/></td>
                      </center>  
                   
                
                </tr>
            </table>
           </center>
       	</form>
       </div>
       
       </div>
       <div class="TabbedPanelsContent">
       
        <div id="Tarjeta">
        <form action="" id="Tarjeta" method="post">
        <center>
        <div id="EfectivoTarjetaFactura">
        <table>
        	<tr>
            	<td>Documento</td>
                <td id="DocumentoID"><?php
				 $IDDocumento=$_GET['id']; 
				echo $IDDocumento ;?></td>
            </tr>
        </table>
        
        <table class="tabla" border="1" bordercolor="#000000" bgcolor="#ccc">
            <tr>
            	<th bgcolor="#FFFFFF">Cantidad</th>  
                <th bgcolor="#FFFFFF">Descripcion</th>  
                <th bgcolor="#FFFFFF">Precio</th>  
            </tr>
         
          <?php 
		  	$sql="Select * From ent_detalletemporal where IdPais_DetalleDocumento='$paisEmpresa' AND IdEmpr_DetalleDocumento ='$empresaID' AND 
Documento_DetalleDocumento='$IDDocumento'";
			$Result=$mysqli->query($sql);
				while($row=$Result->fetch_assoc()){
		  ?><tr>
          	    <td bgcolor="#FFFFFF"><?php echo $row['Cantidad_DetalleDocumento']; ?></td>  
               <td bgcolor="#FFFFFF"><?php echo $row['Descripcion_DetalleDocumentoT']; ?></td>
               <td bgcolor="#FFFFFF"><?php  echo $row['total']; ?></td>  
            </tr>
          <?php }?>
          <?php $sqlsum="SELECT SUM(total) as total_DOC,SUM(Cantidad_DetalleDocumento) as total_U FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$IDDocumento'";
			$Resultsum=$mysqli->query($sqlsum);
			while($rowTOTALU = $Resultsum->fetch_assoc())
				{
					$totalTT = $rowTOTALU['total_DOC'];
					$totalU= $rowTOTALU['total_U'];
					
				};
	
			
			?><center>
        <tr><td bgcolor="#FFFFFF"><?php echo $totalU;?></td><td bgcolor="#FFFFFF">Total</td><td bgcolor="#FFFFFF"><?php echo $totalTT;?></td></tr>
        </center>
   		</table>
        </div>
        <table>
            	<tr>
                	
                	
                </tr>
                
            </table>
          </center>
        <center>
          <table>
          <tr>
            <td><table>
              <tr>
                <td>Efectivo</td>
                <td><input type="text" id="EfectivoTarjeta-Efectivo"  /></td>
              </tr>
              <tr>
  <td>Cargo en tarjeta</td>
    <td><input type="text" id="EfectivoTarjeta-Cargo"value=""/></td>
  </tr>
  
  <tr>
 	<td>Total a Pagar</td>
    <td><input type="text" id="EfectivoTarjeta-Total"value="<?php echo $totalTT ;?>" disabled="disabled"/></td>
  </tr>
  <tr>
    <td>Targetas</td>
    <td><select name="EfectivoTarjeta-Tarjeta" id="EfectivoTarjeta-Tarjeta">
      <option value="1">Visa</option>
      <option value="2">Master Card</option>
    </select></td>
  </tr>
  <tr>
    <td>Numero:</td>
    <td><input type="text" id="EfectivoTarjeta-Numero" value=""/></td>
    <td>Nombre:</td>
    <td><input type="text" id="EfectivoTarjeta-Nombre" value=""/></td>
  </tr>
            </table></td>
          </tr>
          </table>
          <table>
             <tr>
                	<center><td><input type="button" id="EfectivoTarjeta-Pagar" onclick="printcontent('EfectivoTarjetaFactura');" value="Pagar"/></td>
                      </center>  
                   
                
                </tr>
            </table>
           </center>
       	</form>
       </div>
       
       </div>
     </div>
   </div>
 
 </div>
  </div>
   <!-- end .content -->
  <div  align="center" class="footer">

     
  </div>
       
</div>
<!-- end .container -->
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
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