<!-- verificateur.html -->
<!DOCTYPE html>
<html lang="en">
    <?php include 'outil/head.php'; ?>
    <script defer src="./script/words.js"></script>
    <body>
        <?php include 'outil/menu.php'; ?>
        <!-- Main content -->
        <div class="container">
            <h1 class="text-center text-primary-custom">Bienvenue sur le Scrabble</h1>
            <H2 class=self-center>Vérifier la validité de vos mots</H2>
            <form id="verifForm" class="d-flex flex-column align-items-center p-5 self-center" action="verificateur.php" method="post" onsubmit="return false;">
                <input type=text name=word id=word placeholder="Entrez le mot à vérifier" onkeypress="if (event.charCode == 13) { verifWord(); }" class="form-control mb-3" style="width: 250px;">
                <a hreh="#" class="btn btn-primary-custom" onclick="verifWord()">Vérifier</a>
                <br/>
                <p id="result" style="background-color: #fff; margin: 15px"></p>
            </form>
            <p class="text-center">Jouer au Scrabble pour Famille</p>
            <button class="btn btn-primary-custom" onclick="startGame()">Commencer une partie</button>
        </div>
    </body>
</html>