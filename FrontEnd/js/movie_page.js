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

const arr = [0,1,2,3,4,5,6,7,8,9,10];

document.getElementById("sendButton").addEventListener("click", userInput);

function userInput() {
    const userRating = document.getElementById('userRating').value;
    if (arr.includes(parseInt(userRating))){
        alert("Good input");
    }
    else{
        alert("Bad input");
    }
}

