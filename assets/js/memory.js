function randint(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

const startButton = document.querySelector("#start-button");
startButton.addEventListener("click", startGame);
const restartButton = document.querySelector("#restart-button");
restartButton.addEventListener("click", startGame);

/* -------------------------------------------------------------------------- */
/*                                    Board                                   */
/* -------------------------------------------------------------------------- */
let width = 4;
let height = 4;

const board = document.querySelector(".game-board");
board.style.gridTemplateColumns = "repeat(" + width + ", 1fr)";

/* -------------------------------------------------------------------------- */
/*                                    Cards                                   */
/* -------------------------------------------------------------------------- */
let tries = 0;
let hasFlippedCard = false;
let firstCard, secondCard;
let flipping = false;
let foundPairs = 0;

function checkForMatch(firstCard, secondCard) {
    if (firstCard.dataset.pair == secondCard.dataset.pair) {
        // disableCards(firstCard, secondCard);
        firstCard.removeEventListener("click", flipCard);
        secondCard.removeEventListener("click", flipCard);
        foundPairs++;
        if (foundPairs == (width * height) / 2) {
            endGame();
        }
    } else {
        // unflipCards(firstCard, secondCard);
        flipping = true;
        setTimeout(() => {
            firstCard.classList.toggle("flip");
            secondCard.classList.toggle("flip");
            flipping = false;
        }, 500);
    }
}

function flipCard() {
    if (this != firstCard && !flipping) {
        this.classList.toggle("flip");

        if (!hasFlippedCard) {
            // first click
            hasFlippedCard = true;
            firstCard = this;
        } else {
            // second click
            hasFlippedCard = false;
            secondCard = this;

            tries++;
            updateTriesCounter();

            checkForMatch(firstCard, secondCard);
        }
    }
}

function updateTriesCounter() {
    document.querySelector(".tries-number").innerHTML = tries;
}

function getCardList(theme, sizeX, sizeY) {
    let cardList = {};
    if (theme == "pokemon") {
        cardList = getPokemonList(sizeX, sizeY);
    } else {
        cardList = getLeagueList(sizeX, sizeY);
    }
    return cardList;
}

function getImageLink(theme, cardName) {
    if (theme == "pokemon") {
        return getPokemonPicLink(cardName);
    } else {
        return getLeaguePicLink(cardName);
    }
}

/* --------------------------------- Pokémon -------------------------------- */
function getPokemonList(sizeX, sizeY) {
    const idList = {};
    for (let i = 0; i < (sizeX * sizeY) / 2; i++) {
        let pokemonId = randint(1, 900);
        while (idList[pokemonId] != undefined) {
            pokemonId = randint(1, 900);
        }
        idList[pokemonId] = 2;
    }
    return idList;
}

function getPokemonPicLink(id) {
    if (id < 100) {
        const str = "" + id;
        const zeros = "000";
        id = zeros.substring(0, zeros.length - str.length) + str;
    }

    return (
        "https://assets.pokemon.com/assets/cms2/img/pokedex/full/" + id + ".png"
    );
}

/* --------------------------------- League --------------------------------- */
import leagueJson from "../json/league.json" assert { type: "json" };
function getLeagueList(sizeX, sizeY) {
    const champList = {};
    for (let i = 0; i < (sizeX * sizeY) / 2; i++) {
        let champId = randint(0, leagueJson.length);
        while (champList[champId] != undefined) {
            champId = randint(0, leagueJson.length);
        }
        // let champName = leagueJson[champId]["name"];
        champList[champId] = 2;
    }
    return champList;
}

function getLeaguePicLink(champId) {
    return leagueJson[champId]["icon"];
}

function createCard(pairName, imgLink) {
    let gameCard = document.createElement("article");
    gameCard.classList.add("game-card");
    gameCard.dataset.pair = pairName;

    board.appendChild(gameCard);
    let cardFront = document.createElement("div");
    let cardBack = document.createElement("div");
    cardFront.classList.add("card-front");
    cardBack.classList.add("card-back");

    cardFront.innerHTML =
        '<img src="' + imgLink + '" alt="image" draggable="false" />';
    cardBack.innerHTML =
        '<img src="assets/images/cards/back.jpg" alt="image" draggable="false" />';

    gameCard.appendChild(cardFront);
    gameCard.appendChild(cardBack);
}

function createBoard(theme, sizeX, sizeY) {
    const cardList = getCardList(theme, sizeX, sizeY);
    const listKeys = Object.keys(cardList);

    for (let i = 0; i < sizeY; i++) {
        for (let j = 0; j < sizeX; j++) {
            let randomId = randint(0, listKeys.length - 1); // Select a random card from the list
            let cardId = listKeys[randomId]; // Get the name of the card
            let cardName = cardId;
            let imgLink = getImageLink(theme, cardName); // Get the link of the image of the card
            cardList[cardName]--; // Decrease the number of cards of this type to place
            if (cardList[cardName] == 0) {
                // If there are no more cards of this type to place, remove it from the list
                delete cardList[cardName];
                listKeys.splice(randomId, 1);
            }
            createCard(cardName, imgLink); // Place the card
        }
    }
}

function endGame() {
    clearInterval(int);
    document.querySelector(".menu").style.flexDirection = "column";
    document.querySelector(".game-board").classList.toggle("hide");
    document.querySelector(".game-over").classList.toggle("hide");
}

/* -------------------------------------------------------------------------- */
/*                             Password Strenght Check                        */
/* -------------------------------------------------------------------------- */

let state = false;
let password = document.getElementById("pwd");
let passwordStrength = document.getElementById("password-strength");

password.addEventListener("keyup", function(){
    let pass = document.getElementById("pwd").value;
    checkStrength(pass);
});

function checkStrength(password) {
    let strength = 0;

    //If password contains both lower and uppercase characters
    if (password.match(/([a-z].[A-Z])|([A-Z].[a-z])/)) {
        strength += 1;
    }
    //If it has numbers and characters
    if (password.match(/([0-9])/)) {
        strength += 1;
        }
    //If it has one special character
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
        strength += 1;
       }
    //If password is greater than 7
    if (password.length > 8) {
        strength += 1;
        }

    if (password.length > 12) {
        strength += 1;
        }
    // If value is less than 2
    if (strength < 2) {
        passwordStrength.classList.remove('progress-bar-warning');
        passwordStrength.classList.remove('progress-bar-success');
        passwordStrength.classList.add('progress-bar-danger');
        passwordStrength.style = 'width: 10%';
    } else if (strength == 3) {
        passwordStrength.classList.remove('progress-bar-success');
        passwordStrength.classList.remove('progress-bar-danger');
        passwordStrength.classList.add('progress-bar-warning');
        passwordStrength.style = 'width: 60%';
    } else if (strength == 5) {
        passwordStrength.classList.remove('progress-bar-warning');
        passwordStrength.classList.remove('progress-bar-danger');
        passwordStrength.classList.add('progress-bar-success');
        passwordStrength.style = 'width: 100%';
    }
}



