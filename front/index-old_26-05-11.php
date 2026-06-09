<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
    <?php include 'outil/head.php'; ?>
    <body>
        <?php include 'outil/menu.php'; ?>
        <!-- Main content -->
        <div class="d-flex flex-column align-items-center p-5">
            <h1 class="text-primary-custom text-center">Jouer au Scrabble</h1>
            <button class="btn btn-primary-custom">JOUER</button>
        </div>
        <div class="d-flex flex-column align-items-center p-5">
            <h2 class="text-primary-custom text-center">Vérifier la validité de vos mots</h2>
            <p class="text-primary-custom text-center">Utilisez notre dictionnaire pour vérifier si vos mots sont corrects et valide au Scrabble selon la règle française.</p>
            <a class="btn btn-primary-custom" href="./verificateur.php">VÉRIFIER</a>
        </div>
    </body>
</html>