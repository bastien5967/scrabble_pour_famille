<!-- selectLanguage.php -->
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
                    <p class="lead text-white mt-3" id="language_selection"></p>
                </div>
            </div>
            
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-lg-6">
                    <div class="card bg-dark text-white shadow-lg">
                        <div class="card-body text-center p-5">
                            <h2 class="card-title text-primary-custom mb-4">Français</h2>
                            <a class="btn btn-primary-custom btn-lg" href="index.php?language=fr" style="font-size: 2.5em;">🇫🇷</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card bg-dark text-white shadow-lg">
                        <div class="card-body text-center p-5">
                            <h2 class="card-title text-primary-custom mb-4">English</h2>
                            <a class="btn btn-primary-custom btn-lg" href="index.php?language=en" style="font-size: 2.5em;">🇬🇧</a>
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