"use strict"


//Κώδικας για Logout

function performLogout(){


var xhttp = new XMLHttpRequest();
xhttp.open("DELETE", "https://users.it.teithe.gr/~ait062021/index.php/v1/Sessions", true);
xhttp.onload = function() {
  if (xhttp.readyState == 4 && xhttp.status == 204){
    sessionStorage.setItem('connected','false');
    sessionStorage.removeItem('username');
    location.reload();
  }
  else {
    window.alert("Σφάλμα αποσύνδεσης");
  }
}

//xhttp.withCredentials = true
xhttp.send();


} 
