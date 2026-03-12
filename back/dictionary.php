<?php
// dictionary.php
include_once("./config/GestionSQLite.php");
incluse_once("./user.php");

$alphabet = Array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"); // alphabet array

// check if the word is in dictionary
function check_dictionary($word) {
    $sql = "SELECT * FROM dictionary WHERE word = :word";
    $params = Array("word" => $word);
    $result = ExecuteSelectSqlite($sql, $params);
    if (count($result) > 0) {
        $return = Array("valid" => true);
    } else {
        $return = Array("valid" => false);
    }
    return ($return);
}

function formate_word($word)
{
    // format the word to uppercase and remove spaces
    $word = strtoupper($word);
    $word = str_replace(" ", "", $word);
    // check if there is any ? (jocker) in the word
    if (strpos($word, "?") !== false) {
        $count_jocker = count(explode("?", $word)) - 1;
        if ($count_jocker > 1) {
            // TODO: crack my brain against the fact that a player can have 2 jockers at one...
            $return = Array("valid" => false);
        } else {
            // check if the word is valid with one jocker
            foreach ($alphabet as $letter) {
                $word_jocker = str_replace("?", $letter, $word);
                $result = check_dictionary($word_jocker);
                if ($result['valid'] == true) {
                    $return = Array("valid" => true);
                    echo json_encode($return);
                    exit();
                }
            }
            $return = Array("valid" => false);
        }
        echo json_encode($return);
    } else {
        $result = check_dictionary($word_jocker);
        if ($result['valid'] == true) {
            $return = Array("valid" => true);
        } else {
            $return = Array("valid" => false);
        }
        echo json_encode($return);
    }
}

function add_dictionary($word, $user, $role) {
    // check if the role is admin
    $role_checked = check_role($user, $role, true);
    if ($role_checked['success'] == true && $role == 1 || $role == 0) {
        $sql = "INSERT INTO dictionary (word) VALUES (:word)";
        $params = Array("word" => $word);
        $result = ExecuteUpdateSqlite($sql, $params);
        if ($result > 0) {
            log_action("Added a word: $word", $user);
            $return = Array("success" => true, "message" => "Word added successfully");
            if ($debug) {
                echo("Word removed successfully");
            }
        }
    } else {
        $return = Array("success" => false, "message" => "You do not have the permission to add words");
    }
    echo json_encode($return);
}

function remove_dictionary($word, $user, $role) {
    // check if the role is admin
    $role_checked = check_role($user, $role, true);
    if ($role_checked['success'] == true && $role == 0) {
        $sql = "UPDATE dictionary SET sys_datesup = CURRENT_TIMESTAMP WHERE word = :word";
        $params = Array("word" => $word);
        $result = ExecuteUpdateSqlite($sql, $params);
        if ($result > 0) {
            log_action("Removed a word: $word", $user);
            $return = Array("success" => true, "message" => "Word removed successfully");
            if ($debug) {
                echo("Word removed successfully");
            }
        }
    } else {
        $return = Array("success" => false, "message" => "You do not have the permission to remove words");
    }
    echo json_encode($return);
}
?>