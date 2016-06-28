<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->

<head>
    
	<?php 
	include '/../head_tag.php';
	?>

</head>
<body class=" sidebar_main_open sidebar_main_swipe">
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
                <li><span>Creator</span></li>
            </ul>
         

            <div class="uk-grid uk-grid-width-medium-1-2" data-uk-grid-margin="">
                <?php
				foreach($query as $v){
					$username 		 = $v['username'];
					$full_name 		 = $v['full_name'];
					$bio 			 = $v['bio'];
					$profile_picture = $v['profile_picture'];
					$followed_by 	 = $v['followed_by'];
					$media 			 = $v['media'];
					$name 			 = ($full_name!=''?$full_name:$username);
					echo '
					<div class="card-container">
						<div class="md-card md-card-hover md-padd">
							<div class="creator_user">
								<div class="user_heading_avatar">
									<div class="thumbnail">
										<img src="'.$profile_picture.'" alt="'.$name.'" class="">
									</div>
								</div>
								<div class="user_heading_content">
									<a href="'.base_url().'user/'.$username.'/youtube"><h2 class="heading_b"><span class="uk-text-truncate">'.$name.'</span></h2></a>
								</div>
							</div>
							<div class="md-card-content">
								<p class="truncate-text" style="word-wrap: break-word;">'.$bio.'</p>
								<a class="md-btn md-btn-wave waves-effect waves-button btn-Add" href="'.base_url().'user/'.$username.'/youtube.html">Details</a>
							 
								<div class="icon_socmed">
									<div class="socmed_youtube">
										<span class="icon_s"><a href="#!"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></span>
										<span class="count_s">5000 <h6>Subscribers</h6></span>
									</div>
									<div class="socmed_instagram">
										<span class="icon_s"><a href="#!"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
										<span class="count_s">'.$followed_by.' <h6>Followers</h6></span>
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
					</div>';
				}
                ?>
                
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
    <!-- handlebars.js -->
    <script src="<?php echo base_url()?>bower_components/handlebars/handlebars.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/custom/handlebars_helpers.min.js"></script>
    <!-- CLNDR -->
    <script src="<?php echo base_url()?>bower_components/clndr/clndr.min.js"></script>
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


    

    
</body>
</html>