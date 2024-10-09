<?
session_name('misesion'); 
session_register('contador'); 
session_register('IP');
?>
<html>
<head>
<title>Principal</title>
<Script Language="JavaScript">
function load() {
texto=form1.formad.value
//720
var load = window.open("index.php?ide="+texto,'','scrollbars=si,menubar=no,height=900,width=1200,top=0, left=0, resizable=si,toolbar=si,location=si,status=si');
//var load = window.open("index.php?ide="+texto);
window.opener = top ;
window.close();

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