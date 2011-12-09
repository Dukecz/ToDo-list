function validateForm(form){
var username = form.username.value;
var password = form.password.value;

for(var j=0; j<username.length; j++){
var alphaa = username.charAt(j);
var hh = alphaa.charCodeAt(0);
 if((hh > 47 && hh<58) || (hh > 64 && hh<91) || (hh > 96 && hh<123)){
 }else{
 alert("Jméno může obsahovat pouze alfanumerické znaky.");
 return false;
 }
}

if (password==null || password=="" || username==null || username=="")
  {
  alert("Uživatelské jméno i heslo musí být vyplněny");
  return false;
  }
  
 return true;
}