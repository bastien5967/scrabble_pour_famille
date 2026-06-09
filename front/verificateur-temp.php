<!-- verificateur.php -->
<!DOCTYPE html>
<html lang="en">
    <?php include 'outil/head.php'; ?>
    <script defer src="./script/words.js"></script>
    <body>
        <?php include 'outil/menu.php'; ?>
        <!-- Main content -->
        <div class="container-fluid p-4">
            <div class="row justify-content-center">
                <div class="col-12 text-center mb-5">
                    <h1 class="display-4 text-primary-custom font-weight-bold">Vérifier la validité des mots</h1>
                    <p class="lead text-white mt-3">Utilisez notre dictionnaire pour vérifier si vos mots sont corrects et valides selon les règles françaises.</p>
                </div>
            </div>
            
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-lg-6">
                    <div class="card bg-dark text-white shadow-lg">
                        <div class="card-body text-center p-5">
                            <h2 class="card-title text-primary-custom mb-4">Vérification de mot</h2>
                            <form id="verifForm" class="d-flex flex-column align-items-center p-3" onsubmit="return false;">
                                <input type="text" name="word" id="word" placeholder="Entrez le mot à vérifier" 
                                       onkeypress="if (event.charCode == 13) { verifWord(); }" 
                                       class="form-control mb-4" style="width: 100%; max-width: 300px;">
                                <button type="button" class="btn btn-primary-custom btn-lg w-100 mb-4" onclick="verifWord()">VÉRIFIER</button>
                                <p id="result" class="w-100" style="min-height: 60px;"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 text-center">
                    <button class="btn btn-primary-custom btn-lg w-100" onclick="startGame()">Commencer une partie</button>
                </div>
            </div>
        </div>
        
        <footer class="bg-dark text-white text-center p-4 mt-5">
            <p>&copy; 2023 Scrabble en Ligne. Tous droits réservés.</p>
        </footer>
    </body>
</html>