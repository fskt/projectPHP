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
$arr = $reload_date = $reload_arr  = array();
$data_media = (isset($query['data_media'][0]['media_data'])?json_decode($query['data_media'][0]['media_data'],true):array());
$count_comment = $count_like = $total_data = 0;

if(count($data_media)>0){
	foreach($data_media['data'] as $k => $v){
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
		@$reload_date[date('Y-m-d',$created_time)]++;
		$count_comment+=$total_comment;
		$count_like+=$total_like;
		$total_data++;
	}
}
$jumData = $total_data;
$number = '';
if($jumData>$dataPerPage){
	$jumPage = ceil($jumData/$dataPerPage);
	$number = "<ul class='uk-pagination uk-margin-large-top'>";
	if ($noPage > 1) $number.="<a href='".base_url()."user/".$username."/".$active."/".($noPage-1)."'><li class='uk-disabled'><span><i class='uk-icon-angle-double-left'></i></span></li></a>";

	for($page = 1; $page <= $jumPage; $page++){
			 if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)){
				if ((@$showPage == 1) && ($page != 2))  $number.= "<li><span>...</span></li>";
				if ((@$showPage != ($jumPage - 1)) && ($page == $jumPage))  $number.= "<li><span>...</span></li>";
				if ($page == $noPage) $number.= " <li class='uk-active'><span>".$page."</span></li> ";
				else $number.= " <li><span><a href='".base_url()."user/".$username."/".$active."/".$page."'>".$page."</a></span></li> ";
				@$showPage = $page;
			 }
	}

	if ($noPage < $jumPage) $number.= "<a href='".base_url()."user/".$username."/".$active."/".($noPage+1)."'><li class='uk-disabled'><span><i class='uk-icon-angle-double-right'></i></span></li></a>";
	$number.="</ul>";
}

foreach($reload_date as $k => $v){
	$reload_arr[] = array('date'=>$k,'value'=>$v);	
}

