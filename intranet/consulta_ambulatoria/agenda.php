<?
session_register('Gcod_mediconh');
session_register('Gareanh');
session_register('Gareanhn');
?>
<HTML>
<HEAD>
<TITLE>AGENDA MEDICA</TITLE>
<SCRIPT LANGUAGE=JavaScript>


</SCRIPT>
</HEAD>
<BODY background="img/marco.jpg" style="overflow-x:hidden; overflow-y:auto;">
<a href='../modiformula/index.php' target='top'><font face=arial color='#ffffff' size=2><b>MODIFICAR FORMULA</b></font></a>

<table width =70% >
<TABLE BORDER=0>
<TR>
.
</tr>

<td><font color="#FFFFFF">____</font></TD>

<td>
<!--Step 1: Add the below SCRIPT to the head of your page:-->
<script type="text/javascript" src="spinmenu.js"></script>
</head>
<!-- inicia -->
<script language="JavaScript">

var specifyimage=new Array() //Your images

specifyimage[0]="img/proinsalud.gif"
specifyimage[1]="img/icontec.gif"
specifyimage[2]="img/iqnet.gif"
var delay=3000 //3 seconds

//Counter for array
var count =1;
var cubeimage=new Array()
for (i=0;i<specifyimage.length;i++)
{
	cubeimage[i]=new Image()
	cubeimage[i].src=specifyimage[i]
}
function movecube()
{
	if (window.createPopup)
	cube.filters[0].apply()
	document.images.cube.src=cubeimage[count].src;
	if (window.createPopup)
	cube.filters[0].play()
	count++;
	if (count==cubeimage.length)
	count=0;
	setTimeout("movecube()",delay)
}
window.onload=new Function("setTimeout('movecube()',delay)")
</script>
<p align="center"><img src="img/proinsalud.gif" name="cube"  border=0 style="filter:progid:DXImageTransform.Microsoft.Stretch(stretchStyle='PUSH')"></p>
<!-- termina -->
<td><font color="#FFFFFF">_______________________</font></TD>

<?

	//Aqui cargo las funciones
	//include("funciones.php");
	include ('c:/appserv/www/intranet/Libreria/Php/conexiones_g.php');
	include ('c:/appserv/www/intranet/Libreria/Php/sql.php');
	include ('c:/appserv/www/intranet/Libreria/Php/funciones.php');
	base_proinsalud();

	$mario=$mario+1;
	//echo "var:$deli";
	//echo "d:$mario";


	if ($deli<>"" and $mario==1)
	{

		$tmp_table="del_".$deli;
		if (tabla_existe("$tmp_table","proinsalud"))
		{
			$indx="A";
			$campo="A";
			$resultado_sql1=sq02($tmp_table,$indx,$campo);
			$ver=mysql_query($resultado_sql1);
			$dir=1;
			while($rowp1 = mysql_fetch_array($ver))
			{
				$pru=$rowp1["campo"];
				if ($pru<>"")
				{
					$dpru=$dpru+1;
				}
			}
		}
		$tab1="ini_".$deli;
		mysql_query("DROP TABLE $tab1");
		if ($dpru<4)
		{
			$tab1="ini_".$deli;
			$tab2="del_".$deli;
			mysql_query("DROP TABLE $tab1");
			mysql_query("DROP TABLE $tab2");
		}

	}
	$deli="";

	if ($i<>"")
	{
		$tab="ini_".$i;
		$retor=mysql_query("select medico, area from ".$tab."");
		while($rowR = mysql_fetch_array($retor))
		{
			$Gcod_mediconh=$rowR["medico"];
			$Gareanh=$rowR["area"];
		}
		mysql_query("DROP TABLE $tab");

	}


?>

