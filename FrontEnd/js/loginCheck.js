"use strict"


//Κώδικας για Login 

function performLoginCheck(){
    const url = "https://users.it.teithe.gr/~ait062021/index.php/v1/Sessions";
    fetch(url)
      .then(
        response => response.text() // .json(), .blob(), etc.
      ).then(
        text => console.log(text) // Handle here
      );

} 
