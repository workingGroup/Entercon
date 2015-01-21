<?PHP
   session_start ();
?>
<HTML LANG="es">
<HEAD>
<TITLE>Desconectar</TITLE>
<LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">

</HEAD>
<BODY bgcolor="#373737"  >

<?PHP
  if ($_SESSION["Logged"]='yes')
   {
      session_destroy ();
       echo "<h1><center>Conexion finalizada</center></h1>";
    
   }
   else
   {
     echo "<h1><center> No existe una conexion activa Inicie secion</center></h1>";
 
   }
?>

</BODY>
</HTML>