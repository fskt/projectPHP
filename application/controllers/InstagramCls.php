<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InstagramCls extends MY_Controller {
	public function index(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($identitas['type']=='creator'){
				if ($_SERVER["REQUEST_METHOD"] == "POST"){
					$caption		 = $_POST['caption'];
					$date_post 	     = $_POST['date_post'];
					$image_name 	 = ($_FILES['upload_file']["name"]?(time()+1):'').$_FILES['upload_file']["name"];
					$image_temp  	 = $_FILES['upload_file']["tmp_name"];
					$image_size 	 = $_FILES['upload_file']["size"];
					
					if($caption!=null){
						$message = '';
						$target_dir = 'upload_file/instagram/';
						$target_file = $target_dir . basename($image_name);
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						$temp_name_img = clean_text(str_replace('.'.$imageFileType,'',$image_name)).'.'.strtolower($imageFileType);
						$target_file = $target_dir . basename($temp_name_img);
						
						$check = getimagesize($image_temp);
						if($check !== false) {
							$uploadOk = 1;
						} else {
							$message.= "- File is not an image.<br/>";
							$uploadOk = 0;
						}
						
						if ($image_size > 500000) {
							$message.= "- Sorry, your file is too large. Max 500kb<br/>";
							$uploadOk = 0;
						}
						
						if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg"
						&& strtolower($imageFileType) != "gif" ) {
							$message.= "- Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br/>";
							$uploadOk = 0;
						}
						
						if($check==null){
							$uploadOk = 1;
							$message = '';
						}
						
						if ($uploadOk == 0) {
							$info = "Warning : <br/>".$message;
							$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">'.$info.'</div>');
						} else {
							if (move_uploaded_file($image_temp, $target_file)) {
								
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
								$param['caption'] = $caption;
								$param['image'] = $temp_name_img;
								$param['date_post'] = $date_post;
								$param = (object) $param;
								$this->UserModel->setInstagramPost($param);
								$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Success Upload to Post at '.date('d M Y H:i',strtotime($date_post)).'</div>');
							} else {
								$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Sorry, there was an error uploading your file.</div>');
							}
						}	
					}else{
						$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Please complete input data</div>');
					}
					redirect(base_url().'post_instagram.html');
					
				}
				$n = '';
				$message = $this->session->flashdata('message');
				if($message!=FALSE){
					$n = $message;
				}
				$data['message'] = $n;
				$this->load->view('templates/formInstagram.php',$data);				
			}else{
				redirect(base_url().'post_instagram.html');
			}
		}else{
			redirect(base_url());
		}
	}
}
