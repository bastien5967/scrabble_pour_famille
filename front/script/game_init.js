// game_init.js
async function initGame(lesdonnees) {
	try {
		var retour = await callAPI(lesdonnees, 'login', 'json');
		retour = JSON.parse(retour);
	} catch (error) {
		alert(error);
		bip();
		window.location.href = 'login.php?language=' + language + '&error=1';
	}
	if (retour['success'] != true) {
		window.location.href = 'login.php?language=' + language + '&error=2';
	} else {
		var retour = await callAPI(lesdonnees, 'checkActiveGamesForUser', 'json');
		retour = JSON.parse(retour);
		if (retour != false) {
			var game_id = retour[0]['id'];
			window.location.href = 'game.php?language=&' + language + 'game_id=' + game_id;
		} else {
			// initiate game
			lesdonnees.language = language;
			var retour = await callAPI(lesdonnees, 'createNewGame', 'json');
			retour = JSON.parse(retour);
			console.log(retour);
			if (retour != false) {
				game_id = retour['id'];
				document.getElementById('code_partie').innerHTML = game_id;
				document.getElementById('game_id').innerHTML = game_id;
			} else {
				window.location.href = 'login.php?language=' + language + '&error=3';
			}
		}
	}
}