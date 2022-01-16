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
      alert('Please enter your name');
    }
		else if(!letters.test(name))
		{
			alert('Name field required only alphabet characters');
		}
		else if(email=='')
		{
			alert('Please enter your user email id');
		}
		else if (!filter.test(email))
		{
			alert('Invalid email');
		}
		else if(pwd=='')
		{
			alert('Please enter Password');
		}
		else if(cpwd=='')
		{
			alert('Enter Confirm Password');
		}
		else if(!pwd_expression.test(pwd))
		{
			alert ('Upper case, Lower case, Special character and Numeric letter are required in Password filed');
		}
		else if(pwd != cpwd)
		{
			alert ('Password not Matched');
		}
		else if(document.getElementById("form3Example4cdg").value.length < 6)
		{
			alert ('Password minimum length is 6');
		}
		else if(document.getElementById("form3Example4cdg").value.length > 12)
		{
			alert ('Password max length is 12');
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
				alert('Thank You for register');
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
        alert("Password column and Confirm Password column doesn't match!")
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