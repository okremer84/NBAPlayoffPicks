<?php
require_once "phpfunctions.php";

class User
{
	public $score;
	public $name;
	public $result;
	
	public function __construct($firstname, $lastname, $i_Score, $i_Result)
	{
		$this->score = $i_Score;
		$this->name = $firstname . " " . $lastname;
		$this->result = $this->name . " " . $i_Result;
	}
}

function userCompare($usera, $userb)
{
	if ($usera->score == $userb->score)
	{
		return 0;
	}
	return ($usera->score < $userb->score) ? 1 : -1;
}

$mysqli = Database::getInstance();

$allPicks = $mysqli->query("SELECT * from picks");
$friendsArray = Array();
for ($i = 0; $i < $allPicks->num_rows ; $i++) 
{
	$both = false;
	$team = false;
    $allPicks->data_seek($i);
    $row = $allPicks->fetch_assoc();
	
	$user = $mysqli->query("SELECT score,first_name,last_name FROM users WHERE facebook_uid=". $row['user_id'] . " ORDER BY score DESC");
	$userScore = $user->fetch_array(MYSQLI_NUM);
	$newScore = $userScore[0];
	if ($row['finalsWinner'] == 6)
	{
		$newScore += 2;
		$team = true;
		if ($row['finalsWinner_count'] == 6)
		{
			$newScore += 2;
			$both = true;
		}
	}
	$resultString = "";
	if ($team == true && $both == false)
	{
		$resultString .= " Got the team right";
	}
	else if ($both == true)
	{
		$resultString .= " Got them both right";
	}
	else
	{
		$resultString .= " Got the Wrong Team";
	}
	$resultString .= " current score = " . $userScore[0] . " score after adding points = " . $newScore;
	$user = new User($userScore[1], $userScore[2], $newScore, $resultString);
	$friendsArray[] = $user;
	
	
	$mysqli->query("UPDATE users SET score = " . $newScore . " WHERE facebook_uid = " . $row['user_id']); 
}
$arrayObject = new ArrayObject($friendsArray);
$arrayObject->uasort('userCompare');
foreach($arrayObject as $currUser)
{
	echo $currUser->result;
	echo "<br/>";
}
?>