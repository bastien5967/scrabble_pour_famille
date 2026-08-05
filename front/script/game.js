// game.js
var board = Array(15);
for (var i=1; i<= 15; i++) {
    board[i] = Array(15);
    for (var j=1; j<= 15; j++) { board[i][j] = ""; }
}

//*

async function initGame() {
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

async function isCanBePlaced() {
    
}
async function isWordValid(word) {
    // verify if a word is valid
    // remove every space in the word, if any
    word = word.replace(/\s/g, '');
    var lesdonnees = { 'word': word }; // Modified this line

    try {
        var retour = await callAPI(lesdonnees, 'check_dictionary', 'json');
        retour = JSON.parse(retour);
        // console.log(retour);
        // Redirect to the home page if the login is successful
        if (retour['valid'] == true) {
            return true;
        } else {
            return false;
        }
    } catch (error) {
        console.error('Error calling API:'+ error);
        $("#error_catch").html("<span class='red'>" + i18next.t('error_checking') + "</span>");
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