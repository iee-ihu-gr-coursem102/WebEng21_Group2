

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
const postedComments = document.getElementById("postedComments");

const loadComment = async () => {
    try {
       
            const id = json.id;
            const res = await fetch("https://users.it.teithe.gr/~ait062021/index.php/v1/Comments?movieId="+id);
            comments = await res.json();
            displayComments(comments);
        
        
        } catch (err) {
        console.error(err);
    }
};

const displayComments = (comments) => {
    const htmlString = comments
        .map((commnets) => {
            return `
            
            <div class="be-comment">
                <div class="be-img-comment">	
                 
                    <img src="img/duck.png" alt="" class="be-ava-comment">
                 
                </div>
                <div class="be-comment-content">
                  
                    <span class="be-comment-name">
                      ${commnets.username}
                      </span>
                    <span class="be-comment-time">
                      ${commnets.commentDate}
                    </span>
            
                  <p class="commentText" style="color:white">
                  ${commnets.commentText}
                  </p>
                </div>
              </div>
            
            
        `;
        })
        .join('');
        postedComments.innerHTML = htmlString;
};

loadComment();

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


 function userInput1() {
    const id = json.id;
    var userComment = document.getElementById('userComment').value;
    var xhttp = new XMLHttpRequest();
    
    xhttp.open("POST", "https://users.it.teithe.gr/~ait062021/index.php/v1/Comments", false);
    xhttp.onload = function() {
    if (xhttp.status == 201){
        alert("ok");
        location.reload();
    }else if (xhttp.readyState == 4 && xhttp.status == 400)
        window.alert("Error");
    
    
    }
    xhttp.withCredentials = true;
    xhttp.send('{"movieId" : "' + id + '", "commentText" : "' + userComment + '"}');

 }