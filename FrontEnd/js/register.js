"use strict"

function registration()	{

	  	const name= document.getElementById("form3Example1cg").value;
		const email= document.getElementById("form3Example3cg").value;
		const pwd= document.getElementById("form3Example4cg").value;			
		const cpwd= document.getElementById("form3Example4cdg").value;
		
        //email id expression code
		const pwd_expression = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/;
		const letters = /^[A-Za-z]+$/;
		const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		if(name=='') {
      alert('Παρακάλω εισάγετε όνομα');
    }
		else if(!letters.test(name))
		{
			alert('Χρησιμοποιήστε μόνο αλφαβητικούς χαρακτήρες');
		}
		else if(email=='')
		{
			alert('Παρακαλώ εισάγεται email');
		}
		else if (!filter.test(email))
		{
			alert('Λάθος email');
		}
		else if(pwd=='')
		{
			alert('Παρακαλώ εισάγεται κωδικό πρόσβασης');
		}
		else if(cpwd=='')
		{
			alert('Παρακαλώ επιβεβαιώστε τον κωδικό πρόσβασης');
		}
		else if(!pwd_expression.test(pwd))
		{
			alert ('Κεφαλαία, μικρά, ειδικοί χαρακτήρες  και γράμματα απαιτούνται στο πεδίο του κωδικού');
		}
		else if(pwd != cpwd)
		{
			alert ('Οι κωδικοί δεν ταιριάζουν');
		}
		else if(document.getElementById("form3Example4cdg").value.length < 6)
		{
			alert ('Μικρότερο μήκος κωδικού τα 6 ψηφία');
		}
		else if(document.getElementById("form3Example4cdg").value.length > 12)
		{
			alert ('Μεγαλύτερο μήκος κωδικού τα 12 ψηφία');
		}
		else if (document.getElementById("form3Example4cg").value == document.getElementById("form3Example4cdg").value) {
        var users = new Object();
        users.name = document.getElementById("form3Example1cg").value;
        users.email = document.getElementById("form3Example3cg").value;
        users.password = document.getElementById("form3Example4cg").value;

        var postUser = new XMLHttpRequest(); // new HttpRequest instance to send user details
		postUser.open('POST', "https://users.it.teithe.gr/~ait062021/index.php/v1/Users", false); //Use the HTTP POST method to send data to server
                postUser.onload=function(){
			if(postUser.status == 201){	
				alert('Ευχαριστούμε για την εγγραφή σας');
				sessionStorage.setItem('password',users.password);
				sessionStorage.setItem('username',users.name);
				performLogin();
				
			}else if(postUser.status != 201) {
				alert(postUser.status);
					}
		}
                    // postUser.withCredentials = true;
		postUser.send('{"username" : "' + users.name + '", "email" : "' + users.email + '", "password" : "' + users.password + '"}');
	
		
		 
	
    }
    
        
   
    else {
        alert("Κωδικος πρόσβασης με την επιβεβαίωση δεν ταιρίαζουν!")
    }


				                            
        
//Clear Registration Form
		
	}
	function clearFunc()
	{
		document.getElementById("form3Example1cg").value="";
		document.getElementById("form3Example3cg").value="";
		document.getElementById("form3Example4cg").value="";
		document.getElementById("form3Example4cdg").value="";
	}

	function performLogin(){



		const username = sessionStorage.getItem('username');
		const password = sessionStorage.getItem('password');
		
		
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "https://users.it.teithe.gr/~ait062021/index.php/v1/Sessions", false);
		//xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhttp.onload = function() {
		  if (this.status == 201){
			  alert("ok");
			sessionStorage.setItem('connected','true');
			sessionStorage.removeItem('password')
				document.getElementById("papaki").click();
					  }
		  else if (xhttp.readyState == 4 && xhttp.status == 401)
			window.alert("Error Password or Username");
		}
		
		xhttp.withCredentials = true;
		xhttp.send('{"username" : "' + username + '", "password" : "' + password + '"}');
		
		
		} 