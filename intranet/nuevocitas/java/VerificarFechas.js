/*********************************/
	function compare_dates(fecha)   
	{ 
		var fecha2 = "<? echo $fecha_actual; ?>"
		
       var xYear = fecha.substring(0,4)
	   var xMonth=fecha.substring(5, 7);   
       var xDay=fecha.substring(8, 11);   
       //var xYear=fecha.substring(6,10);   
	   var yYear=fecha2.substring(0,4) 
       var yMonth=fecha2.substring(5, 7);
       var yDay=fecha2.substring(8, 11);     
	  
	  
       if (xYear> yYear)   
       {   
           return "mayor";   
       }
       else  
       {   
         if (xYear == yYear)   
         {    
           if (xMonth> yMonth)   
           {   
               return "mayor";  
           }   
           else  
           {    
              if (xMonth == yMonth)   
             {   
               if (xDay> yDay){  
                 return "mayor";
				 
				}
			   else if(xDay == yDay){
				//alert("iguales");	
				 return "iguales";
				}			    	
               else{  
				 
                 return "menor";   
				 }
             }   
             else  
               return "menor";   
           }   
         }		
		 
         else  
           return "menor";    
		
       } 
	}
	
	function comparaFechas(fecha)
	{
		alert(fecha);
		var cdate = compare_dates(fecha);
		if (cdate == "mayor"){
		  return (true);
		}
		else if(cdate == "iguales")
		{
			//alert(cdate);
			alert("Fechas son IGUALES");
			return (true)
		}
		else{
			alert(fecha +" por favor seleccione una fecha valida");						
		}
	}
	/**************************************************************/