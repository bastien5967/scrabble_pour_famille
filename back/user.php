<?php
// user.php
include_once("./config/GestionSQL.php");

// all the return will be echoed as json
function getUserByUsername($username) {
    $sql = "SELECT * FROM user WHERE username = :username";
    $params = Array("username" => $username);
    $result = ExecuteSelectSql($sql, $params);
    return $result; // return the user data or null if not found
}

function login($username, $password, $quiet = false) {
    $user = getUserByUsername($username);
    $password = sha256($password); // hash the password
    if ($user && password_verify($password, $user['password'])) {
        $return = Array("user" => $user, "success" => true, "role" => $user['role']);
    } else {
        $return = Array("success" -> false);
    }
    if ($quiet == false) {
        echo json_encode($return);
    } else {
        return $return;
    }
}

function register($username, $password, $email, $quiet = false) {
    $password = sha256($password); // hash the password
    // Check if there's no user with the same name
    $user = getUserByUsername($username);
    if ($user) {
        $message = "Username already taken";
        $return = Array('success' => false, 'message' => $message);
        $user_ip = $_SERVER['REMOTE_ADDR'];
        log_action("A user tried to login with the username $username", "User IP: $user_ip", "register", "info");
        echo json_encode($return);
    } else {
        // actually register the new user
        $sql = "INSERT INTO `user` (username, password, email) VALUES (:user, :pwd, :email)";
        $params = Array("user" => $username, "pwd" => $password, "email" => $email);
        ExecuteUpdateSql($sql, $params);
        $message = "User registered successfully";
        $return = Array("success" -> true, "message" -> $message);
        log_action("A new user registered with the username $username", "User: $username; email: $email", "register", "info");
        if ($debug) {
            echo("register sucessfull !");
        }
}
    if ($quiet == false) {
        echo json_encode($return);
    } else {
        return $return;
    }
}

function check_role($username, $user_role, $quiet = false) {
    $user = getUserByUsername($username);
    if ($user) {
        if ($user['role'] == $user_role) {
            $return = Array("success" => true);
        } else {
           $message = "User role does not match";
           $return = Array("success" => false, "message" => $message);
        }
    } else {
        $message = "User not found";
        $return = Array("success" => false, "message" => $message);
    }
    if ($quiet == false) {
        echo json_encode($return);
    } else {
        return $return;
    }
}

/* TODO: send email to the user so they ca set and reset their user's password instead of doing it in the backend
function reset_password($username, $new_password) {
    //
}
// */

?>