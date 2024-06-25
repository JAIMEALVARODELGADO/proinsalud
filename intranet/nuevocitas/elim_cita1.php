<?
session_start();
$usucitas=$_SESSION['usucitas'];  
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function salir()
	{		
		uno.action='elim_cita0.php';
		uno.target='';
		uno.submit();			
	}		
</script>
</head>
<body onload='salir()'>
<?	
    if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	$dateh=date("Y-m-d");
	$hor= date("H:i:s");
    include ('php/conexion1.php');	
    if($tipbusca==1)	//	paciente	
    { 
		if($usucitas=='12991944')
		{
			echo"<table>
			<tr>
			<td>USADO</td>
			<td>NHORARIO</td>
			<td>NCITA</td>
			<td>SELCI</td>
			<td>NUMREF</td>
			<td>TIPOCI</td>
			<td>OBSELI</td>
			</TR>
			";
			for($i=0;$i<$finusu;$i++)
			{
				$uso=0;
				$nomvar='usado'.$i;
				$usado=$$nomvar;
				$nomvar='nhorario'.$i;
				$nhorario=$$nomvar;
				$nomvar='ncitac'.$i;
				$ncitac=$$nomvar;			
				$nomvar='selci'.$i;			
				$selci=$$nomvar;
				$nomvar='numref'.$i;
				$numref=$$nomvar;
				$uso=$usado+1;			
				$nomvar='tipoci'.$i;
				$tipoci=$$nomvar;
				$nomvar='obseli'.$i;
				$obseli=$$nomvar;
				ECHO"
				<tr>
				<td>$usado</td>
				<td>$nhorario</td>
				<td>$ncitac</td>
				<td>$selci</td>
				<td>$numref</td>
				<td>$tipoci</td>
				<td>$obseli</td>
				</TR>
				";				
			}
		}



	
        for($i=0;$i<$finusu;$i++)
        {
            $uso=0;
            $nomvar='usado'.$i;
            $usado=$$nomvar;
            $nomvar='nhorario'.$i;
            $nhorario=$$nomvar;
            $nomvar='ncitac'.$i;
            $ncitac=$$nomvar;			
            $nomvar='selci'.$i;			
            $selci=$$nomvar;
			$nomvar='numref'.$i;
            $numref=$$nomvar;
            $uso=$usado+1;			
			$nomvar='tipoci'.$i;
			$tipoci=$$nomvar;
			
			$nomvar='tipsoli'.$i;
			$tipsoli=$$nomvar;
			
			$nomvar='obseli'.$i;
			$obseli=$$nomvar;
			
			
			
			
			
            if($selci==1)
            {
                
				
				mysql_query("Update citas Set Clase_citas  ='$tipoci' where id_cita='$ncitac'");  
                mysql_query("UPDATE horarios SET Usado_horario = '$uso' WHERE ID_horario ='$nhorario'");               
				$bncitas=mysql_query("select cant_cit, idre_dre  from detareferencia where iden_dre='$numref'");
				$rncitas=mysql_fetch_array($bncitas);
				$cuentacit=$rncitas['cant_cit'];
				$idrefer=$rncitas['idre_dre'];
				
				$modorden=mysql_query("update orden Set esta_ord ='1406' where nume_ref='$idrefer'");
				$cuentacit=$cuentacit-1;
				
				$modhor=mysql_query("update detareferencia Set cita_dre ='', marc_dre='1402', cant_cit='$cuentacit' where iden_dre='$numref'");
				/*
				$tok = strtok ($numref,"-");
				while ($tok) 
				{	
					$tok = strtok ("-");
					$modhor=mysql_query("update detareferencia Set cita_dre ='', marc_dre='1402', cant_cit='$cuentacit' where iden_dre='$tok'");	
				}
				$rangoip=$vec[1];
				*/
				
				//echo "update detareferencia Set cita_dre ='', marc_dre='1402', cant_cit='$ncitasig' where iden_dre='$numref'";
				
				
				
				$bhor=mysql_query("select * from horarios where ID_horario='$nhorario'");
				while($rhor=mysql_fetch_array($bhor))
				{
					$codmedico=$rhor['Cmed_horario'];
					$codarea=$rhor['Cserv_horario'];
					$fechahor=$rhor['Fecha_horario'];
					$horahor=$rhor['Hora_horario'];
				}
				mysql_query("insert into vitacora (Codci_Vitaco ,Fopera_Vitaco,Hopera_Vitaco ,Operacio_Vitaco, pete_vitaco,Nota_Vitaco ,Cod_oper_vitaco,cmed_horario,cserv_horario,fecha_horario,hora_horario, tip_soli) values 
				($ncitac,'$dateh','$hor','DELETE','$tipoci','$obseli','$usucitas','$codmedico','$codarea','$fechahor','$horahor', '$tipsoli')");				
            }
        }	
    }	
    if($tipbusca==2)	//	medico
    {		
        for($j=100;$j<$finalp;$j++)
        {			
            $nomvar='fin'.$j;
            $final=$$nomvar;
            for($k=0;$k<$final;$k++)
            {
                $uso=0;
                $nomvar='nhorario'.$j.$k;
                $nhorario=$$nomvar;
                $nomvar='usado'.$j.$k;
                $usado=$$nomvar;
                $nomvar='id_cita'.$j.$k;
                $id_cita=$$nomvar;
                $nomvar='selhora'.$j.$k;
                $selhora=$$nomvar;
				$nomvar='numref'.$j.$k;
                $numref=$$nomvar;
                $uso=$usado+1;
                if($selhora==1)
                {
                    mysql_query("Update citas Set Clase_citas  ='$tipoci' where id_cita='$id_cita'"); 
                    mysql_query("UPDATE horarios SET Usado_horario = '$uso' WHERE ID_horario ='$nhorario'");
					$bncitas=mysql_query("select cant_cit from detareferencia where iden_dre='$numref'");
					$rncitas=mysql_fetch_array($bncitas);
					$cuentacit=$rncitas['cant_cit'];
					$cuentacit=$cuentacit-1;
					if($cuentacit>0)
					{						
						$modhor=mysql_query("update detareferencia Set cant_cit='$ncitasig' where iden_dre='$idendetaref'");	
					}
					else
					{
						$modhor=mysql_query("update detareferencia Set cita_dre ='', marc_dre='1402', cant_cit='$ncitasig' where iden_dre='$idendetaref'");	
					}
                    //echo "2. UPDATE horarios SET Usado_horario = '$uso' WHERE ID_horario ='$nhorario'";
					
					
					mysql_query("insert into vitacora (Codci_Vitaco ,Fopera_Vitaco,Hopera_Vitaco ,Operacio_Vitaco, pete_vitaco ,Nota_Vitaco,Cod_oper_vitaco) values 
					('$ncitac','$dateh','$hor','DELETE','1','$obselime','$usucitas')");
					
                }
            }
        }
    }
    echo"<form name=uno method=post>
    <input type=hidden name=codusu value='$codusu'>
    </form>";	
?>
</body>
</html>