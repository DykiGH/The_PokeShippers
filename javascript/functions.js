function zoomImage(img) {
    // créer un élément div pour afficher l'image en grand
    var divZoom = document.createElement("div");
    divZoom.style.position = "fixed";
    divZoom.style.top = "0";
    divZoom.style.left = "0";
    divZoom.style.width = "100%";
    divZoom.style.height = "100%";
    divZoom.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
    divZoom.style.zIndex = "9999";
    divZoom.onclick = function () {
        // retirer l'élément div lorsque l'utilisateur clique dessus
        divZoom.parentNode.removeChild(divZoom);
    };

    // créer un élément img pour afficher l'image agrandie
    var imgZoom = document.createElement("img");
    imgZoom.src = img.src;
    imgZoom.style.position = "absolute";
    imgZoom.style.top = "50%";
    imgZoom.style.left = "50%";
    imgZoom.style.transform = "translate(-50%, -50%)";
    imgZoom.style.maxWidth = "80%";
    imgZoom.style.maxHeight = "80%";
    imgZoom.style.width = "25vw"; //changement de width qd clic
    imgZoom.style.height = "70vh"; //changement de height qd clic
    imgZoom.style.borderRadius = "5px";

    // ajouter l'élément img à l'élément div
    divZoom.appendChild(imgZoom);

    // ajouter l'élément div à la page
    document.body.appendChild(divZoom);
}

function refreshValueInput(value) {
    document.getElementById("eurosToPokeCoins").innerHTML = value * 4;
}

function remplirFormulaire(idCarte, seriePaquet, InputCarteId, InputSerieId) {
    // Récupérer les champs de formulaire
    var idCarteInput = document.getElementById(InputCarteId);
    var seriePaquetInput = document.getElementById(InputSerieId);

    // Affecter les valeurs aux champs de formulaire
    idCarteInput.value = idCarte;
    seriePaquetInput.value = seriePaquet;
}

//change l'image dans achatBoosters lors de la selection
function changeImage() {
    var selectedValue = document.getElementById("boosterSelect").value;
    var image = document.getElementById("boosterImage");
    if (selectedValue === "rubissaphir") {
        image.src = "./image/ressources/rubysaphirBooster.png";
        image.alt = "Booster Rubis & Saphir";
    } else if (selectedValue === "tempete") {
        image.src = "./image/ressources/tempeteBooster.png";
        image.alt = "Booster Tempête";
    } //on ajoute des images de paquets ici ...
}

function randomCursor() {
    var cursors = [
        "url(../image/cursor/delphox.png), auto",
        "url(../image/cursor/espeon.png), auto",
        "url(../image/cursor/joltik.png), auto",
        "url(../image/cursor/mimikyu.png), auto",
        "url(../image/cursor/pikachu.png), auto",
        "url(../image/cursor/torchic.png), auto",
        "url('../image/cursor/mudkip.png'), auto",
    ];
    var cursor = cursors[Math.floor(Math.random() * cursors.length)];
    return cursor;
}

window.onload = function () {
    cursor = randomCursor();
    document.documentElement.style.setProperty("--custom-cursor", cursor);
};
