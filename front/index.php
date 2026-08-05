<!-- index.php -->
<!DOCTYPE html>
<html lang="fr">
    <?php include 'outil/head.php'; ?>
    <body>
        <?php include 'outil/menu.php'; ?>
        <!-- Main content -->
        <div class="container-fluid p-4">
            <div class="row justify-content-center">
                <div class="col-12 text-center mb-5">
                    <h1 class="display-4 text-primary-custom font-weight-bold"></h1>
                    <p class="lead text-white mt-3"></p>
                </div>
            </div>
            
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-lg-6">
                    <div class="card bg-dark text-white shadow-lg">
                        <div class="card-body text-center p-5">
                            <h2 class="card-title text-primary-custom mb-4" id="play_button_title"></h2>
                            <p class="card-text mb-4" id="play_button_desc"></p>
                            <a class="btn btn-primary-custom btn-lg w-100" id=start_game href="./game_init.php?language=<?= $_SESSION['lang'] ?>">|system_separator_istruction_level|"></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card bg-dark text-white shadow-lg">
                        <div class="card-body text-center p-5">
                            <h2 class="card-title text-primary-custom mb-4" id="check_words_title"></h2>
                            <p class="card-text mb-4" id="check_words_desc"></p>
                            <a class="btn btn-primary-custom btn-lg w-100" id="verify" href="./verificateur.php?language=<?= $_SESSION['lang'] ?>"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <footer class="bg-dark text-white text-center p-4 mt-5">
            <p></p>
        </footer>
    </body>
</html>