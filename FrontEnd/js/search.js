

const input1 = document.querySelector("#myInput");
const SearchButton = document.querySelector('#SearchButton')



SearchButton.onclick = function () 
  {
      const combo_box = document.getElementById('combo_box').textContent; 
      const key = 'serach_input';
      const value1 = input1.value;

      
    
      if(value1===''){
        const key1 = ' ';
        const value2 = ' ';
        sessionStorage.setItem(key, value2);
      }
      else if(key && value1){
        sessionStorage.setItem(key, value1);
        };

    
        sessionStorage.setItem('combo_box', combo_box);
        window.location = 'search_page.html#'+combo_box+'#'+value1;

  }

let resultEle = document.querySelector("#search_result");
let sampleEle = document.querySelector("#myInput");
sampleEle.addEventListener("keyup", (event) => {
    if (event.keyCode === 13) {
      event.preventDefault();
      document.querySelector("#SearchButton").click();
    }
  });

