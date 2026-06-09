<!-- menu.php -->
        <nav class="navbar navbar-dark bg-dark" style="width: 100%;">
            <div class="container-fluid">
                <div class="text-left">
                    <a onclick="home_login()" class="text-menu btn-menu" id="btn_menu">Connexion</a>
                </div>
                <div class="text-center">
                    <a href="index.php?language=<?= $_SESSION['lang'] ?>" id="btn_accueil" title="Accueil" class="text-menu btn-menu" id="btn_accueil">Accueil</a>
                </div>
                <div class="text-right">
                    <!-- <a href="selectLanguage.php" class="text-menu btn-menu">Changer la langue</a> -->
                    <a href="selectLanguage.php?language=<?= $_SESSION['lang'] ?>" id="change_language" title="Change language" class="text-menu btn-menu" data-bs-toggle="tooltip" data-bs-placement="bottom" role="button" aria-pressed="false">Changer la langue</a>
                </div>
            </div>
        </nav>