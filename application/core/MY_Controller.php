<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/idiorm/idiorm.php';
require_once '/assets/idiorm/idiorm.php';
require_once '/assets/instagram_upload/src/Instagram.php';
class MY_Controller extends CI_Controller {
	public $user = "";
	private $delimiter = 'Cryppptth1sus2r';
	
	public function __construct() {
		parent::__construct();

		// Load facebook library and pass associative array which contains appId and secret key
		$this->load->library('facebook', array('appId' => $this->config->item('fb_app_id'), 'secret' => $this->config->item('fb_secret_key')));

		// Get user's login information
		$this->user = $this->facebook->getUser();
	}
	
	protected function sendEmailDemo($param){
		
		$this->load->config('mandrill');
		$this->load->library('mandrill');

		$mandrill_ready = NULL;

		try {

		    $this->mandrill->init( $this->config->item('mandrill_api_key') );
		    $mandrill_ready = TRUE;

		} catch(Mandrill_Exception $e) {

		    $mandrill_ready = FALSE;

		}

		if( $mandrill_ready ) {
			$subject_email = $param->subject;
			$text_email = $param->message;
		    //Send us some email!
		    $mandrill = array(
		        'html' => '', //Consider using a view file
		        'text' => $text_email,
		        'subject' => $subject_email,
		        'from_email' => $this->config->item('contact_email'),
		        'from_name' => $this->config->item('contact_email'),
		        'to' => array(array('email' => $param->email )));

		    $result = $this->mandrill->messages_send($mandrill);

		    $str = '';
		    foreach ($result as $data) {
                if($data['status'] != 'sent')
                    $str .= 'Failed to send ' . $data['email'] . ' ';
            }

            $str = $str != '' ? $str : 'true';
            if($str == 'true'){
 				return 'success';
            } else {
            	return 'failed';
            }
		} else {
			return 'failed';
		}
	}
	
	protected function sendEmail($name,$email){
		
		$this->load->config('mandrill');
		$this->load->library('mandrill');

		$mandrill_ready = NULL;

		try {

		    $this->mandrill->init( $this->config->item('mandrill_api_key') );
		    $mandrill_ready = TRUE;

		} catch(Mandrill_Exception $e) {

		    $mandrill_ready = FALSE;

		}

		if( $mandrill_ready ) {
			$subject_email = 'WhatWeLike.co - User Validation';
			$text_email = '
			Hi '. $name .',

			Thank you very for being a part of our community, this is just an email to validate your email address.
			To confirm, please click the url below:

			------
			'. $this->config->item('emailvalidation_url') . '?email_address='. $email .'&key='. MD5($email) .'
			------

			You can now start commenting and favoriting your favorite products!.


			Thanks,

			Team WhatWeLike,
			https://www.WhatWeLike.co -  Social Shopping Community.
			';
			
			
			
		    //Send us some email!
		    $mandrill = array(
		        'html' => '', //Consider using a view file
		        'text' => $text_email,
		        'subject' => $subject_email,
		        'from_email' => $this->config->item('contact_email'),
		        'from_name' => $this->config->item('contact_email'),
		        'to' => array(array('email' => $email )));

		    $result = $this->mandrill->messages_send($mandrill);

		    $str = '';
		    foreach ($result as $data) {
                if($data['status'] != 'sent')
                    $str .= 'Failed to send ' . $data['email'] . ' ';
            }

            $str = $str != '' ? $str : 'true';
            if($str == 'true'){
 				return 'success';
            } else {
            	return 'failed';
            }
		} else {
			return 'failed';
		}
	}
	
    protected function resizeImage($fileSource, $fullImageName, $width, $height) {
    	//print_r($fullImageName);
    	$config = array();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $fileSource;
        $config['new_image'] = $fullImageName;
        $config['thumb_marker'] = '-' . $width . 'px';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
        $config['height'] = $height;

        $this->load->library('image_lib');
        $this->image_lib->initialize($config);

        $isResize = $this->image_lib->resize();
        if(!$isResize) {
            echo $this->image_lib->display_errors();
        }

        $this->image_lib->clear();
    }
	
	protected function isValidOAuth($param){
		if(isset($param['user_id']) && isset($param['access_token'])){
			$chunk = explode(crypt($param['user_id'] ,$this->delimiter), $param['access_token']);
			
			$userIdJSON = array('user_id' => $param['user_id']);
			$currTokenId = SHA1(json_encode($userIdJSON)) ;
			$currdate = mktime(0, 0, 0, date("n")  , date("j"), date("Y"));
			
			if(count($chunk) <= 1)
				return false;
			
			if($chunk[1] == $currTokenId && ((int) $chunk[0]) >= ((int) $currdate))
				return true;
			
			return false;
		}
		
		return false;
	}
	
