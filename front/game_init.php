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
<script>

    var lesdonnees = { username: username, password: password }; // Modified this line
    try {
        var retour = await callAPI(lesdonnees, 'login', 'json');
        retour = JSON.parse(retour);
    } catch (error) {
        window.location.href = 'login.php?language=<?= $_SESSION['lang']; ?>';
    }
    if (retour['success'] != true) {
        window.location.href = 'login.php?language=<?= $_SESSION['lang']; ?>';
    } else {
        var retour = await callAPI(lesdonnees, 'checkActiveGamesForUser', 'json');
        retour = JSON.parse(retour);
        if (retour != false) {
            // alert("bip");
            var game_id = retour[0]['id'];
            var user_id = retour[0]['user_id'];
            var username = retour[0]['username'];
            var password = retour[0]['password'];
            var active_game = new ActiveGame(game_id, user_id, username, password);
        }
    }
    window.location.href = 'game.php?language=<?= $_SESSION['lang']; ?>';
</script>