/* -------------------------------------------------------------------------- */
/*                                    Timer                                   */
/* -------------------------------------------------------------------------- */
let [milliseconds, seconds, minutes, hours] = [0, 0, 0, 0];
let timer = document.querySelector(".timer");
let int = null;

function updateTimer() {
    milliseconds += 10;

    if (milliseconds >= 1000) {
        milliseconds = 0;
        seconds++;

        if (seconds >= 60) {
            seconds = 0;
            minutes++;

            if (minutes >= 60) {
                minutes = 0;
                hours++;
            }
        }
    }
    let h = hours < 10 ? "0" + hours : hours;
    let m = minutes < 10 ? "0" + minutes : minutes;
    let s = seconds < 10 ? "0" + seconds : seconds;
    let ms =
        milliseconds < 10
            ? "00" + milliseconds
            : milliseconds < 100
            ? "0" + milliseconds
            : milliseconds;

    timer.innerHTML = ` ${h} : ${m} : ${s} : ${ms} `;
}

function startGame() {
    startButton.classList.toggle("hide");

    document.querySelector(".menu").classList.toggle("hide");
    document.querySelector(".menu").style.flexDirection = "row";
    createBoard("pokemon", width, height);

    const cards = document.querySelectorAll(".game-card");
    cards.forEach((card) => card.addEventListener("click", flipCard));

    if (int != null) {
        clearInterval(int);
    }
    int = setInterval(updateTimer, 10);
}
