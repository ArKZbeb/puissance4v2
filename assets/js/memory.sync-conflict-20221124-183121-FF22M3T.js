let width = 6;
let height = 4;

let secondCard = false;

function randint(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function getPokemonList(sizeX, sizeY){
    idList = {};
    for (let i = 0; i < (sizeX * sizeY)/2; i++){
        pokemonId = randint(1, 905);
        while (idList[pokemonId] != undefined){
            pokemonId = randint(1, 905);
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

    return "https://assets.pokemon.com/assets/cms2/img/pokedex/full/"+ id + ".png";
}

function createCard(imgLink){
    let board = document.querySelector(".game-board");
    board.style.gridTemplateColumns = "repeat(" + width + ", 1fr)";

    let gameCard = document.createElement("article");
    gameCard.classList.add("game-card");

    board.appendChild(gameCard);
    let cardFront = document.createElement("div");
    let cardBack = document.createElement("div");
    cardFront.classList.add("card-front");
    cardBack.classList.add("card-back");

    cardFront.innerHTML = '<img src="'+ imgLink + '" alt="image" />';
    cardBack.innerHTML = '<img src="assets/images/cards/back.jpg" alt="image" />';

    gameCard.appendChild(cardFront);
    gameCard.appendChild(cardBack);
    let faceUp = true;
    gameCard.addEventListener("click", function() {
        faceUp = !faceUp;
        if (faceUp) {
            gameCard.style.transform = "rotateY(0deg)";
        } else {
            gameCard.style.transform = "rotateY(180deg)";
        }
    });
}

function createBoard(sizeX, sizeY, theme = "pokemon"){
    if (theme == "pokemon"){
        cardList = getPokemonList(sizeX, sizeY);
        
        listKeys = Object.keys(cardList);
        
    }

    for (let i = 0; i < sizeY; i++){
        for (let j = 0; j < sizeX; j++){
            if (theme == "pokemon"){
                test = randint(0, listKeys.length - 1);
                pokemonId = listKeys[test];
                imgLink = getPokemonPicLink(pokemonId);
                cardList[pokemonId]--;
                if (cardList[pokemonId] == 0){
                    delete cardList[pokemonId];
                    delete listKeys.splice(test, 1);
                }
            }

            createCard(imgLink);
        }
    }
}

createBoard(width, height, "pokemon");

