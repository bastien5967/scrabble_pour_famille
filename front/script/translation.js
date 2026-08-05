// script/translation.js
// Translation initialization
i18next.init({
    lng: 'fr', // default language
    fallbackLng: 'fr',
    resources: {
        fr: {
            translation: {
                "title": "Jouer au Scrabble",
                "subtitle": "Le jeu de mots classique en ligne",
                "play_button": "JOUER",
                "play_button_title": "Jouer maintenant",
                "play_button_desc": "Rejoignez des parties en direct et défiez vos amis !",
                "check_words": "Vérifier la validité de vos mots",
                "check_words_title": "Vérifier la validité de vos mots",
                "check_words_desc": "Utilisez notre dictionnaire pour vérifier si vos mots sont corrects et valides selon les règles françaises.",
                "check_button": "VÉRIFIER",
                "verify_word": "Vérification de mot",
                "enter_word": "Entrez le mot à vérifier",
                "verify": "VÉRIFIER",
                "start_game": "Commencer une partie",
                "valid_word": "Le mot <b>{{word}}</b> est <span class='green'>valide</span> au scrabble",
                "invalid_word": "Le mot <b>{{word}}</b> <span class='red'>n'est pas valide</span> au scrabble",
                "enter_word_prompt": "Veuillez donner un mot à vérifier",
                "error_checking": "Erreur lors de la vérification du mot",
                "home": "Accueil",
                "login": "Connexion",
                "change_language": "Changer la langue",
                "footer": "© 2023 Scrabble en Ligne. Tous droits réservés."
            }
        },
        en: {
            translation: {
                "title": "Play Scrabble",
                "subtitle": "The classic word game online",
                "play_button": "PLAY",
                "play_button_title": "Play now",
                "play_button_desc": "Join games, play with friends and have fun !",
                "check_words_title": "Check word validity",
                "check_words_desc": "Use our dictionary to verify if your words are correct and valid according to French rules.",
                "check_button": "CHECK",
                "verify_word": "Word verification",
                "enter_word": "Enter the word to verify",
                "verify": "VERIFY",
                "start_game": "Start a game",
                "valid_word": "The word <b>{{word}}</b> is <span class='green'>valid</span> in the Scrabble dictionary",
                "invalid_word": "The word <b>{{word}}</b> is <span class='red'>not valid</span> in the Scrabble dictionary",
                "enter_word_prompt": "Please enter a word to verify",
                "error_checking": "Error checking the word",
                "home": "Home",
                "login": "Login",
                "change_language": "Change language",
                "footer": "© 2023 Online Scrabble. All rights reserved."
            }
        }
    },
    interpolation: {
        escapeValue: false
    }
}, (err, t) => {
    // Initialize the translation
    if (err) return console.error('i18next initialization error:', err);
    
    // Apply translations to the page
    applyTranslations();
});

// Function to apply translations to elements
function applyTranslations() {
    // Translate main page elements
    if (document.querySelector('h1.display-4')) { document.querySelector('h1.display-4').textContent = i18next.t('title'); };
    if (document.querySelector('p.lead')) { document.querySelector('p.lead').textContent = i18next.t('subtitle'); };
    if (document.querySelector('button.btn-primary-custom')) { document.querySelector('button.btn-primary-custom').textContent = i18next.t('play_button'); };
    if (document.getElementById('verify_word')) { document.getElementById('verify_word').textContent = i18next.t('verify_word'); };
    if (document.getElementById('check_words_title')) { document.getElementById('check_words_title').textContent = i18next.t('check_words_title'); };
    if (document.getElementById('check_words_desc')) { document.getElementById('check_words_desc').textContent = i18next.t('check_words_desc'); };
    if (document.getElementById('play_button_desc')) { document.getElementById('play_button_desc').textContent = i18next.t('play_button_desc'); };
    if (document.getElementById('play_button_title')) { document.getElementById('play_button_title').textContent = i18next.t('play_button_title'); };
    if (document.querySelector('button.btn-primary-custom')) { document.querySelector('button.btn-primary-custom').textContent = i18next.t('check_button'); };
    if (document.querySelector('input#word')) { document.querySelector('input#word').setAttribute('placeholder', i18next.t('enter_word')); };
    if (document.querySelector('button.btn-primary-custom')) { document.querySelector('button.btn-primary-custom').textContent = i18next.t('verify'); };
    if (document.getElementById('start_game')) { document.getElementById('start_game').textContent = i18next.t('start_game'); };
    if (document.getElementById('verify')) { document.getElementById('verify').textContent = i18next.t('verify'); };
    
    // Translate menu items
    if (document.getElementById('btn_accueil')) { document.getElementById('btn_accueil').textContent = i18next.t('home'); };
    if (document.getElementById('btn_menu')) { document.getElementById('btn_menu').textContent = i18next.t('login'); };
    if (document.getElementById('change_language')) { document.getElementById('change_language').textContent = i18next.t('change_language'); };
    
    // Translate footer
    const footer = document.querySelector('footer p');
    if (footer) {
        footer.textContent = i18next.t('footer');
    }
}

// Function to change language
function changeLanguage(lng) {
    i18next.changeLanguage(lng, (err, t) => {
        if (err) return console.error('Language change error:', err);
        applyTranslations();
    });
}