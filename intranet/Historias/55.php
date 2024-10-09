<?



function suma_fechas($fecha,$ndias)
            
 
{

           
 
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
            
 
              list($dia,$mes,$año)=split("/", $fecha);
            
 
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
            
 
              list($dia,$mes,$año)=split("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
        $nuevafecha=date("d-m-Y",$nueva);
            
 
      return ($nuevafecha);  
            
 
}
echo '<head>
            
 
              <title>'.$_SERVER[PHP_SELF].'</title>
            
 
      </head>
            
 
      <html>
            
 
      <body>';
$f1="02/08/2006";
            
 
$f2="02/08/2006";
$f11=suma_fechas($f1,30);
            
 
      echo "$f1 más 25 es  $f11<br>";
$f11=suma_fechas($f1, -1);
            
 
      echo "$f1 menos 40 es  $f11<br>";
$f21=suma_fechas($f2, 365);
            
 
      echo "$f2 más 365 es  $f21<br>";
$f21=suma_fechas($f2, -365);
            
 
      echo "$f2 menos 365 es  $f21<br>";
            
 
echo "<a href=$_SERVER[PHP_SELF]>Recargar la Página</a>";
echo '</body>
            
 
      </html>';
?>
            
 

