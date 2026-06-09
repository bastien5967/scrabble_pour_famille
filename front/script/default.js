// default.js
//* DEBUG
var DebugValueForAlert = 0;
function bip() {
    alert("bip " + DebugValueForAlert);
    DebugValueForAlert++;
}
function bop() {
    console.log("bop" + DebugValueForAlert);
    DebugValueForAlert++;
}
window.onerror = function (msg, url, linenumber) {
    alert('Error message: ' + msg + '\nURL: ' + url + '\nLine Number: ' + linenumber + '\nalert number: ' + DebugValueForAlert);
    DebugValueForAlert++;
}
// */
function home_login() {
    // if not on login page: redirect to login page, else redirect to index.php
    var pathname = window.location.pathname;
    pathname = pathname.split('/');
    var final = '';
    if (loggedin && loggedin == true) {
        final = 'disconnect.php';
    } else {
        if (pathname[pathname.length - 1] != 'login.php') {
            final = './login.php';
        } else {
            final = './index.php';
        }
    }
    if (language != 'fr') {
        final += '?language=' + language;
    }
    window.location.href = final;
}

$(document).ready(function() { //à éxecuter une seul fois au chargement de la page
    var pathname = window.location.pathname;
    var isconnected = false// call to local API to check if user is connected
    // alert(isconnected);
    // alert(pathname[pathname.length - 1]);
    pathname = pathname.split('/');
    // alert(pathname[pathname.length - 1]);
    if (pathname[pathname.length - 1] == 'login.php') {
        $('#btn_menu').hide();
    } else if (isconnected) {
        $('#btn_menu').html("Déconnexion")
    } else {
        $('#btn_menu').html("Connexion")
    }

    if (pathname[pathname.length - 1] == 'index.php') {
        $('#btn_accueil').hide();
    }

    if (username != '' && role != '' && password != "") {
        $('#btn_menu').html("Deconnexion");
        loggedin = true;
    }

    if (language != "fr") {
        // bip();
        changeLanguage(language);
    }
});

function accueil() {
    window.location.href = './index.php';
}

