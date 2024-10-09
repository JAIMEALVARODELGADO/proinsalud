/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function Seccion(objHabilitar)
{
        var nameContenedor = objHabilitar.name;
        var codiSeccion = nameContenedor.substring(3,nameContenedor.length);
        nameContenedor = "Secc_" + codiSeccion;
        var txtClas = "txt_clasificacion_"+codiSeccion;
        if(objHabilitar.value=="NO")
        {
            document.getElementById(nameContenedor).style.display='none';            
            switch (codiSeccion)             {
                
                case "10":
                    document.getElementById(txtClas).value="38;";
                    break;
                case "11":
                    document.getElementById(txtClas).value="43;";
                    break;
                case "12":
                    document.getElementById(txtClas).value="47;";
                    break;
                default:
                    break;
            }

        }
        else{
                document.getElementById(nameContenedor).style.display='block';
                document.getElementById(txtClas).value="";
        }
}
function mostrarSiNo(respuesta,ident)
{
        //alert("ide:" +ident + "\n Res: " +respuesta)
        if(respuesta=="si")
        {
                ident1 = ident+"_si"; 
                ident2 = ident+"_no";
                document.getElementById(ident1).style.display = 'inline';		
                document.getElementById(ident2).style.display = 'none';		
        }
        else
        {
                ident1 = ident+"_no"; 
                ident2 = ident+"_si";
                document.getElementById(ident1).style.display = 'inline';		
                document.getElementById(ident2).style.display = 'none';		
        }

}
function mostrar(obj,idcampos)
{
        if(obj.checked)
        {			
                mostrarSiNo("si",idcampos);
        }
        else
        {
                mostrarSiNo("no",idcampos);
        }
}
function habilitarText(obj,miForm)
{
        //alert(obj.name);
        for (i=0;i<miForm.elements.length;i++)
                {
                        if(obj.checked)
                        {
                                //alert("on");
                                if(miForm.elements[i].name ==obj.name && miForm.elements[i].type == "text")
                                {
                                        //alert(miForm.elements[i].type);
                                        miForm.elements[i].disabled = false;
                                        miForm.elements[i].focus();
                                        return 0;
                                        exit();
                                }
                        }
                        else
                        {
                                if(miForm.elements[i].name ==obj.name && miForm.elements[i].type == "text")
                                {

                                        miForm.elements[i].value="";
                                        miForm.elements[i].disabled = true;
                                        //alert("of");
                                        return 0;
                                        exit();
                                }
                        }

                }

}
function verificar(miForm,secc)
{
    txt_variables = "txt_variables_" + secc;
    txt_clasificacion = "txt_clasificacion_" + secc;
    //alert(txt_seccion);
    seccion = "S" + secc;		
    var sAux="";
    var resul="";
    var Clasifi="";

    for (i=0;i<miForm.elements.length;i++)
    {
            sNombre = miForm.elements[i].name.split("_");	

            if(sNombre[1] == seccion)
            {	
                    sAux += "NOMBRE: " + miForm.elements[i].name  + " ";
                    sAux += "TIPO :  " + miForm.elements[i].type  + " ";;
                    sAux += "VALOR: " +  miForm.elements[i].value + "\n" ;
                    NomVar = miForm.elements[i].name.split("_");
                    //Checkbox
                    if(miForm.elements[i].type == "checkbox")
                    {
                            if(miForm.elements[i].checked)
                            {						
                                    if(miForm.elements[i].value == "on")	
                                    {
                                            NomVar = NomVar[0] + "_" + "SI";
                                            resul = resul + NomVar + ";";	
                                    }
                                    else
                                    {
                                            NomVar = NomVar[0] + "_" + miForm.elements[i].value;
                                            resul = resul + NomVar + ";";
                                    }

                            }
                            miForm.elements[i].disabled=true;	
                    }
                    //TextBox
                    if(miForm.elements[i].type == "text")
                    {
                            if(miForm.elements[i].value != "")
                            {
                                    NomVar = NomVar[0] + "_" + miForm.elements[i].value;
                                    resul = resul + NomVar + ";";

                            }
                            miForm.elements[i].disabled=true;	
                    }
                    //TextArea
                    if(miForm.elements[i].type == "textarea")
                    {
                            if(miForm.elements[i].value != "")
                            {
                                    NomVar = NomVar[0] + "_" + miForm.elements[i].value;
                                    resul = resul + NomVar + ";";
                            }
                            miForm.elements[i].disabled=true;	
                    }
                    //radio
                    if(miForm.elements[i].type == "radio")
                    {
                            if(miForm.elements[i].checked)
                            {
                                    NomVar = NomVar[0] + "_" + miForm.elements[i].value;
                                    resul = resul + NomVar + ";";
                            }
                            miForm.elements[i].disabled=true;	
                    }			



            }
            //Clasificacion: _clasif                    
            if(sNombre[0]==secc  && sNombre[1] == "clasif")
            {
                    if(miForm.elements[i].checked)
                    {
                            Clasifi = Clasifi + miForm.elements[i].value + ";";
                    }
                    miForm.elements[i].disabled=true;
            }




        }
        document.getElementById(txt_variables).value=resul;
        document.getElementById(txt_clasificacion).value= Clasifi 
        if(document.getElementById(txt_variables).value != "" & document.getElementById(txt_clasificacion).value == "")
        {
                alert("Seleccione al menos una Opcion de Clasificacion");
                habilitarSeccion(miForm,secc)
                return 0;
        }
        else if(document.getElementById(txt_variables).value =="" & document.getElementById(txt_clasificacion).value != "")
        {
                alert("Seleccione al menos una Variable de la Seccion");
                habilitarSeccion(miForm,secc)
                return 0;
        }
        else if(document.getElementById(txt_variables).value =="" & document.getElementById(txt_clasificacion).value == "")
        {
                alert("Seleccione al menos una Variable de la Seccion\nSeleccione al menos una Opcion de Clasificacion");
                habilitarSeccion(miForm,secc)
                return 0;
        }		
        else
        {
                btn_finalizar = "btn_finalizar_" + secc;
                document.getElementById(btn_finalizar).disabled=true;
                btn_habilitar = "btn_habilitar_" + secc;
                document.getElementById(btn_habilitar).disabled=false;                      
        }

}
function mensaje(miForm,secc,seccion_oblig,tiene_clasificacion)
{                 

    //alert(tiene_clasificacion);
    //alert(secc);
    //alert(miForm.elements.length);

    if(seccion_oblig == "SI" && tiene_clasificacion != "NO" )
    {                
        verificar(miForm,secc);               
    }
    else if(seccion_oblig == "SI" && tiene_clasificacion == "NO")
    {
    txt_variables = "txt_variables_" + secc;
    txt_clasificacion = "txt_clasificacion_" + secc;
    //alert(txt_seccion);
    seccion = "S" + secc;		
    var sAux="";
    var resul="";
    var Clasifi="";

    for (i=0;i<miForm.elements.length;i++)
    {
            sNombre = miForm.elements[i].name.split("_");	

            if(sNombre[1] == seccion)
            {	
                    sAux += "NOMBRE: " + miForm.elements[i].name  + " ";
                    sAux += "TIPO :  " + miForm.elements[i].type  + " ";;
                    sAux += "VALOR: " +  miForm.elements[i].value + "\n" ;
                    NomVar = miForm.elements[i].name.split("_");
                    //Checkbox
                    if(miForm.elements[i].type == "checkbox")
                    {
                            if(miForm.elements[i].checked)
                            {						
                                    if(miForm.elements[i].value == "on")	
                                    {
                                            NomVar = NomVar[0] + "_" + "SI";
                                            resul = resul + NomVar + ";";	
                                    }
                                    else
                                    {
                                            NomVar = NomVar[0] + "_" + miForm.elements[i].value;
                                            resul = resul + NomVar + ";";
                                    }

                            }
                            miForm.elements[i].disabled=true;	
                    }
                    //TextBox
                    if(miForm.elements[i].type == "text")
                    {
                            if(miForm.elements[i].value != "")
                            {
                                    NomVar = NomVar[0] + "_" + miForm.elements[i].value;
                                    resul = resul + NomVar + ";";

                            }
                            miForm.elements[i].disabled=true;	
                    }
                    //TextArea
                    if(miForm.elements[i].type == "textarea")
                    {
                            if(miForm.elements[i].value != "")
                            {
                                    NomVar = NomVar[0] + "_" + miForm.elements[i].value;
                                    resul = resul + NomVar + ";";
                            }
                            miForm.elements[i].disabled=true;	
                    }
                    //radio
                    if(miForm.elements[i].type == "radio")
                    {
                            if(miForm.elements[i].checked)
                            {
                                    NomVar = NomVar[0] + "_" + miForm.elements[i].value;
                                    resul = resul + NomVar + ";";
                            }
                            miForm.elements[i].disabled=true;	
                    }			



            }
            //Clasificacion: _clasif                    
            if(sNombre[0]==secc  && sNombre[1] == "clasif")
            {
                    if(miForm.elements[i].checked)
                    {
                            Clasifi = Clasifi + miForm.elements[i].value + ";";
                    }
                    miForm.elements[i].disabled=true;
            }




        }
        document.getElementById(txt_variables).value=resul;
        document.getElementById(txt_clasificacion).value= Clasifi 

        if(document.getElementById(txt_variables).value =="")
        {
                alert("Seleccione al menos una Variable de la Seccion");
                habilitarSeccion(miForm,secc)
                return 0;
        }				
        else
        {
                btn_finalizar = "btn_finalizar_" + secc;
                document.getElementById(btn_finalizar).disabled=true;
                btn_habilitar = "btn_habilitar_" + secc;
                document.getElementById(btn_habilitar).disabled=false;                      
        }
    }
    else
    {
         for (i=0;i<miForm.elements.length;i++)
         {                     
             if(miForm.elements[i].type == "radio")
             {
                nRadio = "rd_" + secc;                     
                if(nRadio == miForm.elements[i].name)
                {
                    if(miForm.elements[i].checked)
                    {
                        verificar(miForm,secc);                                          
                    }                                                        
                }                    
             }                     
         }               

    }

}
function habilitarSeccion(miForm,secc)
{
        for (i=0;i<miForm.elements.length;i++)
        {
                sNombre = miForm.elements[i].name.split("_");	

                if(sNombre[1] == seccion)
                {
                        miForm.elements[i].disabled=false;
                }
                if(sNombre[0]==secc  && sNombre[1] == "clasif")
                {
                        miForm.elements[i].disabled=false;
                }

        }
        btn_finalizar = "btn_finalizar_" + secc;
        document.getElementById(btn_finalizar).disabled=false;
        btn_habilitar = "btn_habilitar_" + secc;
        document.getElementById(btn_habilitar).disabled=true;
}
function buscarBotones(miForm,clasAten)
{
   
   var ban=true;
   var SeccVacia ="";
   secciones = miForm.txt_seccion.value.split(";");
   for (i = 0; i < secciones.length-1; i++) {
       Secc = secciones[i].split("_");
       if(Secc[1]!="SI")
       {
           nRadio = "rd_" + Secc[0];
           bFinalizar = "btn_finalizar_" + Secc[0];
           //tClasificacion = "txt_clasificacion_" + Secc[0];
           if(document.getElementById(nRadio).checked && document.getElementById(nRadio).value== "SI")
           {
               if(document.getElementById(bFinalizar).disabled==false)
               {
                   nomSeccion = document.getElementById(Secc[0]).value;
                   //alert("La seccion " + nomSeccion + " no puede estar vacia");
                   SeccVacia +="La seccion " + nomSeccion + " no puede estar vacia" + "\n";
                   ban = false
               }   
           }                     
       }
       else
       {
           bFinalizar = "btn_finalizar_" + Secc[0];
           if(document.getElementById(bFinalizar).disabled==false)
               {
                   nomSeccion = document.getElementById(Secc[0]).value;
                   //alert("La seccion " + nomSeccion + " no puede estar vacia");
                   SeccVacia +="La seccion " + nomSeccion + " no puede estar vacia" + "\n";
                   ban=false
               }
       }
   }
   
   if(ban)
   {
       //alert("Enviando");
       if(clasAten == "05anos")
       {            
            miForm.action="frm_historia_2m_5a1.php";
            miForm.submit();
       }
       else//02meses
       {
            miForm.action="frm_historia_02meses1.php"; //frm_historia_2m_5a_guardar.php";
            miForm.submit();  
       }
   }
   else
   {
       alert(SeccVacia);
   }

}




