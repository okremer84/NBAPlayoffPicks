<?php

class Database extends MySQLi {
     private static $instance = null ;

     private function __construct($host, $user, $password, $database){ 
         parent::__construct($host, $user, $password, $database);
     }

     public static function getInstance(){
         if (self::$instance == null){
             self::$instance = new self("localhost", "wwwndkpl_picksus", "*********", "wwwndkpl_nbaplayoffpicks");
         }
         return self::$instance ;
     }
}

function populateTeams($UID)
{
	$mysqli = Database::getInstance();
	$teams = $mysqli->query("SELECT * FROM teams");
	  $selectedPlayer = $mysqli->query("SELECT players_player_id FROM picks WHERE user_id = '" . $UID . "';");
	  
	  if ($selectedPlayer != false && $selectedPlayer->num_rows > 0)
	  {
		  $selectedPlayer = $selectedPlayer->fetch_array(MYSQLI_NUM);
		  $selectedPlayer = $selectedPlayer[0];
		  $selectedTeam = $mysqli->query("SELECT teams_team_id FROM players where player_id='" . $selectedPlayer . "'");
		  $selectedTeam = $selectedTeam->fetch_array(MYSQLI_NUM);
		  $selectedTeam = $selectedTeam[0];
	  }
  for ($row_no = $teams->num_rows - 1; $row_no >= 0; $row_no--) {
    $teams->data_seek($row_no);
    $row = $teams->fetch_assoc();
    echo "<option value=\"" . $row['team_id'] . "\"";
	if ($row['team_id'] == $selectedTeam)
	{
		echo " selected";
	}
	echo ">" . $row['name'] . "</option>";
	}
}

function populatePlayers($UID)
{
	$mysqli = Database::getInstance();
	$teams = $mysqli->query("SELECT * FROM teams");
  for ($row_no = $teams->num_rows - 1; $row_no >= 0; $row_no--) {
      $teams->data_seek($row_no);
      $row = $teams->fetch_assoc();
	  $players = $mysqli->query("SELECT * FROM players WHERE teams_team_id = '" . $row['team_id'] . "';");
	  $selectedPlayer = $mysqli->query("SELECT players_player_id FROM picks WHERE user_id = '" . $UID . "';");
	  
	  if ($selectedPlayer != false && $selectedPlayer->num_rows > 0)
	  {
		  $selectedPlayer = $selectedPlayer->fetch_array(MYSQLI_NUM);
		  $selectedPlayer = $selectedPlayer[0];
	  }
	  
	  echo "<select name=\"MVP\" id=\"MVP_" . $row['team_id'] . "\" style=\"visibility:hidden\" class=\"playerSelect\">";
	  for ($i = 0; $i < $players->num_rows; $i++)
	  {
		  $row = $players->fetch_array(MYSQLI_ASSOC);
		  echo "<option value=\"" . $row['player_id'] . "\"";
		  if ($selectedPlayer == $row['player_id'])
		  {
			  echo " selected";
		  }
		  echo ">" . $row['first_name'] . " " . $row['last_name'] . "</option>";
	  }
	  echo "</select>";
    
	}
}

function populateTeam($where, $next, $UID)
{
	$mysqli = Database::getInstance();
	$teams = $mysqli->query("SELECT " . $where . " FROM picks WHERE user_id = '" . $UID . "'");
	$result = $mysqli->query("SELECT " . $where . " FROM results WHERE picks_id = 1");
	$results = $result->fetch_array(MYSQLI_NUM);
	if ($teams->num_rows == 0)
	{
		echo "<img src=\"images/none.png\" class=\"teamImg\" id=\"_" . $next . "\">";
	}
	else
	{
		$row = $teams->fetch_array(MYSQLI_NUM);
		if ($row[0] == 0)
		{
			echo "<img src=\"images/none.png\" class=\"teamImg";
			echo "\" id=\"_" . $next . "\">";
			return;
		}
		$teamPic = $mysqli->query("SELECT logo FROM teams WHERE team_id = '" . $row[0] . "'");
		$teamPicRow = $teamPic->fetch_array(MYSQLI_NUM);
		echo "<img src=\"images/" . $teamPicRow[0] . "\" class=\"teamImg";
		if ($results[0] != 0 && $row[0] == $results[0])
		{
			echo " correctTeam";
		}
		else if ($results[0] != 0 && $row[0] != $results[0])
		{
			echo " incorrectTeam";
		}
		echo "\" id=\"" . $row[0] . "_" . $next . "\">";
	}
}

function populateSelect($where, $UID)
{
	$mysqli = Database::getInstance();
	$countPicks = $mysqli->query("SELECT " . $where . " from picks WHERE user_id = '" . $UID . "'");
	$result = $mysqli->query("SELECT " . $where . " FROM results WHERE picks_id = 1");
	$results = $result->fetch_array(MYSQLI_NUM);
	if ($countPicks != false && $countPicks->num_rows > 0)
	{
		$countRow = $countPicks->fetch_array(MYSQLI_NUM);
	}
	else
	{
		$countRow[0] = 0;
	}
	echo "<select name=\"" . $where . "\"";
	if ($results[0] != 0 && $countRow[0] == $results[0])
	{
		echo " class=\"correctCount\"";
	}
	else if ($results[0] != 0 && $countRow[0] != $results[0])
	{
		echo " class=\"incorrectCount\"";
	}
	echo ">";
	for ($i = 4; $i < 8; $i++)
	{
		echo "<option value=\"" . $i . "\"";
		if ($countRow[0] == $i)
		{
			echo " selected";
		}
		echo ">" . $i . " Games</option>";
	}
	echo "</select>";
}
?>
