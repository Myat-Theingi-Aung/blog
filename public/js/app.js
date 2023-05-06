let input = document.getElementById('title');
let search = document.getElementById('search');
search.disabled = true;
input.addEventListener('keyup',function(){
    if(input.value.length > 0){
        search.disabled = false;
    }else{
        search.disabled = true;
    }
});