/************/
function clasificacionesRegistradas(codiSeccion,CodiClasificacion)
{
    var miForm = document.forms[0];

    var nomClasificacion = codiSeccion + "_clasif";           

    for (i = 0; i < miForm.elements.length; i++) 
    {
        if(miForm.elements[i].type == "checkbox")
        {
            if(miForm.elements[i].name == nomClasificacion )
            {
                if(miForm.elements[i].value == CodiClasificacion)
                {
                    miForm.elements[i].checked= true;                            
                }
            }
        }
    }


}
function VariablesRegistradas(variable, valor)
{

    var miForm = document.forms[0];

    for(i=0;i<miForm.elements.length;i++)
    {
        nomVar = variable;//.substring(1,variable.length);

       if(miForm.elements[i].type=="text")
        {
            if(nomVar== miForm.elements[i].name)
            {
                  miForm.elements[i].value = valor;
            }
        }
        else if(miForm.elements[i].type=="checkbox")
        {
            if(nomVar== miForm.elements[i].name)
            {

                miForm.elements[i].checked = true;
                if(miForm.elements[i].title=="SI-NO")
                    mostrar(miForm.elements[i],"sp_" + miForm.elements[i].name);

            }
            else
            {

               nom = miForm.elements[i].name.split("_");
               novarChk = nom[0] + "_" + nom[1]

               if(nom[2] != undefined)
                   {  
                     if(variable == novarChk && miForm.elements[i].value.toUpperCase() == valor)                            
                     {                                    
                         miForm.elements[i].checked = true;
                     }
                   }


            }
        }
        else if(miForm.elements[i].type=="textarea")
        {
            if(nomVar== miForm.elements[i].name)
            {                        
                miForm.elements[i].value = valor;
            }
        }
        else if(miForm.elements[i].type=="radio")
        {
            if(nomVar== miForm.elements[i].name)
            {

                if(miForm.elements[i].value.toUpperCase() == valor)
                {

                    miForm.elements[i].checked = true;
                }        
            }
        }
    }



}

