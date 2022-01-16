"use strict"


//Κώδικας για Login 

function performLogin(){



const username = document.getElementById("exampleDropdownFormEmail1").value;
const password =document.getElementById("exampleDropdownFormPassword1").value;


var xhttp = new XMLHttpRequest();
xhttp.open("POST", "https://users.it.teithe.gr/~ait062021/index.php/v1/Sessions", false);
//xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhttp.onload = function() {
  if (this.status == 201){
	  alert("Καλως ήρθατε");
    sessionStorage.setItem('connected','true');
    sessionStorage.setItem('username',username);
    location.reload();
  
  }
  else if (xhttp.readyState == 4 && xhttp.status == 401)
    window.alert("Σφάλμα σύνδεσης");
}

//xhttp.withCredentials = true;
xhttp.send('{"username" : "' + username + '", "password" : "' + password + '"}');


} 
