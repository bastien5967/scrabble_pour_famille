<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
    <?php include 'outil/head.php'; ?>
    <body>
        <?php include 'outil/menu.php'; ?>
        <!-- Main content -->
        <div class="container-fluid p-4">
            <div class="row justify-content-center">
                <div class="col-12 text-center mb-5">
                    <h1 class="display-4 text-primary-custom font-weight-bold">Jouer au Scrabble</h1>
                    <p class="lead text-white mt-3">Le jeu de mots classique en ligne</p>
                </div>
            </div>
            
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-lg-6">
                    <div class="card bg-dark text-white shadow-lg">
                        <div class="card-body text-center p-5">
                            <h2 class="card-title text-primary-custom mb-4">Jouer maintenant</h2>
                            <p class="card-text mb-4">Rejoignez des parties en direct et défiez vos amis !</p>
                            <button class="btn btn-primary-custom btn-lg w-100">JOUER MAINTENANT</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card bg-dark text-white shadow-lg">
                        <div class="card-body text-center p-5">
                            <h2 class="card-title text-primary-custom mb-4">Vérifier la validité des mots</h2>
                            <p class="card-text mb-4">Utilisez notre dictionnaire pour vérifier si vos mots sont corrects et valides selon les règles françaises.</p>
                            <a class="btn btn-primary-custom btn-lg w-100" href="./verificateur.php">VÉRIFIER LES MOTS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <footer class="bg-dark text-white text-center p-4 mt-5">
            <p>&copy; 2023 Scrabble en Ligne. Tous droits réservés.</p>
        </footer>
    </body>
</html>