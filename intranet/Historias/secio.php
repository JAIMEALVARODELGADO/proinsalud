<?php   
session_name('misesion'); 
session_register('contador'); 



echo '<a href="'.$PHP_SELF.'?'.SID.'">Contador vale: '.++$_SESSION['contador'].'</a><br>'; 
echo 'Ahora el nombre es '.session_name().' y la sesión '.$misesion.'<br>'; 
?> 