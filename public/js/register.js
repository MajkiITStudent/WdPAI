//wyciagniecie formularza z register.php
const form = document.querySelector("form");
//wyciaganei odpowiednich elementow z formularza
const emailInput = form.querySelector('input[name="email"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');

//sprawdzanie poprawnosci wpisu email
function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

//sprawdzenie czy podane haslo potwierdzajace jest identyczne jak pierwowzor
function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

//zaznaczenie pola w przypadku gdy nie jest spelnionny warunek
function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}


//event listenery w trakcie wprowadzania danych do formularza
function validateEmail() {
    setTimeout(function () {
            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

function validatePassword() {
    setTimeout(function () {
            const condition = arePasswordsSame(
                confirmedPasswordInput.previousElementSibling.value,
                confirmedPasswordInput.value
            );
            markValidation(confirmedPasswordInput, condition);
        },
        1000
    );
}

//dolaczenie event listenerow
emailInput.addEventListener('keyup', validateEmail);
confirmedPasswordInput.addEventListener('keyup', validatePassword);