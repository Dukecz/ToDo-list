var input = document.getElementById("frmregisterForm-username");
var result = document.getElementById("result");

input.value = "";
result.value = "";
input.focus();

var sendRequest = function() {
	var query = input.value;
	if (!query) { 
		result.value = "";
		return; 
	}
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = receiveResponse;
	xhr.open("GET", "../js/usernameTest.php?q="+query, true);
	xhr.send(null);
}

var receiveResponse = function() {
	if (this.readyState != 4) { return; }
	if (this.status != 200) { return; }
	if (this.responseText == 0){
		result.innerHTML  = '<img src="/ToDo-list/images/s_success.png" alt="Uživatelské jméno je volné.">';
	}else{
		//result.value = '<img src="/ToDo-list/images/b_drop.png" alt="Delete Category">';
		result.innerHTML  = '<img src="/ToDo-list/images/b_drop.png" alt="Uživatelské jméno není volné.">';
	}
}


input.addEventListener("keyup", sendRequest, false);
