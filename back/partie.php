<?php
    // partie.php
    require_once("./config/GestionSQL.php");
    global $debug;
    
    function checkActiveGames($username, $silent = false) {
        // var_dump("hi");
        $user_info = getUserByUsername($username);
        // var_dump($user_info);
        $user_id = $user_info[0]['id'];
        // var_dump($user_id);
        $sql = "SELECT * FROM `partie_player` WHERE `user_id` = :user_id AND partie_id IN (SELECT partie_id FROM `partie` WHERE `state` != 'finished' ORDER BY `date_start` DESC) ORDER BY `partie_id` DESC";
        $params = array(":user_id" => $user_id);
        // var_dump($params);
        $games = executeSelectSql($sql, $params);
        // var_dump($games);
        if (count($games) > 0) {
            if (count($games) > 1) {
                $retour = array("return" => true, "multiple" => true, "games" => $games);
                return $retour;
            } else {
                return array("return" => true, "multiple" => false, "game" => $games[0]['id']);
            }
        } else {
            return array("return" => false);
        }
    }
    
    function createNewGame($username, $lang, $silent = false) { // returns the id of the new game created
        // var_dump("createNewGame");
        $query = "INSERT INTO `partie` (`language`, `state`, `date_start`) VALUES (:lang, 'waiting', NOW())";//
        $paramsQuery = array(":lang" => $lang);
        $nb_row = executeUpdateSql($query, $paramsQuery);
        if ($nb_row <= 0) {
            return false;
        }
        $partie_id = getLastInsertId();
        // var_dump($partie_id);
        if ($silent) {
            return $partie_id;
        } else {
            // get last inserted ID
            $user = getUserByUsername($username); // get the user id from username
            // var_dump($user);
            $sql = "INSERT INTO `partie_player` (`user_id`, `partie_id`) VALUES (:user_id, :partie_id)";
            // error_log("DEBUG: retour = " . print_r($sql, true));
            
            $params = array(":user_id" => $user[0]['id'], ":partie_id" => $partie_id);
            // error_log("DEBUG: retour = " . print_r($params, true));
            // var_dump($params);
            
            executeUpdateSql($sql, $params); // insert the user in the partie_player table
            return $partie_id;
        }
    }
    
    function initGameState($id, $language) {
        //
        return False;
        // return False;
        $allPlayerOn = checkAllPlayer();
        
        if ($allPlayerOn == true) { // all player are on the game
            initPlayer(); // init the player's data
            initBoard(); // init the board TIL
            include_once("./letters.php");
            initLetterBag($language, $id);
            // var_dump($letter_bag
            
            executeUpDateSql("UPDATE partie SET state = 'in_progress' WHERE id = :id", array(":id" => $id)); // set the game state to init
        }
    }
    
    function isGameReady($id){
        $state = executeSelectSql("SELECT state FROM partie WHERE id = :id", array(":id" => $id));
        if ($state[0]['state'] == 'in_progress') return true;
        else return false;
    }
    
    function initBoard() {
        return False;
    }
    
    function initLetterBag() {
        return False;
        $bag = array();
    }
    
    function getCurentGameState($partie_id) {
        $sql = "SELECT row_idx, col_idx, letter FROM board_tiles WHERE partie_id = :partie_id";
        $param = array(":partie_id" => $partie_id);
        $raw_board = executeSelectSql($sql, $param); // get the board tiles
        $board = array();
        for ($i=1; $i<= 15; $i++) {
            $board[$i] = array(15);
            for ($j=1; $j<= 15; $j++) { $board[$i][$j] = ""; }
        }
        foreach ($raw_board as $letter) {
            $board[$letter['row_idx']][letter['col_idx']] = $letter['letter'];
        }
        return $board;
    }
    
    function getChevalet($username, $partie_id) {
        $user_id = getUserByUsername($username);
        $sql = "SELECT chevalet FROM partie_player WHERE partie_id = :partie_id AND user_id = :user_id";
        $param = array("user_id"=> $user_id, "partie_id" => $partie_id);
        $retour = executeSelectSql($sql, $param);
        if (count($retour) > 0) {
            $return = explode("", $retour[0]['chevalet']);
        } else { $return = false; }
        return $retour;
    }
    
    function getNewLetter($partie_id, $username, $n){
        $sql = "SELECT letter_bag FROM partie WHERE id = :id";
        $param = array("id" => $partie_id);
        $letter_bag = executeSelectSql($sql, $param);
        $chevalet = getChevalet($username, $partie_id);
        if (count($letter_bag) > 0){
            $nb_letter = count($letter_bag[0]);
            if ($n > $nb_letter) { // check that the number of letter is enough to get n letters
                $chevalet = implode("", $letter_bag);
                $chevalet .= $letter_bag[0];
                return $chevalet;
            }
        } else {
            $retour = false;
        }
    }
?>