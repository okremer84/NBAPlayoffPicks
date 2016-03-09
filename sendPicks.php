<?php
require_once("fbindex.php");
print_r($_POST);
echo "UID:" . $UID;
	
	$user = $mysqli->query("SELECT user_id FROM picks WHERE user_id = '" . $UID . "'");
	if ($user->num_rows > 0)
	{
		$mysqli->query("DELETE FROM `picks` WHERE `user_id`='" . $UID . "';");
		echo "DELETE FROM `picks` WHERE `user_id`='" . $UID . "';";
	}
	$mysqli->query("INSERT INTO `picks` (`user_id`, `eastSemi1`, `eastSemi1_count`, `eastSemi2`, `eastSemi2_count`, `eastSemi3`, `eastSemi3_count`, `eastSemi4`, `eastSemi4_count`, `westSemi1`, `westSemi1_count`, `westSemi2`, `westSemi2_count`, `westSemi3`, `westSemi3_count`, `westSemi4`, `westSemi4_count`, `eastFinals2`, `eastFinals2_count`, `westFinals1`, `westFinals1_count`, `westFinals2`, `westFinals2_count`, `eastFinals1`, `eastFinals1_count`, `nbaFinals1`, `nbaFinals2`, `finalsWinner`, `nbaFinals_count`, `players_player_id`, `eastFinalsWinner_count`, `westFinalsWinner_count`) VALUES ('" . $UID ."', '" . $_POST['eastSemi1'] ."', '" . $_POST['eastSemi1_count'] ."', '" . $_POST['eastSemi2'] ."', '" . $_POST['eastSemi2_count'] ."', '" . $_POST['eastSemi3'] ."', '" . $_POST['eastSemi3_count'] ."', '" . $_POST['eastSemi4'] ."', '" . $_POST['eastSemi4_count'] ."', '" . $_POST['westSemi1'] ."', '" . $_POST['westSemi1_count'] ."', '" . $_POST['westSemi2'] ."', '" . $_POST['westSemi2_count'] ."', '" . $_POST['westSemi3'] ."', '" . $_POST['westSemi3_count'] ."', '" . $_POST['westSemi4'] ."', '" . $_POST['westSemi4_count'] ."', '" . $_POST['eastFinals2'] ."', '" . $_POST['eastFinals2_count'] ."', '" . $_POST['westFinals1'] ."', '" . $_POST['westFinals1_count'] ."', '" . $_POST['westFinals2'] ."', '" . $_POST['westFinals2_count'] ."', '" . $_POST['eastFinals1'] ."', '" . $_POST['eastFinals1_count'] ."', '" . $_POST['nbaFinals1'] ."', '" . $_POST['nbaFinals2'] ."', '" . $_POST['finalsWinner'] ."', '" . $_POST['nbaFinals_count'] . "', '" . $_POST['MVP'] . "', '" . $_POST['eastFinalsWinner_count'] ."', '" . $_POST['westFinalsWinner_count'] ."');");
?>