<?php
    // GestionSQL.php
    if ($debug) {
        echo("hi");
    }
    
    function ExecuteSelectSql($sql, $params)
    { // return what the select return
        global $bdd;
        $stmt = $bdd->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function ExecuteUpdateSql($sql, $params)
    { // return the number of affected rows
        global $bdd;
        $stmt = $bdd->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    function log_action($data, $user = null, $context = null, $type = null)
    {
        // log the data in the database
        $sql = "INSERT INTO `logs` (data, user, context, type) VALUES (:datas, :user, :context, :log_type)";
        if ($user == null) {
            $user = "unknown";
        }
        if ($context == null) {
            // $context = "unknown";
            $context = $_SERVER['PHP_SELF']; // curent file if no context is specified
        }
        if ($type == null) {
            $type = "info";
        }
        $params = ['datas' => $data, 'user' => $user, 'context' => $context, 'log_type' => $type];
        ExecuteUpdateSql($sql, $params);
    }

    $bdd = null;
    try {
        // $bdd = new PDO('mysql:host=localhost;dbname=scrabble', 'bastien5967', 'd975.Y3+tu');
        $bdd = new PDO('mysql:host=localhost;dbname=scrabble', 'scrabble', 'Tv7S3qc3+xvq!');
    }
    catch (Error $e) {
        echo("Error: base de donnée non initialisée: " . $e);
        exit();
    }
    catch (Exception $e) {
        echo("Error: base de donnée non initialisée: " . $e);
        exit();
    }
?>