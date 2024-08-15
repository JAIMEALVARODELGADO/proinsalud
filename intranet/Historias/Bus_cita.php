<?
session_register('Gnombre');
session_register('Gidenti');
session_register('Gtipoafi');
session_register('Gestado');
session_register('Gcodi');
session_register('Gcontra');
session_register('Gcodmed');
session_register('Gfeini');
session_register('Gffini');
session_register('Garea');
session_register('Ghora');
session_register('Gtodos');
?> 
<HTML>
<HEAD>
<title>Buscar datos del usuario</title>

<?

$Gtodos=$GLOBALS["tod"];
$Gcodmed=$GLOBALS["medicoe"];
$Gfeini=$GLOBALS["date23"];
$Gffini=$GLOBALS["date2"];
$Garea=$GLOBALS["areae"];


?>


</HEAD>





     <FRAMESET cols=100%,* border="0" frmborder="0">
     <FRAMESET rows=40%,*> 
      <FRAME SRC=histo_ci.php NAME=Frm1> 


	<FRAMESET cols=100%,*>

      <FRAME SRC= gen_cita_der.php NAME=Frm2> 
      

     </FRAMESET> 


  

     </FRAMESET> 

     </FRAMESET> 
  






 


</HTML>