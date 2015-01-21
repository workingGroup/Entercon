// JavaScript Document
function printcontent(el){
	DEscuento();
imprimir(el);
 
}
function GuardarDocumento(){
	  	$.ajax({
          type:"post",
          url:"ajax/AJCPuntoVenta.php",
          dataType:"json",
		  async:false,
          data:"Insertar="+"&IDDOC="+Documento+"&Fecha="+fecha+"&Serie="+Serie+"&Factura="+Factura+"&NIT="+NIT+"&Tpago="+Tpago+"&TDoc="+TDoc,
          success:function (data){
          }
        });
}