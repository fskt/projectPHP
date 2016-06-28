<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function youtube_access_token(){
		$code = $_GET['code'];
		//$url = 'https://www.googleapis.com/youtube/analytics/v1/reports?ids=channel%3D%3DUCo7CX9Vxb_gw1P3xa-IY1Xg&start-date=2001-01-01&end-date=2016-05-01&metrics=views&dimensions=month&grant_type=client_credentials&access_token=4/Yej9Kfms7QO6dpMVg8-nPC3ACzVLFZMcbFLPDQhhhdo';
		
		$url = 'https://www.googleapis.com/youtube/analytics/v1/reports?ids=channel%3D%3DUCo7CX9Vxb_gw1P3xa-IY1Xg&start-date=2016-06-17&end-date=2016-06-30&metrics=views&dimensions=dimensions=ageGroup%2Cgender&key=AIzaSyA1iVSnNbo-vXnAMW7ANU-uSLCab2FqOdA';
		
		/*
		$url = 'https://www.googleapis.com/youtube/analytics/v1/reports?ids=channel%3D%3DMINE&start-date=2014-05-01&end-date=2014-06-30&metrics=views%2CestimatedMinutesWatched&dimensions=day&sort=day%2Cviews&key=AIzaSyClREiPBolLuiXpDcpW37cLdZTwn8Tn8Xs';
		*/
		
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$code)); //setting custom header
		
		$result = curl_exec($curl);
		curl_close($curl);
		print($result);
	}
	
	public function index(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($identitas['type']=='creator'){
				$param = array();
				$param['id'] = 	$identitas['id_user'];
				$param['id_c'] = $identitas['id_c'];
				$param = (object) $param;
				$this->load->model('UserModel');
				$qry = $this->UserModel->getUserCreator($param);
				if($qry==null){
					$this->logout();
					exit;
				}else{
					redirect(base_url().'user/'.$qry->username.'/youtube');
				}
			}else{
				redirect(base_url().'dashboard.html');	
			}
		}else{
			$this->load->view('welcome_message');
		}
	}
	
	public function dashboard(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			$this->load->model('UserModel');
			if($identitas['type']=='creator'){
				$param = array();
				$param['id'] = 	$identitas['id_user'];
				$param['id_c'] = $identitas['id_c'];
				$param = (object) $param;
				$qry = $this->UserModel->getUserCreator($param);
				if($qry==null){
					$this->logout();
					exit;
				}else{
					redirect(base_url().'user/'.$qry->username.'/youtube');
				}
			}else{
				$data['query'] = $this->UserModel->showUser('creator');
				$this->load->view('templates/index_update.php',$data);	
			}
		}else{
			redirect(base_url());
		}
	}
	
	public function user(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			$username = $this->uri->segment(2);
			if($identitas['type']=='creator'){
				$param = array();
				$param['id'] = 	$identitas['id_user'];
				$param['id_c'] = $identitas['id_c'];
				$param['username'] = $username;
				$param['flag'] = 'optional';
				$param = (object) $param;
				$this->load->model('UserModel');
				$qry = $this->UserModel->getUserCreator($param);
				if($qry==null){
					redirect(base_url());
					exit;
				}else{
					$username = $qry->username;
				}
			}
			$tab = $this->uri->segment(3);
			$nopage = $this->uri->segment(4);
			
			if($username==''){
				redirect(base_url());
				exit;
			}else{
				$this->load->model('UserModel');
				$data['query'] = $this->UserModel->getUserDetail($username,'creator');
				if($data['query']==null){
					redirect(base_url());
					exit;
				}else{
					$arr_tab = array('youtube','instagram','twitter','facebook');
					if(in_array(strtolower($tab),$arr_tab)){
						$data['active'] = strtolower($tab);
						$data['username'] = $username;
						if($tab=='youtube'){
							$channelId = $data['query']['data_user'][0]['youtube_channelId'];
							$path_config = $this->config->item('path_config');
							if($channelId!=null){
								$url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId='.$channelId.'&maxResults=6'.(isset($nopage)?'&pageToken='.$nopage:'').'&order=date&key='.$path_config['youtube']['key'];
								$ch = curl_init();
								curl_setopt_array($ch,array(
									CURLOPT_URL =>$url,
									CURLOPT_RETURNTRANSFER =>true,
									CURLOPT_SSL_VERIFYPEER =>false,
									CURLOPT_SSL_VERIFYHOST =>2
								));
								$result = curl_exec($ch);
								curl_close($ch);
								$results = json_decode($result,true);
								$data['youtube_query'] = (!empty($results['items'])?$results['items']:null);
							}else{
								$data['youtube_query'] = null;	
							}
					
							$data['nextPage'] = (empty($results['nextPageToken'])?null:$results['nextPageToken']);
							$data['prevPage'] = (empty($results['prevPageToken'])?null:$results['prevPageToken']);
							$data['dataPerPage'] = 1;
							$data['noPage'] = 1;
						}
						
						if($tab=='instagram'){
							$nopage =($nopage==''?1:is_numeric($nopage)?$nopage:null);
							if($nopage==null){
								redirect(base_url().'user/'.$username.'/'.$tab.'/1');
								exit;
							}
							$data['noPage'] = $nopage;
							$data['dataPerPage'] = 10;
						}
						
						if($tab=='facebook'){
							$data['dataPerPage'] = 1;
							$data['noPage'] = 1;
						}
						
						if($tab=='twitter'){
							$data['dataPerPage'] = 1;
							$data['noPage'] = 1;
						}
						$this->output->cache(5);
						$this->load->view('templates/page_user_profile_update.php',$data);	
							
					}else{
						redirect(base_url().'user/'.$username.'/youtube');
					}
				}
			}
		}else{
			redirect(base_url());
		}
	}
	 public function commentGraph(){		
		echo '[
			{
			"date": "2016-01-01", 
			"value": 2062.025150690567
			}, 
			{
				"date": "2016-01-02", 
				"value": 9490.615524570567
			}
		]';
	 }
	 
	 public function create_brief(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($identitas['type']=='brand'){
				$this->load->model('UserModel');
				if ($_SERVER["REQUEST_METHOD"] == "POST"){
					$user_id		 = $identitas['id_user'];
					@$checkbox_sosmed = $_POST['checkbox_sosmed'];
					@$creator 		 = $_POST['creator'];
					$start_date 	 = ($_POST['start_date']!=''?date('Y-m-d',strtotime($_POST['start_date'])):null);
					$end_date 		 = ($_POST['end_date']!=''?date('Y-m-d',strtotime($_POST['end_date'])):null);
					$title 			 = mysql_real_escape_string(html_entity_decode(htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8')));
					$description     = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
					$description 	 = mysql_real_escape_string(strip_tags(html_entity_decode($description),'<br><b><ul><li><p><strong><i><em><h1><h2><h3><h4><h5><h6>'));
					$image_name 	 = ($_FILES['upload_file']["name"]?(time()+1):'').$_FILES['upload_file']["name"];
					$image_temp  	 = $_FILES['upload_file']["tmp_name"];
					$image_size 	 = $_FILES['upload_file']["size"];
					
					if($checkbox_sosmed!=null && $creator!=null && $start_date!=null && $end_date!=null && $description!=null && $title!=null){
						$message = '';
						$target_dir = 'upload_file/';
						$target_file = $target_dir . basename($image_name);
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						$temp_name_img = clean_text(str_replace('.'.$imageFileType,'',$image_name)).'.'.$imageFileType;
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
							$param = array();
							$param['user_id']  = $user_id;
							$param['checkbox_sosmed']  = $checkbox_sosmed;
							$param['creator']  = $creator;
							$param['start_date']  = $start_date;
							$param['end_date']  = $end_date;
							$param['title'] = $title;
							$param['description'] = $description;
							$param['image_upload']  = $temp_name_img;
							$param['date_created'] = date('Y-m-d H:i:s');
							$param = (object) $param;
							$this->UserModel->uploadBrief($param);
							
							if($check!=null){
								if (move_uploaded_file($image_temp, $target_file)) {
									$this->session->set_flashdata('message', '<div class="alert alert-success text-center">Success Upload</div>');
								} else {
									$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Sorry, there was an error uploading your file.</div>');
								}
							}else{
								$this->session->set_flashdata('message', '<div class="alert alert-success text-center">Success Sent brief</div>');
							}
						}	
					}else{
						$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Please complete input data</div>');
					}
					redirect(base_url().'create_brief.html');
				}else{
					$n = '';
					$message = $this->session->flashdata('message');
					if($message!=FALSE){
						$n = $message;
					}
					$data['message'] = $n;
					$data['query'] = $this->UserModel->showUser('creator');
					$this->load->view('templates/forms_advanced_update.php',$data);
				}
			}else{
				redirect(base_url());
			}
		}else{
			redirect(base_url());
		}
	}
	
	public function brief(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($identitas['type']=='brand'){
				$param = array();
				$param['id_user'] = $identitas['id_user'];
				$param['id_ref'] = 	0;
				$param = (object) $param;
				
				$this->load->model('UserModel');
				$data['query'] = $this->UserModel->getBriefs($param);
				$this->load->view('templates/brief.php',$data);
			}
		}else{
			redirect(base_url());
		}
	}
	
	public function brief_detail(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($identitas['type']=='brand'){
				$id_ref = $this->uri->segment(2);
				$id_refs = $this->uri->segment(3);
				$id_ref =($id_ref!=''?(is_numeric($id_ref)?$id_ref:null):null);
				$id_refs =($id_refs!=''?(is_numeric($id_refs)?$id_refs:null):null);
				if($id_ref==null){
					redirect(base_url().'brief.html');
					exit;
				}
				$this->load->model('UserModel');
				if ($_SERVER["REQUEST_METHOD"] == "POST"){
					$description     = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
					$description 	 = mysql_real_escape_string(html_entity_decode($description));
					$description	 = stripslashes($description);
					preg_match_all('%(https?:\/\/\S+\.(?:jpg|png|gif))%i', $description , $result);
					foreach($result[0] as $v){
						$split = explode('/',$v);
						$nm = end($split);
						if(file_exists('upload_file/image_temp/'.$nm)){
							copy('upload_file/image_temp/'.$nm,'upload_file/image_brief/'.$nm);
							unlink('upload_file/image_temp/'.$nm);
						}
					}
					$description = str_replace('upload_file/image_temp/','upload_file/image_brief/',$description);
					
					$param = array();
					$param['id_user'] = $identitas['id_user'];
					$param['id_ref'] = $id_ref;
					$param['description'] = $description;
					$param = (object) $param;
					$qry = $this->UserModel->reMessage($param);
					if($qry!=null){
						$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Thank you</div>');
					}else{
						$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Please submit again</div>');
					}
					redirect(base_url().'brief_detail/'.$id_ref.'.html');
				}else{
					$n = '';
					$message = $this->session->flashdata('message');
					if($message!=FALSE){
						$n = $message;
					}
					$data['message'] = $n;
					
					$param = array();
					$param['id_user'] = $identitas['id_user'];
					$param['id_ref'] = $id_ref;
					$param['id_refs'] = $id_refs;
					$param = (object) $param;
					
					$data['id_ref'] = $id_ref;
					$data['query'] = $this->UserModel->getBriefs($param);
					
					$this->load->view('templates/brief_detail.php',$data);
				}
			}
		}else{
			redirect(base_url());
		}
	}
	
	public function login(){
		$this->load->model('UserModel');
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$email 		= $_POST['email'];
			$password 	= mysql_real_escape_string($_POST['pass']);
			$check_email = (!filter_var($email, FILTER_VALIDATE_EMAIL)?'invalid':$email);
			if($check_email!='invalid' && $password!=null){
				$param = array();
				$param['email']  = $email;
				$param['password']  = $password;
				$param['type']  = 'brand';
				$param['status']  = 'accept';
				$param = (object) $param;
				$query = $this->UserModel->checkUserLogin($param);
				if($query!=null){
					$userdata = array(
						   'id_user'  => $query[0]['id'],
						   'type'     => $query[0]['type']
					 );
					$this->session->set_userdata('identitas',$userdata);
					redirect(base_url().'dashboard.html');	
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Please login again</div>');
					redirect(base_url().'login.html');
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Please login again</div>');
				redirect(base_url().'login.html');
			}
		}else{
			$n = '';
			$message = $this->session->flashdata('message');
			if($message!=FALSE){
				$n = $message;
			}
			$data['message'] = $n;
			$data['query'] = $this->UserModel->showUser('creator');
			$this->load->view('templates/login.php',$data);
		}
	}
	
	public function logout() {
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			$this->session->unset_userdata('identitas');
			session_destroy();
		}
		redirect(base_url());
	}
	
	public function report($type='',$p=''){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($identitas['type']=='brand'){
				$active_youtube = $active_instagram = $active_facebook = $active_twitter = '';
				if($type=='youtube'){
					$active_youtube = 'active';
					$url = 'report_youtube';
				}elseif($type=='instagram'){
					$active_instagram = 'active';
					$url = 'report_instagram';
				}elseif($type=='facebook'){
					$active_facebook = 'active';
					$url = 'report_facebook';
				}elseif($type=='twitter'){
					$active_twitter = 'active';
					$url = 'report_twitter';
				}else{
					$type = 'youtube';
					$active_youtube = 'active';
					$url = 'report_youtube';
				}
				$this->load->model('UserModel');
				$param = array();
				$param['type']  = $type;
				$param['id_brand']  = $identitas['id_user'];
				$param['itemPerPage']  = 10;
				$param['page']  = ($this->uri->segment(2))?$this->uri->segment(2):0;
				$param = (object) $param;
				$qry = $this->UserModel->getReports($param);
				$data['query'] = $qry;
				$countContent = $this->UserModel->countReport($param);
				
				$this->load->library('pagination');
				$config['base_url'] = base_url().$url.'/';
				$config['total_rows'] = $countContent;
				$config['per_page'] = 10;
				$config['uri_segment'] = 2;
				$config['num_links'] = 2;
				$config['full_tag_open'] = '<ul class="uk-pagination uk-margin-medium-top">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="uk-active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				
				$this->pagination->initialize($config); 
				$data['paging'] = $this->pagination->create_links();
				
				$data['active'] = array('active_youtube'=>$active_youtube, 'active_instagram'=>$active_instagram, 'active_facebook'=>$active_facebook,'active_twitter'=>$active_twitter); 
				$this->load->view('templates/report.php',$data);	
			}else{
				redirect(base_url());
			}	
		}else{
			redirect(base_url());
		}
	}
	
	public function signup(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			redirect(base_url());
		}else{
			$this->load->model('UserModel');
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				$email 		= $_POST['register_email'];
				$name 		= mysql_real_escape_string($_POST['register_username']);
				$company 	= mysql_real_escape_string($_POST['register_company']);
				$password 	= mysql_real_escape_string($_POST['register_password']);
				$check_email = (!filter_var($email, FILTER_VALIDATE_EMAIL)?'invalid':$email);
				if($check_email!='invalid' && $password!=null && $name!=null && $company!=null){
					$param = array();
					$param['email']  	= $email;
					$param['password']  = $password;
					$param['name']  	= $name;
					$param['company']  	= $company;
					$param = (object) $param;
					$query = $this->UserModel->userSignUp($param);
					if($query!=null){
						$status = ($query[0]['status']=='accept'?'Anda sudah pernah mendaftar dengan status <b>Approve</b>':($query[0]['status']=='pending'?'Anda belum mengaktifkan akun anda, silahkan periksa kembali email yang pernah kami kirimkan':'Maaf, status email anda :<b>ditolak</b>'));
						$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">'.$status.'</div>');	
					}else{
						$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Silahkan check email anda</div>');
					}
					redirect(base_url().'signup.html');
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Please login again</div>');
					redirect(base_url().'signup.html');
				}
			}else{
				$n = '';
				$message = $this->session->flashdata('message');
				if($message!=FALSE){
					$n = $message;
				}
				$data['message'] = $n;
				$this->load->view('templates/signup.php',$data);
			}
		}
	}
	
	//http://localhost/instagram/verified.html?email_address=frans_tunti@yahoo.com&key=95f22fba314cc132b86e27d2dafbe695
	public function verified(){
		$identitas = check_session('identitas');
		if($identitas==FALSE){
			redirect(base_url());
			exit;
		}
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
			$email 		= $this->input->get('email_address');
			$key 		= $this->input->get('key');
			$check_email = (!filter_var($email, FILTER_VALIDATE_EMAIL)?'invalid':'valid');
			$n = '';
			if($email!='' && $check_email!='invalid' && md5($email)==$key){
				$this->load->model('UserModel');
				$param = array();
				$param['email']  = $email;
				$param = (object) $param;
				$qry = $this->UserModel->updateStatusUserBrand($param);
				if($qry==null){
					$n = '<div class="alert alert-warning text-center">Sorry, your email can not be found in our database</div>';
				}else{
					$n = '<div class="alert alert-success text-center">Your account is already activated. Please Login <a data-toggle="modal" href="#loginModal">here</a></div>';
				}
			}else{
				$n = '<div class="alert alert-warning text-center">Sorry, your email can not be found in our database</div>';
			}
			
			$data['message'] = $n;
			//$this->load->view('forgotpwd_view',$data);
		}else{
			redirect(base_url());
		}
	}
	
	public function report_detail(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($identitas['type']=='brand'){
				$id = ($this->uri->segment(2)!=null?((int)$this->uri->segment(2)!=0?$this->uri->segment(2):null):null);
				if($id!=null){
					$this->load->model('UserModel');
					$param = array();
					$param['id']  = $id;
					$param['id_brand']  = $identitas['id_user'];
					$param = (object) $param;
					$qry = $this->UserModel->getReportsDetail($param);
					if($qry!=null){
						$data['query'] = $qry;
						$this->load->view('templates/report_detail.php',$data);	
					}else{
						redirect(base_url());	
					}
				}else{
					redirect(base_url());
				}
			}else{
				redirect(base_url());
			}
		}else{
			redirect(base_url());
		}
	}
	
	public function forgot_pass(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			redirect(base_url());
			exit;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$email 		= $_POST['email_reset'];
			$password 	= mysql_real_escape_string($_POST['pass']);
			$check_email = (!filter_var($email, FILTER_VALIDATE_EMAIL)?'invalid':$email);
			if($check_email!='invalid' && $password!=null){
				$this->load->model('UserModel');
				$param = array();
				$param['email'] = $email;
				$param['password'] = $password;
				$param = (object) $param;
				$qry = $this->UserModel->resetPasswordBrand($param);
				if($qry==null){
					$n = '<div class="alert alert-warning text-center">Sorry, your email can not be found in our database OR your not yet active your account from email we sent</div>';
					$this->session->set_flashdata('message', $n);
					redirect(base_url().'forgot_password.html');
				}else{
					$format = base_url().'verified_password.html?email_address='.$email.'&key='.crypt($password,'Cryppptth1sus2r');
					echo $format;
					//send to email
				}
			}else{
				$n = '<div class="alert alert-warning text-center">Sorry, please input correctly</div>';
				$this->session->set_flashdata('message', $n);
				redirect(base_url().'forgot_password.html');
			}
		}else{
			$n = '';
			$message = $this->session->flashdata('message');
			if($message!=FALSE){
				$n = $message;
			}
			$data['message'] = $n;
			$this->load->view('templates/forgot_pass.php',$data);
		}
	}
	 
	public function verified_password(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			redirect(base_url());
			exit;
		}
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
			$email 		= $this->input->get('email_address');
			$key 		= $this->input->get('key');
			$check_email = (!filter_var($email, FILTER_VALIDATE_EMAIL)?'invalid':'valid');
			$n = '';
			if($email!='' && $check_email!='invalid' && $key!=null){
				$this->load->model('UserModel');
				$param = array();
				$param['email']  = $email;
				$param['key']  = $key;
				$param = (object) $param;
				$qry = $this->UserModel->updatePasswordBrand($param);
				if($qry==null){
					echo 'gagal';
				}else{
					echo 'sukses';
				}
			}else{
				echo 'masih ada yang salah';
			}
		}else{
			redirect(base_url());
		}
	} 
	
	public function edit_profile($username=""){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($username!=null){
				if($identitas['type']=='creator'){
					$param = array();
					$param['id'] = 	$identitas['id_user'];
					$param['id_c'] = $identitas['id_c'];
					$param = (object) $param;
					$this->load->model('UserModel');
					$qry = $this->UserModel->getUserCreator($param);
					if($_SERVER["REQUEST_METHOD"] == "POST"){
						$description     = htmlspecialchars($_POST['bio'], ENT_QUOTES, 'UTF-8');
						$description 	 = mysql_real_escape_string(strip_tags(html_entity_decode($description),'<br><b><ul><li><p><strong><i><em><h1><h2><h3><h4><h5><h6>'));
						if($qry->username==$username){
							$param = array();
							$param['bio'] = $description;
							$param['username'] = $username;
							$param['id'] = 	$identitas['id_user'];
							$param['id_c'] = $identitas['id_c'];
							$param = (object) $param;
							$this->UserModel->updateUserCreator($param);
							redirect(base_url());
						}else{
							redirect(base_url());
						}						
					}else{
						if($qry==null){
							$this->logout();
							exit;
						}else{
							if($qry->username==$username){
								$data['qry'] = $qry;
								$this->load->view('templates/forms_regular.php',$data);
							}else{
								redirect(base_url());
							}
						}
					}	
				}else{
					redirect(base_url());	
				}	
			}else{
				redirect(base_url());
			}
		}else{
			redirect(base_url());
		}
	}
	
	public function uploadTemp(){
		$image_name = $_FILES['file']["name"];
		$image_temp = $_FILES['file']["tmp_name"];
		
		$target_dir = 'upload_file/image_temp/';
		$target_file = $target_dir.$image_name;
		move_uploaded_file($image_temp, $target_file);
		$json = array('url'=>base_url().$target_file,'title'=>$image_name,'id'=>$image_name);
		echo json_encode($json);
	}
	
	public function action_notif(){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			$this->load->model('UserModel');
			$param = array();
			$param['type']  = 'brand';
			$param['user_id']  = $identitas['id_user'];
			$param = (object) $param;
			$this->UserModel->updateActionNotif($param);
			echo 'yes';
		}else{
			echo 'no';
		}
	}
	
	public function media_recent($type){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($identitas['type']=='creator'){
				$this->load->model('UserModel');
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$id = $_POST['id'];
					$title = $_POST['title'][$id];
					$image = $_POST['image'][$id];
					$brand = $_POST['brand'];
					$start_date = $_POST['start_date'];
					$end_date = $_POST['end_date'];
					
					$param = array();
					$param['id_content'] = $id;
					$param['creator_id']  = $identitas['id_user'];
					$param['brand_name']  = $brand;
					$param['title']  = $title;
					$param['image']  = $image;
					$param['start_date']  = $start_date;
					$param['end_date']  = $end_date;
					$param['type'] = $type;
					$param = (object) $param;
					$qry = $this->UserModel->postToReport($param);
					if($qry!=null){
						$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Sukses submit</div>');
					}else{
						$this->session->set_flashdata('message', '<div class="alert alert-warning text-center">Maaf, data tidak dapat disimpan</div>');
					}					
					redirect(base_url().$type.'_recent.html');
				}else{
					$n = '';
					$message = $this->session->flashdata('message');
					if($message!=FALSE){
						$n = $message;
					}
					$data['message'] = $n;
					
					$param = array();
					$param['user_id']  = $identitas['id_user'];
					$param['type']  = $type;
					$param = (object) $param;
					$data['type_action'] = $type;
					$data['query_creator'] = $this->UserModel->dataBrand();
					$data['query'] = $this->UserModel->contentMedia($param);
					$this->load->view('templates/contentCurrent.php',$data);
				}
			}else{
				redirect(base_url());
			}
		}else{
			redirect(base_url());
		}
	}
	
	public function media_recent_log($type){
		$identitas = check_session('identitas');
		if($identitas!=FALSE){
			if($identitas['type']=='creator'){
				$this->load->model('UserModel');
					
				$param = array();
				$param['user_id']  = $identitas['id_user'];
				$param['type']  = $type;
				$param = (object) $param;
				$data['type_action'] = $type;
				$data['query_creator'] = $this->UserModel->dataBrand();
				$data['query'] = $this->UserModel->contentMediaLog($param);
				$this->load->view('templates/contentCurrentLog.php',$data);				
			}else{
				redirect(base_url());
			}
		}else{
			redirect(base_url());
		}
	}
}
