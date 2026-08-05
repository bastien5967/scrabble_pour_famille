<?php
    // login.php
?>
<!DOCTYPE html>
<html lang="fr">
    <?php include 'outil/head.php'; ?>
        <?php
        if (isset($_GET['inscription'])) {
            $inscription = true;
        } else {
            $inscription = false;
        }
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
        }
    ?>
    <script src="./script/login.js"></script>
    <body>
        <?php include 'outil/menu.php'; ?>
        <!-- Main content -->
        <div class="d-flex flex-column align-items-center p-5">
            <h1 class="text-primary-custom text-center"><?php if ($inscription) { echo("Inscription"); } else { echo("Connexion"); } ?></h1>
            <form class="card" style="width: 37rem;" align=center method="post">
                <!-- <img src="à_trier/cursed/images_utiles/404.png" class="card-img-top" alt="..."> -->
                 <h3 class="card-img-top alert" id=error_login><?php if (isset($message) && $message == 'true') { echo "Inscription efféctué; vous pouvez ,aintenant vous connecter"; } ?></h3>
                <div class="card-body">
                    <h5 class="card-title" align=center><?php if ($inscription) { echo("Inscription"); } else { echo("Connexion"); } ?></h5>
                    <p class="card-text" align=center>Nom d'utilisateur: <input type=text name=username id=username placeholder="Nom d'utilisateur"></p>
                    <p class="card-text" align=center>Mot de passe: <input type=text name=password id=password placeholder="Mot de passe"></p>
                    <?php if ($inscription) { ?>
                        <p class="card-text" align=center>Adresse mail: <input type=text name=email id=email placeholder="Adresse email"></p>
                    <?php } ?>
                    <div class="d-flex flex-row justify-content-around" align=center>
                    <a href="#" onclick="<?php if ($inscription) { ?>inscription();<?php } else { ?>login();<?php } ?>" class="btn btn-primary text-align-center">Valider</a>
                    <?php if (!$inscription) { ?>
                        <a href="#" class="btn btn-primary text-align-center">Mot de passe oublié ?</a>
                    <?php } ?>
                    </div>
                    <?php if ($inscription) { ?>
                    <div class="d-flex flex-column align-item-center"><div class="self-center">Déjà inscrit ?</div><a href="?" class="btn btn-primary text-align-center self-center">Connectez-vous</a></div>
                    <?php } else { ?>
                        <div class="d-flex flex-column align-item-center"><div class="self-center">Pas encore membre ?</div><a href="?inscription" class="btn btn-primary self-center">Inscrivez-vous ici</a></div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </body>
</html>
