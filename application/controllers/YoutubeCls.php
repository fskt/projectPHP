<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class YoutubeCls extends MY_Controller {
	public function index(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($identitas['type']=='creator'){
				if ($_SERVER["REQUEST_METHOD"] == "POST"){
					$title		 	 = $_POST['title'];
					$description	 = $_POST['description'];
					$date_post 	     = $_POST['date_post'];
					$video_name 	 = ($_FILES['upload_file']["name"]?(time()+1):'').$_FILES['upload_file']["name"];
					$video_temp  	 = $_FILES['upload_file']["tmp_name"];
					$video_size 	 = $_FILES['upload_file']["size"];
					
					if($title!=null && $description!=null){
						$message = '';
						$target_dir = 'upload_file/youtube/';
						$target_file = $target_dir . basename($video_name);
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						//$temp_name_video = clean_text(str_replace('.'.$imageFileType,'',$video_name)).'.'.strtolower($imageFileType);
						$temp_name_video = (time()+1).'.'.strtolower($imageFileType);
						$target_file = $target_dir . basename($temp_name_video);
						
						
						if ($video_size > 500000) {
							$message.= "- Sorry, your file is too large. Max 500kb<br/>";
							$uploadOk = 0;
						}
						
						if(strtolower($imageFileType) != "mp4") {
							$message.= "- Sorry, only mp4 files are allowed.<br/>";
							$uploadOk = 0;
						}
						
						if ($uploadOk == 0) {
							$info = "Warning : <br/>".$message;
							$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">'.$info.'</div>');
						} else {
							if (move_uploaded_file($video_temp, $target_file)) {
								
								/*
								$path_config = $this->config->item('path_config');
								$this->load->model('UserModel');
								$param = array();
								$param['id'] = 	$identitas['id_user'];
								$param['id_c'] = $identitas['id_c'];
								$param = (object) $param;
								$qry = $this->UserModel->getUserCreator($param);
								$username = $qry->username;
								$password = $path_config['instagram']['pass'][$identitas['id_c']];
								$debug    = false;
								$photo = $target_file;
								$i = new Instagram($username, $password, $debug);
								try{
								  $i->login();
								} catch (InstagramException $e){
								  $this->session->set_flashdata('message', '<div class="alert alert-success text-center">'.$e->getMessage().'</div>');
								}
								try {
								  $i->uploadPhoto($photo, $caption);
								  $this->session->set_flashdata('message', '<div class="alert alert-success text-center">Success Post</div>');
								} catch (Exception $e){
									$this->session->set_flashdata('message', '<div class="alert alert-success text-center">'.$e->getMessage().'</div>');
									unlink($photo);
								}
								*/
								$date_post = date('Y-m-d H:i:s');
								$this->load->model('UserModel');
								$param = array();
								$param['id_c'] = $identitas['id_c'];
								$param['title'] = $title;
								$param['description'] = $description;
								$param['video'] = $temp_name_video;
								$param['date_post'] = $date_post;
								$param = (object) $param;
								$this->UserModel->setYoutubePost($param);
								$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Success Upload to Post at '.date('d M Y H:i',strtotime($date_post)).'</div>');
							} else {
								$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Sorry, there was an error uploading your file.</div>');
							}
						}	
					}else{
						$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Please complete input data</div>');
					}
					redirect(base_url().'post_youtube.html');
					
				}
				$n = '';
				$message = $this->session->flashdata('message');
				if($message!=FALSE){
					$n = $message;
				}
				$data['message'] = $n;
				$this->load->view('templates/formYoutube.php',$data);				
			}else{
				redirect(base_url().'post_youtube.html');
			}
		}else{
			redirect(base_url());
		}
	}
}
