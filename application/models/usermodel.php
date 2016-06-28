<?php
class Usermodel extends CI_Model {
    function __construct(){
        parent::__construct();
    }
	
	function updateUserData($param){
		$user_id = $this->db->escape($param->user_id);
		$username = $this->db->escape($param->username);
		$full_name = $this->db->escape($param->full_name);
		$bio = $this->db->escape($param->bio);
		$profile_picture = $this->db->escape($param->profile_picture);
		$followed_by = $this->db->escape($param->followed_by);
		$follows = $this->db->escape($param->follows);
		$media = $this->db->escape($param->media);
		$medias = $this->db->escape($param->medias);
		$y_subs = $this->db->escape($param->y_subs);
		$y_media = $this->db->escape($param->y_media);
		
		$n = null;
		
		$query = $this->db->query('SELECT id FROM users WHERE user_id='.$user_id.' LIMIT 1');
		$row = $query->row();
		$id_max = $row->id;
		if($row==null){
			$sql = "INSERT INTO users (user_id, username, full_name, bio, profile_picture, followed_by, follows, media) VALUES (".$user_id.", ".$username.", ".$full_name.", ".$bio.", ".$profile_picture.", ".$followed_by.", ".$follows.", ".$media.")";
			$this->db->query($sql);
			
			$sql = $this->db->query('SELECT MAX(id) FROM users');
			$row = $query->row();
			$id_max = $row->id;
			
			$sql = $this->db->query('SELECT yt_username FROM youtubes WHERE user_id ='.$user_id);
			$row = $query->row();
			$yt_youtube = $row->yt_username;
			$n = array('id_table'=>$id_max,'yt_youtube'=>$yt_youtube);
		}else{
			$sql = "UPDATE users SET username = ".$username.", full_name=".$full_name.", bio=".$bio.", profile_picture=".$profile_picture.", followed_by=".$followed_by.", follows=".$follows.", media =".$media." WHERE user_id=".$user_id."";
			$this->db->query($sql);	
			
			$sql = $this->db->query('SELECT yt_username FROM youtubes WHERE user_id ='.$user_id);
			$row = $sql->row();
			$yt_youtube = $row->yt_username;
			$n = array('id_table'=>$id_max,'yt_youtube'=>$yt_youtube);
		}
		
		//medias
		$query = $this->db->query('SELECT id FROM medias WHERE user_id='.$user_id);
		$row = $query->row();
		if($row==null){
			$sql = "INSERT INTO medias (user_id, media_data) VALUES (".$user_id.", ".$medias.")";
			$this->db->query($sql);
			$sql = "INSERT INTO contents_recent (id_creator, data) VALUES (".$user_id.", ".$medias.")";
			$this->db->query($sql);
		}else{
			$sql = "UPDATE medias SET media_data = ".$medias." WHERE user_id=".$user_id."";
			$this->db->query($sql);
			$sql = "UPDATE contents_recent SET data = ".$medias." WHERE id_creator=".$user_id."";
			$this->db->query($sql);	
		}
		return $n;
	}
	
	function showUser($type){
		$query = $this->db->query('SELECT user_id,username,full_name,bio,profile_picture,followed_by,follows,media FROM users WHERE type="'.$type.'"');
		return $query->result_array();
	}
	
