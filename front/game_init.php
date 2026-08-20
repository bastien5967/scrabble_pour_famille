<!DOCTYPE html>
<html lang="fr">
<?php // game_init.php
// $_SESSION['lang'] = 'fr'; // already a session thingy
session_start();

// get language from url or session
if (isset($_GET['language'])) {
    $lang = $_GET['language'];
} else if (isset($_SESSION['lang'])) {
    $lang = _SESSION['lang'];
} else {
    $lang = 'fr';
}
$_SESSION['lang'] = $lang;

// vérifier que l'utilisateur est dans la session
if (!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['role']) || !isset($_SESSION['email'])) { // si pas de username, on redirige vers login
    header('Location: login.php');
}
include 'outil/head.php'
// header('Location: game.php?language='.$_SESSION['lang']);
?>
    <script src="./script/game_init.js"></script>
    <body>
        <?php include 'outil/menu.php'; ?>
        <div id=error_catch></div>
        <!-- Main content -->
        <div class="container-fluid p-4">
            <div class="row justify-content-center">
                <div class="col-12 text-center mb-5">
                    code *<span id="game_id" style="color: red;"></span>*
                </div>
            </div>

            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-lg-6">
                    <div class="card bg-dark text-white shadow-lg">
                        <div class="card-body text-center p-5">
                            <h2 class="card-title text-primary-custom mb-4" id="join_button_title"></h2>
                            <p class="card-text mb-4" id="join_button_desc"></p>
                            <form method=POST action="./game.php?language=<?= $_SESSION['lang'] ?>">
                                <input type=hidden name=username value="<?= $_SESSION['username'] ?>"/>
                                <input type=hidden name=action value="join"/>
                                <input type="hidden" name="partie_id" id="code_partie" value="">
                                <input type=submit class="btn btn-primary-custom btn-lg w-100" id=join_button value="|system_separator_istruction_level|">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <script>
        var lesdonnees = { username: username, password: password }; // Modified this line
        $(window).ready(async function() { //à éxecuter une seul fois au chargement de la page
            try {
                var retour = await callAPI(lesdonnees, 'login', 'json');
                retour = JSON.parse(retour);
            } catch (error) {
                window.location.href = 'login.php?language=' + language + '&error=1';
            }
            if (retour['success'] != true) {
                window.location.href = 'login.php?language=' + language + '&error=2';
            } else {
                var retour = await callAPI(lesdonnees, 'checkActiveGamesForUser', 'json');
                retour = JSON.parse(retour);
                if (retour['return'] != false) {
                    if (retour['multiple'] == true) {
                        alert('Vous avez déjà plusieures parties en cours, Vous allez être redirigé vers la plus ancienne');
                        var games_id = retour['games'];
                        // console.log(games_id);
                        // var last_game_id = games_id[0]['partie_id'];
                        var last_game_id = games_id[games_id.length - 1]['partie_id'];
                        window.location.href = 'game.php?language=' + language + '&game_id=' + last_game_id;
                    } else {
                        var game_id = retour['game'];
                        window.location.href = 'game.php?language=' + language + '&game_id=' + game_id;
                    }
                } else {
                    // bip();
                    // initiate game
                    lesdonnees.language = language;
                    var retour = await callAPI(lesdonnees, 'createNewGame', 'json');
                    game_id = JSON.parse(retour);
                    // console.log(game_id);
                    if (game_id != false) {
                        document.getElementById('code_partie').value = game_id;
                        document.getElementById('game_id').innerHTML = game_id;
                    } else {
                        window.location.href = 'login.php?language=' + language + '&error=3';
                    }
                }
            }
        });
    </script>
