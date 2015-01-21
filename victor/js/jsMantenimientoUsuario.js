// JavaScript Document
var Id=null;
var Nombre=null;
var Contraseña=null;
var Descuento=null;
var NombreUsuario=null;
var Role=null;
var Usuario=null;
var Fecha=null;
var Maquina=null;
var RoleId=null ;
Inicio()
function LLenarDatos(){
	document.getElementById("ID").value=Id;
	document.getElementById("Nombre").value=Nombre;
	document.getElementById("Contraseña").value=Contraseña;
	document.getElementById("Descuento").value=Descuento;
	document.getElementById("Usuario").value=NombreUsuario;
	document.getElementById("Role").value=Role;
	document.getElementById("UsuarioCrecion").value=Usuario;
	document.getElementById("FechaCreacion").value=Fecha;
	document.getElementById("MaquinaCreacion").value=Maquina;
	
	}
function Inicio(){
$.ajax({
	type:"post",
	dataType:"json",
	url:"ajax/AJCMantenimientoUsuario.php",
	data:"Inicio=",
	success: function(data){
 Id=data.Id;
 Nombre=data.Nombre;
 Contraseña=data.Contraseña;
 Descuento=data.Descuento;
 NombreUsuario=data.NombreUsuario;
 Role=data.Role;
 Usuario=data.Usuario;
 Fecha=data.Fecha;
 Maquina=data.Maquina;	
 LLenarDatos();
 Tabla_Data(Id);
		}
	});		
}
function Previo(){
$.ajax({
	type:"post",
	dataType:"json",
	url:"ajax/AJCMantenimientoUsuario.php",
	data:"Previo="+"&Documento="+Id,
	success: function(data){
 Id=data.Id;
 Nombre=data.Nombre;
 Contraseña=data.Contraseña;
 Descuento=data.Descuento;
 NombreUsuario=data.NombreUsuario;
 Role=data.Role;
 Usuario=data.Usuario;
 Fecha=data.Fecha;
 Maquina=data.Maquina;	
 LLenarDatos();
 Tabla_Data(Id);
		}
	});		
}
function Siguiente(){
$.ajax({
	type:"post",
	dataType:"json",
	url:"ajax/AJCMantenimientoUsuario.php",
	data:"Siguiente="+"&Documento="+Id,
	success: function(data){
 Id=data.Id;
 Nombre=data.Nombre;
 Contraseña=data.Contraseña;
 Descuento=data.Descuento;
 NombreUsuario=data.NombreUsuario;
 Role=data.Role;
 Usuario=data.Usuario;
 Fecha=data.Fecha;
 Maquina=data.Maquina;	
 LLenarDatos();
 Tabla_Data(Id);
		}
	});		
}
function Final(){
$.ajax({
	type:"post",
	dataType:"json",
	url:"ajax/AJCMantenimientoUsuario.php",
	data:"Final=",
	success: function(data){
 Id=data.Id;
 Nombre=data.Nombre;
 Contraseña=data.Contraseña;
 Descuento=data.Descuento;
 NombreUsuario=data.NombreUsuario;
 Role=data.Role;
 Usuario=data.Usuario;
 Fecha=data.Fecha;
 Maquina=data.Maquina;	
 LLenarDatos();
 Tabla_Data(Id);
		}
	});		
}
function Buscar(){
var Item=$("#Buscar").val();
$.ajax({
	type:"post",
	dataType:"json",
	url:"ajax/AJCMantenimientoUsuario.php",
	data:"Buscar="+"&Item="+Item,
	success: function(data){
 Id=data.Id;
 Nombre=data.Nombre;
 Contraseña=data.Contraseña;
 Descuento=data.Descuento;
 NombreUsuario=data.NombreUsuario;
 Role=data.Role;
 Usuario=data.Usuario;
 Fecha=data.Fecha;
 Maquina=data.Maquina;	
 LLenarDatos();
 Tabla_Data(Id);
		}
	});		
}
function printcontent(el){
	  var resetearpagina  = document.body.innerHTML;
	  var Printcontent = document.getElementById(el).innerHTML;
	  document.body.innerHTML = Printcontent;
	  window.print();
	 document.body.innerHTML = resetearpagina;
  }
function Agregar(){
	window.open('NuevoUsuario.php', 'Nuevo-Usuario','width=1100, height=350');
	 return false;
}
function Modificar(){
	var Id = document.getElementById("ID").value;
	var Nombre=document.getElementById("Nombre").value;
	var Descuento=document.getElementById("Descuento").value;
	var Usuario=document.getElementById("Usuario").value;
	window.open('ModificarUsuario.php?Id='+Id+'&Nombre='+Nombre+'&Descuento='+Descuento+'&Usuario='+Usuario+'', 'Modificar-Usuario','width=1100, height=350');
	 return false;
}


function Tabla_Data(CODIGO){
		
		var valoresTabla = "tabla_data="+"&Codigo="+CODIGO;
      $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoUsuario.php",
          dataType:"json",
          data:valoresTabla,
          success:function (data){
            $("#Tabla").html(data);
          }
        });
    }
 