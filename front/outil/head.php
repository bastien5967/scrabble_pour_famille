<!-- head.php -->
<?php session_start(); //var_dump($_SESSION); ?>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jouer au Scrabble</title>
        <link rel="icon" href="../src/favicon.png">
        <meta name="description" content="Jouer au Scrabble pour Famille">
        <script src="https://cdn.jsdelivr.net/npm/i18next@21.6.14/dist/umd/i18next.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/i18next-http-middleware@1.2.0/dist/umd/i18nextHttpMiddleware.min.js"></script>
        <script defer src="./script/script.js"></script>
        <script defer src="./script/default.js"></script>
        <script defer src="./script/translation.js"></script>
        <link rel="stylesheet" href="./outil/stylesheet.css">
        <script>
            var loggedin = false;
            const username = "<?= $_SESSION['username'] ?? '' ?>";
            const role = "<?= $_SESSION['role'] ?? '' ?>";
            const password = "<?= $_SESSION['password'] ?? '' ?>";
            const email = "<?= $_SESSION['email'] ?? '' ?>";
            <?php if (isset($_GET['language'])) {
                $_SESSION['lang'] = $_GET['language']; ?>
                var language = "<?= htmlspecialchars($_GET['language']); ?>";
            <?php } else {
                $_SESSION['lang'] = "fr"; ?>
                var language = "fr"; // default language
            <?php } ?>
        </script>
    </head>