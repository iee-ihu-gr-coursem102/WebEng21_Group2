
const loadGenres = async () => {
    try {
        const res = await fetch('https://users.it.teithe.gr/~ait062021/index.php/v1/Genres');
        genres = await res.json();
        for (let i = 0; i < 20; i++) {
            var d1 = document.getElementById("drop");
            d1.insertAdjacentHTML('beforeend', '<li><a class="dropdown-item" id = "item_'+(i+1).toString()+'" onclick="changeBox('+(i+1).toString()+')">'+genres[i]+'</a></li>');
          }
        } 
        catch (err) {
        console.error(err);
    }
};

loadGenres();

function changeBox(i){
    if (i===30) {
        document.getElementById('combo_box').textContent = 'All';
    }
    else {
        const text = document.querySelector('#item_'+(i).toString()).textContent;
        document.getElementById('combo_box').textContent = text;
        }
    
}




