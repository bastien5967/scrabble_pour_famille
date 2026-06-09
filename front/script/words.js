// script/words.js
// words.js

async function verifWord() {
    var word = document.getElementById('word').value;
    if (word == "") {
        $("#result").html("<span class='red'>" + i18next.t('enter_word_prompt') + "</span>");
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
            $('#result').html(i18next.t('valid_word', {word: word}));
        } else {
            $('#result').html(i18next.t('invalid_word', {word: word}));
        }
    } catch (error) {
        console.error('Error calling API:'+ error);
        $("#result").html("<span class='red'>" + i18next.t('error_checking') + "</span>");
    }
}
