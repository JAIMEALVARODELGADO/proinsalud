<?php
session_start();
$_SESSION[id_cita]=$idcita;
$_SESSION[codi_usu]=$codiusu;
$_SESSION[asol_ref]=$asolref;
?>
<!-- Aqui se definen los frames de la captura de terapia-->
<HTML>
<HEAD>
<title>TERAPIA</title>
</HEAD>
    <FRAMESET COLS="15%,*" framespacing="0" border="0" frameborder="0">
        <FRAME SRC='ter_left.php' NAME='fr03'>
        <FRAME SRC='fondo.php' NAME='fr04'>
    </FRAMESET>
</HTML>
