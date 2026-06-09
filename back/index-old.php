<?php
// index.php
require_once "./config/util.php";
require_once("./dictionary.php");
require_once("./user.php");
$action = $_GET['action'];
$retour = isset($_GET['return']) ? $_GET['retour'] : 'json';
switch ($action) {
    case 'login':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = login($username, $password, true);
        return json_encode($result);
        // break;
    case 'check_user':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = login($username, $password, true);
        if ($retour = "json") {
            echo json_encode($result);
        } else {
            return $result;
        }
        break;
    case 'check_role':
        $username = $_POST['username'];
        $role = $_POST['role'];
        $result = check_role($username, $password, true);
        if ($retour = "json") {
            echo json_encode($result);
        } else {
            return json_encode($result);
        }
        break;
    case 'register':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $result = register($username, $password, $email, false); // does the echo already
        break;
    case 'check_dictionary':
        $word = $_POST['word'];
        $result = formate_word($word); // does the echo already
        /*
        if ($retour = "json") {
            echo json_encode($result);
        } else {
            return $result;
        }
        */
        break;
    case 'setSession':
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['role'] = $_POST['role'];
        break;
    case 'getSession':
        $retour = [
            'username' => $_SESSION['username'],
            'password' => $_SESSION['password'],
            'role' => $_SESSION['role']
        ];
        if ($retour = "json") {
            echo json_encode($retour);
        } else {
            return $retour;
        }
        break;
    default:
        if ($retour = "json") {
            echo json_encode(['error'=>"Invalid action"]);
        } else {
            return false;
        }
    break;
}
?>