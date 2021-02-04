
//pobieramy wszystkie serduszka z istniejacych projektow, beda to przyciski
const likeButtons = document.querySelectorAll(".fa-heart");


function addHeart()
{
    // pobranie tagu i z serduszkiem z mainpage
    const likes = this;
    // do tagu trzeba sie dostac, bo jest wewnatrz 3 divow
    const divs = likes.parentElement.parentElement.parentElement;
    //pobieramy atrybut id
    const id = divs.getAttribute("id");

    // do endpointu like przekazujemy id projektu
    fetch(`/like/${id}`)
        .then(function () {
            //inkrementacja wartosci serduszek
            likes.innerHTML = parseInt(likes.innerHTML) + 1;
        })
}

// iteracje po przyciskach, wywolanie funkcji add like po kliknieciu w serduszko
likeButtons.forEach(button => button.addEventListener("click", addHeart));