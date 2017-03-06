<?php

require_once 'config.php';
require 'vendor/autoload.php';
require_once "phpfunctions.php";
use Facebook\HttpClients\FacebookHttpable;
use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;

// start session
session_start();
// init app with app id and secret
$mysqli = Database::getInstance();

FacebookSession::setDefaultApplication(FB_PUBLIC, FB_SECRET);
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( 'http://www.nbaplayoffpicks.com/' );
// see if a existing session exists
if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
    // create new session from saved access_token
    $session = new FacebookSession( $_SESSION['fb_token'] );
    // validate the access_token to make sure it's still valid
    try {
        if ( !$session->validate() ) {
            $session = null;
        }
    } catch ( Exception $e ) {
        // catch any exceptions
        $session = null;
    }
}

if ( !isset( $session ) || $session === null ) {
    // no session exists
    try {
        $session = $helper->getSessionFromRedirect();
    } catch( FacebookRequestException $ex ) {
        // When Facebook returns an error
        // handle this better in production code
        print_r( $ex );
    } catch( Exception $ex ) {
        // When validation fails or other local issues
        // handle this better in production code
        print_r( $ex );
    }
}

// see if we have a session
if ( isset( $session ) ) {
    // save the session
    $_SESSION['fb_token'] = $session->getToken();
    // create a session using saved token or the new one we generated at login
    $session = new FacebookSession( $session->getToken() );
    // graph api request for user data
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject()->asArray();

    // print profile data

	$UserObject = $graphObject;
	$UID = $graphObject['id'];

	$user = $mysqli->query("SELECT * FROM users WHERE facebook_uid=" . $UID . "");
	if ($user == false || $user->num_rows == 0)
	{
		$mysqli->query("INSERT INTO `users` (`facebook_uid`, `first_name`, `last_name`, `score`) VALUES (" . $UID . ", '" . $graphObject['first_name'] . "', '" . $graphObject['last_name'] . "', '0');");
		
		$mysqli->query("INSERT INTO picks (`user_id`) VALUES ('" . $UID . "')");
	}
} else {
    // show login url
	header('Location: '.$helper->getLoginUrl( array( 'user_friends' ) ));
}


function getUserPic($UID)
{
    $session = new FacebookSession( $_SESSION['fb_token'] );
        if ( !$session->validate() ) {
            $session = null;
			return null;
        }
    $picrequest = new FacebookRequest( $session, 'GET', "/" . $UID . "/picture" ,
           array (
               'redirect' => false,
               'type'     => 'large'
           ));
	$picresponse = $picrequest->execute();
	$userPic = $picresponse->getGraphObject()->asArray();
	$userPic = $userPic['url'];
	return $userPic;
}

function getUserName($UID)
{
    $session = new FacebookSession( $_SESSION['fb_token'] );
    if ( !$session->validate() ) {
            $session = null;
			return null;
    }
	
    $request = new FacebookRequest( $session, 'GET', "/". $UID . "" );
    $response = $request->execute();
	
    // get response
    $graphObject = $response->getGraphObject()->asArray();

    // print profile data
	return $graphObject['first_name'];
}


function getName($UID)
{
    $session = new FacebookSession( $_SESSION['fb_token'] );
    if ( !$session->validate() ) {
            $session = null;
			return null;
    }
	
    $request = new FacebookRequest( $session, 'GET', "/". $UID . "" );
    $response = $request->execute();
	
    // get response
    $graphObject = $response->getGraphObject()->asArray();

    // print profile data
	return $graphObject['first_name'] . " " . $graphObject['last_name'];
}
?>