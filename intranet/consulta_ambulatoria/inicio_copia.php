<?
session_register('Gcod_mediconh');
session_name('misesion'); 
session_register('contador'); 
session_register('IP'); 
$Gcod_mediconh=$id;
?>
<html>
<head>
<title>Principal</title>
<Script Language="JavaScript">
function load() {
//Ancho Y Alto Con Que Desea La Nueva Ventana.

var ancho = 400;
var alto = 200;

//Con un sencillo proceso calculamos la altura y anchura de la ventana, luego hacemos el calculo para poner la ventana de tal manera que quede centrada a la pantalla.
var centroAncho = (screen.width/2) - (ancho/2);
var centroAlto = (screen.height/2) - (alto/2);

texto=form1.formad.value
jlm = window.open("iniindex.php?ide="+texto,'','fullscreen,toolbar=0,location=0,directories=0,status=0,menubar =0,scrollbars=0,resizable=0');
//Ahora hacemos un resezeTo() para achicar esa ventana y como esta a fullscreen no tendra barras ni bordes ni nada:
jlm.resizeTo(ancho,alto)

//La centramos.
jlm.moveTo(centroAlto,centroAncho)

}
</Script>
















<?php

echo '<a href="'.$PHP_SELF.'?'.SID.'">Contador vale: '.++$_SESSION['contador'].'</a><br>'; 

echo 'Ahora el nombre es '.session_name().' y la sesión '.$misesion.'<br>'; 

function getRealIP()
{
   
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
  
   
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
   
      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
 
            $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');
   
            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
   
            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }
   
   return $client_ip;
   
}


?>

 <?php 
$IP=getRealIP();
echo "ip: $IP";

?>

</head>
<body onload="javascript:load()">
		<form name=form1 METHOD=POST ACTION=index.php>
		<?
		echo"<input type=hidden name=formad value='$id'>";
		?>
</form>
		</body>
</html>