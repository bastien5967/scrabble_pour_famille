<?php
// index.php - API endpoint
session_start(); // Start session at the beginning

require_once "./config/util.php";
require_once("./dictionary.php");
require_once("./user.php");

// Set content type to JSON
header('Content-Type: application/json');
$debug = false;

$action = $_GET['action'] ?? '';
$retour = $_GET['return'] ?? 'json';

// Handle all requests through POST for API consistency
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Only POST requests allowed']);
    exit;
}

switch ($action) {
    // USER MANAGMENT
    case 'login':
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $result = login($username, $password, true);
        echo json_encode($result);
        break;
        
    case 'register':
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';
        register($username, $password, $email, false); // Already handles echo
        break;

    
    // ADMIN USER MANAGMENT
    case 'check_user':
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $result = login($username, $password, true);
        if ($retour == "json") { // Fixed: using == for comparison
            echo json_encode($result);
        } else {
            echo json_encode($result); // Return JSON regardless
        }
        break;
        
    case 'check_role':
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? '';
        $result = check_role($username, $password, true);
        echo json_encode($result);
        break;
    
    // GAME MANAGMENT
    case 'initGameState':
        $return = initGameState($state, $id);
        echo json_encode(['status' => $return]);
        break;
    
    case 'checkActiveGamesForUser':
        $username = $_POST['username'] ?? '';
        $result = checkActiveGames($username, true);
        echo json_encode($result);
        break;
        
    // DICTIONARY MANAGMENT
    case 'check_dictionary':
        $word = $_POST['word'] ?? '';
        formate_word($word); // Already handles echo
        break;
        
    case 'check_dictionary_direct':
        $word = $_POST['word'] ?? '';
        $result = check_dictionary($word);
        echo json_encode($result);
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}
?>