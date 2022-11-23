const board = document.querySelector(".containerGame");

function addCard(name, posX, posY){
    const card = document.createElement("div");
    card.style.position = "fixed";
    card.style.left = posX + "px";
    card.style.top = posY + "px";
    card.classList.add("card");
    board.appendChild(card);

    cardContainer = document.createElement("div");
    cardContainer.classList.add("containerSquare");
    card.appendChild(cardContainer);

    const innerSquare = document.createElement("div");
    const outerSquare = document.createElement("div");
    innerSquare.classList.add("innerSquare");
    outerSquare.classList.add("outerSquare");
    innerSquare.innerHTML = name;
    outerSquare.innerHTML = "Face";
    const r = Math.floor(Math.random() * 255);
    const g = Math.floor(Math.random() * 255);
    const b = Math.floor(Math.random() * 255);
    innerSquare.style.backgroundColor = "rgb(" + r + ", " + g + ", " + b + ")";
    cardContainer.appendChild(innerSquare);
    cardContainer.appendChild(outerSquare);

    let faceUp = true;
    cardContainer.addEventListener("click", function() {
        faceUp = !faceUp;
        if (faceUp) {
            cardContainer.style.transform = "rotateY(0deg)";
        } else {
            cardContainer.style.transform = "rotateY(180deg)";
        }
    });

}

addCard("A", 30, 30);
addCard("B", 120, 30);
addCard("C", 230, 90);
addCard("D", 330, 500);
addCard("FUCK", 450, 500);



const containers = document.querySelectorAll(".containerSquare");