//$data_reload = '[{"date": "2016-01-01","value": 2062.025150690567},{"date": "2016-01-02","value": 9490.615524570567}]';
$data_reload = json_encode($reload_arr);

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
            <h3 class="md-card-toolbar-heading-text">Dashboard</h3>
            
            <ul id="breadcrumbs" class="menu_b">
                <li><a href="<?php echo base_url()?>">Home</a></li>
                <li><a href="<?php echo base_url()?>">Creator</a></li>
                <li><span>View Creator</span></li>
            </ul>
            
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_menu" data-uk-dropdown="{pos:'left-top'}">
                                <i class="md-icon material-icons md-icon-light">&#xE5D4;</i>
                                <div class="uk-dropdown uk-dropdown-small">
                                    <ul class="uk-nav">
                                        <li><a href="#">Action 1</a></li>
                                        <li><a href="#">Action 2</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user_heading_avatar">
                                <div class="thumbnail">
                                    <?php
									echo '<img src="'.$query['data_user'][0]['profile_picture'].'" alt="'.($query['data_user'][0]['full_name']!=''?$query['data_user'][0]['full_name']:$query['data_user'][0]['username']).'"/>';
									?>
                                </div>
                            </div>
                            <div class="user_heading_content uk-grid">
                                
                                <div class="uk-width-4-10 uk-row-first">
                                    <h2 class="heading_b"><span class="uk-text-truncate"><?php echo ($query['data_user'][0]['full_name']!=''?$query['data_user'][0]['full_name']:$query['data_user'][0]['username'])?></span></h2>
                                </div>

                                <div class="uk-width-6-10 ">
                                    <div class="icon_socmed">
                                        <div class="socmed_youtube">
                                            <span class="icon_s"><a href="#!"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></span>
                                            <span class="count_s"><?php echo $query['data_user'][0]['youtube_subscriber']?> <h6>Subscribers</h6></span>
                                        </div>
                                        <div class="socmed_instagram">
                                            <span class="icon_s"><a href="#!"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
                                            <span class="count_s"><?php echo $query['data_user'][0]['followed_by']?> <h6>Followers</h6></span>
                                        </div>
                                        <div class="socmed_twitter">
                                            <span class="icon_s"><a href="#!"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></span>
                                            <span class="count_s">8000 <h6>Followers</h6></span>
                                        </div>
                                        <div class="socmed_facebook">
                                            <span class="icon_s"><a href="#!"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></span>
                                            <span class="count_s">1500 <h6>Fans Page</h6></span>
                                        </div>
                                    </div>
                                </div>


                                
                            </div>
                            
                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                <li  <?php echo ($active=='youtube'?'class="uk-active"':'')?>><a href="#" class="link_tab" id="youtube">Youtube</a></li>
                                <li <?php echo ($active=='instagram'?'class="uk-active"':'')?>><a href="#" class="link_tab" id="instagram">Instagram</a></li>
                                <li <?php echo ($active=='twitter'?'class="uk-active"':'')?>><a href="#" class="link_tab" id="twitter">Twitter</a></li>
								<li <?php echo ($active=='facebook'?'class="uk-active"':'')?>><a href="#" class="link_tab" id="facebook">Facebook</a></li>
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                    <!-- statistics (small charts) -->
                                    <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
                                        <div>
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-play fa-2x" aria-hidden="true"></i></div>
                                                    <span class="uk-text-muted uk-text-small">Total Video</span>
                                                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript><?php echo $query['data_user'][0]['youtube_media']?></noscript></span></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-comments fa-2x" aria-hidden="true"></i></div>
                                                    <span class="uk-text-muted uk-text-small">Total Comments</span>
                                                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript><?php echo $query['data_user'][0]['youtube_comment']?></noscript></span></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></div>
                                                    <span class="uk-text-muted uk-text-small">Total Views</span>
                                                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript><?php echo $query['data_user'][0]['youtube_view']?></noscript></span></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i></div>
                                                    <span class="uk-text-muted uk-text-small">Total Likes</span>
                                                    <h2 class="uk-margin-remove" id="peity_live_text">7767</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid uk-grid-medium uk-grid-width-medium-1-2 uk-grid-width-large-1-3" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
                                     
									<?php
									if($youtube_query==null){
										
									}else{
										foreach($youtube_query as $v){
											$id = (isset($v['id']['videoId'])?$v['id']['videoId']:null);
											if($id!=null){
												echo '
													<div>
														<div class="md-card no-shadow">
															<div class="md-card-head video-youtube">
														<iframe width="100%" height="100%" src="https://www.youtube.com/embed/'.@$id.'" frameborder="0" allowfullscreen></iframe>
															</div>
															
														</div>
													 </div>
												';	
											}
										}
									}
									?>
                                        
                                    </div>
                                    <div>
                                            <ul class="uk-pagination uk-margin-medium-top uk-margin-medium-bottom">
												<?php
												echo ($prevPage!=null?'<li><a href="'.base_url().'user/'.$username.'/'.$active.'/'.$prevPage.'">Prev</a></li> ':'');
												
												echo ($nextPage!=null?' <li><a href="'.base_url().'user/'.$username.'/'.$active.'/'.$nextPage.'">Next</a></li>':'');
												?>
                                                
                                            </ul>
                                    </div>
                                </li>
                                <li>

                                    <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
                                        <div>
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i></div>
                                                    <span class="uk-text-muted uk-text-small">Total Foto</span>
                                                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript><?php echo count(@$arr['image'])?></noscript></span></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-play fa-2x" aria-hidden="true"></i></div>
                                                    <span class="uk-text-muted uk-text-small">Total Video</span>
                                                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript><?php echo count(@$arr['video'])?></noscript></span></h2>
                                                </div>
                                            </div>
                                        </div>
                                         <div>
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i></div>
                                                    <span class="uk-text-muted uk-text-small">Total Likes</span>
                                                    <h2 class="uk-margin-remove" id="peity_live_text"><?php echo $count_like?></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-comments fa-2x" aria-hidden="true"></i></div>
                                                    <span class="uk-text-muted uk-text-small">Total Comments</span>
                                                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript><?php echo $count_comment?></noscript></span></h2>
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                    </div>

									<div>&nbsp;</div>
									
									<div class="gallery_grid uk-grid-width-medium-1-4 uk-grid-width-large-1-5" data-uk-grid="{gutter: 16}">
										<?php
											if(count($arr)>0){
												$m = 1;
												foreach($arr['image'] as $k => $v){
													$split = parse_url($v['images_standar_resol']['url']);
													$img = $split['scheme'].'://'.$split['host'].$split['path']; 
													if($k!=0 && $k % 10==0){
														$m++;
													}
													echo '
														<div class="image-group image-group'.$m.'" style="display:none;">
															<div class="md-card md-card-hover">
																<div class="gallery_grid_item md-card-content">
																	<a href="'.$img.'" data-uk-lightbox="{group:\'gallery\'}">
																		<img src="'.$v['images_standar_resol']['url'].'" alt="'.$v['caption']['text'].'"/>
																	</a>
																	<div class="gallery_grid_image_caption">
																		
																		<span class="gallery_image_title uk-text-truncate">'.$v['caption']['text'].'</span>
																		<div class="uk-text-muted uk-text-small">'.$v['date'].'</div>
																		<div class="uk-text-muted uk-text-small">Likes : '.$v['total_like'].'</div>
																		<div class="uk-text-muted uk-text-small">Comments : '.$v['total_comment'].'</div>
																	</div>
																</div>
															</div>
														</div>
													';	
												}
											}
										?>										
                                    </div>
									
									<?php
									echo $number;
									?>
                                </li>
                                <li>
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Quos dolorem earum dolores itaque reiciendis fugiat.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">10 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">17</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">926</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Ut molestias blanditiis accusantium voluptatum mollitia.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">24 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">11</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">644</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Odio consequatur sapiente libero similique.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">03 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">13</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">954</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Cum excepturi illo qui sapiente omnis nulla eaque.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">22 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">5</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">798</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Vel molestiae aliquid et repudiandae in numquam qui.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">08 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">9</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">688</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                             
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
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

     <!-- page specific plugins -->
    <!-- d3 -->
    <script src="<?php echo base_url()?>bower_components/d3/d3.min.js"></script>
    <!-- metrics graphics (charts) -->
    <script src="<?php echo base_url()?>bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>
    <!-- chartist (charts) -->
    <script src="<?php echo base_url()?>bower_components/chartist/dist/chartist.min.js"></script>
    <!-- maplace (google maps) -->
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="<?php echo base_url()?>bower_components/maplace-js/dist/maplace.min.js"></script>
    <!-- peity (small charts) -->
    <script src="<?php echo base_url()?>bower_components/peity/jquery.peity.min.js"></script>
    <!-- easy-pie-chart (circular statistics) -->
    <script src="<?php echo base_url()?>bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
    <!-- countUp -->
    <script src="<?php echo base_url()?>bower_components/countUp.js/dist/countUp.min.js"></script>
    <!-- handlebars.js -->
    <script src="<?php echo base_url()?>bower_components/handlebars/handlebars.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/custom/handlebars_helpers.min.js"></script>
       <!-- c3.js (charts) -->
    <script src="<?php echo base_url()?>bower_components/c3js-chart/c3.min.js"></script>
        <!--  charts functions -->
    <script src="<?php echo base_url()?>assets/js/pages/plugins_charts.min.js"></script>
    <!-- fitvids -->
    <script src="<?php echo base_url()?>bower_components/fitvids/jquery.fitvids.js"></script>

    <!--  dashbord functions -->
    <script src="<?php echo base_url()?>assets/js/pages/dashboard.min.js"></script>
    
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


    <script>
		function ChangeUrl(page, url, param) {
			if (typeof (history.pushState) != "undefined") {
				var obj = { Page: page, Url: url };
				history.pushState(obj, obj.Page, '/instagram/user/'+param+'/'+url);
			} else {
				alert("Browser does not support HTML5.");
			}
		}
		$(function() {
			$('.image-group1').show();
			var url   = window.location.pathname;
			var split = url.split('/');
			var new_id = (typeof split[5] !='undefined'?split[5]:1);
			$('.image-group').hide();
			$('.image-group'+new_id).show();
			
			$('.link_tab').click(function(e){
				e.preventDefault();
				var id = $(this).attr('id');
				window.location = '<?php echo base_url()?>user/'+split[3]+'/'+id;
				//ChangeUrl('replace', id, split[3]);	
			});
			
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