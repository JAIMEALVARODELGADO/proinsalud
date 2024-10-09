src="jss/validanum.js"
var nav4 = window.Event ? true : false;
function validanum(evt){
  // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
  var key = nav4 ? evt.which : evt.keyCode;
  return (key <= 13 || (key >= 46 && key <= 57));
}