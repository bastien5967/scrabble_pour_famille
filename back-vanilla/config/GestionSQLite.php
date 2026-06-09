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

$slite_db = null;
try {
    // $dbPath = 'db/dictionnaire.db';
    // $dbPath_WTF = 'config/db/dictionnaire.db';
    $dbPath = __DIR__ . '/db/dictionnaire.db'; // Use __DIR__ to get the directory of the current script
    br();
    echo("Database path: ");
    var_dump($dbPath);
    if (!file_exists($dbPath)) {
        throw new Exception("Failed to create new database connection.");
    }

    // Check if the file exists and is writable
    if (file_exists($dbPath) && !is_writable($dbPath)) {
        throw new Exception("Database file is not writable.");
    }

    echo("<br/>\n\n");
    // Connect to the SQLite DB that contains the dictionary
    $slite_db = new PDO("sqlite:$dbPath");
    $slite_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo("Connection to the SQLite database initialized. <br/>\n\n");

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