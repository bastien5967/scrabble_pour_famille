// login.js
async function login() {
    // alert("bop");
    // call to the API via POST method with the username and password that the user will fill
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    if (username == "" || password == "") {
        $("#error_login").html("Veuillez remplir tous les champs");
        return;
    }
    var lesdonnees = { username: username, password: password }; // Modified this line
    
    try {
        var retour = await callAPI(lesdonnees, 'login', 'json');
        retour = JSON.parse(retour);
        // alert("bip");

        // Redirect to the home page if the login is successful
        if (retour['success'] == true) {
            var lesdonnees = { 'username': username, 'password': password, 'role': retour['user'][0].role, 'email': retour['user'][0].email };
            fetch("./logingin.php", { // POST to store token in PHP session
                method: "POST",
                body: JSON.stringify(lesdonnees),
                headers: {
                    "Content-type": "application/json; charset=UTF-8"
                }
            });
            alert("Connexion réussie !");
            window.location.href = 'index.php';
        } else {
            $("#error_login").html("Nom d'utilisateur ou mot de passe incorrect");
        }
    } catch (error) {
        console.error('Error calling API:'+ error);
    }
}

async function inscription() {
    // call to the API via POST method with the username, password, and email that the user will fill
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var email = document.getElementById('email').value;

    if (username == "" || password == "" || email == "") {
        $("#error_login").html("Veuillez remplir tous les champs");
        return ;
    }
    var lesdonnees = { username: username.trim(), password: password.trim(), email: email.trim() }; // Modified this line

    try {
        bip();
        var retour = await callAPI(lesdonnees, 'register', 'json');
        retour = JSON.parse(retour);
        // Redirect to the home page if the login is successful
        if (retour["success"] == true) {
            window.location.href = 'login.php?message=' + retour['message'];
        } else {
            $("#error_login").html("Error during registration : " + retour['message']);
        }
    } catch (error) {
        console.error('Error calling API:', error);
    }
}
