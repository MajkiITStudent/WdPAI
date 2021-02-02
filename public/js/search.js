//inicjacja stalych
const search = document.querySelector('input[placeholder="Search for an event..."]');
const eventContainer = document.querySelector(".mainblock");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        //zapobiegniecie mozliwosi wykonania kolejnych akcji
        event.preventDefault();

        //pobranie wartosci z searchbaru
        const data = {search: this.value};

        fetch("/search", {
            //przekazanie na backend hasla z searchbaru
            method: "POST",
            //naglowek protokolu http
            headers: {
                'Content-Type': 'application/json'
            },
            //przekazanie danych
            body: JSON.stringify(data)
        }).then(function (response) {
            //odebranie odpowiedzi w formacie json
            return response.json();
        }).then(function (events) {
            eventContainer.innerHTML = "";
            loadEvents(events)
        });
    }
});

function loadEvents(events) {
    events.forEach(events => {
        console.log(events);
        createEvent(events);
    });
}

function createEvent(events) {
    //odwolanie do templatki
    const template = document.querySelector("#event-template");

    //sklonowanie kontentu templatki
    const clone = template.content.cloneNode(true);
    //podmiana danych z tabeli bazy danych w odpowiednie miejsca
    const div = clone.querySelector("div");
    div.id = events.id;
    const title = clone.querySelector("h5");
    title.innerHTML = events.title;
    const image = clone.querySelector("img");
    image.src = `/public/uploads/${events.image}`;
    const description = clone.querySelector("p");
    description.innerHTML = events.description;
    const like = clone.querySelector(".fa-heart");
    like.innerText = events.like;
    const comment = clone.querySelector(".fa-comments");
    comment.innerText = events.comment;

    eventContainer.appendChild(clone);
}
