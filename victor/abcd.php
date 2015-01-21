<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>javascript - Obtener el valor de un select de varias maneras</title>
    <script>
    function capturar()
    {
        // obtenemos e valor por el numero de elemento
        var porElementos=document.forms["form1"].elements[4].value;
        // Obtenemos el valor por el id
        var porId=document.getElementById("seleccion").value;
        // Obtenemos el valor por el Nombre
        var porNombre=document.getElementsByName("seleccion")[0].value;
        // Obtenemos el valor por el tipo de tag
        var porTagName=document.getElementsByTagName("select")[0].value;
        // Obtenemos el valor por el nombre de la clase
        var porClassName=document.getElementsByClassName("formulario_select")[0].value;
        
        document.getElementById("resultado").innerHTML=" \
            Por elementos: "+porElementos+" \
            <br>Por ID: "+porId+" \
            <br>Por Nombre: "+porNombre+" \
            <br>Por TagName: "+porTagName+" \
            <br>Por ClassName: "+porClassName;
    }
	
    </script>
    
    <style>
        form   {width:250px;height:180px;border:1px solid #ccc;padding:10px;}
    </style>
</head>

<body>


    <h1>Obtener el valor de un select de varias maneras</h1>
    <form id="form1" method="post" action="">
        Nombre:<br>
        <input type="text" name="nombre1" value="jose" id="nombre1" class="formulario">
     
        
        <p><input type="checkbox" name="acepto" id="acepto" class="formulario_check"> Acepto el contrato</p>
        
        <p>Deacuerdo: Si<input type="radio" name="deacuerdo" value="si"> No<input type="radio" name="deacuerdo" value="no"></p>
        
        <p>
        <select name="seleccion" id="seleccion" class="formulario_select">
            <option value="1">primera</option>
            <option value="2">segunda</option>
        </select>
        </p>
    </form>
  
    
    <input type="button" value="Que valor hay en el select" onclick="funcion a();">
    
    
    <?php 
	$string = "'afsdfd'adsfasdfasd'saafsd'";
	echo addslashes($string);
	?>

    <div id="resultado"></div>
    
    <p><a href="http://www.lawebdelprogramador.com">http://www.lawebdelprogramador.com</a></p>
</body>
</html>










$("#PORTADA").focus(function (){
var reading = 0;
if (reading == 1){
	document.print('go sleep');
		}
        else (reading != 1){
        	document.print('common read me')
        }
}
);










