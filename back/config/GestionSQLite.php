<?php
// GestionSQLite.php
if ($debug) {
    echo("hi");
}

function ExecuteSelectSqlite($sql, $params) {
    // return what the select returns
    global $slite_db;
    $stmt = $slite_db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function ExecuteUpdateSqlite($sql, $params) {
    // return the number of affected rows
    global $slite_db;
    $stmt = $slite_db->prepare($sql);
    $stmt->execute($params);
    return $stmt->rowCount();
}

$bdd = null;
try {
    $dbPath = './config/dictionaire.db';

    // Check if the file exists and is writable
    if (file_exists($dbPath) && !is_writable($dbPath)) {
        throw new Exception("Database file is not writable.");
    }

    // Attempt to delete the file
    if (file_exists($dbPath) && !unlink($dbPath)) {
        throw new Exception("Failed to delete the database file.");
    }

    // Connect to the SQLite DB that contains the dictionary
    // $slite_db = new SQLite3($dbPath);
    $pdo = new PDO("sqlite:$dbPath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (!$slite_db) {
        throw new Exception("Failed to create new database connection.");
    }
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