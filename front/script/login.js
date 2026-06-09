// login.js
async function login() {
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
        // console.log(retour['user']);
        // console.log('\n\n');
        // console.log(retour['user'][0].email);
        // // user = JSON.parse(retour['user']);
        // console.log(user);
        // console.log(user['role']);
        // console.log(user['email']);

        // Redirect to the home page if the login is successful
        if (retour['success'] == true) {
            var lesdonnees = { 'username': username, 'password': password, 'role': retour['user'][0].role, 'email': retour['user'][0].email };
            await callAPI(lesdonnees, 'setSession', 'json');
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
    var lesdonnees = { username: username, password: password, email: email }; // Modified this line

    try {
        var retour = await callAPI(lesdonnees, 'register', 'json');
        // Redirect to the home page if the login is successful
        if (retour == "success") {
            window.location.href = 'login.php?message=success';
        } else {
            $("#error_login").html("Error during registration");
        }
    } catch (error) {
        console.error('Error calling API:', error);
    }
}
