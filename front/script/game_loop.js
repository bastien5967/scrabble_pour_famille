// game_loop.js
var alerted = false;
let pollingTimerId = null;
let isCheckingEnabled = true;

// Your async check function (replace with your actual API call)
async function checkOpponentMove() {
	stopPooling(); // stop pooling while checking;
	var lesdonnees = { 'partie_id': partie_id, 'username': username, 'boardState': board, 'chevalet': chevalet };// ID de la partie en cours

	// alert("hi");
	var newState = await callAPI(lesdonnees, 'getCurentGameState', 'json');
	if (newState != board && newState != null) {
		board = newState;
		console.log(newState);
		drawBoard();
	}
    
	var newChevalet = await callAPI(lesdonnees, 'getChevalet', 'json'); // get the current chevalet
	if (newChevalet != chevalet && newChevalet != null) { // if the chevalet has changed
		chevalet = newChevalet;
		drawChevalet();
	}
	
	var nb_letter_bag = await callAPI(lesdonnees, 'getNbLetterBag', 'json'); // get the number of letters in the bag
	if (nb_letter_bag == 0 && !alerted) { // if the number of letters has changed
		alert("No more letters in the bag");
		alerted = true;
	}
	return true;
}

// Recursive polling function
async function poll() {
	// bip();
    if (!isCheckingEnabled) return; // Safety check

    try {
        const result = await checkOpponentMove();
        
        // Handle the response (e.g., detect if opponent moved)
        if (result == true) {
            startPooling(); // Stop polling once event is handled
            // Trigger UI/game logic here
        }
    } catch (error) {
        console.warn('Polling check failed:', error.message);
        // Optionally: implement exponential backoff or retry logic for prod
    } finally {
        // Schedule next check after 1 second
        pollingTimerId = setTimeout(poll, 1000);
    }
}

function startPooling() {
	if (!isCheckingEnble) { // if the game is not being checked
		isCheckingEnble = true; // enable checking
		poll();
	}
}
function stopPooling() {
	// bip();
	isCheckingEnble = false; // enable checking
	if (pollingTimerId) { // if the game is not being checked
		clearTimeout(pollingTimerId); // disable checking);
	}
}