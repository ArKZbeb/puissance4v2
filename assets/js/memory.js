function randint(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

const startButton = document.querySelector("#start-button");
startButton.addEventListener("click", startGame);

/* -------------------------------------------------------------------------- */
/*                                    Board                                   */
/* -------------------------------------------------------------------------- */
const board = document.querySelector(".game-board");

function getTheme() {
    return document.querySelector("#theme").value;
}

function getDifficulty() {
    return document.querySelector("#difficulty").value;
}

let width, height;
function setBoardSize() {
    const difficulty = getDifficulty();

    if (difficulty == "easy") {
        width = 4;
        height = 4;
        startDelay = 2000;
    } else if (difficulty == "normal") {
        width = 6;
        height = 4;
        startDelay = 2500;
    } else {
        width = 8;
        height = 4;
        startDelay = 3000;
    }

    board.style.gridTemplateColumns = "repeat(" + width + ", 1fr)";
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
    const cardNames = Object.keys(cardList);

    for (let i = 0; i < sizeY; i++) {
        for (let j = 0; j < sizeX; j++) {
            let randomId = randint(0, cardNames.length - 1); // Select a random card from the list
            let cardName = cardNames[randomId]; // Get the name of the card
            let imgLink = getImageLink(theme, cardName); // Get the link of the image of the card
            cardList[cardName]--; // Decrease the number of cards of this type to place
            if (cardList[cardName] == 0) {
                // If there are no more cards of this type to place, remove it from the list
                delete cardList[cardName];
                cardNames.splice(randomId, 1);
            }
            createCard(cardName, imgLink); // Place the card
        }
    }
}
/* -------------------------------------------------------------------------- */
/*                                    Cards                                   */
/* -------------------------------------------------------------------------- */
let tries = 0;
let hasFlippedCard = false;
let firstCard, secondCard;
let isAutoFlipping = false;
let foundPairs = 0;
let startDelay;
const flipDelay = 1000;

function checkForMatch(firstCard, secondCard) {
    if (firstCard.dataset.pair == secondCard.dataset.pair) {
        // disableCards(firstCard, secondCard);
        firstCard.removeEventListener("click", flipCard);
        secondCard.removeEventListener("click", flipCard);
        foundPairs++;
        if (foundPairs >= (width * height) / 2) {
            endGame();
        }
    } else {
        // unflipCards(firstCard, secondCard);
        isAutoFlipping = true;
        setTimeout(() => {
            firstCard.classList.toggle("flip");
            secondCard.classList.toggle("flip");
            isAutoFlipping = false;
        }, flipDelay);
    }
}

function flipCard() {
    if (this != firstCard && !isAutoFlipping) {
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
            firstCard = null;
        }
    }
}

function updateTriesCounter() {
    document.querySelector(".tries-number").innerHTML = tries;
}

/* -------------------------------------------------------------------------- */
/*                                Cards Lists                                 */
/* -------------------------------------------------------------------------- */

function getCardList(theme, sizeX, sizeY) {
    let cardList = {};
    if (theme == "pokemon") {
        cardList = getPokemonList(sizeX, sizeY);
    } else if (theme == "league") {
        cardList = getLeagueList(sizeX, sizeY);
    } else {
        cardList = getMemesList(sizeX, sizeY);
    }
    return cardList;
}

function getImageLink(theme, cardName) {
    if (theme == "pokemon") {
        return getPokemonPicLink(cardName);
    } else if (theme == "league") {
        return getLeaguePicLink(cardName);
    } else {
        return getMemePicLink(cardName);
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
        champList[champId] = 2;
    }
    return champList;
}

function getLeaguePicLink(champId) {
    return leagueJson[champId]["icon"];
}

/* ---------------------------------- Memes --------------------------------- */
import memesJson from "../json/memes.json" assert { type: "json" };
function getMemesList(sizeX, sizeY) {
    const memesList = {};
    for (let i = 0; i < (sizeX * sizeY) / 2; i++) {
        let memeId = randint(0, memesJson.length);
        while (memesList[memeId] != undefined) {
            memeId = randint(0, memesJson.length);
        }
        memesList[memeId] = 2;
    }
    return memesList;
}

function getMemePicLink(memeId) {
    return memesJson[memeId]["image"];
}
/* -------------------------------------------------------------------------- */
/*                                    Timer                                   */
/* -------------------------------------------------------------------------- */
let [milliseconds, seconds, minutes] = [0, 0, 0];
let totalMilliseconds = 0;
let timer = document.querySelector(".timer");
let timerInterval = null;

function updateTimer() {
    milliseconds += 10;
    totalMilliseconds += 10;

    if (milliseconds >= 1000) {
        milliseconds = 0;
        seconds++;

        if (seconds >= 60) {
            seconds = 0;
            minutes++;
        }
    }
    let m = minutes < 10 ? "0" + minutes : minutes;
    let s = seconds < 10 ? "0" + seconds : seconds;
    let ms =
        milliseconds < 10
            ? "00" + milliseconds
            : milliseconds < 100
            ? "0" + milliseconds
            : milliseconds;

    timer.innerHTML = ` ${m} : ${s} : ${ms} `;
}
/* -------------------------------------------------------------------------- */
/*                               Game management                              */
/* -------------------------------------------------------------------------- */
function startGame() {
    startButton.classList.toggle("hide");

    document.querySelector(".menu").classList.toggle("hide");
    document.querySelector(".select-options").classList.toggle("hide");
    document.querySelector(".menu").style.flexDirection = "row";

    board.innerHTML = "";
    const theme = getTheme();
    setBoardSize();
    createBoard(theme, width, height);
    board.classList.toggle("hide");

    const cards = document.querySelectorAll(".game-card");
    cards.forEach((card) => card.addEventListener("click", flipCard));
    cards.forEach((card) => {
        isAutoFlipping = true;
        card.classList.toggle("flip");
        setTimeout(() => {
            card.classList.toggle("flip");
            isAutoFlipping = false;

            if (timerInterval != null) {
                clearInterval(timerInterval);
            }
            timerInterval = setInterval(updateTimer, 10);
        }, startDelay);
    });
}

function endGame() {
    clearInterval(timerInterval);
    document.querySelector(".menu").style.flexDirection = "column";
    document.querySelector(".game-board").classList.toggle("hide");
    document.querySelector(".game-over").classList.toggle("hide");

    $.ajax({
        url: "memory.php",
        type: "POST",
        data: {
            score: (totalMilliseconds / 1000).toPrecision(3),
            difficulty: getDifficulty(),
            tries: tries,
        },
    });
}
