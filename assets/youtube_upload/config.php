<?php
    set_time_limit(0);
	ini_set('default_socket_timeout',300);
	/* ini jika menggunakan oauth */
    // OAUTH Configuration
    /*
	$oauthClientID = '381393882664-nbb3nsj6dgp5rk63shub9vimjchte238.apps.googleusercontent.com';
    $oauthClientSecret = 'Apnw5fxT_aJHw3_TrNeyiJT9';
    $baseUri = 'http://localhost/youtube_upload/';
    $redirectUri = 'http://localhost/youtube_upload/youtube_upload.php';
    $DEVELOPER_KEY = 'AIzaSyA1iVSnNbo-vXnAMW7ANU-uSLCab2FqOdA';
    */
	$oauthClientID = '254488098964-djmt0q3uj28sdi9rfh23vvmrvjqj25gn.apps.googleusercontent.com';
    $oauthClientSecret = 'H_wc63cD9L0CrYBnmtqRz-5o';
    $baseUri = 'http://localhost/youtube_upload/';
    $redirectUri = 'http://localhost/youtube_upload/youtube_upload.php';
    $DEVELOPER_KEY = 'AIzaSyCWYK3L1wY0CA3y9zV_z_ZirH1-1irJy78';
	
    define('OAUTH_CLIENT_ID',$oauthClientID);
    define('OAUTH_CLIENT_SECRET',$oauthClientSecret);
    define('REDIRECT_URI',$redirectUri);
    define('BASE_URI',$baseUri);
    /* ini jika menggunakan oauth */

    // Include google client libraries
    require_once 'src/Google/autoload.php'; 
    require_once 'src/Google/Client.php';
    require_once 'src/Google/Service/YouTube.php';
    session_start();

    $client = new Google_Client();
    //$client->setApplicationName('Youtube Uploader');
    $client->setClientId(OAUTH_CLIENT_ID);
    $client->setClientSecret(OAUTH_CLIENT_SECRET);
    $client->setRedirectUri(REDIRECT_URI);
    $client->setDeveloperKey($DEVELOPER_KEY);
    $client->setScopes('https://www.googleapis.com/auth/youtube');

    
    // Define an object that will be used to make all API requests.
    $youtube = new Google_Service_YouTube($client);
    
?>