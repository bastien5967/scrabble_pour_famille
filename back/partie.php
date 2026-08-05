<?php
    // partie.php
    require_once("./config/GestionSQL.php");
    global $debug;
    
    function checkActiveGames($user) {
        $query = ("SELECT id FROM player WHERE `id_user` = :id_user AND `deleted_at` IS NULL");
        $paramsQuery = array(":id_user" => $user);
        $id_user = executeSelectSql($query, $paramsQuery);
        $sql = "SELECT * FROM `partie_player` WHERE `id_user` = :id_user AND `id_game` IN (SELECT `id` FROM `partie` WHERE `state` = 'ended')";
        $params = array(":id_user" => $user);
        $games = executeSelectSql($sql, $params);
        if (count($games) > 0) {
            if (count($games) > 1) {
                return true;
            } else {
                return $games[0]['id'];
            }
        } else {
            return false;
        }
    }
    
?>