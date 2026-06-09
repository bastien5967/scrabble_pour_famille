// game.js
var board = [];
for (var i=1; i<= 15; i++) {
    board.push([]);
    for (var j=1; j<= 15; j++) { board[i][j] = ""; }
}
//*
function initGame() {
    // Initialize the game board
    // generate a UUID
    var uuid = generateUUID();
    var lesdonnees = { 'uuid': uuid, 'board': board  }; // Modified this line
    try {
        var retour = await callAPI(lesdonnees, 'saveGameState', 'json');
        retour = JSON.parse(retour);
        // console.log(retour);
        // Redirect to the home page if the login is successful
        if (retour['valid'] == true) {
            $('#result').html(i18next.t('valid_word', {word: word}));
        } else {
            $('#result').html(i18next.t('invalid_word', {word: word}));
        }
    } catch (error) {
        console.error('Error calling API:'+ error);
        $("#result").html("<span class='red'>" + i18next.t('error_checking') + "</span>");
    }
}
// */

function verifBoardState() {
    // verify the board state is valid
    for ($i = 1; $i <= 15; $i++) {
        if (board[i][j] != "") {
            // check the word in the board
            if (board[i - 1][j] != "") {
                // already been checked previously, skip it
            } else {
                // check the word in the board
                var word_to_check = "";
                var i_start = i;
                while (board[i_start][j] != "") {
                    word_to_check += board[i_start][j];
                    i_start++;
                }
                verifWord(word_to_check);
            }
            if (board[i][j-1] != "") {
                // already been checked previously, skip it
            } else {
                // check the word in the board
                var word_to_check = "";
                var j_start = j;
                while (board[i][j_start] != "") {
                    word_to_check += board[i_start][j];
                    i_start++;
                }
                verifWord(word_to_check);
            }
        }
    }
}


//.