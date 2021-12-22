"use strict"


//Κώδικας για Login 

function performLogin(){



const username = document.getElementById("exampleDropdownFormEmail1").value;
const password =document.getElementById("exampleDropdownFormPassword1").value;


var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (xhttp.readyState == 4 && xhttp.status == 201){
	  window.alert("Correct");
    window.open("front_page.html");
    //Code that you are connected
  }
  else if (xhttp.readyState == 4 && xhttp.status == 401)
    window.alert("Error Password or Username");
}

xhttp.open("POST", "https://users.it.teithe.gr/~ait062021/index.php/v1/Sessions", false);
xhttp.send('{"username" : "' + username + '", "password" : "' + password + '"}');


} 
