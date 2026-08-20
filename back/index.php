<?php
// index.php - API endpoint
session_start(); // Start session at the beginning

require_once "./config/util.php";
require_once("./dictionary.php");
require_once("./user.php");
require_once("./partie.php");

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
        $result = register($username, $password, $email, false); // Already handles echo
        echo json_encode($result);
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
    
    // INIT GAME MANAGMENT
    case 'initGameState':
        $id = $_POST['id'] ?? '';
        $language = $_POST['language'] ?? '';
        $return = initGameState($id, $language);
        echo json_encode(['status' => $return]);
        break;
    
    case 'checkActiveGamesForUser':
        // var_dump("hi");
        $username = $_POST['username'] ?? '';
        $result = checkActiveGames($username, true);
        echo json_encode($result);
        break;
    
    case 'createNewGame':
        $username = $_POST['username'] ?? '';
        $language = $_POST['language'] ?? '';
        $result = createNewGame($username, true);
        echo json_encode($result);
        break;
    
    case "isGameReady":
        $partie_id = $_POST['partie_id'];
        $username = $_POST['username'] ?? '';
        $result = isGameReady($partie_id, true);
        echo json_encode($result);
        break;
    
    // ACTIVE GAME MANAGMENT
    case 'getCurentGameState':
        $partie_id = $_POST['partie_id'];
        // $username = $_POST['username'];
        $retour = getCurentGameState($partie_id, $username);
        echo json_encode($result);
        break;
    
    case 'getChevalet':
        $partie_id = $_POST['partie_id'];
        $username = $_POST['username'];
        $retour = getChevalet($partie_id, $username);
        echo json_encode($result);
        break;
    
    case 'getNewLetter':
        $partie_id = $_POST['partie_id'];
        $username = $_POST['username'];
        $n = $_POST['n'];
        $retour = getNewLetter($partie_id, $username, $n);
        echo json_encode($retour);
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