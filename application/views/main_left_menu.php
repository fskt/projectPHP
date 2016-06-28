<?php
$menu1 = $menu2 = $menu3 = $menu4 = $menu5 = $menu6 = $menu7 = '';
$segment = $this->uri->segment(1);
if($segment=='user' || $segment=='dashboard' || $segment=='edit_profile'){
	$menu1 = 'class="current_section"';
}elseif($segment=='brief' || $segment=='brief_detail' || $segment=='create_brief'){
	$menu2 = 'class="current_section"';
}elseif($segment=='report' || $segment=='report_youtube' || $segment=='report_instagram' || $segment=='report_facebook' || $segment=='report_twitter' || $segment=='report_detail'){
	$menu3 = 'class="current_section"';
}elseif($segment=='youtube_recent' || $segment=='youtube_recent_log'){
	$menu4 = 'class="current_section"';
}elseif($segment=='instagram_recent' || $segment=='instagram_recent_log'){
	$menu5 = 'class="current_section"';
}elseif($segment=='post_instagram'){
	$menu6 = 'class="current_section"';
}elseif($segment=='post_youtube'){
	$menu7 = 'class="current_section"';
}

?>
<aside id="sidebar_main">
        
        <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <!-- <a href="index.html" class="sSidebar_hide"><img src="<?php echo base_url()?>assets/img/logo_main.png" alt="" height="15" width="71"/></a>
                <a href="index.html" class="sSidebar_show"><img src="<?php echo base_url()?>assets/img/logo_main_small.png" alt="" height="32" width="32"/></a> -->
                <a href="dashboard.html" class="current-logo"><img src="<?php echo base_url()?>assets/img/logo_main.png" alt="" height="45" width="200"/></a>
				
				
				
            </div>

        </div>
        
        <div class="menu_section">
            <ul>
                <li <?php echo $menu1?> title="Creator">
                    <a href="<?php echo base_url()?>dashboard.html">
                        <span class="menu_icon"><i class="fa fa-diamond fa-lg" aria-hidden="true"></i></span>
                        <span class="menu_title">Creator</span>
                    </a>
                </li>
				<?php
				$identitas = check_session('identitas');
				if($identitas['type']=='brand'){
					echo '
					<li '.$menu2.' title="Create Brief">
						<a href="'.base_url().'brief.html">
							<span class="menu_icon"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></span>
							<span class="menu_title">Brief</span>
						</a>
					</li>
					<li '.$menu3.' title="Report">
						<a href="'.base_url().'report.html">
							<span class="menu_icon"><i class="fa fa-line-chart fa-lg" aria-hidden="true"></i></span>
							<span class="menu_title">Report</span>
						</a>
					</li>
					';
				}elseif($identitas['type']=='creator'){
					echo '
					<li '.$menu4.' title="Youtube Recents">
						<a href="'.base_url().'youtube_recent.html">
							<span class="menu_icon"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></span>
							<span class="menu_title">Youtube Recent</span>
						</a>
					</li>
					<li '.$menu5.' title="Instagram Recents">
						<a href="'.base_url().'instagram_recent.html">
							<span class="menu_icon"><i class="fa fa-line-chart fa-lg" aria-hidden="true"></i></span>
							<span class="menu_title">Instagram Recent</span>
						</a>
					</li>
					<li '.$menu6.' title="Instagram Recents">
						<a href="'.base_url().'post_instagram.html">
							<span class="menu_icon"><i class="fa fa-line-chart fa-lg" aria-hidden="true"></i></span>
							<span class="menu_title">Time Post Instagram</span>
						</a>
					</li>
					<li '.$menu7.' title="Instagram Recents">
						<a href="'.base_url().'post_youtube.html">
							<span class="menu_icon"><i class="fa fa-line-chart fa-lg" aria-hidden="true"></i></span>
							<span class="menu_title">Time Post Youtube</span>
						</a>
					</li>
					';
				}
				?>
            </ul>
        </div>
    </aside>