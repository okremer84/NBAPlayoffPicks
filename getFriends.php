<?php
require("fbindex.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NBA Playoff Picks Challenge</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
use Facebook\FacebookSession;ion;
use Facebook\GraphObject;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;


if ($_GET["friends"] == "true")
{
	GetUsers(false);	
}
else
{
	GetUsers(true);
}

function GetUsers($global)
{
	
    $session = new FacebookSession( $_SESSION['fb_token'] );
        if ( !$session->validate() ) {
            $session = null;
			return null;
        }
    $friendsRequest = new FacebookRequest( $session, 'GET', "/me/friends" );
	$friendsResponse = $friendsRequest->execute();
	$friendsObject = $friendsResponse->getGraphObject()->asArray();
	$friendsArray = Array();
	foreach ($friendsObject['data'] as &$friend)
	{
		$friendsArray[] = $friend->id;
	}
	
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject()->asArray();

	$friendsArray[] = $graphObject['id'];
	
	$mysqli = Database::getInstance();
	$query = "SELECT score,facebook_uid, first_name, last_name FROM users ORDER BY score DESC";
	if ($global == true)
	{
		$query = $query . " LIMIT 10";
	}
	$scoreResponse = $mysqli->query($query);
	echo "<ul>";
	$position = 0;
	$lastScore = 0;
	for ($i = 0; $i < $scoreResponse->num_rows; $i++)
	{
		$usersScore = $scoreResponse->fetch_array(MYSQLI_ASSOC);
		if ($usersScore['score'] != $lastScore)
		{
			$lastScore = $usersScore['score'];
			$position++;
		}
		if (in_array($usersScore['facebook_uid'],$friendsArray) || $global == true)
		{
			$picrequest = new FacebookRequest( $session, 'GET', "/" . $usersScore['facebook_uid'] . "/picture" ,
				   array (
					   'redirect' => false,
					   'type'     => 'square'
				   ));
			$picresponse = $picrequest->execute();
			$userPic = $picresponse->getGraphObject()->asArray();
			$userPic = $userPic['url'];
			echo "<a href=\"index.php?friendid=" . $usersScore['facebook_uid'] . "\"><li class=\"FBUser\" id=\"FBUser\">";
			echo "<span class=\"UserPosition\">" . $position . "</span>";
			echo "<img id=\"profilePic\" src=\"" . $userPic ."\">";
			echo "<span class=\"userName\">" . $usersScore['first_name'] . " " . $usersScore['last_name'] . "</span>";
			echo "<span class=\"userPoints\">" . $usersScore['score'] . " Points</span>";
			echo "</li></a>";
		}
	}
	echo "</ul>";
}

?>
</body>