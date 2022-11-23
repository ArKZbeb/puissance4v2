let difficluty = 8;

function createCard(x, y){

}

function createBoard(size){
    let board = document.querySelector(".game-board");
    for (let i = 0; i < size; i++){
        for (let j = 0; j < size; j++){
            let cardGame = document.createElement("div");
            cardGame.classList.add("game-card");
            board.appendChild(cardGame);
            let cardFront = document.createElement("div");
            let cardBack = document.createElement("div");
            cardFront.classList.add("card-front");
            cardBack.classList.add("card-back");
            cardFront.innerHTML = '<img src="assets/images/cards/obama.jpg" alt="image" />';
            cardBack.innerHTML = '<img src="assets/images/cards/back.jpg" alt="image" />';

            cardGame.appendChild(cardFront);
            cardGame.appendChild(cardBack);
            let faceUp = true;
            cardGame.addEventListener("click", function() {
                faceUp = !faceUp;
                if (faceUp) {
                    cardGame.style.transform = "rotateY(0deg)";
                } else {
                    cardGame.style.transform = "rotateY(180deg)";
                }
            });
        }
    }
}

for (let i = 0; i < difficluty; i++) {

}

createBoard(difficluty);
