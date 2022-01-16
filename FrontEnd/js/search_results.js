let windowHash = window.location.hash;
windowHash = windowHash.split('#');
keySearch = windowHash[2];
keySearch = keySearch.split('%20').join(' ');
keyCategory = windowHash[1].toLowerCase();
document.getElementById("search_result").textContent += '"'+keySearch+'"'+' Category: "'+keyCategory+'"';

const searchResult = document.getElementById('searchResults');
let movie = [];

if(keyCategory==='all'){
    keyCategory = '';
}


  
const loadMovies = async () => {
    try {
       
            const searchString = keySearch.toLowerCase();
            const res = await fetch("https://users.it.teithe.gr/~ait062021/index.php/v1/Movies?searchText="+searchString+"&category="+keyCategory+"&bestMovies=true");
            movie = await res.json();

            for (let i = 0; i < movie.length ; i++) {
                const title = movie[i].title;
                const titleS = title.toString();
                sessionStorage.setItem(titleS, JSON.stringify(movie[i]));
            }
            displayMovies(movie);
        
        
        } catch (err) {
        console.error(err);
    }
};

const displayMovies = (movies) => {
    const htmlString = movies
        .map((movies) => {
            return `
            
            <div class="d-flex col col-sm col-md">
                    <div class="card bg-dark text-white" style="width: 10rem; margin-bottom: 2em;">
                      <a href="movie_page.html#${movies.title}" class="movie" id="${movies.title}"><img class="card-img-top" src="${movies.posterImage}" alt="Card image cap"></a>
                      <span class="badge rounded-pill bg-danger position-absolute bottom-0 end-0">${movies.voteAverage}</span>
                      <div class="card-body">
                        <p class="card-text">${movies.title}</p>
                        
                      </div>
                    </div>  
            </div>
            
            
        `;
        })
        .join('');
    searchResult.innerHTML = htmlString;
};

loadMovies();


