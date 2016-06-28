<?php
$count_notif = $count_message = $count_view_all = $click_active = $list_title = '';
$identitas = check_session('identitas');
if($identitas!=FALSE){
	if($identitas['type']=='brand'){
		$header = mysql_query('SELECT count(id) total FROM brief WHERE warning_notif="brand" AND user_id="'.$identitas['id_user'].'" AND admin_id!=""');
		$data_header = mysql_fetch_object($header);
		
		$header2 = mysql_query('SELECT id,ref_id,admin_id,description,status_brand FROM brief WHERE user_id="'.$identitas['id_user'].'" AND admin_id!="" ORDER BY date_created DESC LIMIT 5');
		while($data_header2 = mysql_fetch_object($header2)){
			$desc = strip_tags($data_header2->description);
			$id	  =	$data_header2->id;
			$user_id = $data_header2->admin_id;
			$header3 = mysql_query('SELECT id,title,description FROM brief WHERE id="'.$data_header2->ref_id.'"');
			$data_header3 = mysql_fetch_object($header3);
			$title = strip_tags($data_header3->title);
			$status_brand = ($data_header2->status_brand=='open'?' Belum diklik':' Sudah diklik');
			$id_master = $data_header3->id;
			$list_title.= '
				<li>
					<div class="md-list-addon-element">
						<span class="md-user-letters md-bg-cyan">'.$user_id.'</span>
					</div>
					<div class="md-list-content">
						<span class="md-list-heading"><a href="'.base_url().'brief_detail/'.$id_master.'/'.$id.'.html">Reply to '.$title.'</a></span>
						<span class="uk-text-small uk-text-muted">'.$desc.$status_brand.'</span>
					</div>
				</li>
			';
			$click_active = 'ok';
		}
		
		$count_notif = ($data_header->total!=0?'<span class="uk-badge action_notif icon_notif">'.$data_header->total.'</span>':'');
		$count_message = $data_header->total;
		if((int)$data_header->total>5){
			$count_view_all = '
			<div class="uk-text-center uk-margin-top uk-margin-small-bottom">
				<a href="page_mailbox.html" class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent">Show All</a>
			</div>';
		}
	}
}
?>
<header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
            
                <!-- secondary sidebar switch -->
                
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE5D0;</i></a></li>
                        <li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>
                        <li <?php echo ($click_active!=''?'data-uk-dropdown="{mode:\'click\',pos:\'bottom-right\'}"':'')?>>
                            <a href="#" class="user_action_icon action_notif"><i class="material-icons md-24 md-light">&#xE7F4;</i><?php echo $count_notif?></a>
                            <div class="uk-dropdown uk-dropdown-xlarge">
                                <div class="md-card-content">
                                    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#header_alerts',animation:'slide-horizontal'}">
                                        <li class="uk-width-1-1 uk-active"><a href="#" class="js-uk-prevent uk-text-small">Messages (<?php echo $count_message?>)</a></li>
                                    </ul>
                                    <ul id="header_alerts" class="uk-switcher uk-margin">
                                        <li>
                                            <ul class="md-list md-list-addon">
                                                <?php echo $list_title?>
                                            </ul>
                                            <?php echo $count_view_all?>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image"><img class="md-user-image" src="<?php echo base_url()?>assets/img/avatars/avatar_11_tn.png" alt=""/></a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="page_user_profile.html">My profile</a></li>
                                    <li><a href="page_settings.html">Settings</a></li>
                                    <li><a href="login.html">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form uk-autocomplete" data-uk-autocomplete="{source:'data/search_data.json'}">
                <input type="text" class="header_main_search_input" />
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
                <script type="text/autocomplete">
                    <ul class="uk-nav uk-nav-autocomplete uk-autocomplete-results">
                        {{~items}}
                        <li data-value="{{ $item.value }}">
                            <a href="{{ $item.url }}">
                                {{ $item.value }}<br>
                                <span class="uk-text-muted uk-text-small">{{{ $item.text }}}</span>
                            </a>
                        </li>
                        {{/items}}
                    </ul>
                </script>
            </form>
        </div>
    </header>