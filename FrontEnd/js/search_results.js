let windowHash = window.location.hash;
windowHash = windowHash.split('#');
keySearch = windowHash[2];
keySearch = keySearch.split('%20').join(' ');
keyCategory = windowHash[1].toLowerCase();
document.getElementById("search_result").textContent += keySearch;

const searchResult = document.getElementById('searchResults');
let movie = [];




  
const loadMovies = async () => {
    try {
        if(keyCategory==='all'){
            const res = await fetch('https://users.it.teithe.gr/~ait062021/index.php/v1/Movies');
        movie = await res.json();
        const searchString = keySearch.toLowerCase();
        //console.log(searchString);
        const filteredMovies = movie.filter((movie) => {
            return (
                movie.title.toLowerCase().includes(searchString)||
                movie.overview.toLowerCase().includes(searchString)
            );
        });
        for (let i = 0; i < filteredMovies.length ; i++) {
            const title = filteredMovies[i].title;
            const titleS = title.toString();
            sessionStorage.setItem(titleS, JSON.stringify(filteredMovies[i]));
        }
        displayMovies(filteredMovies);
        
        }
        else{
            const res = await fetch('https://users.it.teithe.gr/~ait062021/index.php/v1/Movies?category='+ keyCategory);
            movie = await res.json();
            const searchString = keySearch.toLowerCase();
            
            const filteredMovies = movie.filter((movie) => {
                return (
                    movie.title.toLowerCase().includes(searchString)||
                    movie.overview.toLowerCase().includes(searchString)
                );
            });
            for (let i = 0; i < filteredMovies.length ; i++) {
                const title = filteredMovies[i].title;
                const titleS = title.toString();
                sessionStorage.setItem(titleS, JSON.stringify(filteredMovies[i]));
            }
            displayMovies(filteredMovies);
            
        }
        
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


