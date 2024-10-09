function AbrirVentana() {
 MiVentana=open("","MiPropiaVentana","toolbar=no,directories=no,menubar=no,status=yes");

MiVentana.document.write(
    "<HEAD><TITLE>Una nueva ventana</TITLE></HEAD>");
    MiVentana.document.write("<FRAMESET cols=100%,*>
     <FRAMESET rows=25%,*> 
    
        <FRAME SRC=enc_bus.htm NAME=Frm1> 


	<FRAMESET cols=50%,*>
      <FRAME SRC= dat_usuat.html NAME=Frm2> 
      <FRAMESET rows=100%,*> 
    
        <FRAME SRC=histo_cit.html NAME=Frm3> 
     

     </FRAMESET> 

     </FRAMESET> 




    

     </FRAMESET> 

     </FRAMESET> ");


}
