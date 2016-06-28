<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends MY_Controller {
	public function index(){
		$this->load->model('UserModel');
		$path_config = $this->config->item('path_config');
		$param = array();
		$param['client_id'] = $path_config['instagram']['client_id'];
		$param['client_secret'] = $path_config['instagram']['client_secret'];
		$param['grant_type'] = 'authorization_code';
		$param['redirect_uri'] = $path_config['instagram']['client_redirect'];
		$param['code'] = $_GET['code'];	
		
		$ch = curl_init($path_config['instagram']['access_token_url']);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $param);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		$results = json_decode($result,true);
		$access_token = $results['access_token'];
		$query 		 = $this->getUserData($access_token);
		$cekCreator  = $this->UserModel->checkCreator($query['data']['id'],'creator');
		if($cekCreator!=null){
			$userdata = array(
				   'id_user'  => $cekCreator[0]['id'],
				   'id_c' => $cekCreator[0]['user_id'],
				   'type'     => $cekCreator[0]['type']
			 );
			$this->session->set_userdata('identitas',$userdata);
			
			$query_media = $this->getUserMedia($access_token);
			/*Youtube*/
			$username = 'taylorgangent';
			$query_youtube = $this->statisticYoutube($username);
			/*Youtube*/
			
			$param = array();
			$param['user_id'] 		 = $query['data']['id'];
			$param['username'] 		 = $query['data']['username'];
			$param['full_name'] 	 = $query['data']['full_name'];
			$param['bio'] 			 = $query['data']['bio'];
			$param['profile_picture']= $query['data']['profile_picture'];
			$param['media'] 		 = $query['data']['counts']['media'];
			$param['followed_by'] 	 = $query['data']['counts']['followed_by'];
			$param['follows'] 		 = $query['data']['counts']['follows'];
			$param['medias'] 		 = $query_media;
			$param['y_subs'] 		 = $query_youtube['items'][0]['statistics']['subscriberCount'];
			$param['y_media'] 		 = $query_youtube['items'][0]['statistics']['videoCount'];
			$param['y_channelId'] 	 = $query_youtube['items'][0]['id'];
			$param 					 = (object) $param;
			$this->UserModel->updateUserData($param);
			
			redirect(base_url().'user/'.$query['data']['username'].'/youtube');
			//redirect(base_url().'dashboard.html');
			/*
			2725597 = reza_levi | 13021985
			3246426221 = frans_tunti
			202551088 = saya_yasa |tes123
			*/
			/*
			$username = array('reza_levi','saya_yasa');
			$user_id = $this->getUserID($username,$access_token);
			
			$a = array();
			foreach($user_id as $k => $v){
				$a[] = $this->printFollowed($k,$access_token);
			}
			var_dump($a);
			*/
			//$user_followed = $this->printFollowed($access_token);
			//var_dump($user_followed);
		}else{
			redirect(base_url());
		}
	}
	
	private function statisticYoutube($username){
		$path_config = $this->config->item('path_config');
		$url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername='.$username.'&key='.$path_config['youtube']['key'];
		$instagramInfo = $this->connectToInstagram($url);
		$results = json_decode($instagramInfo,true);
		return ($results);
	}
	
	private function connectToInstagram($url){
		$ch = curl_init();
		curl_setopt_array($ch,array(
			CURLOPT_URL =>$url,
			CURLOPT_RETURNTRANSFER =>true,
			CURLOPT_SSL_VERIFYPEER =>false,
			CURLOPT_SSL_VERIFYHOST =>2
		));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	
	private function getUserID($username,$access_token){
		$arr = array();
		foreach($username as $v){
			$url = 'https://api.instagram.com/v1/users/search?q='.urlencode($v).'&access_token='.$access_token.'';
			$instagramInfo = $this->connectToInstagram($url);
			$results   = json_decode($instagramInfo,true);
			$username  = $results['data'][0]['username'];
			$full_name = $results['data'][0]['full_name'];
			$id 	   = $results['data'][0]['id'];
			$bio	   = $results['data'][0]['bio'];
			$arr[$id] = array('id'=>$id,'full_name'=>$full_name,'username'=>$username,'bio'=>$bio);
		}
		return ($arr);
	}
	
	private function getUserData($access_token){
		$url = 'https://api.instagram.com/v1/users/self/?access_token='.$access_token;
		$instagramInfo = $this->connectToInstagram($url);
		$results = json_decode($instagramInfo,true);
		return ($results);
	}
	
	private function getUserMedia($access_token){
		$url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$access_token;
		$instagramInfo = $this->connectToInstagram($url);
		$results = $instagramInfo;
		return ($results);
	}
	
	private function printImage($user_id,$access_token){
		$path_config = $this->config->item('path_config');
		$url = 'https://api.instagram.com/v1/users/'.$user_id.'/media/recent/?access_token='.$access_token;
		$instagramInfo = $this->connectToInstagram($url);
		$results = json_decode($instagramInfo,true);
		return ($results);
	}
	
}
