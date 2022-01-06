

let d = window.location.hash;
d = d.split('#').join('');
d = d.split('%20').join(' ');
d = d.split('%C3%A9').join('é');
d = d.split('%C3%A8').join('è');
d = d.split('%C3%B4').join('ô');
d = d.split('%C3%A0').join('à');
d = d.split('%C3%B2').join('ò');
const retrievedObject = sessionStorage.getItem(d);



const json = JSON.parse(retrievedObject);

document.getElementById("title").innerHTML = json.title;



document.getElementById("score").innerHTML = json.voteAverage;



document.getElementById("overview").innerHTML = json.overview;



document.getElementById("images").src = json.posterImage;

//document.getElementById("sendButton").addEventListener("click", userInput);
"use strict";

function userInput() {
    const id = json.id;
    var userRating = document.getElementById('userRating').value;
    var intRating = parseFloat(userRating);
    var xhttp = new XMLHttpRequest();
    
    xhttp.open("POST", "https://users.it.teithe.gr/~ait062021/index.php/v1/Ratings", false);
    xhttp.onload = function() {
    if (xhttp.status == 201){
        alert("ok");
        location.reload();
    }else if (xhttp.readyState == 4 && xhttp.status == 401)
        window.alert("Error Password or Username");
    
    
    }
    xhttp.withCredentials = true;
    xhttp.send('{"movieid" : "' + id + '", "rating" : ' + intRating + '}');

 }