	function getUserDetail($username,$type){
		$username = $this->db->escape($username);
		$query = $this->db->query('SELECT user_id,username,full_name,bio,profile_picture,followed_by,follows,media,youtube_subscriber,youtube_media,youtube_comment,youtube_view,youtube_channelId FROM users WHERE username='.$username.' AND type="'.$type.'"');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$data_user = $query->result_array();
			$query_media = $this->db->query('SELECT media_data FROM medias WHERE user_id='.$row->user_id);
			$n = array('data_user'=>$data_user,'data_media'=>$query_media->result_array());
		}
		return $n;
	}
	
	function uploadBrief($param){
		$sql = "INSERT INTO brief (user_id, sosmed, creator, start_end_date, title, description, image_upload, date_created) VALUES ('".$param->user_id."', '".implode('[SPLIT]',$param->checkbox_sosmed)."', '".implode('[SPLIT]',$param->creator)."', '".$param->start_date."[SPLIT]".$param->end_date."', '".$param->title."','".$param->description."', '".$param->image_upload."', '".$param->date_created."')";
		$this->db->query($sql);
	}
	
	function checkUserLogin($param){
		$query = $this->db->query('SELECT id,type FROM users WHERE email="'.$param->email.'" AND pass="'.crypt($param->password,'Cryppptth1sus2r').'" AND type ="'.$param->type.'" AND status ="'.$param->status.'"');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$n = $query->result_array();
		}
		return $n;
	}
	
	function checkCreator($user_id,$type){
		$query = $this->db->query('SELECT id,user_id,type FROM users WHERE user_id='.$user_id.' AND type="'.$type.'"');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$n = $query->result_array();
		}
		return $n;
	}
	
	function userSignUp($param){
		$email = $this->db->escape($param->email);
		$password = $this->db->escape($param->password);
		$name = $this->db->escape($param->name);
		$company = $this->db->escape($param->company);
		
		$query = $this->db->query('SELECT status FROM users WHERE email="'.$email.'" AND type ="brand"');
		$row = $query->row();
		if($row==null){
			$sql = "INSERT INTO users (full_name, pass, company, email) VALUES (".$name.", '".crypt($password,'Cryppptth1sus2r')."', ".$company.", ".$email.")";
			$this->db->query($sql);
			$n = null;
		}else{
			$n = $query->result_array();
		}
		return $n;
	}
	
	function updateStatusUserBrand($param){
		$email = $this->db->escape($param->email);
		$query = $this->db->query('SELECT status FROM users WHERE email='.$email.' AND type ="brand"');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$sql = "UPDATE users SET status = 'accept' WHERE email=".$email;
			$this->db->query($sql);
			$n = 1;
		}
		return $n;
	}
	
	function resetPasswordBrand($param){
		$email = $this->db->escape($param->email);
		$password = $param->password;
		$query = $this->db->query('SELECT id FROM users WHERE email='.$email.' AND type ="brand" AND status="accept"');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$sql = "UPDATE users SET pass_temp = '".crypt($password,'Cryppptth1sus2r')."' WHERE email=".$email;
			$this->db->query($sql);
			$n = 1;
		}
		return $n;
	}
	
	function updatePasswordBrand($param){
		$email = $this->db->escape($param->email);
		$key   = $param->key;
		$query = $this->db->query('SELECT id FROM users WHERE email='.$email.' AND pass_temp="'.$key.'" AND type ="brand" AND status="accept"');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$sql = "UPDATE users SET pass = '".$key."', pass_temp='' WHERE email=".$email;
			$this->db->query($sql);
			$n = 1;
		}
		return $n;
	}
	
	function getUserCreator($param){
		$id = $this->db->escape($param->id);
		$id_c = $this->db->escape($param->id_c);
		$query = $this->db->query('SELECT username,full_name,bio,profile_picture,followed_by,follows,media FROM users WHERE id='.$id.' AND user_id='.$id_c.' AND type ="creator" AND status="accept" '.(isset($param->flag)?'AND username="'.$param->username.'"':'').'');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$n = $row;
		}
		return $n;
	}
	
	function updateUserCreator($param){
		$username = $param->username;
		$bio = $this->db->escape($param->bio);
		$id = $this->db->escape($param->id);
		$id_c = $this->db->escape($param->id_c);
		$sql = 'UPDATE users SET bio='.$bio.' WHERE id='.$id.' AND user_id='.$id_c.' AND type ="creator" AND status="accept" AND username="'.$username.'"';
		$this->db->query($sql);
	}
	
	function getBriefs($param){
		$id_user = $this->db->escape($param->id_user);
		$id_ref = $this->db->escape($param->id_ref);
		$query = $this->db->query('SELECT * FROM brief WHERE (user_id='.$id_user.' AND ref_id='.$id_ref.') '.($id_ref!='0'?'OR id='.$id_ref:'').' ORDER BY date_created DESC');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			if($id_ref!='0'){
				$sql = 'UPDATE brief SET status_brand="clicked" WHERE id='.$id_ref.' AND user_id='.$id_user;
				$this->db->query($sql);
			}
			
			if(isset($param->id_refs) && $param->id_refs!=null){
				$sql = 'UPDATE brief SET status_brand="clicked" WHERE id="'.$param->id_refs.'"';
				$this->db->query($sql);
			}
			$n = array('results'=>$query->result(),'counts'=>$query->num_rows());
		}
		return $n;
	}
	
	function reMessage($param){
		$id_user = $this->db->escape($param->id_user);
		$id_ref = $this->db->escape($param->id_ref);
		$description = $this->db->escape($param->description);
		$query = $this->db->query('SELECT id FROM brief WHERE user_id='.$id_user.' AND id='.$id_ref.' LIMIT 1');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$date_created = date('Y-m-d H:i:s');
			$sql = "INSERT INTO brief (ref_id, user_id, description, date_created) VALUES (".$id_ref.", ".$id_user.", ".$description.", '".$date_created."')";
			$this->db->query($sql);
			$n = 1;
		}
		return $n;
	}
	
	function updateActionNotif($param){
		$sql = 'UPDATE brief SET warning_notif="" WHERE admin_id!="" AND user_id="'.$param->user_id.'"';
		$this->db->query($sql);
	}
	
	function getReports($param){
		$type = $this->db->escape($param->type);
		$id_brand = $this->db->escape($param->id_brand);
		$query = $this->db->query('SELECT a.*,b.username,b.full_name,b.profile_picture FROM reports a LEFT JOIN users b ON a.id_user_creator = b.id WHERE a.id_user_brand='.$id_brand.' AND a.type_content='.$type.' LIMIT '.$param->page.','.$param->itemPerPage.'');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$n = $query->result();
		}
		return $n;
	}
	
	function countReport($param){
		$type = $this->db->escape($param->type);
		$id_brand = $this->db->escape($param->id_brand);
		$query = $this->db->query('SELECT count(id) id FROM reports WHERE id_user_brand='.$id_brand.' AND type_content='.$type.'');
		$row = $query->row();
		return $row->id;
	}
	
	function getReportsDetail($param){
		$id = $this->db->escape($param->id);
		$id_brand = $this->db->escape($param->id_brand);
		$query = $this->db->query('SELECT a.*,b.username,b.full_name,b.profile_picture,c.instagram_image,c.instagram_title,c.youtube_image,c.youtube_title,d.demographics,d.geography FROM reports a LEFT JOIN users b ON a.id_user_creator = b.id LEFT JOIN contents c ON a.id_content = c.id_content LEFT JOIN youtubes_analytics d ON a.id_content = d.id_video WHERE a.id_user_brand='.$id_brand.' AND a.id='.$id);
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$n = $row;
		}
		return $n;
	}
	
	function contentMedia($param){
		$user_id = $this->db->escape($param->user_id);
		$type = $this->db->escape($param->type);
		
		$query = $this->db->query('SELECT user_id FROM users WHERE id='.$user_id.' AND type="creator"');
		$row = $query->row();
		$user_id = $row->user_id;
		$query = $this->db->query('SELECT * FROM contents_recent WHERE id_creator="'.$user_id.'" AND type='.$type);
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$n = $query->result_array();
		}
		return $n;
	}
	
	function dataBrand(){
		$query = $this->db->query('SELECT username,full_name,profile_picture FROM users WHERE type="brand"');
		return $query->result_array();
	}
	
	function postToReport($param){
		$id_content = $this->db->escape($param->id_content);
		$creator_id = $this->db->escape($param->creator_id);
		$brand_name = $this->db->escape($param->brand_name);
		$title = $this->db->escape($param->title);
		$image = $this->db->escape($param->image);
		$type = $this->db->escape($param->type);
		$start_date = $this->db->escape($param->start_date);
		$end_date = $this->db->escape($param->end_date);
		$date_range = date('Y-m-d',strtotime($param->start_date)).'[SPLIT]'.date('Y-m-d',strtotime($param->end_date));
		$query = $this->db->query('SELECT id FROM users WHERE username='.$brand_name.' AND type="brand"');
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$id_user_brand = $row->id;
			$query = $this->db->query('SELECT id FROM reports WHERE id_user_creator='.$creator_id.' AND id_user_brand="'.$id_user_brand.'" AND id_content = '.$id_content.' AND type_content='.$type);
			$row = $query->row();
			if($row==null){
				$date_created = date('Y-m-d H:i:s');
				$sql = "INSERT INTO reports (id_user_creator, id_user_brand, id_content, date_created, date_range,type_content) VALUES (".$creator_id.", '".$id_user_brand."', ".$id_content.", '".$date_created."', '".$date_range."',".$type.")";
				$this->db->query($sql);
				
				$sql = "INSERT INTO contents (id_content, ".$param->type."_image, ".$param->type."_title) VALUES (".$id_content.", ".$image.", ".$title.")";
				$this->db->query($sql);
				$n = 1;
			}else{
				$n = null;	
			}
		}	
		return $n;
	}
	
	function dataUpdateMedia($param){
		$id_tables = $this->db->escape($param->id_tables);
		$y_subs = $this->db->escape($param->y_subs);
		$y_media = $this->db->escape($param->y_media);
		$y_view = $this->db->escape($param->y_view);
		$y_comment = $this->db->escape($param->y_comment);
		$creator_id = $this->db->escape($param->user_id);
		$medias = $this->db->escape($param->y_data);
		
		$sql = 'UPDATE users SET youtube_subscriber='.$y_subs.',youtube_media='.$y_media.',youtube_view='.$y_view.',youtube_comment='.$y_comment.',youtube_channelId="'.$param->y_channelId.'" WHERE id='.$id_tables.'';
		$this->db->query($sql);
		
		$query = $this->db->query('SELECT id FROM contents_recent WHERE id_creator='.$creator_id.' AND type="youtube"');
		$row = $query->row();
		if($row==null){
			$sql = "INSERT INTO contents_recent (id_creator, data, type) VALUES (".$creator_id.", ".$medias.", 'youtube')";
			$this->db->query($sql);
		}else{
			$sql = "UPDATE contents_recent SET data =".$medias." WHERE id_creator=".$creator_id." AND type='youtube'";
			$this->db->query($sql);
		}
	}
	
	function contentMediaLog($param){
		$user_id = $this->db->escape($param->user_id);
		$type = $this->db->escape($param->type);
		
		$query = $this->db->query('SELECT a.date_created,a.date_updated,a.date_range,a.type_content,b.instagram_image,b.instagram_title,b.youtube_image,b.youtube_title,c.username,c.full_name FROM reports a LEFT JOIN contents b ON a.id_content = b.id_content LEFT JOIN users c ON a.id_user_brand = c.id WHERE a.id_user_creator='.$user_id.' AND a.type_content='.$type);
		$row = $query->row();
		if($row==null){
			$n = null;
		}else{
			$n = $query->result_array();
		}
		return $n;
	}
	
	function setInstagramPost($param){
		$idc = $this->db->escape($param->id_c);
		$caption = $this->db->escape($param->caption);
		$image = $this->db->escape($param->image);
		$date_post = $this->db->escape($param->date_post);
		$sql = "INSERT INTO instagram_post (id_creator, caption, file_upload, date_post) VALUES (".$idc.", ".$caption.", ".$image.",".$date_post.")";
		$this->db->query($sql);
	}
	
	function setYoutubePost($param){
		$idc = $this->db->escape($param->id_c);
		$title = $this->db->escape($param->title);
		$description = $this->db->escape($param->description);
		$video = $this->db->escape($param->video);
		$date_post = $this->db->escape($param->date_post);
		$sql = "INSERT INTO youtube_post (id_creator, title, description, file_upload, date_post) VALUES (".$idc.", ".$title.", ".$description.",  ".$video.",".$date_post.")";
		$this->db->query($sql);
	}
	
}	


