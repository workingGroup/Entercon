// JavaScript Document
/////Documento
var Codigo = null ;
var Nombre = null ;
var Clasificacion = null ;
var Marca = null ;
var Modelo = null;
var Proveedor= null; 
var Minimos =null ;
var ValorCompra = null;
var ValorVenta=null;
var Medida= null;
var ModificarPrecio= null;
var Usuario=null;
var Estado=null;
/////Detalle
//LLenar detalle Segun NO Documento
function Search(){
	var ValorBuscar= document.getElementById("Buscar").value;
$.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:"Buscar="+"&VB="+ValorBuscar,
          success:function (data){
 Codigo = data.Codigo;
 Nombre =  data.Nombre ;
 Clasificacion =  data.Clasificacion ;
 Marca =  data.Marca ;
 Modelo =  data.Modelo;
 Proveedor=  data.Proveedor; 
 Minimos = data.Minimos ;
 ValorCompra =  data.ValorCompra;
 ValorVenta= data.ValorVenta;
 Medida=  data.Medida;
 ModificarPrecio=  data.ModificarPrecio;
 Usuario= data.Usuario;
 Estado=data.Estado;
  Tabla_Data(Codigo);
         llenarValores();  
		 Tabla_Data2(Codigo); 
        
          }
        });

}
function Modify(){
	var Codigo=document.getElementById("Codigo").value;
	window.open('ModificarProducto.php?Codigo='+Codigo+'', 'Modificar-Producto','width=1100, height=350');
	 return false;
	}
function Add(){
var codigo=document.getElementById("Codigo").value;
	window.open('NuevoDUNM.php?codigo='+codigo+'', 'NuevoDUNM','width=1100, height=350');
	 return false;
}
function llenarValores(){
	document.getElementById("Codigo").value=Codigo;
	document.getElementById("Nombre").value=Nombre;
	document.getElementById("Clasificacion").value=Clasificacion;
	document.getElementById("Marca").value=Marca;
	document.getElementById("Modelo").value=Modelo;
	document.getElementById("Proveedor").value=Proveedor;
	document.getElementById("Minimos").value=Minimos;
	document.getElementById("ValorCompra").value=ValorCompra;
	document.getElementById("ValorVenta").value=ValorVenta;	
	document.getElementById("Medida").value=Medida;	
	document.getElementById("Usuario").value=Usuario;
	document.getElementById("estado").value=Estado;
	$("#estado").html(Estado)
	if(ModificarPrecio==1){
		 document.getElementById("Modificar Precio").checked = true;
	}else if(ModificarPrecio==0){
		 document.getElementById("Modificar Precio").checked = false;
		
	}
}

function Primero(){
 $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:"Iniccio=",
          success:function (data){
 Codigo = data.Codigo;
 Nombre =  data.Nombre ;
 Clasificacion =  data.Clasificacion ;
 Marca =  data.Marca ;
 Modelo =  data.Modelo;
 Proveedor=  data.Proveedor; 
 Minimos = data.Minimos ;
 ValorCompra =  data.ValorCompra;
 ValorVenta= data.ValorVenta;
 Medida=  data.Medida;
 ModificarPrecio=  data.ModificarPrecio;
 Usuario= data.Usuario;
 Estado=data.Estado;
  Tabla_Data(Codigo);
         llenarValores();  
		 Tabla_Data2(Codigo); 
        
          }
        });

}
function Ultimo(){
 $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:"Final=",
          success:function (data){
 Codigo = data.Codigo;
 Nombre =  data.Nombre ;
 Clasificacion =  data.Clasificacion ;
 Marca =  data.Marca ;
 Modelo =  data.Modelo;
 Proveedor=  data.Proveedor; 
 Minimos = data.Minimos ;
 ValorCompra =  data.ValorCompra;
 ValorVenta= data.ValorVenta;
 Medida=  data.Medida;
 ModificarPrecio=  data.ModificarPrecio;
 Usuario= data.Usuario;
 Estado=data.Estado;
         llenarValores();
		 Tabla_Data(Codigo);   
		 Tabla_Data2(Codigo);
          }
        });

}
function Anterior(){
	var IDProd = document.getElementById("Codigo").value;
 $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:"Previo="+"&IDprod="+IDProd,
          success:function (data){
			  
 Codigo = data.Codigo;
 Nombre =  data.Nombre ;
 Clasificacion =  data.Clasificacion ;
 Marca =  data.Marca ;
 Modelo =  data.Modelo;
 Proveedor=  data.Proveedor; 
 Minimos = data.Minimos ;
 ValorCompra =  data.ValorCompra;
 ValorVenta= data.ValorVenta;
 Medida=  data.Medida;
 ModificarPrecio=  data.ModificarPrecio;
 Usuario= data.Usuario;
 Estado=data.Estado;
         llenarValores();   
		 Tabla_Data(Codigo);
		 Tabla_Data2(Codigo);
          }
        });

}

function Next(){
	var IDProd = document.getElementById("Codigo").value;
 $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:"Siguiente="+"&IDprod="+IDProd,
          success:function (data){
			  
 Codigo = data.Codigo;
 Nombre =  data.Nombre ;
 Clasificacion =  data.Clasificacion ;
 Marca =  data.Marca ;
 Modelo =  data.Modelo;
 Proveedor=  data.Proveedor; 
 Minimos = data.Minimos ;
 ValorCompra =  data.ValorCompra;
 ValorVenta= data.ValorVenta;
 Medida=  data.Medida;
 ModificarPrecio=  data.ModificarPrecio;
 Usuario= data.Usuario;
 Estado=data.Estado;
         llenarValores();
		 Tabla_Data(Codigo);  
		 Tabla_Data2(Codigo);
          }
        });

}
function Agregar(){
	window.open('nuevoProducto.php','Nuevo-Producto','width=1100, height=350');
	 return false;
}
function Delete(){
	if (confirm("Si eliminas este producto ya no estara disponible para venderlo o comprarlo y deberas crearlo nuevamente - si no quieres mostrarlo modificalo y desactivalo!...\n\n¿Realmente deseas continuar presiona aceptar para eliminar o cancelar para cerrar este dialogo sin eliminar el dato?") == true) {
       var codigo= document.getElementById("Codigo").value;
	$.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:"Delete="+"&DeleteID="+codigo,
          success:function (data){
			  alert('Producto Eliminado');
			  window.location.reload();
			  		  }
	});
    } 
	
}

  function printme(){
	  var resetearpagina  = document.body.innerHTML;
	  var Printcontent = document.getElementById("contenido").innerHTML;
	  document.body.innerHTML = Printcontent;
	  window.print();
	  document.body.innerHTML = resetearpagina;
  }
   
function Tabla_Data(CODIGO){
		
		var valoresTabla = "tabla_data="+"&Codigo="+CODIGO;
      $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:valoresTabla,
          success:function (data){
            $("#TablaDUM").html(data);
          }
        });
    }
	function Tabla_Data2(CODIGO){
		
		var valoresTabla = "tabla_data2="+"&Codigo="+CODIGO;
      $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:valoresTabla,
          success:function (data){
            $("#MovBodega").html(data);
          }
        });
    }
	
   $(document).ready(function(){
Primero();
    }); 
	
	
    
   
 