
const menuBtn = document.querySelector('.menu_btn'); //wybranie elementu
const menuSide = document.querySelector('.small_menu');

let menuOpen = false;
menuBtn.addEventListener('click', ()=> {
    if(!menuOpen){
        menuBtn.classList.add('open'); //nadanie klasy po kliknieciu jezeli jej nie ma
        menuSide.classList.add('open');
        menuOpen = true;
    } else{
        menuBtn.classList.remove('open');
        menuSide.classList.remove('open');
        menuOpen = false;
    }
});

const collapseContentHeight = document.querySelector('.collapsible__content').scrollHeight + 'px';
console.log(collapseContentHeight); //zczytanie wielkosci elemenut
if(window.innerWidth < '670'){ //jezeli szerokosc ekranu jest mniejsza niz 670px element zosjtaje ukryty
    document.querySelector('.collapsible__content').style.maxHeight = 0;
}

document.querySelectorAll('.search_collapse').forEach(button => {
    button.addEventListener('click', () =>{
        const collapseContent = document.querySelector('.collapsible__content');
        button.classList.toggle('.search_collapse--active');

        if (button.classList.contains('.search_collapse--active')){ //rozwiniecie elementu do jego pierwotnej dlugosci
            collapseContent.style.maxHeight = collapseContentHeight; 
        }
        else{
            collapseContent.style.maxHeight = 0;
        }
    })
});


