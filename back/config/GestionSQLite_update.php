<?php
// GestionSQLite_update.php

function ExecuteUpdateSqlite($sql, $params) {
    // return the number of affected rows
    global $slite_db_write;
    $stmt = $slite_db_write->prepare($sql);
    $stmt->execute($params);
    return $stmt->rowCount();
}

$slite_db_write = null;
try {
    // $dbPath = 'db/dictionnaire.db';
    // $dbPath_WTF = 'config/db/dictionnaire.db';
    $dbPath = __DIR__ . '/db/dictionnaire.db'; // Use __DIR__ to get the directory of the current script
    // br();
    // echo("Database path: ");
    // var_dump($dbPath);
    if (!file_exists($dbPath)) {
        throw new Exception("Failed to create new database connection.");
    }

    // Check if the file exists and is writable
    if (file_exists($dbPath) && !is_writable($dbPath)) {
        throw new Exception("Database file is not writable.");
    }

    // Connect to the SQLite DB that contains the dictionary
	$writeDb = new PDO("sqlite:$dbPath");
	$writeDb->exec('PRAGMA journal_mode=WAL;');
	$slite_db_write->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($debug) {
        br();
        echo("Connection to the SQLite database initialized. <br/>\n\n");
    }
    // Check if the connection was successful
    if (!$slite_db_write) {
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
