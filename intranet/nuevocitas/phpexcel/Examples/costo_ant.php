<html>
<head>

</head>
<body>
<?php
		//INFORME DE COSTOS
	set_time_limit (180);
	$conexion = mysql_connect("localhost","root","");
    if(!$conexion)
    {
       echo "Error de conexion a la base de datos, Intente mas tarde.";
       exit();
    }	
	$anoinforme='2014';
	$mesinforme='09';
	
    mysql_select_db("formedica",$conexion);
	$opcion=$_POST['opcion'];
	if($opcion==1)
	{
		//MEDICOS
		
		$busca=mysql_query("SELECT costos_final.nmedico, costos_final.citas, costos_final.formagis, costos_final.cosmagis, costos_final.forotros, costos_final.cosotros, formagis+forotros AS totformulas, cosmagis+cosotros AS totcosto
		FROM costos_final WHERE (((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme'))
		ORDER BY costos_final.nmedico");
		$variables=8;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="MEDICO";
				$vec[0][2]="CITAS";
				$vec[0][3]="FORMULAS MAGISTERIO";
				$vec[0][4]="COSTO MAGISTRRIO";
				$vec[0][5]="FORMULAS OTROS";
				$vec[0][6]="COSTO OTROS";
				$vec[0][7]="TOTAL FORMULAS";;
				$vec[0][8]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nmedico'];
			$vec[$m][2]=$res['citas'];
			$vec[$m][3]=$res['formagis'];
			$vec[$m][4]=$res['cosmagis'];
			$vec[$m][5]=$res['forotros'];
			$vec[$m][6]=$res['cosotros'];
			$vec[$m][7]=$res['totformulas'];
			$vec[$m][8]=$res['totcosto'];
			$m++;
		}
	}
	
	
	if($opcion==2)
	{
		//ESPECIALIDADES
		
		$busca=mysql_query("SELECT costos_final.nespe, Sum(costos_final.citas) AS SumaDecitas, Sum(costos_final.formagis) AS SumaDeformagis, 
		Sum(costos_final.cosmagis) AS SumaDecosmagis, Sum(costos_final.forotros) AS SumaDeforotros, Sum(costos_final.cosotros) AS SumaDecosotros, 
		Sum(formagis+forotros) AS totformulas, Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final WHERE (((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme'))
		GROUP BY costos_final.nespe");
		$variables=8;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="ESPECIALIDAD";
				$vec[0][2]="CITAS";
				$vec[0][3]="FORMULAS MAGISTERIO";
				$vec[0][4]="COSTO MAGISTRRIO";
				$vec[0][5]="FORMULAS OTROS";
				$vec[0][6]="COSTO OTROS";
				$vec[0][7]="TOTAL FORMULAS";;
				$vec[0][8]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nespe'];
			$vec[$m][2]=$res['SumaDecitas'];
			$vec[$m][3]=$res['SumaDeformagis'];
			$vec[$m][4]=$res['SumaDecosmagis'];
			$vec[$m][5]=$res['SumaDeforotros'];
			$vec[$m][6]=$res['SumaDecosotros'];
			$vec[$m][7]=$res['totformulas'];
			$vec[$m][8]=$res['totcosto'];
			$m++;
		}
	}
	if($opcion==3)
	{
		//MEDICOS ME

		$busca=mysql_query("SELECT costos_final.nmedico, Sum(costos_final.citas) AS SumaDecitas, Sum(costos_final.formagis) AS SumaDeformagis, 
		Sum(costos_final.cosmagis) AS SumaDecosmagis, Sum(costos_final.forotros) AS SumaDeforotros, Sum(costos_final.cosotros) AS SumaDecosotros, 
		Sum(formagis+forotros) AS totformulas, Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final
		WHERE (((costos_final.especi)<>'2655' And (costos_final.especi)<>'2656' And (costos_final.especi)<>'2661' And (costos_final.especi)<>'2619') AND ((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme'))
		GROUP BY costos_final.nmedico
		ORDER BY costos_final.nmedico");
		$variables=8;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="ESPECIALIDAD";
				$vec[0][2]="CITAS";
				$vec[0][3]="FORMULAS MAGISTERIO";
				$vec[0][4]="COSTO MAGISTRRIO";
				$vec[0][5]="FORMULAS OTROS";
				$vec[0][6]="COSTO OTROS";
				$vec[0][7]="TOTAL FORMULAS";;
				$vec[0][8]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nmedico'];
			$vec[$m][2]=$res['SumaDecitas'];
			$vec[$m][3]=$res['SumaDeformagis'];
			$vec[$m][4]=$res['SumaDecosmagis'];
			$vec[$m][5]=$res['SumaDeforotros'];
			$vec[$m][6]=$res['SumaDecosotros'];
			$vec[$m][7]=$res['totformulas'];
			$vec[$m][8]=$res['totcosto'];
			$m++;
		}
		
	
	}
	if($opcion==4)
	{
		//MEDICOS MG
		
		$busca=mysql_query("SELECT costos_final.nmedico, Sum(costos_final.citas) AS SumaDecitas, Sum(costos_final.formagis) AS SumaDeformagis, 
		Sum(costos_final.cosmagis) AS SumaDecosmagis, Sum(costos_final.forotros) AS SumaDeforotros, Sum(costos_final.cosotros) AS SumaDecosotros, 
		Sum(formagis+forotros) AS totformulas, Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final
		WHERE ((((costos_final.especi)='2655' Or (costos_final.especi)='2656' Or (costos_final.especi)='2661' Or (costos_final.especi)='2619')) AND ((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme'))
		GROUP BY costos_final.nmedico
		ORDER BY costos_final.nmedico");
		$variables=8;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="ESPECIALIDAD";
				$vec[0][2]="CITAS";
				$vec[0][3]="FORMULAS MAGISTERIO";
				$vec[0][4]="COSTO MAGISTRRIO";
				$vec[0][5]="FORMULAS OTROS";
				$vec[0][6]="COSTO OTROS";
				$vec[0][7]="TOTAL FORMULAS";;
				$vec[0][8]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nmedico'];
			$vec[$m][2]=$res['SumaDecitas'];
			$vec[$m][3]=$res['SumaDeformagis'];
			$vec[$m][4]=$res['SumaDecosmagis'];
			$vec[$m][5]=$res['SumaDeforotros'];
			$vec[$m][6]=$res['SumaDecosotros'];
			$vec[$m][7]=$res['totformulas'];
			$vec[$m][8]=$res['totcosto'];
			$m++;
		}
	}
	if($opcion==5)
	{
		//CONTRATOS

		$busca=mysql_query("SELECT costos_enca.nomccos, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, 
		Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nomccos");		
		$variables=4;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="CONTRATO";
				$vec[0][2]="FORMULAS";
				$vec[0][3]="REGISTROS";
				$vec[0][4]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nomccos'];
			$vec[$m][2]=$res['CuentaDeformu'];
			$vec[$m][3]=$res['SumaDeregistros'];
			$vec[$m][4]=$res['SumaDetcos'];
			$m++;
		}
	
	}
	if($opcion==6)
	{
		//AREAS

		$busca=mysql_query("SELECT costos_final.nomscco, Sum(costos_final.citas) AS SumaDecitas, Sum(costos_final.formagis) AS SumaDeformagis, Sum(costos_final.cosmagis) AS SumaDecosmagis, 
		Sum(costos_final.forotros) AS SumaDeforotros, Sum(costos_final.cosotros) AS SumaDecosotros, Sum(formagis+forotros) AS totformula, 
		Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final WHERE ((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme')
		GROUP BY costos_final.nomscco
		ORDER BY costos_final.nomscco");
		$variables=8;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="AREA";
				$vec[0][2]="CITAS";
				$vec[0][3]="FORMULAS MAGISTERIO";
				$vec[0][4]="COSTO MAGISTRRIO";
				$vec[0][5]="FORMULAS OTROS";
				$vec[0][6]="COSTO OTROS";
				$vec[0][7]="TOTAL FORMULAS";;
				$vec[0][8]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nomscco'];
			$vec[$m][2]=$res['SumaDecitas'];
			$vec[$m][3]=$res['SumaDeformagis'];
			$vec[$m][4]=$res['SumaDecosmagis'];
			$vec[$m][5]=$res['SumaDeforotros'];
			$vec[$m][6]=$res['SumaDecosotros'];
			$vec[$m][7]=$res['totformula'];
			$vec[$m][8]=$res['totcosto'];
			$m++;
		}
	}
	if($opcion==7)
	{
		//BODEGAS

		$busca=mysql_query("SELECT costos_enca.nombod, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, 
		Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nombod");
		$variables=4;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="NOMBRE BODEGA";
				$vec[0][2]="FORMULAS";
				$vec[0][3]="REGISTROS";
				$vec[0][4]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nombod'];
			$vec[$m][2]=$res['CuentaDeformu'];
			$vec[$m][3]=$res['SumaDeregistros'];
			$vec[$m][4]=$res['SumaDetcos'];
			$m++;
		}
	}
	if($opcion==8)
	{
		//ALTO COSTO POR MEDICO

		$busca=mysql_query("SELECT costos_deta.nmedico, Count(costos_deta.formu) AS CuentaDeformu, Count(costos_deta.regis) AS CuentaDeregis, Sum(costos_deta.tcos) AS SumaDetcos
		FROM costos_deta
		WHERE (((costos_deta.altocosto)='S') AND ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))
		GROUP BY costos_deta.nmedico
		ORDER BY costos_deta.nmedico");
		$variables=4;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="MEDICO";
				$vec[0][2]="FORMULAS";
				$vec[0][3]="REGISTROS";
				$vec[0][4]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nmedico'];
			$vec[$m][2]=$res['CuentaDeformu'];
			$vec[$m][3]=$res['CuentaDeregis'];
			$vec[$m][4]=$res['SumaDetcos'];
			$m++;
		}
	}
	if($opcion==9)
	{
		//ALTO COSTO POR CONTRATO

		$busca=mysql_query("SELECT costos_deta.nomccos, Count(costos_deta.formu) AS CuentaDeformu, Count(costos_deta.regis) AS CuentaDeregis, Sum(costos_deta.tcos) AS SumaDetcos
		FROM costos_deta
		WHERE (((costos_deta.altocosto)='S') AND ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))
		GROUP BY costos_deta.nomccos ORDER BY costos_deta.nomccos");
		$variables=4;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="CONTRATO";
				$vec[0][2]="FORMULAS";
				$vec[0][3]="REGISTROS";
				$vec[0][4]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nomccos'];
			$vec[$m][2]=$res['CuentaDeformu'];
			$vec[$m][3]=$res['CuentaDeregis'];
			$vec[$m][4]=$res['SumaDetcos'];
			$m++;
		}
	}
	if($opcion==10)
	{
		//ALTO COSTO POR AREA

		$busca=mysql_query("SELECT costos_deta.nomscco, Count(costos_deta.formu) AS CuentaDeformu, Count(costos_deta.regis) AS CuentaDeregis, Sum(costos_deta.tcos) AS SumaDetcos
		FROM costos_deta
		WHERE (((costos_deta.altocosto)='S') AND  ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))
		GROUP BY costos_deta.nomscco ORDER BY costos_deta.nomscco");
		$variables=4;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="AREA";
				$vec[0][2]="FORMULAS";
				$vec[0][3]="REGISTROS";
				$vec[0][4]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nomscco'];
			$vec[$m][2]=$res['CuentaDeformu'];
			$vec[$m][3]=$res['CuentaDeregis'];
			$vec[$m][4]=$res['SumaDetcos'];
			$m++;
		}
	}
	if($opcion==11)
	{
		//PRODUCTOS ALTO COSTO

		$busca=mysql_query("SELECT costos_deta.nombrepro, Count(costos_deta.formu) AS CuentaDeformu, Count(costos_deta.regis) AS CuentaDeregis, Sum(costos_deta.tcos) AS SumaDetcos
		FROM costos_deta
		WHERE (((costos_deta.altocosto)='S') AND ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))
		GROUP BY costos_deta.nombrepro
		ORDER BY costos_deta.nombrepro");
		$variables=4;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="PRODUCTO";
				$vec[0][2]="FORMULAS";
				$vec[0][3]="REGISTROS";
				$vec[0][4]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nombrepro'];
			$vec[$m][2]=$res['CuentaDeformu'];
			$vec[$m][3]=$res['CuentaDeregis'];
			$vec[$m][4]=$res['SumaDetcos'];
			$m++;
		}
	}
	if($opcion==12)
	{
		//MEDICOS POR AREA

		$busca=mysql_query("SELECT costos_final.nomscco, costos_final.nmedico, Sum(costos_final.citas) AS SumaDecitas, Sum(costos_final.formagis) AS SumaDeformagis, 
		Sum(costos_final.cosmagis) AS SumaDecosmagis, Sum(costos_final.forotros) AS SumaDeforotros, 
		Sum(costos_final.cosotros) AS SumaDecosotros, Sum(formagis+forotros) AS totformula, 
		Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final WHERE ((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme')
		GROUP BY costos_final.nomscco, costos_final.nmedico
		ORDER BY costos_final.nomscco");
		$variables=9;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="AREA";
				$vec[0][2]="MEDICO";
				$vec[0][3]="CITAS";
				$vec[0][4]="FORMULAS MAGISTERIO";
				$vec[0][5]="COSTO MAGISTRRIO";
				$vec[0][6]="FORMULAS OTROS";
				$vec[0][7]="COSTO OTROS";
				$vec[0][8]="TOTAL FORMULAS";;
				$vec[0][9]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nomscco'];
			$vec[$m][2]=$res['nmedico'];
			$vec[$m][3]=$res['SumaDecitas'];
			$vec[$m][4]=$res['SumaDeformagis'];
			$vec[$m][5]=$res['SumaDecosmagis'];
			$vec[$m][6]=$res['SumaDeforotros'];
			$vec[$m][7]=$res['SumaDecosotros'];
			$vec[$m][8]=$res['totformula'];
			$vec[$m][9]=$res['totcosto'];
			$m++;
		}
	}
	if($opcion==13)
	{

		//CONTRATOS POR AREA

		$busca=mysql_query("SELECT costos_enca.nomscco, costos_enca.nomccos, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nomscco, costos_enca.nomccos
		ORDER BY costos_enca.nomscco");
		$variables=5;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="AREA";
				$vec[0][2]="CONTRATO";
				$vec[0][3]="FORMULAS";
				$vec[0][4]="REGISTROS";
				$vec[0][5]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nomscco'];
			$vec[$m][2]=$res['nomccos'];
			$vec[$m][3]=$res['CuentaDeformu'];
			$vec[$m][4]=$res['SumaDeregistros'];
			$vec[$m][5]=$res['SumaDetcos'];
			$m++;
		}
	}
	if($opcion==14)
	{
		//MUNICIPIOS

		$busca=mysql_query("SELECT costos_enca.nombod, costos_enca.nmedico, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca
		WHERE (((costos_enca.cbod)<>2 And (costos_enca.cbod)<>5 And (costos_enca.cbod)<>12 And (costos_enca.cbod)<>203) AND ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme'))
		GROUP BY costos_enca.nombod, costos_enca.nmedico
		ORDER BY costos_enca.nombod, costos_enca.nmedico");
		$variables=5;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="BODEGA";				
				$vec[0][2]="MEDICO";
				$vec[0][3]="FORMULAS";
				$vec[0][4]="REGISTROS";
				$vec[0][5]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nombod'];
			$vec[$m][2]=$res['nmedico'];
			$vec[$m][3]=$res['CuentaDeformu'];
			$vec[$m][4]=$res['SumaDeregistros'];
			$vec[$m][5]=$res['SumaDetcos'];
			$m++;
		}

	}
	if($opcion==15)
	{
		//COSTO X PRODUCTO	DETA
		
		$busca=mysql_query("SELECT costos_deta.nombrepro, Count(costos_deta.regis) AS CuentaDeregis, Sum(costos_deta.canti) AS SumaDecanti, Sum(costos_deta.tcos) AS SumaDetcos
		FROM costos_deta WHERE ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme')
		GROUP BY costos_deta.nombrepro
		ORDER BY Sum(costos_deta.tcos) DESC");
		$variables=4;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="PRODUCTO";
				$vec[0][2]="REGISTROS";
				$vec[0][3]="CANTIDAD";
				$vec[0][4]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nombrepro'];
			$vec[$m][2]=$res['CuentaDeregis'];
			$vec[$m][3]=$res['SumaDecanti'];
			$vec[$m][4]=$res['SumaDetcos'];
			$m++;
		}
		//REGISTROS X PRODUCTO	DETA

				//ORDER BY Count(costos_deta.regis) DESC;

		//CANTIDAD X PRODUCTOS	DETA

				//ORDER BY Sum(costos_deta.canti) DESC;

		
		
	}
	if($opcion==16)
	{	
		//FORMULAS POR USUARIO	ENCA
		
		$busca=mysql_query("SELECT costos_enca.cedu, costos_enca.nomusu, Count(costos_enca.formu) AS CuentaDeformu, 
		Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.cedu, costos_enca.nomusu
		ORDER BY Count(costos_enca.formu) DESC");
		$variables=5;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="DOCUMENTO";
				$vec[0][2]="NOMBRE USUARIO";
				$vec[0][3]="FORMULAS";
				$vec[0][4]="REGISTROS";
				$vec[0][5]="TOTAL COSTO";
				
			}
			$vec[$m][1]=$res['cedu'];
			$vec[$m][2]=$res['nomusu'];
			$vec[$m][3]=$res['CuentaDeformu'];
			$vec[$m][4]=$res['SumaDeregistros'];
			$vec[$m][5]=$res['SumaDetcos'];
			$m++;
		}

	}
	if($opcion==17)
	{
		//FORMULAS X USUARIO CE	ENCA (menos hospi, urge, ucis, quiro)

		$busca=mysql_query("SELECT costos_enca.cedu, costos_enca.nomusu, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos, costos_enca.scco
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.cedu, costos_enca.nomusu, costos_enca.scco
		HAVING (((costos_enca.scco)<>6 And (costos_enca.scco)<>4 And (costos_enca.scco)<>18 And (costos_enca.scco)<>20 And (costos_enca.scco)<>7))
		ORDER BY Count(costos_enca.formu) DESC");
		$variables=5;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="DOCUMENTO";
				$vec[0][2]="NOMBRE USUARIO";
				$vec[0][3]="FORMULAS";
				$vec[0][4]="REGISTROS";
				$vec[0][5]="TOTAL COSTO";
				
			}
			$vec[$m][1]=$res['cedu'];
			$vec[$m][2]=$res['nomusu'];
			$vec[$m][3]=$res['CuentaDeformu'];
			$vec[$m][4]=$res['SumaDeregistros'];
			$vec[$m][5]=$res['SumaDetcos'];
			$m++;
		}

	}
	if($opcion==18)
	{
		//FORMULAS X MEDICO	ENCA

		$busca=mysql_query("SELECT costos_enca.nmedico, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nmedico
		ORDER BY Count(costos_enca.formu) DESC");
		$variables=4;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="MEDICO";
				$vec[0][2]="FORMULAS";
				$vec[0][3]="REGISTROS";
				$vec[0][4]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nmedico'];
			$vec[$m][2]=$res['CuentaDeformu'];
			$vec[$m][3]=$res['SumaDeregistros'];
			$vec[$m][4]=$res['SumaDetcos'];
			$m++;
		}

	}
	if($opcion==19)
	{
		//FORMULAS X CONTRATO	ENCA
		$busca=mysql_query("SELECT costos_enca.nomccos, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nomccos
		ORDER BY Count(costos_enca.formu) DESC");
		$variables=4;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="CONTRATO";
				$vec[0][2]="FORMULAS";
				$vec[0][3]="REGISTROS";
				$vec[0][4]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nomccos'];
			$vec[$m][2]=$res['CuentaDeformu'];
			$vec[$m][3]=$res['SumaDeregistros'];
			$vec[$m][4]=$res['SumaDetcos'];
			$m++;
		}
	}
	if($opcion==20)
	{		
		//FORMULAS X AREA	ENCA

		$busca=mysql_query("SELECT costos_enca.nomscco, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nomscco
		ORDER BY Count(costos_enca.formu) DESC");
		$variables=4;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{
				$vec[0][1]="AREA";
				$vec[0][2]="FORMULAS";
				$vec[0][3]="REGISTROS";
				$vec[0][4]="TOTAL COSTO";
			}
			$vec[$m][1]=$res['nomscco'];
			$vec[$m][2]=$res['CuentaDeformu'];
			$vec[$m][3]=$res['SumaDeregistros'];
			$vec[$m][4]=$res['SumaDetcos'];
			$m++;
		}

	}
	if($opcion==21)
	{
		//PACIENTES POR CONTRATO	ACCES (FARMACIASERV4.2)

		$busca=mysql_query("CREATE TEMPORARY TABLE costotmp SELECT contrato.NSII_CON, formulamae.codi_usu
		FROM formulamae INNER JOIN contrato ON formulamae.ccos_for = contrato.CSII_CON
		WHERE (((formulamae.fdis_for)>='2014-09-01' And (formulamae.fdis_for)<='2014-09-27'))
		GROUP BY contrato.NSII_CON, formulamae.codi_usu");

		$resul=mysql_query("SELECT costotmp.NSII_CON, Count(costotmp.codi_usu) AS CuentaDecodi_usu
		FROM costotmp
		GROUP BY costotmp.NSII_CON");
		$variables=2;
		$m=1;
		while($res=mysql_fetch_array($resul))
		{
			if($m==1)
			{
				$vec[0][1]="CONTRATO";
				$vec[0][2]="PACIENTES";				
			}
			$vec[$m][1]=$res['NSII_CON'];
			$vec[$m][2]=$res['CuentaDecodi_usu'];			
			$m++;
		}
		
		

	}
	if($opcion==22)
	{
		//PACIENTES POR AREA	ACCES (FARMACIASERV4.2)

		$busca=mysql_query("CREATE TEMPORARY TABLE costotmp SELECT subcen.desc, formulamae.codi_usu
		FROM subcen INNER JOIN formulamae ON subcen.codi = formulamae.scco_for
		WHERE (((formulamae.fdis_for)>='2014-09-01' And (formulamae.fdis_for)<='2014-09-27'))
		GROUP BY subcen.desc, formulamae.codi_usu");

		$resul=mysql_query("SELECT costotmp.desc, Count(costotmp.codi_usu) AS CuentaDecodi_usu1
		FROM costotmp
		GROUP BY costotmp.desc
		ORDER BY Count(costotmp.codi_usu) DESC");
		$variables=2;
		$m=1;
		while($res=mysql_fetch_array($resul))
		{
			if($m==1)
			{
				$vec[0][1]="AREA";
				$vec[0][2]="PACIENTES";				
			}
			$vec[$m][1]=$res['desc'];
			$vec[$m][2]=$res['CuentaDecodi_usu1'];			
			$m++;
		}

	}
		//MULTIDISPENSACION	192.168.4.2/intraweb/intranet/formula/costos/busca_usuarios_multiformula2.php



		//COMPORTAMIENTO 2013	Datos del informe

		//FORMULACION COSTO Y ALTOCOSTO



		//DATOS ESTADISTICOS	Datos del informe

		//NUMERO DE FORMULAS DISPENSADAS	32977
		//NUMERO DE USUARIOS FORMULADOS	10015
		//NUMERO DE REGISTROS DIGITADOS	68539
		//NUMERO DE PRODUCTOS DISPENSADOS	1271
		//NUMERO DE ESPECIALIDADES QUE FORMULARON	39
		//NUMERO DE PRODUCTOS ALTO COSTO DISPENSADOS	41
	
	if($opcion==12 || $opcion==13|| $opcion==14) 
	{
		ECHO"<br><br>
		<table align=center cellpadding=5 border=1>";
		for($n=2;$n<=$variables;$n++)
		{
			$totparcial[$n]=0;	
		}
		for($n=2;$n<=$variables;$n++)
		{
			$totgeneral[$n]=0;	
		}
		$control='';
		
		for($i=0;$i<$m;$i++)
		{
			if($control!=$vec[$i][1])
			{
				echo"<tr bgcolor='#DDDDDD'><td>TOTAL $control</td>";
				for($j=2;$j<=$variables;$j++)
				{
					$valorp=$totparcial[$j];
					echo"<td>$valorp</td>";					
					$totparcial[$j]=0;	
				}
				echo"</tr>";
				$control=$vec[$i][1];				
			}
			
			echo"<tr>";
			for($j=1;$j<=$variables;$j++)
			{
				$valor=$vec[$i][$j];
				echo"<td>$valor</td>";
				if($j>1) 
				{
					$totgeneral[$j]=$totgeneral[$j]+$valor;
					$totparcial[$j]=$totparcial[$j]+$valor;
				}
				
			}	
			echo "</tr>";			
		}
		echo"<tr>
		<td>TOTALES</td>
		";
		for($n=2;$n<=$variables;$n++)
		{
			$val=$totgeneral[$n];
			echo"<td>$val</td>";		
		}
			
		echo"</tr></table>";
	}
	else
	{	
		ECHO"<br><br>
		<table align=center cellpadding=5 border=1>";
		for($n=2;$n<=$variables;$n++)
		{
			$totgeneral[$n]=0;	
		}
		for($i=0;$i<$m;$i++)
		{
			$color="#FFFFFF";
			if($i==0)$color="#F5E099";
			echo"<tr>";
			for($j=1;$j<=$variables;$j++)
			{
				$valor=$vec[$i][$j];
				echo"<td>$valor</td>";
				if($j>1) 
				{
					$totgeneral[$j]=$totgeneral[$j]+$valor;
				}
				
			}
			echo "</tr>";
		}
		echo"<tr>
		<td>TOTALES</td>
		";
		for($n=2;$n<=$variables;$n++)
		{
			$val=$totgeneral[$n];
			echo"<td>$val</td>";		
		}
			
		echo"</tr></table>";	
	}
	
?>

</body>
</html>