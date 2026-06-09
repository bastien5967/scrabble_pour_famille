<?php // index.php
    require_once "./config/util.php";
    require_once("./config/GestionSQLite.php");
    echo("hi");
    require_once("./config/GestionSQL.php");
    echo "Hello World";
    try {
        // require_once("./user.php");
        require_once("./dictionary.php");
        echo("\n\n\n<br/>Test de vérification des mots: <br/><br/>\n\n\n");
        $temp = check_dictionary("test"); // should return true
        echo("*test* should be true: ");
        var_dump($temp);
        br();
        br();
        $temp = check_dictionary("test123"); // should return false
        echo("*test123* should be false: ");
        var_dump($temp);
        br();
        br();
        $temp = check_dictionary("hello"); // should return true
        echo("*hello* hould be true /??? It's valid in French scrabble ???: ");
        var_dump($temp);
        br();
        br();
        $temp = check_dictionary("bonjour"); // should return true
        echo("*bonjour* should be true: ");
        var_dump($temp);
        br();
        br();
        $temp = check_dictionary("AA");
        echo("*AA* should be true: ");
        var_dump($temp);
        br();
        br();
        $temp = check_dictionary("Gyoza");
        echo("*Gyoza* should be true: ");
        var_dump($temp);
        br();
        br();
        $temp = check_dictionary("Zucchini");
        echo("*Zucchini* should be true: ");
        var_dump($temp);
        br();
        br();
        $temp = check_dictionary("xylophone");
        echo("*xylophone* should be true: ");
        var_dump($temp);
        br();
        br();
        $temp = check_dictionary("false");
        echo("*false* should be false: ");
        var_dump($temp);
        br();
        br();
        $temp = check_dictionary("TEMPERATURE");
        echo("*TEMPERATURE* should be true: ");
        var_dump($temp);
        br();
        br();
        $temp = check_dictionary("TEMP?RATURE");
        echo("*TEMP?RATURE* should be false since it's just the basic function: ");
        var_dump($temp);
        br();
        br();
    } catch (Exception $e) {
        echo "Error: " . $e;
    } catch (Error $e) {
        echo "Error: " . $e;
    }

?>