

const input1 = document.querySelector("#myInput");
const SearchButton = document.querySelector('#SearchButton')



SearchButton.onclick = function () 
  {
      
      const key = input1.value;
      const value1 = input1.value;

      
    
      if(key===''){
        const key1 = ' ';
        const value2 = ' ';
        localStorage.setItem(key1, value2);
      }
      else if(key && value1){
        localStorage.setItem(key, value1);
        };

    
    window.location = 'search_page.html';

  }

let resultEle = document.querySelector("#search_result");
let sampleEle = document.querySelector("#myInput");
sampleEle.addEventListener("keyup", (event) => {
    if (event.keyCode === 13) {
      event.preventDefault();
      document.querySelector("#SearchButton").click();
    }
  });

