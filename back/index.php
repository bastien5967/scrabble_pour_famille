<?php // index.php
    echo("hi");
    include_once("./config/GestionSQL.php");
    echo "Hello World";
    try {
        // include_once("./user.php");
        include_once("./dictionary.php");
    } catch (Exception $e) {
        echo "Error: " . $e;
    } catch (Error $e) {
        echo "Error: " . $e;
    }
    echo("\n\n\n<br/>Test de vérification des mots: <br/><br/>\n\n\n");
    check_dictionary("test"); // should return true
    echo("\n\n\n<br/><br/>\n\n\n");
    check_dictionary("test123"); // should return false
    echo("\n\n\n<br/><br/>\n\n\n");
    check_dictionary("hello"); // should return true
    echo("\n\n\n<br/><br/>\n\n\n");
    check_dictionary("AA");
    echo("\n\n\n<br/><br/>\n\n\n");
    check_dictionary("Gyoza");
    echo("\n\n\n<br/><br/>\n\n\n");
    check_dictionary("Zucchini");
    echo("\n\n\n<br/><br/>\n\n\n");
    check_dictionary("xylophone");
    echo("\n\n\n<br/><br/>\n\n\n");
    check_dictionary("false");
    echo("\n\n\n<br/><br/>\n\n\n");
?>