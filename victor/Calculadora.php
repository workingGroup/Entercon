<html> 

<head><title>Calculadora dinamica</title></head> 

<body bgcolor="#373737"> 

<CENTER> 

<h1>CALCULADORA </h1> 

<form method="POST"> 

<font color="#FFF">Ingrese una operacion valida:</font><BR/> 
<input type="text" name="caja" placeholder="ejemplo: 1+5, 6-4, 7*3, 10/2..." size=30><br/> 
<br/> 
<input type="submit" value="Procesar..."><br/> 
<br/> 

<?php 

if(isset($_POST['caja'])){ 

$caja=$_POST['caja']; 

if($caja==''){ 

echo '<font color="red"><b>Ingrese un valor</b></font>'; 

}else{ 

$resul="echo $caja;"; 

echo '<table border="0">'; 

echo '<tr bgcolor="#fff">'; 
echo '<td>'; 
echo '<strong>Operacion</strong>'; 
echo '</td>'; 

echo '<td>'; 
echo '<strong>Resultado</strong>'; 
echo '</td>'; 
echo '</tr>'; 

echo '<tr bgcolor="#fff">'; 
echo '<td>'; 
echo '<center><B>'.$caja.'</center></B>'; 
echo '</td>'; 

echo '<td>'; 
echo '<center><B>'; 
eval($resul); 
echo '</center></B>'; 
echo '</td>'; 
echo '</tr>'; 

echo '</table>'; 

} 

}//isset 

?> 

</form> 

<b>Nota:</b> tambien acepta el uso de parentesis, <b>ejemplo: (8*3)/(5-2)</b><br> 
Para potencia, escribir pow(base,potencia), <b>ejemplo: pow(2,3)</b><br/> 
Para raiz, utilizar sqrt(numero), <b>ejemplo: sqrt(100)</b> 

</CENTER> 

</body> 

</html> 