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
    case 'login':
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $result = login($username, $password, true);
        echo json_encode($result);
        break;
        
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
        
    case 'register':
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';
        register($username, $password, $email, false); // Already handles echo
        break;
        
    case 'check_dictionary':
        $word = $_POST['word'] ?? '';
        formate_word($word); // Already handles echo
        break;
        
    case 'check_dictionary_direct':
        $word = $_POST['word'] ?? '';
        $result = check_dictionary($word);
        echo json_encode($result);
        break;
    
    case 'isCanBePlaced':
        $words = $_POST['words'] ?? '';
        $word = explode(',', $words);
        $result = isCanBePlaced($word);
        echo json_encode($result);
        break;
        
    case 'setSession':
        $_SESSION['username'] = $_POST['username'] ?? '';
        $_SESSION['password'] = $_POST['password'] ?? '';
        $_SESSION['role'] = $_POST['role'] ?? '';
        $_SESSION['email'] = $_POST['email'] ?? '';
        echo json_encode(['status' => 'success']);
        break;
        
    case 'getSession':
        $retour = [
            'username' => $_SESSION['username'] ?? '',
            'password' => $_SESSION['password'] ?? '',
            'email' => $_SESSION['email'] ?? '',
            'role' => $_SESSION['role'] ?? ''
        ];
        echo json_encode($retour);
        break;
    case 'saveGameState':
        //
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}
?>