function Campos_de_Texto(ClasAten)
{
    miForm = document.forms[0];

    var expText=/^[0-9]+[\-|\_]+S[0-9]/;
    var patron = /[_;']/;
    var busca = new Array;
    var ban = false;
    for(i=0;i<miForm.elements.length;i++)
    {
      if(miForm.elements[i].type == "text" || miForm.elements[i].type == "textarea" )
      {
          if(expText.test(miForm.elements[i].name))
          {
            busca = patron.exec(miForm.elements[i].value);
            if (busca != null){ 
                alert("Caracteres invalidos " + busca.input + " caracteres");                
                miForm.elements[i].focus();
                return 0;
                exit();
            }
            else{                        
                ban = true;
            }

          }
      }
      
    }

    if(ban)
    {
        buscarBotones(miForm,ClasAten);
    }
    return 0;
}

/*
*FUNCION SOLO NUMEROS
*/
function solo_numeros(){    
    var key=window.event.keyCode;
    if (key < 48 || key > 57)
    {                
        window.event.keyCode=0;
    }
}

function cambiaColor(obj,codigo ,color)
{
    ban  = obj.checked;
    var div = "dv_" + codigo;  
    color = Color(color)
    if(ban==true)
    {
        document.getElementById(div).style.backgroundColor=color;
    }
    else
    {
        document.getElementById(div).style.backgroundColor='#b7e0f5';
    }            

}
function Color(color)
{
    switch (color) {
    case "ROJO":
        return "red";
        break;
    case "AMARILLO":
        return "yellow";
        break;    
    case "VERDE":
        return "green";
        break;                
    }
}
