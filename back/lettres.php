<?php
    // lettres.php
	function initLetterBag($language, $partie_id) {
		$letter_bag = Array();
		$list_letter_english = ["A" => 9, "B" => 2, "C" => 2, "D" => 4, "E" => 12, "F" => 2, "G" => 3, "H" => 2, "I" => 9, "J" => 1, "K" => 1, "L" => 4, "M" => 2, "N" => 6, "O" => 8, "P" => 2, "Q" => 1, "R" => 6, "S" => 4, "T" => 6, "U" => 4, "V" => 2, "W" => 2, "X" => 1, "Y" => 2, "Z" => 1];
		$list_letter_francais = ["A" => 9, "B" => 2, "C" => 2, "D" => 3, "E" => 15, "F" => 2, "G" => 2, "H" => 2, "I" => 8, "J" => 1, "K" => 1, "L" => 5, "M" => 3, "N" => 6, "O" => 6, "P" => 2, "Q" => 1, "R" => 6, "S" => 6, "T" => 6, "U" => 6, "V" => 2, "W" => 1, "X" => 1, "Y" => 2, "Z" => 1];
		$active = false;
		switch ($language) {
			case 'en':
				$active = $list_letter_english;
				break;
			case 'fr':
				$active = $list_letter_francais;
				break;
			default:
				$active = $list_letter_francais;
				break;
		}
		foreach ($active as $key => $value) {
			for ($i = 0; $i < $value; $i++) {
				array_push($list_letter, $key);
			} // end for
		} // end foreach
		$success = executeUpDateSql("UPDATE partie SET letter_bag = :letter_bag WHERE id = :partie_id", array(":letter_bag" => implode(",", $list_letter), ":partie_id" => $partie_id));
		// return $success;
	} // end function
?>