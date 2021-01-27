
const menuBtn = document.querySelector('.menu_btn');
const menuSide = document.querySelector('.small_menu');
//const menuBurger = document.querySelector('.menu_btn-burger');
let menuOpen = false;
menuBtn.addEventListener('click', ()=> {
    if(!menuOpen){
        menuBtn.classList.add('open');
        menuSide.classList.add('open');
        //menuBurger.classList.add('open');
        menuOpen = true;
    } else{
        menuBtn.classList.remove('open');
        menuSide.classList.remove('open');
        //menuBurger.classList.remove('open');
        menuOpen = false;
    }
});

const collapseContentHeight = document.querySelector('.collapsible__content').scrollHeight + 'px';
console.log(collapseContentHeight);
if(window.innerWidth < '670'){
    document.querySelector('.collapsible__content').style.maxHeight = 0;
}

document.querySelectorAll('.search_collapse').forEach(button => {
    button.addEventListener('click', () =>{
        const collapseContent = document.querySelector('.collapsible__content');
        button.classList.toggle('.search_collapse--active');

        if (button.classList.contains('.search_collapse--active')){
            collapseContent.style.maxHeight = collapseContentHeight; 
        }
        else{
            collapseContent.style.maxHeight = 0;
        }
    })
});


