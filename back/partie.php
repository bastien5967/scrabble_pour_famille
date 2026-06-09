<?php
    // partie.php
    require_once("./config/GestionSQL.php");
    global $debug;
    
    
    function isCanBePlaced($words)
    {
        foreach ($words as $word) {
            $result = check_dictionary($word);
            if ($result['valid'] == false) {
                return json_encode(Array('valid' => false));
            }
        }
        return json_encode(Array('valid' => true));
    }
    
    function getPartie($id)
    {
        $sql = "SELECT * FROM partie WHERE id = :id";
        $params = Array("id" => $id);
        $result = ExecuteSelectSql($sql, $params);
        return $result;
    }

    function getPartieByUser($user_id)
    {
        $sql = "SELECT * FROM partie WHERE user_id = :user_id";
        $params = Array("user_id" => $user_id);
        $result = ExecuteSelectSql($sql, $params);
        return $result;
    }

    function saveState($partie_id, $state)
    {
        $sql = "INSERT INTO partie (id, x, y, letter) VALUES (:partie_id, :x, :y, :letter)";
        // $state is sorted as $state[row][column][letter] with 15 row and column unless bug
        for ($x = 1; $x < 16; $x++) {
            for ($y = 1; $y < 16; $y++) {
                $params = Array("partie_id" => $partie_id, "x" => $x, "y" => $y, "letter" => $state[$x][$y]);
                ExecuteUpdateSql($sql, $params);
            }
        }
        return true;
    }

    function getState($partie_id)
    {
        $sql = "SELECT * FROM partie WHERE id = :partie_id";
        $params = Array("partie_id" => $partie_id);
        $result = ExecuteSelectSql($sql, $params);
        if (!empty($result)) {
            $retour = [];
            foreach ($result as $row) {
                $retour[$row['x']][$row['y']] = $row['letter'];
            }
        }
        return json_encode($retour);
    }

    function calculScore($action_id)
    {
        $score = 0;
        // get the infos about the action from the DB
        $query = "SELECT * FROM action_jeu WHERE action_id = :action_id";
        $params = Array("action_id" => $action_id);
        $result = ExecuteSelectSql($query, $params);
        foreach ($result as $row) {
            $score += $row['score'];
        }
        // clean behind you to not clutter the DB
        $sql = "DELETE FROM action_jeu WHERE action_id = :action_id";
        ExecuteUpdateSql($sql, $params);
        return $score;
    }

    function saveAction($player_id, $score)
    {
        $sql = "INSERT INTO action_jeu (player_id, score) VALUES (:player_id, :score)";
        $params = Array("player_id" => $player_id, "score" => $score);
        ExecuteUpdateSql($sql, $params);
        return true;
    }

?>