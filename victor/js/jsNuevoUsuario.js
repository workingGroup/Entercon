// JavaScript Document
var Role= null ;

    $(document).ready(function(){
Roles();
RoleSV()
	});
	
function RoleSV(){
Role=document.getElementById("Role").value;
alert(Role)
} 
function Roles(){
	 $.ajax({
		 type:"post",
		 url:"ajax/AJCMantenimientoUsuario.php",
		 dataType:"json",
		 data:"Roles=",
		 success: function(data){
var numero =0 ;
					select = document.getElementById("Role");
					var vacio = document.createElement('option');
					vacio.value ="-1";
					vacio.innerHTML = "Seleccione Role";
					select.appendChild(vacio);
					
						for(numero; numero<= data.Role.length ; numero++ ){
						var opt = document.createElement('option');
						opt.value =data.Role[numero]['Id'];
						opt.innerHTML =data.Role[numero]['Nombre'];
						select.appendChild(opt);
			}
		 }
	  });
 }
 function gettingValues() {
	var Nombre= document.getElementById("Nombre").value;
	var Contraseña= document.getElementById("Contraseña").value;
	var Descuento= document.getElementById("Descuento").value;
	var Usuario= document.getElementById("Usuario").value;
	if ((Nombre!="")&&(Contraseña!="")&&(Descuento!="")&&(Usuario!="")&&(Role!=-1)){
		 $.ajax({
			 type:"post",
			 dataType:"json",
			 url:"ajax/AJCMantenimientoUsuario.php",
			 data:"Nuevo="+"&Nombre="+Nombre+"&Contraseña="+Contraseña+"&Descuento="+Descuento+"&Usuario="+Usuario+"&Role="+Role,
			 success: function(){
				 alert ('hola');
				 }
		 	});
		 
	 }else{alert('Llene Todos los Datos')} 
 }
 
 function ModifyingValue() {
	var Nombre= document.getElementById("Nombre").value;
	var Contraseña= document.getElementById("Contraseña").value;
	var Descuento= document.getElementById("Descuento").value;
	var Usuario= document.getElementById("Usuario").value;
	if (document.getElementById("Role").value!=-1){
	if ((Nombre!="")&&(Descuento!="")&&(Usuario!="")){
		 $.ajax({
			 type:"post",
			 dataType:"json",
			 url:"ajax/AJCMantenimientoUsuario.php",
			 data:"Modificar="+"&Nombre="+Nombre+"&Contraseña="+Contraseña+"&Descuento="+Descuento+"&Usuario="+Usuario+"&Role="+Role,
			 success: function(){
				 alert ('hola');
				 }
		 	});
		 
	 }else{alert('Llene Todos los Datos')} 
	}else{alert('Seleccione Role')}
 }