/* ------------------ Allow cross browser setting --------------------- */

// connect to API and fetch data
const connectToAPIs = () => {
    fetch('https://users.it.teithe.gr/~ait062021/index.php/v1/Movies?bestMovies=true')
    .then(response => response.json())
    .then(data => {
      getData(data);
      carousel();
    })
  };
  // get url of img and set it as attribute
  function getData (data){
  
    //grab img tags and captions tags
    const imgs = document.querySelectorAll('div.mySlides .img');
    const captions = document.querySelectorAll('div.mySlides .badge');
    const anchors = document.querySelectorAll('div.mySlides .movie');
    const array = [];
    
   
  
    //iterate img tags to set different src and set it to attributes
    imgs.forEach( (img,index) => {
  
      //get random num between 0-19
      const random = Math.floor(index);
  
      //get src and title of img from data obj with random num
      const imgSrc = data[random].posterImage;
      const capText = data[random].title;
     
  
  
      //set img attributes
      img.setAttribute('src', imgSrc);
  
      //replace caption text
      captions[index].innerHTML = capText;
      sessionStorage.setItem(capText, JSON.stringify(data[random]))
      array.push("movie_page.html#" +data[random].title)
  
    });

    anchors.forEach((anchor,index) =>{
      const anchorLink = array[index];
      anchor.setAttribute('href', anchorLink)

    });
  
  }
  
  //carousel function
  function carousel (){
    let slideIndex = 1;
  
    //prev and next btn
    function plusSlides(index){
      showSlides(slideIndex += index);
    }
  
    //dot btn
    function dotSlides(index){
      showSlides(index);
    }
  
    function showSlides(n){
  
      const slides = document.getElementsByClassName('mySlides');
      const dots = document.getElementsByClassName('dot');
  
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (let i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "flex";
      dots[slideIndex-1].className += " active";
  
    }
  
    //prev btn eventlistener
    const prev = document.querySelector('.prev');
    prev.addEventListener('click', e => {
      plusSlides(-1);
    });
  
  
    //next btn eventlistener
    const next = document.querySelector('.next');
    next.addEventListener('click', e => {
      plusSlides(1);
    });
  
    //dot btn
    const dots = document.querySelectorAll('.dot');
    dots.forEach((dot, index) => {
      dot.addEventListener('click', e => {
        dotSlides(index+1);
      });
    });
  
    //initial display img
    showSlides(1);
  
  } //carousels
  
  connectToAPIs();
  