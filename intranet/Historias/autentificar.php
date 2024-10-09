<?
session_register('Goper');
$Goper=$usuario;
?>
<html>
<head>
<title>Principal</title>
<Script Language="JavaScript">
function load() {
var load = window.open('frm_princi.php','',',scrollbars=si,menubar=si,height=760,width=1020,top=0, left=0, resizable=no,toolbar=no,location=si,status=no');
 
}
</Script>

<? 
//conecto con la base de datos 
$conn = mysql_connect("localhost","root",""); 

//selecciono la Base de Datos 
mysql_select_db("General",$conn); 

//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT * FROM seguridad WHERE Log_Segu='$usuario' and Pas_Segu='$clave'"; 

//Ejecuto la sentencia 
$rs = mysql_query($ssql,$conn); 

//vemos si el usuario y contraseña es váildo 
//si la ejecución de la sentencia SQL nos da algún resultado 
//es que si que existe esa conbinación usuario/contraseña 
if (mysql_num_rows($rs)!=0){ 
    //Si el usuario y contraseña son válidos: defino una sesion y guardo datos 
    
    /*  while($row = mysql_fetch_row($rs)) {
         //cargo la variable con el sql a utilizar
         $usuario= "$row[1]";
      }
*/
    session_start(); 
    $fecha=date("Y-n-j H:i:s");
    $_SESSION["datos"]=array('SI', $fecha, $usuario);
//    header ("Location: frm_princi.php,,fullscreen");

echo "</head>";
echo "<body onload=javascript:load()>";
echo  "<!-- <a href=javascript:load()>Solicitudes de Informatica</a> -->";
echo "</body>";
echo "</html>";



}else { 
    //si no existe le mando otra vez a la portada 
   


header("Location: SI_Autenticacion.htm?errorusuario=si"); 

} 
mysql_free_result($rs); 
mysql_close($conn); 
?> 
