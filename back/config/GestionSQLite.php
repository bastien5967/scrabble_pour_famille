<?php
// GestionSQLite.php
global $debug;
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

/*
$slite_db = null;
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
    $slite_db = new PDO("sqlite:$dbPath");
    $slite_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($debug) {
        br();
        echo("Connection to the SQLite database initialized. <br/>\n\n");
    }
    // Check if the connection was successful
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
    */
$slite_db = null;
try {
    $dbPath = __DIR__ . '/db/dictionnaire.db';

    // Check if the file exists
    if (!file_exists($dbPath)) {
        throw new Exception("Database file not found.");
    }

    $dsn = "sqlite:file:$dbPath?mode=ro";
    $slite_db = new PDO($dsn);
    $slite_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $slite_db->exec('PRAGMA busy_timeout = 2000;');
    if (!$slite_db) {
        throw new Exception("Failed to create new database connection.");
    }
}
catch (Exception $e) {
    echo("Error: base de donnée non initialisée: " . $e->getMessage());
    exit();
}
?>