<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->

<head>

	<?php 
	include '/../head_tag.php';
	?>

</head>
<body class=" sidebar_main_open sidebar_main_swipe">
<?php
$arr = array();

if($type_action=='youtube'){
	$arr = json_decode($query[0]['data'],true);
}elseif($type_action=='instagram'){
	$data_media = (isset($query[0]['data'])?json_decode($query[0]['data'],true):array());
	$count_comment = $count_like = $total_data = 0;
	if(count($data_media)>0){
		foreach($data_media['data'] as $k => $v){
			if($k>4) break;
			$type = $v['type'];
			$total_comment = $v['comments']['count'];
			$filter = $v['filter'];
			$created_time = $v['created_time'];
			$link_intragram = $v['link'];
			$total_like = $v['likes']['count'];
			$images_low_resol = array('url'=>$v['images']['low_resolution']['url'],'width'=>$v['images']['low_resolution']['width'],'height'=>$v['images']['low_resolution']['height']);
			$images_standar_resol = array('url'=>$v['images']['standard_resolution']['url'],'width'=>$v['images']['standard_resolution']['width'],'height'=>$v['images']['standard_resolution']['height']);
			$images_thumbnail = array('url'=>$v['images']['thumbnail']['url'],'width'=>$v['images']['thumbnail']['width'],'height'=>$v['images']['thumbnail']['height']);
			$media_id = $v['id'];
			$caption = array('created_time'=>$v['caption']['created_time'],'text'=>$v['caption']['text']);
			$arr[$type][] = array(
				'id'=>$media_id,
				'total_comment'=>$total_comment,
				'total_like'=>$total_like,
				'images_standar_resol'=>$images_standar_resol,
				'caption'=>$caption,
				'date'=>date('d M Y',$created_time)
			);
		}
	}
}
$option = '';
foreach($query_creator as $v){
	$username = $v['username'];
	$fullname = $v['full_name'];
	$name	  = ($fullname!=''?$fullname:$username);
	$option.='<option value="'.$username.'">'.$name.'</option>';
}
?>
    <!-- main header -->
    <?php 
	include '/../main_header.php';
	?>
	<!-- main header end -->
    <!-- main sidebar -->
    <?php 
	include '/../main_left_menu.php';
	?>
	<!-- main sidebar end -->

    <div id="page_content">
        <div id="page_content_inner">
            <div class="md-card">
                <div class="md-card-content">
                    <?php
					if(count($arr)>0){
						$form = $message.'<form method="post" action="'.base_url().$type_action.'_recent.html">';
						if($type_action=='youtube'){
							foreach($arr as $k => $v){
								$id = (isset($v['id']['videoId'])?$v['id']['videoId']:null);
								if($id!=null){
									$img = $v['snippet']['thumbnails']['high']['url'];
									$title = $v['snippet']['title'];
									$form.= '
										<input type="hidden" name="title['.$id.']" value="'.$title.'">
										<input type="hidden" name="image['.$id.']" value="'.$img.'">
										<input type="radio" name="id" value="'.$id.'">
										<img src="'.$img.'" alt="'.$title.'" width="250"/> 
										<br/>
									';
								}
							}
						}elseif($type_action=='instagram'){
							foreach($arr['image'] as $k => $v){
								$split = parse_url($v['images_standar_resol']['url']);
								$img = $split['scheme'].'://'.$split['host'].$split['path'];
								$form.= '
									<input type="hidden" name="title['.$v['id'].']" value="'.$v['caption']['text'].'">
									<input type="hidden" name="image['.$v['id'].']" value="'.$img.'">
									<input type="radio" name="id" value="'.$v['id'].'">
									<img src="'.$img.'" alt="'.$v['caption']['text'].'" width="250"/> 
									<br/>
								';
							}	
						}
						
						$form.='<br/>Assign to :
								<select name="brand">
									'.$option.'
								</select>';
						$form.='<br/>Date range :
								<div class="uk-grid" data-uk-grid-margin>
									<div class="uk-width-large-1-3 uk-width-medium-1-1">
										<div class="uk-input-group">
											<span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
											<label for="uk_dp_start">Start Date</label>
											<input class="md-input" name="start_date" type="text" id="uk_dp_start" required>
										</div>
									</div>
									<div class="uk-width-large-1-3 uk-width-medium-1-1">
										<div class="uk-input-group">
											<span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
											<label for="uk_dp_end">End Date</label>
											<input class="md-input" name="end_date" type="text" id="uk_dp_end" required>
										</div>
									</div>
								</div>';		
						$form.='<input type="submit" name="submit" value="Submit">';
						$form.='</form>';
						echo $form;
					}
					?>
                </div>
            </div>
        </div>
    </div>

    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="<?php echo base_url()?>assets/js/common.min.js"></script>

    <!-- uikit functions -->
    <script src="<?php echo base_url()?>assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="<?php echo base_url()?>assets/js/altair_admin_common.min.js"></script>

	<script src="<?php echo base_url()?>bower_components/ion.rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/pages/forms_advanced.min.js"></script>
    <script>
        $(function() {
            if(isHighDensity) {
                // enable hires images
                altair_helpers.retina_images();
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>


    <div id="style_switcher">
        <div id="style_switcher_toggle"><i class="material-icons">&#xE8B8;</i></div>
        <div class="uk-margin-medium-bottom">
            <h4 class="heading_c uk-margin-bottom">Colors</h4>
            <ul class="switcher_app_themes" id="theme_switcher">
                <li class="app_style_default active_theme" data-app-theme="">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_a" data-app-theme="app_theme_a">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_b" data-app-theme="app_theme_b">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_c" data-app-theme="app_theme_c">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_d" data-app-theme="app_theme_d">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_e" data-app-theme="app_theme_e">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_f" data-app-theme="app_theme_f">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_g" data-app-theme="app_theme_g">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_h" data-app-theme="app_theme_h">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_i" data-app-theme="app_theme_i">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
            </ul>
        </div>
        <div class="uk-visible-large uk-margin-medium-bottom">
            <h4 class="heading_c">Sidebar</h4>
            <p>
                <input type="checkbox" name="style_sidebar_mini" id="style_sidebar_mini" data-md-icheck />
                <label for="style_sidebar_mini" class="inline-label">Mini Sidebar</label>
            </p>
        </div>
        <div class="uk-visible-large uk-margin-medium-bottom">
            <h4 class="heading_c">Layout</h4>
            <p>
                <input type="checkbox" name="style_layout_boxed" id="style_layout_boxed" data-md-icheck />
                <label for="style_layout_boxed" class="inline-label">Boxed layout</label>
            </p>
        </div>
        <div class="uk-visible-large">
            <h4 class="heading_c">Main menu accordion</h4>
            <p>
                <input type="checkbox" name="accordion_mode_main_menu" id="accordion_mode_main_menu" data-md-icheck />
                <label for="accordion_mode_main_menu" class="inline-label">Accordion mode</label>
            </p>
        </div>
    </div>

    <script>
        $(function() {
            var $switcher = $('#style_switcher'),
                $switcher_toggle = $('#style_switcher_toggle'),
                $theme_switcher = $('#theme_switcher'),
                $mini_sidebar_toggle = $('#style_sidebar_mini'),
                $boxed_layout_toggle = $('#style_layout_boxed'),
                $accordion_mode_toggle = $('#accordion_mode_main_menu'),
                $body = $('body');


            $switcher_toggle.click(function(e) {
                e.preventDefault();
                $switcher.toggleClass('switcher_active');
            });

            $theme_switcher.children('li').click(function(e) {
                e.preventDefault();
                var $this = $(this),
                    this_theme = $this.attr('data-app-theme');

                $theme_switcher.children('li').removeClass('active_theme');
                $(this).addClass('active_theme');
                $body
                    .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g app_theme_h app_theme_i')
                    .addClass(this_theme);

                if(this_theme == '') {
                    localStorage.removeItem('altair_theme');
                } else {
                    localStorage.setItem("altair_theme", this_theme);
                }

            });

            // hide style switcher
            $document.on('click keyup', function(e) {
                if( $switcher.hasClass('switcher_active') ) {
                    if (
                        ( !$(e.target).closest($switcher).length )
                        || ( e.keyCode == 27 )
                    ) {
                        $switcher.removeClass('switcher_active');
                    }
                }
            });

            // get theme from local storage
            if(localStorage.getItem("altair_theme") !== null) {
                $theme_switcher.children('li[data-app-theme='+localStorage.getItem("altair_theme")+']').click();
            }


        // toggle mini sidebar

            // change input's state to checked if mini sidebar is active
            if((localStorage.getItem("altair_sidebar_mini") !== null && localStorage.getItem("altair_sidebar_mini") == '1') || $body.hasClass('sidebar_mini')) {
                $mini_sidebar_toggle.iCheck('check');
            }

            $mini_sidebar_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_sidebar_mini", '1');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_sidebar_mini');
                    location.reload(true);
                });


        // toggle boxed layout

            if((localStorage.getItem("altair_layout") !== null && localStorage.getItem("altair_layout") == 'boxed') || $body.hasClass('boxed_layout')) {
                $boxed_layout_toggle.iCheck('check');
                $body.addClass('boxed_layout');
                $(window).resize();
            }

            $boxed_layout_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_layout", 'boxed');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_layout');
                    location.reload(true);
                });

        // main menu accordion mode
            if($sidebar_main.hasClass('accordion_mode')) {
                $accordion_mode_toggle.iCheck('check');
            }

            $accordion_mode_toggle
                .on('ifChecked', function(){
                    $sidebar_main.addClass('accordion_mode');
                })
                .on('ifUnchecked', function(){
                    $sidebar_main.removeClass('accordion_mode');
                });


        });
    </script>
</body>
</html>