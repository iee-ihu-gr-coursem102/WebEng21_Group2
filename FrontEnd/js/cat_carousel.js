
var scrollPerClick;
var ImagePadding = 20
document.addEventListener("DOMContentLoaded", function(event) {
ActionMovies ()
dramaMovies ()
HorrorMovies ()
RomanceMovies ()
ComedyMovies ()

});

var scrollAmount = 0;

function sliderScrollLeft(carouselSelector) {
    const carousel = document.querySelector(carouselSelector)
    carousel.scrollTo({
        top: 0,
        left: (scrollAmount -= scrollPerClick),
        behavior: "smooth",
    });

    if (scrollAmount <0) {
        scrollAmount = 0
    }
}

function sliderScrollRight(carouselSelector) {
    const carousel = document.querySelector(carouselSelector)
    if (scrollAmount <= carousel.scrollWidth - carousel.clientWidth) {        
        carousel.scrollTo({
            top: 0,
            left: (scrollAmount += scrollPerClick),
            behavior: "smooth",
        });
    }
}


async function ActionMovies () {
    
    const actionCarousel =  document.querySelector("#actionCarousel")
    var result = await axios.get("https://users.it.teithe.gr/~ait062021/index.php/v1/Movies?category=Action");
    result = result.data;
    
    result.sort(() =>(Math.random()>0.5)?1:-1).slice(0,20).map (function (movie) {
       actionCarousel.insertAdjacentHTML(
           "beforeend",
           `<a href="#" data-id="${movie.id}" data="${JSON.stringify(movie)}" data-name="${movie.title}"><img class="img-slider-img" src="${movie.posterImage}" /></a>`        
       )

        document.querySelectorAll(`a[data-id=${movie.id}]`)[0].addEventListener("click", (event)=>{
            event.preventDefault();
            event.stopPropagation();
            sessionStorage.setItem(movie.title, JSON.stringify(movie))
            document.location.href=`movie_page.html#${movie.title}`
        })

    })
    
    scrollPerClick = 400;
    
}

async function dramaMovies () {
    
    const dramaCarousel =  document.querySelector("#dramaCarousel")
    var result = await axios.get("https://users.it.teithe.gr/~ait062021/index.php/v1/Movies?category=Drama");
    result = result.data;
    
    result.sort(() =>(Math.random()>0.5)?1:-1).slice(0,20).map (function (movie) {
       dramaCarousel.insertAdjacentHTML(
           "beforeend",
           `<a href="#" data-id="${movie.id}" data="${JSON.stringify(movie)}" data-name="${movie.title}"><img class="img-slider-img" src="${movie.posterImage}" /></a>`       
       )

       document.querySelectorAll(`a[data-id=${movie.id}]`)[0].addEventListener("click", (event)=>{
        event.preventDefault();
        event.stopPropagation();
        sessionStorage.setItem(movie.title, JSON.stringify(movie))
        document.location.href=`movie_page.html#${movie.title}`
    })
          
    })
    
    scrollPerClick = 400;
    
}

async function HorrorMovies () {
    
    const horrorCarousel =  document.querySelector("#horrorCarousel")
    var result = await axios.get("https://users.it.teithe.gr/~ait062021/index.php/v1/Movies?category=Horror");
    result = result.data;
    
    result.sort(() =>(Math.random()>0.5)?1:-1).slice(0,20).map (function (movie) {
        horrorCarousel.insertAdjacentHTML(
           "beforeend",
           `<a href="#" data-id="${movie.id}" data="${JSON.stringify(movie)}" data-name="${movie.title}"><img class="img-slider-img" src="${movie.posterImage}" /></a>`        
       )

       document.querySelectorAll(`a[data-id=${movie.id}]`)[0].addEventListener("click", (event)=>{
        event.preventDefault();
        event.stopPropagation();
        sessionStorage.setItem(movie.title, JSON.stringify(movie))
        document.location.href=`movie_page.html#${movie.title}`
    })

    })
    
    scrollPerClick = 400;
    
}

async function RomanceMovies () {
    
    const romanceCarousel =  document.querySelector("#romanceCarousel")
    var result = await axios.get("https://users.it.teithe.gr/~ait062021/index.php/v1/Movies?category=Romance");
    result = result.data;
    
    result.sort(() =>(Math.random()>0.5)?1:-1).slice(0,20).map (function (movie) {
        romanceCarousel.insertAdjacentHTML(
           "beforeend",
           `<a href="#" data-id="${movie.id}" data="${JSON.stringify(movie)}" data-name="${movie.title}"><img class="img-slider-img" src="${movie.posterImage}" /></a>`        
       )

       document.querySelectorAll(`a[data-id=${movie.id}]`)[0].addEventListener("click", (event)=>{
        event.preventDefault();
        event.stopPropagation();
        sessionStorage.setItem(movie.title, JSON.stringify(movie))
        document.location.href=`movie_page.html#${movie.title}`
    })

    })

    
    
    scrollPerClick = 400;
    
}

async function ComedyMovies () {
    
    const comedyCarousel =  document.querySelector("#comedyCarousel")
    var result = await axios.get("https://users.it.teithe.gr/~ait062021/index.php/v1/Movies?category=Comedy");
    result = result.data;
    
    result.sort(() =>(Math.random()>0.5)?1:-1).slice(0,20).map (function (movie) {
        comedyCarousel.insertAdjacentHTML(
           "beforeend",
           `<a href="#" data-id="${movie.id}" data="${JSON.stringify(movie)}" data-name="${movie.title}"><img class="img-slider-img" src="${movie.posterImage}" /></a>`        
       )

       document.querySelectorAll(`a[data-id=${movie.id}]`)[0].addEventListener("click", (event)=>{
        event.preventDefault();
        event.stopPropagation();
        sessionStorage.setItem(movie.title, JSON.stringify(movie))
        document.location.href=`movie_page.html#${movie.title}`
    })
    
    })
    
    scrollPerClick = 400;
    
}


