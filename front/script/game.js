// game.js
var board = Array(15);
for (var i=1; i<= 15; i++) {
    board[i] = Array(15);
    for (var j=1; j<= 15; j++) { board[i][j] = ""; }
}
var selectedLetter = false; // store the curently selected letter if possible
var selectedLetterPos = -1;
var chevalet = Array(8); // store the current cheval
function count(table){
    var retour = 0;
    table.forEach(function(n){
        if (n != null && n != "") {
            retour++;
        }
    });
    return retour;
}

function drawBoard() {
    for (var i=1; i<= 15; i++) {
        for (var j=1; j<= 15; j++) {
            document.getElementById("cell_" + i + "_" + j).innerHTML = board[i][j];
        }
    }
}

function drawChevalet() {
    for (var i=1; i<= 7; i++) {
        document.getElementById("chevalet_" + i).innerHTML = chevalet[i];
    }
}

async function initGame() {
    var lesdonnees = { 'partie_id': partie_id, 'language': language, 'username': username  };
    var initGame = await callAPI(lesdonnees, 'initGameState', 'json');
    retour = JSON.parse(initGame);
    if (retour == true || retour == "true") {
        document.getElementById('game_over').style.display = 'none';
        drawStartingHand();
        drawBoard();
        drawChevalet();
    } else {
        console.log("nope")
    }
}

async function pioche(n) {
    var hand = count(chevalet);
    if (hand + n > 7) {
        console.log("Merci de ne pas jouer avec les commandes");
    } else {
        // get n new letter from the server
        var lesdonnees = { 'partie_id': partie_id, 'username': username , 'n': n };
        var resultPioche = await callAPI(lesdonnees, 'getNewLetter', 'json');
       resultPioche = JSON.parse(resultPioche);
       if (resultPioche['success'] == true && count(resultPioche) == (hand + n) ){
           // add new letter to chevalet
           chevalet = resultPioche['letter'];
       }
    }
}

async function drawStartingHand() {
    var lesdonnees = { 'partie_id': partie_id, 'username': username };
    var chevalet = await callAPI(lesdonnees, 'getChevalet', 'json');
    if (count(chevalet) == 0 && count(board[8]) == 0) {
        pioche(7)
    }
}

function clickCell(cell, i, j) {
    console.log(cell);
    // check if cell is empty, and if it's not the sta
}

function clickChevalet(cell, i) {
    console.log(cell);
    console.log(chevalet[i]);
    if (selectedLetterPos == -1 && slectedLetter == false) {
        // select the letter
        selectedLetterPos = i;
        selectedLetter = true;
    }
}

async function verifBoardState() {
    // verify the board state is valid
    for ($i = 1; $i <= 15; $i++) {
        if (board[i][j] != "") {
            // check the word in the board
            if (i > 0 && board[i - 1][j] != "") {
                // already been checked previously, skip it
            } else {
                // check the word in the board
                var word_to_check = "";
                var i_start = i;
                while (board[i_start][j] != "" && i_start <= board[i].length) {
                    word_to_check += board[i_start][j];
                    i_start++;
                }
                if (word_to_check.length > 1) {
                    var lesdonnees = { 'word': word_to_check }; // Modified this line
                    try {
                        var retour = await callAPI(lesdonnees, 'check_dictionary', 'json');
                        retour = JSON.parse(retour);
                        // console.log(retour);
                    }
                    catch (error) {
                        console.error('Error calling API:'+ error);
                        $("#result").html("<span class='red'>" + i18next.t('error_checking') + "</span>");
                    }
                }
            }
            if (j > 0 && board[i][j-1] != "") {
                // already been checked previously, skip it
            } else {
                // check the word in the board
                var word_to_check = "";
                var j_start = j;
                while (board[i][j_start] != "" && j_start <= board[j].length) {
                    word_to_check += board[j_start][j];
                    j_start++;
                }
                if (word_to_check.length > 1) {
                    var lesdonnees = { 'word': word_to_check }; // Modified this line
                    try {
                        var retour = await callAPI(lesdonnees, 'check_dictionary', 'json');
                        retour = JSON.parse(retour);
                        // console.log(retour);
                    }
                    catch (error) {
                        console.error('Error calling API:'+ error);
                        $("#result").html("<span class='red'>" + i18next.t('error_checking') + "</span>");
                    }
                }
            }
        }
    }
}


//.