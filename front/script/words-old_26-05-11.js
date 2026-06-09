// words.js

async function verifWord() {
    var word = document.getElementById('word').value;
    if (word == "") {
        $("#result").html("<span class=red>Veuillez donner un mot à vérifier</span>");
        return;
    }
    // remove every space in the word, if any
    word = word.replace(/\s/g, '');

    var lesdonnees = { 'word': word }; // Modified this line
    
    try {
        var retour = await callAPI(lesdonnees, 'check_dictionary', 'json');
        retour = JSON.parse(retour);
        // console.log(retour);
        // Redirect to the home page if the login is successful
        if (retour['valid'] == true) {
            $('#result').html("Le mot <b>" + word + "</b> est <span class=green>valide</span> au scrabble");
        } else {
            $('#result').html("Le mot <b>" + word + "</b> <span class=red>n'est pas valide</span> au scrabble");
        }
    } catch (error) {
        console.error('Error calling API:'+ error);
    }
}
