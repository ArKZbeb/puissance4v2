function randint(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

const startButton = document.querySelector("#start-button");

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
tries = 0;
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
        }, 1500);
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
    let cardList = getPokemonList(sizeX, sizeY);
    return cardList;
}

function getPokemonList(sizeX, sizeY) {
    idList = {};
    for (let i = 0; i < (sizeX * sizeY) / 2; i++) {
        pokemonId = randint(1, 900);
        while (idList[pokemonId] != undefined) {
            pokemonId = randint(1, 900);
        }
        idList[pokemonId] = 2;
    }
    return idList;
}

function getPokemonPicLink(id) {
    if (id < 100) {
        let str = "" + id;
        zeros = "000";
        id = zeros.substring(0, zeros.length - str.length) + str;
    }

    return (
        "https://assets.pokemon.com/assets/cms2/img/pokedex/full/" + id + ".png"
    );
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
            randomId = randint(0, listKeys.length - 1); // Select a random card from the list
            cardId = listKeys[randomId]; // Get the name of the card
            cardName = cardId;
            imgLink = getPokemonPicLink(cardId); // Get the link of the image of the card
            cardList[cardId]--; // Decrease the number of cards of this type to place
            if (cardList[cardId] == 0) {
                // If there are no more cards of this type to place, remove it from the list
                delete cardList[cardId];
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