<?

	$pagi3=sq04($Gcod_mediconh);

	$pagi4=mysql_query($pagi3);

	while($rowY = mysql_fetch_array($pagi4))
	{
		$nommedi=$rowY["nom_medi"];
	}

	$pag=sq05($Gareanh);
	base_proinsalud();
	$pag4=mysql_query($pag);

	while($ro = mysql_fetch_array($pag4))
	{
		$xareas=$ro["nom_areas"];
	}



	echo "<td  align=center><B>Proinsalud S.A<br>Bienvenido DR(a): $nommedi</B></td>";


	$Gareanhn=$xareas;

	?>
	</td>
	</table>
	<table width =60% align="center" border=1 cellpadding="0" cellpacing="1" align="center">
	<th bgcolor="#FF9900" ><font size=4>Agenda Medica <?echo "$xareas";?></font></th>
	</table>
	<table width =60% align="center" border=1 cellpadding="0" cellpacing="1" align="center">
	<th bgcolor="#FF9900"><font size=2>Elegir</font></th><th bgcolor="#FF9900"><font size=2>Hora</font></th><th bgcolor="#FF9900"><font size=2>Fecha</th><th bgcolor="#FF9900"><font size=2>Nombre</th><th bgcolor="#FF9900"><font size=2>Estado</th><th bgcolor="#FF9900"><font size=2>Estado Cita</th>
	<? 
	if($Gareanh==4)
	{
		echo"<th bgcolor='#FF9900'><font size=2>Triage</th>";
	}
	?>
	<tr>


	<?
	echo "<FORM METHOD=POST ACTION=paso.php>";

	$x1=$Gcodmed;
	$x2=$Gfeini;
	$x3=$Gareanh;
	$x4=$Gtodos;
	$x5=$Gffini;
	$ced=$Gcodi;
	$num="5";
	$cont=0;

	//"2007-01-19";
	if ($Gfecha<>"")
	{  
		$fecha=$Gfecha;
	}
	$fecha=date("Y")."-".date("m")."-".date("d");
	$Gfecha=$fecha;


	//Sentencia sql (sin limit)
	//
	if ($Gareanh=="81")
	{
	  //$_pagi_sql=("SELECT id_cita,SEXO_USU, Idusu_citas,Esta_cita,descrip_estaci, NROD_USU,Cotra_citas, PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita FROM usuario,horarios,citas,areas,medicos,esta_cita  where cod_estaci=Esta_cita AND CODI_USU=Idusu_citas  and Cmed_horario='1102229' and Clase_citas<=$num and  horarios.ID_horario = citas.ID_horario and cod_areas=Cserv_horario and cod_medi =Cmed_horario and Fecha_horario='$Gfecha' and Cserv_horario='$Gareanh'  order by  Fecha_horario DESC,Hora_horario");
	  $_pagi_sql=("SELECT id_cita,SEXO_USU, Idusu_citas,Esta_cita,descrip_estaci, NROD_USU,Cotra_citas, 
	  PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, 
	  horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita 
	  FROM usuario,horarios,citas,areas,medicos,esta_cita  where cod_estaci=Esta_cita AND CODI_USU=Idusu_citas  
	  and Cmed_horario='$Gcod_mediconh' and Clase_citas<='$num' and  horarios.ID_horario = citas.ID_horario 
	  and cod_areas=Cserv_horario and cod_medi =Cmed_horario and Fecha_horario='$Gfecha' and Cserv_horario='$Gareanh'  order by  Fecha_horario DESC,Hora_horario");
	  //echo $_pagi_sql;
	}
	if ($Gareanh=="04")
	{
		//and Esta_cita<>'2'
			
		$_pagi_sql=("SELECT citas.id_cita,SEXO_USU, Idusu_citas,Esta_cita,descrip_estaci, NROD_USU,Cotra_citas, 
		PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, 
		horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita,
		triage.cltr_tri FROM usuario,horarios,citas,areas,medicos,esta_cita, triage  
		where cod_estaci=Esta_cita AND CODI_USU=Idusu_citas  and Cmed_horario='1101' and Clase_citas<='$num' and
		horarios.ID_horario = citas.ID_horario and cod_areas=Cserv_horario and cod_medi =Cmed_horario
		and Fecha_horario='$Gfecha' and Cserv_horario='$Gareanh' and Esta_cita<>'2' and 
		citas.id_cita=triage.id_cita and triage.paus_tri <> 'S' order by  Fecha_horario DESC,triage.cltr_tri,Hora_horario");
		
		
		/*
		SELECT citas.id_cita,SEXO_USU, Idusu_citas,Esta_cita,descrip_estaci, NROD_USU,Cotra_citas, PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita,triage.cltr_tri FROM usuario,horarios,citas,areas,medicos,esta_cita, triage  
		where cod_estaci=Esta_cita AND CODI_USU=Idusu_citas  and Cmed_horario='1101' and Clase_citas<=$num and
		horarios.ID_horario = citas.ID_horario and cod_areas=Cserv_horario and cod_medi =Cmed_horario
		and Fecha_horario='$Gfecha' and Cserv_horario='04' and Esta_cita<>'2' and 
		citas.id_cita=triage.id_cita and triage.paus_tri <> 'S'  order by  Fecha_horario DESC,triage.cltr_tri,Hora_horario
		*/
	}
	if ($Gareanh=="01")
	{
		$_pagi_sql=("SELECT id_cita,SEXO_USU, Idusu_citas,Esta_cita,descrip_estaci, NROD_USU,Cotra_citas, 
		PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, 
		horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita 
		FROM usuario,horarios,citas,areas,medicos,esta_cita where  (cod_estaci=Esta_cita AND CODI_USU=Idusu_citas  
		and Cmed_horario='$Gcod_mediconh' and Clase_citas<='$num' and  horarios.ID_horario = citas.ID_horario and 
		cod_areas=Cserv_horario and cod_medi =Cmed_horario and Fecha_horario='$fecha' and Cserv_horario='$Gareanh')    order by  Fecha_horario DESC,Hora_horario");
	}

	if ($Gareanh<>"01" and $Gareanh<>"04" and $Gareanh<>"81")
	{
		$_pagi_sql=("SELECT id_cita,SEXO_USU, Idusu_citas,Esta_cita,descrip_estaci, NROD_USU,Cotra_citas, 
		PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, 
		horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita 
		FROM usuario,horarios,citas,areas,medicos,esta_cita  where cod_estaci=Esta_cita AND CODI_USU=Idusu_citas  
		and Cmed_horario='$Gcod_mediconh' and Clase_citas<='$num' and  horarios.ID_horario = citas.ID_horario and 
		cod_areas=Cserv_horario and cod_medi =Cmed_horario and Fecha_horario='$fecha' and Cserv_horario='$Gareanh'  
		order by  Fecha_horario DESC,Hora_horario");
	}
	//$pagi2=mysql_query($pagi);
	$cont=0;
	//cantidad de resultados por página (opcional, por defecto 20)
	$_pagi_cuantos = 13;
	//Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	include("paginator.inc.php");
	//Leemos y escribimos los registros de la página actual
	$numefula=Mysql_num_rows($_pagi_result);
	//echo $numefula;
	
	while($row = mysql_fetch_array($_pagi_result))
	{
		
		$valor=$row["id_cita"];//recupera este
		//echo $valor;
		$nombre="mario";
		$aDatos=array($valor=>$nombre);
		$h=substr($row["Hora_horario"],10);
		$identificacion=$row["NROD_USU"];
		$contrato=$row["Cotra_citas"];
		$esta_cita=$row["descrip_estaci"];
		$sexo=$row["SEXO_USU"];
		$idcita=$row["id_cita"];
		$idusua=$row["Idusu_citas"];
		
		if($Gareanh==4)
		{	
			$triage=$row["cltr_tri"];
		}
		echo "<input type=hidden name=contrato value='$contrato' >";
		echo "<input type=hidden name=idcita value='$idcita' >";
		//echo '<td>'.$row["Hora_horario"].'</td>';
		$fecha_hor=$row["Fecha_horario"];
		echo "<input type=hidden name=fecha value='$fecha' >";
		$nombre_us=$row["PNOM_USU"]." ".$row["SNOM_USU"]." ".$row["PAPE_USU"]." ".$row["SAPE_USU"];
		      //CODIGO USUARIO
	    /*$consulta="SELECT ESTA_UCO,CODI_CON,CODI_USU, PNOM_USU,MRES_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU, TRES_USU, TEL2_USU, REGI_USU, TPAF_USU, ESTR_USU, PARE_USU, DCOT_USU, CONT_UCO,NEPS_CON,NOMB_MUN,IDEN_UCO 
		FROM usuario, ucontrato,contrato,municipio 
		WHERE CUSU_UCO = CODI_USU AND CODI_CON=CONT_UCO AND MATE_USU=CODI_MUN AND ESTA_USU='A' AND CONT_UCO='$contrato' AND NROD_USU = '$identificacion'";*/
		//echo $consulta;
		
		$consulta=mysql_query("SELECT ESTA_UCO,CODI_CON,CODI_USU, PNOM_USU,MRES_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU, TRES_USU, TEL2_USU, REGI_USU, TPAF_USU, ESTR_USU, PARE_USU, DCOT_USU, CONT_UCO,NEPS_CON,NOMB_MUN,IDEN_UCO 
		FROM usuario, ucontrato,contrato,municipio 
		WHERE CUSU_UCO = CODI_USU AND CODI_CON=CONT_UCO AND MATE_USU=CODI_MUN AND ESTA_USU='A' AND CONT_UCO='$contrato' AND NROD_USU = '$identificacion'");
		if (mysql_num_rows($consulta)==0)
		{
		    //echo "<h2>Usuario no Encontrado</h2>";
			$cotizante="false";
		}
		else
		{
			$row=mysql_fetch_array($consulta);
			$codigo_uco=$row['IDEN_UCO'];
			$estado=$row['ESTA_UCO'];
			//and $esta_cita<>'ATENDIDA'
			
			
			
			
			
			foreach($aDatos as $id=>$nombre) 
			{
				//<input type='checkbox' name='seleccion[]' value='$id' /> <br /></td>";
				//echo $estado;
				if ($estado=="AC")
				{
					
						
						//echo "<tr><td align=center><input type='radio' name='seleccion[]' value='$id' onClick=validar3(this.form) ><br /></td>";
							if($Gareanh==4)
					{
						if ($contrato==2)
						{
							echo "<tr><td align=center><input type='radio' name='seleccion[]' value='$id' onClick=validar3(this.form) ><br /></td>";
						}
						else
						{
							if($triage<4 || $triage=='R')
							{
								echo "<tr><td align=center><input type='radio' name='seleccion[]' value='$id' onClick=validar3(this.form) ><br /></td>";
							
							}
						}
					}
					else
					{	
						
						echo "<tr><td align=center><input type='radio' name='seleccion[]' value='$id' onClick=validar3(this.form) ><br /></td>";
							
					}
					
					mysql_query("insert into lis_pendi  (id_citap, cod_medp,fec_cit  ) values ('$idcita','$Gcod_mediconh','$Gfecha')");
				}
				else
				{
					if ($estado=="AC")
					{
						$esta_cita="ATENDIDA";
					}
					else
					{
						$esta_cita="SUSPENDIDO";
					}
					echo "<tr><td align=center><br /></td>";
				}
			}
			if($Gareanh==4)
			{			
				if($contrato==2)
				{
					echo '<td><font size=1>'.$h.'</font></td>';
					echo '<td><font size=1>'.$fecha_hor.'</font></td>';//FECHA
					echo '<td><font size=1>'.$nombre_us.'</font></td>';
					echo '<td><font size=1>'.$estado.'</font></td>';			
					if ($esta_cita=="PENDIENTE")
					{
						echo '<td><font size=1 color=#FF0000><b>'.$esta_cita.'</b></font></td>';
					}
					if ($esta_cita=="ATENDIDA")
					{
						echo '<td><font size=1 color=#238E23><b>'.$esta_cita.'</b></font></td>';
					}
					IF ($esta_cita=="ESPERA")	
					{
						echo '<td><font size=1 color=#23238E>'.$esta_cita.'</font></td>';
					}
					IF ($esta_cita=="AIEPI")
					{
						echo '<td><font size=1 color=#8E236B>'.$esta_cita.'</font></td>';
					}

					IF ($esta_cita=="INASISTENCIA")
					{
						echo '<td><font size=1 color=#9932CD >'.$esta_cita.'</font></td>';
					}
					if($Gareanh==4)
					{		
						if($triage==1)
						{
							//rojo
							echo '<td bgcolor=#FF0000 align=center><font size=2>'.$triage.'</font></td>';
						}
						if($triage==2)
						{
							//amarillo
							echo '<td bgcolor=#FFFF00 align=center><font size=2 bgcolor=#000000>'.$triage.'</font></td>';
						}
						if($triage==3)
						{
							//verde
							echo '<td bgcolor=#00FF00 align=center><font size=2>'.$triage.'</font></td>';
						}
						if($triage==4)
						{
							//verde
							echo '<td bgcolor=#00FFFF align=center><font size=2>'.$triage.'</font></td>';
						}
						if($triage=='R')
						{
							$cadmed=Mysql_query("SELECT Max(consultaprincipal.numc_cpl) AS MáxDenumc_cpl
							FROM (citas INNER JOIN consultaprincipal ON citas.consul_cita = consultaprincipal.numc_cpl) INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario
							WHERE (((citas.Idusu_citas)=37637) AND ((horarios.Cserv_horario)='04') AND ((citas.Esta_cita)='2'))");
							$consu=mysql_fetch_array($cadmed);
							$maxconsu=$consu[MáxDenumc_cpl];								
							$medi=Mysql_query("SELECT medicos.nom_medi
							FROM consultaprincipal INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi
							WHERE (((consultaprincipal.numc_cpl)='$maxconsu'))");
							$nommed=mysql_fetch_array($medi);
							$nomm=$nommed[nom_medi];
							echo '<td bgcolor=#FFFFFF align=center><font size=2>';echo $nomm;echo '</font></td>';
						}
					}	
				}
				else
				{
					if($triage<4 || $triage=='R')
					{
						echo '<td><font size=1>'.$h.'</font></td>';
						echo '<td><font size=1>'.$fecha_hor.'</font></td>';//FECHA
						echo '<td><font size=1>'.$nombre_us.'</font></td>';
						echo '<td><font size=1>'.$estado.'</font></td>';			
						if ($esta_cita=="PENDIENTE")
						{
							echo '<td><font size=1 color=#FF0000><b>'.$esta_cita.'</b></font></td>';
						}
						if ($esta_cita=="ATENDIDA")
						{
							echo '<td><font size=1 color=#238E23><b>'.$esta_cita.'</b></font></td>';
						}
						IF ($esta_cita=="ESPERA")	
						{
							echo '<td><font size=1 color=#23238E>'.$esta_cita.'</font></td>';
						}
						IF ($esta_cita=="AIEPI")
						{
							echo '<td><font size=1 color=#8E236B>'.$esta_cita.'</font></td>';
						}

						IF ($esta_cita=="INASISTENCIA")
						{
							echo '<td><font size=1 color=#9932CD >'.$esta_cita.'</font></td>';
						}
						if($Gareanh==4)
						{		
							if($triage==1)
							{
								//rojo
								echo '<td bgcolor=#FF0000 align=center><font size=2>'.$triage.'</font></td>';
							}
							if($triage==2)
							{
								//amarillo
								echo '<td bgcolor=#FFFF00 align=center><font size=2 bgcolor=#000000>'.$triage.'</font></td>';
							}
							if($triage==3)
							{
								//verde
								echo '<td bgcolor=#00FF00 align=center><font size=2>'.$triage.'</font></td>';
							}
							
							if($triage==4)
							{
								//verde
								echo '<td bgcolor=##00FFFF align=center><font size=2>'.$triage.'</font></td>';
							}
							if($triage=='R')
							{
								
								$cadmed=Mysql_query("SELECT Max(consultaprincipal.numc_cpl) AS MáxDenumc_cpl
								FROM (citas INNER JOIN consultaprincipal ON citas.consul_cita = consultaprincipal.numc_cpl) INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario
								WHERE (((citas.Idusu_citas)=37637) AND ((horarios.Cserv_horario)='04') AND ((citas.Esta_cita)='2'))");
								$consu=mysql_fetch_array($cadmed);
								$maxconsu=$consu[MáxDenumc_cpl];								
								$medi=Mysql_query("SELECT medicos.nom_medi
								FROM consultaprincipal INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi
								WHERE (((consultaprincipal.numc_cpl)='$maxconsu'))");
								$nommed=mysql_fetch_array($medi);
								$nomm=$nommed[nom_medi];
								echo '<td bgcolor=#FFFFFF align=center><font size=2>';echo $nomm;echo '</font></td>';
							}
						}	
					}
				}			
			}			
			else
			{			
				echo '<td><font size=1>'.$h.'</font></td>';
				echo '<td><font size=1>'.$fecha_hor.'</font></td>';//FECHA
				echo '<td><font size=1>'.$nombre_us.'</font></td>';
				echo '<td><font size=1>'.$estado.'</font></td>';			
				if ($esta_cita=="PENDIENTE")
				{
					echo '<td><font size=1 color=#FF0000><b>'.$esta_cita.'</b></font></td>';
				}
				if ($esta_cita=="ATENDIDA")
				{
					echo '<td><font size=1 color=#238E23><b>'.$esta_cita.'</b></font></td>';
				}
				IF ($esta_cita=="ESPERA")	
				{
					echo '<td><font size=1 color=#23238E>'.$esta_cita.'</font></td>';
				}
				IF ($esta_cita=="AIEPI")
				{
					echo '<td><font size=1 color=#8E236B>'.$esta_cita.'</font></td>';
				}
				IF ($esta_cita=="INASISTENCIA")
				{
					echo '<td><font size=1 color=#9932CD >'.$esta_cita.'</font></td>';
				}										
			}			
		}
	}

?>
</table>
<?
$pagi=("SELECT  text_msn, area_msn  FROM mensaje where area_msn='$Gareanh'");
$pagi2=mysql_query($pagi);

//Leemos y escribimos los registros de la página actual
while($row = mysql_fetch_array($pagi2))
{
	$mensaje=$row["text_msn"];//recupera este
}
echo "<Marquee Behavior=Alternate><font size=3><b><i>$mensaje</i></b></font></Marquee>";

echo "<table width =90% border=1 align=center border=0 cellpadding=0 cellpacing=8><font size=1>".$_pagi_navegacion."</table>";

?>
<?
///inicio
	if ($Gareanh>4)
	{
		$tre=date('Y-m-d',strtotime('-10 day'));
		//echo $tre;
		$_pagi_sql_mg=("SELECT id_cita, SEXO_USU, Idusu_citas, Esta_cita, descrip_estaci, NROD_USU, Cotra_citas, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, nom_areas, nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, citas.Idusu_citas, citas.Esta_cita
		FROM usuario, horarios, citas, areas, medicos, esta_cita, lis_pendi
		WHERE ( id_cita=id_citap and Cmed_horario=cod_medp and cod_estaci = Esta_cita AND CODI_USU = Idusu_citas AND Cmed_horario =  '$Gcod_mediconh' AND Clase_citas <=  '$num' AND horarios.ID_horario = citas.ID_horario AND cod_areas = Cserv_horario AND cod_medi = Cmed_horario AND Cserv_horario =  '$Gareanh' )  AND  Fecha_horario > '$tre' and Fecha_horario <  '$fecha'
		ORDER  BY Fecha_horario DESC , Hora_horario");
		if (mysql_num_rows(mysql_query($_pagi_sql_mg))>0)
		{
			echo "<table width =60% align=center border=1 cellpadding=0 cellpacing=1 align=center>";
			echo "<th bgcolor=#FF9900 ><font size=4>Listado de Pendientes</font></th>";
			echo"</table>";
			echo"<table width =60% align=center border=1 cellpadding=0 cellpacing=1 align=center>";
			echo"<th bgcolor=#FF9900><font size=2>Elegir</font></th><th bgcolor=#FF9900><font size=2>Hora</font></th><th bgcolor=#FF9900><font size=2>Fecha</th><th bgcolor=#FF9900><font size=2>Nombre</th><th bgcolor=#FF9900><font size=2>Estado</th><th bgcolor=#FF9900><font size=2>Estado Cita</th>";
			echo"<tr>";
			///
			//$_pagi_sql_mg=("SELECT id_cita,SEXO_USU, Idusu_citas,Esta_cita,descrip_estaci, NROD_USU,Cotra_citas, PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita FROM usuario,horarios,citas,areas,medicos,esta_cita, lis_pendi  where  (cod_estaci=Esta_cita AND CODI_USU=Idusu_citas  and Cmed_horario='$Gcod_mediconh' and Clase_citas<='$num' and  horarios.ID_horario = citas.ID_horario and cod_areas=Cserv_horario and cod_medi =Cmed_horario  and Cserv_horario='$Gareanh')  and  horarios.ID_horario =id_citap and  Cmed_horario=cod_medp and Fecha_horario<'$fecha'order by  Fecha_horario DESC,Hora_horario");

			/*$_pagi_sql_mg=("SELECT id_cita, SEXO_USU, Idusu_citas, Esta_cita, descrip_estaci, NROD_USU, Cotra_citas, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, nom_areas, nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, citas.Idusu_citas, citas.Esta_cita
			FROM usuario, horarios, citas, areas, medicos, esta_cita, lis_pendi
			WHERE ( id_cita=id_citap and Cmed_horario=cod_medp and cod_estaci = Esta_cita AND CODI_USU = Idusu_citas AND Cmed_horario =  '$Gcod_mediconh' AND Clase_citas <=  '$num' AND horarios.ID_horario = citas.ID_horario AND cod_areas = Cserv_horario AND cod_medi = Cmed_horario AND Cserv_horario =  '$Gareanh' ) AND Fecha_horario <  '$fecha'
			ORDER  BY Fecha_horario DESC , Fecha_horario");
			//$pagi2=mysql_query($pagi);
			*/
			$cont=0;
			//cantidad de resultados por página (opcional, por defecto 20)
			$_pagi_cuantos_mg = 2;

			//Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
			include("paginator2.inc.php");

			$dir_lis="";
			//Leemos y escribimos los registros de la página actual
			while($row = mysql_fetch_array($_pagi_result_mg))
			{
				$valor=$row["id_cita"];//recupera este
				$nombre="mario";
				$aDatos=array($valor=>$nombre);
				$h=substr($row["Hora_horario"],10);
				$identificacion=$row["NROD_USU"];
				$contrato=$row["Cotra_citas"];
				$esta_cita=$row["descrip_estaci"];
				$sexo=$row["SEXO_USU"];
				echo "<input type=hidden name=contrato value='$contrato' >";
				echo "<input type=hidden name=idcita value='$idcita' >";
				//echo '<td>'.$row["Hora_horario"].'</td>';
				$fecha_hor=$row["Fecha_horario"];
				echo "<input type=hidden name=fecha value='$fecha' >";
				$nombre_us=$row["PNOM_USU"]." ".$row["SNOM_USU"]." ".$row["PAPE_USU"]." ".$row["SAPE_USU"];
				      //CODIGO USUARIO
				$consulta=mysql_query("SELECT ESTA_UCO,CODI_CON,CODI_USU, PNOM_USU,MRES_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU, TRES_USU, TEL2_USU, REGI_USU, TPAF_USU, ESTR_USU, PARE_USU, DCOT_USU, CONT_UCO,NEPS_CON,NOMB_MUN,IDEN_UCO FROM usuario, ucontrato,contrato,municipio WHERE CUSU_UCO = CODI_USU AND CODI_CON=CONT_UCO AND MATE_USU=CODI_MUN AND ESTA_USU='A' AND CONT_UCO=$contrato AND NROD_USU = $identificacion");
				if (mysql_num_rows($consulta)==0)
				{
				    //echo "<h2>Usuario no Encontrado</h2>";
					$cotizante="false";
				}
				else
				{
					$row=mysql_fetch_array($consulta);
					$codigo_uco=$row['IDEN_UCO'];
					$estado=$row['ESTA_UCO'];
					//and $esta_cita<>'ATENDIDA'
					foreach($aDatos as $id=>$nombre) 
					{
						//<input type='checkbox' name='seleccion[]' value='$id' /> <br /></td>";
						if ($estado=="AC" )
						{
							echo "<tr><td align=center><input type='radio' name='seleccion[]' value='$id' onClick=validar3(this.form) ><br /></td>";
							$dir_lis=$dir_lis+1;
						}
						else
						{
							if ($estado=="AC")
							{
								$esta_cita="ATENDIDA";
							}
							else
							{
								$esta_cita="SUSPENDIDO";
							}
							echo "<tr><td align=center><br /></td>";
						}
					}
					echo '<td><font size=1>'.$h.'</font></td>';
					echo '<td><font size=1>'.$fecha_hor.'</font></td>';//FECHA
					echo '<td><font size=1>'.$nombre_us.'</font></td>';
					echo '<td><font size=1>'.$estado.'</font></td>';
					echo "<input type=hidden name=id_lis[$dir_lis] value='$idcita' >";
					if ($esta_cita=="PENDIENTE")
					{
						echo '<td><font size=1 color=#FF0000><b>'.$esta_cita.'</b></font></td>';
					}
					if ($esta_cita=="ATENDIDA")
					{
						echo '<td><font size=1 color=#238E23><b>'.$esta_cita.'</b></font></td>';
					}
					IF ($esta_cita=="ESPERA")
					{
						echo '<td><font size=1 color=#23238E>'.$esta_cita.'</font></td>';
					}
					IF ($esta_cita=="AIEPI")
					{
						echo '<td><font size=1 color=#8E236B>'.$esta_cita.'</font></td>';
					}
					IF ($esta_cita=="INASISTENCIA")
					{
						echo '<td><font size=1 color=#9932CD >'.$esta_cita.'</font></td>';
					}
				}
			}
			echo "<table>";
			echo "<br>";
			echo "<table width =90% border=1 align=center border=0 cellpadding=0 cellpacing=8><font size=1>".$_pagi_navegacion_mg."</table>";
		}
		///fin
	}
?>
<table border=1 width =50% align="center">
<td align="center" bgcolor="#FF9900">
<input type="submit" name="btn2" value="Ejecutar">
<?
echo "<input type=radio name=btn3 value=consulta>Consulta";

?>
<input type="radio" name="btn3" value="inacistencia">Inasistencia
<?
if($Gareanh=="04")
{
	echo "<input type=radio name=btn3 value=perdida>Aiepi";
}

?>
<input type="radio" name="btn3" value="Cerrar">Cerrar Jornada
</td>
</table>
</form>


</BODY>



</HTML>
