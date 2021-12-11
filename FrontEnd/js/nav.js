function changeClass() { 
    const search_icon = document.getElementById('search_icon');
    const value = search_icon.classList.value;
    if (value==='fas fa-search'){
        search_icon.className ='far fa-times-circle';
        
    }
    else {
        search_icon.className ='fas fa-search';

    }
    
    
} ;