	protected function getTokenKey($param){
		if(isset($param['user_id'])){
			$userIdJSON = array('user_id' => $param['user_id']);
			$currTokenKey = SHA1(json_encode($userIdJSON)) ;
			
			return $currTokenKey;
		}
		
		return null;
	}
	
	protected function getSessionData($param){
		if(isset($param['user_id']) && isset($param['access_token'])){
			$session_prefix = MD5($param['user_id']) . '_';
			$session_name = $this->getTokenKey(array('user_id' => $param['user_id']));
			$session_fullname = $session_prefix . '' . $session_name;
			
			$result = $this->session->userdata($session_fullname);
			if($result == false)
				return null;
			
			return $result->session_id;
		}
	}
	
	protected function isSessionActive($param){
		if(isset($param['user_id']) && isset($param['access_token'])){
			$session_prefix = MD5($param['user_id']) . '_';
			$session_name = $this->getTokenKey(array('user_id' => $param['user_id']));
			$session_fullname = $session_prefix . '' . $session_name;
			
			$result = $this->session->userdata($session_fullname);
			//var_dump('isSessionActive');
			//var_dump($result);
			if($result == false)
				return false;
			
			return true;
		}
		
		return false;
	}
	
	protected function destroySession($param){
		if(isset($param['user_id']) && isset($param['access_token'])){
			$session_prefix = MD5($param['user_id']) . '_';
			$session_name = $this->getTokenKey(array('user_id' => $param['user_id']));
			
			$session_fullname = $session_prefix . '' . $session_name;
			$this->session->unset_userdata($session_fullname);
			
			return true;
		}
		
		return false;
	}
	
	protected function createSession($param, $data){
		if(isset($param['user_id']) && isset($param['access_token'])){
			$data->session_id = $this->session->userdata('session_id');
			
			$session_prefix = MD5($param['user_id']) . '_';
			$session_name = $this->getTokenKey(array('user_id' => $param['user_id']));
			
			$session_fullname = $session_prefix . '' . $session_name;
			//echo $session_fullname;
			
			$this->session->set_userdata($session_fullname, $data);
			//echo json_encode($this->session->userdata($session_fullname));
			
			return true;
		}
		
		return false;
	}
	
	protected function createOAuth($param){
		if(isset($param->id)){
			$userIdJSON = array('user_id' => $param->id);
			$token = mktime(0, 0, 0, date("n")  , date("j") + 30, date("Y"))
				. crypt($param->id ,$this->delimiter)
				. SHA1(json_encode($userIdJSON)) ;
				
			return $token;
		}
		
		return null;
	}
	
	protected function isJson($string) {
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}
	
	protected function isValidMethod($method, $validMethod){
		return $method == $validMethod;
	}

	protected function saveCache($cache_name = '', $cache_data = null, $cache_time = 240){
		if(empty($cache_name) || $cache_data == null
			|| !$this->config->item('enable_cache'))
			return;
		
		$this->load->driver('cache', array('backup' => 'file'));
		$cache = $this->cache->file->save($cache_name, $cache_data, $cache_time);
		if($cache == false){
			error_log('Failed to create cache file');
		}
	}
	
	protected function loadCache($cache_name = ''){
		if(empty($cache_name)|| !$this->config->item('enable_cache'))
			return null;
		
		$this->load->driver('cache', array('backup' => 'file'));
		$cache = $this->cache->file->get($cache_name);
		if($cache == false)
			return null;
		
		return $cache;
	}
	
	protected function deleteCache($cache_name = ''){
		if(empty($cache_name))
			return false;
		
		$this->load->driver('cache', array('backup' => 'file'));
		$cache = $this->cache->file->delete($cache_name);
		if($cache == false)
			return false;
		
		return true;
	}
	
	protected function getCacheMetadata($cache_name = ''){
		if(empty($cache_name))
			return null;
		
		$this->load->driver('cache', array('backup' => 'file'));
		return $this->cache->file->get_metadata($cache_name);
	}
	
	protected function isCacheExist($cache_name = ''){
		if(empty($cache_name)|| !$this->config->item('enable_cache'))
			return false;
		
		//$this->load->driver('cache', array('backup' => 'file'));
		$this->load->helper('file');
		$files = get_filenames('application/cache/');
		
		return in_array($cache_name, $files);
	}
}