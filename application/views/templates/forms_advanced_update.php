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
$option = '';
foreach($query as $k => $v){
	$username = $v['username']; 
	$fullname = $v['full_name'];
	if($k<2){
		$option.='<option value="'.$username.'" selected>'.($fullname!=''?$fullname:$username).'</option>';	
	}
	$arr[] = array('id'=>$username,'title'=>($fullname!=''?$fullname:$username),'url'=>'');
}
$data_option = json_encode($arr);
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
            <h3 class="md-card-toolbar-heading-text">Create Brief</h3>
            
            <ul id="breadcrumbs" class="menu_b">
                <li><a href="<?php echo base_url()?>">Home</a></li>
                <li><span>Create Brief</span></li>
            </ul>
            <?php echo $message?>
			<form method="post" action="<?php echo base_url()?>create_brief.html" enctype="multipart/form-data">
                <div class="md-card">
                    <div class="md-card-content create-form">
                        <div class="uk-width-medium-5-5 creator_needs">
                            <h3 class="heading_a">Creator yang dibutuhkan</h3>
                            <span class="icheck-inline">
                                <input type="checkbox" name="checkbox_sosmed[]" value="instagram" id="checkbox_demo_inline_1" data-md-icheck />
                                <label for="checkbox_demo_inline_1" class="inline-label">
                                    <i class="fa fa-instagram fa-lg" aria-hidden="true"></i> Instagram</label>
                            </span>
                            <span class="icheck-inline">
                                <input type="checkbox" name="checkbox_sosmed[]" value="twitter" id="checkbox_demo_inline_2" data-md-icheck />
                                <label for="checkbox_demo_inline_2" class="inline-label">
                                    <i class="fa fa-twitter-square fa-lg" aria-hidden="true"></i> Twitter</label>
                            </span>
                            <span class="icheck-inline">
                                <input type="checkbox" name="checkbox_sosmed[]" value="youtube" id="checkbox_demo_inline_3" data-md-icheck />
                                <label for="checkbox_demo_inline_3" class="inline-label">
                                    <i class="fa fa-youtube-square fa-lg" aria-hidden="true"></i> Youtube</label>
                            </span>
                            <span class="icheck-inline">
                                <input type="checkbox" name="checkbox_sosmed[]" value="facebook" id="checkbox_demo_inline_4" data-md-icheck />
                                <label for="checkbox_demo_inline_4" class="inline-label">
                                    <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i> Facebook</label>
                            </span>
                           
                        </div>

                        <div class="uk-width-medium-5-5 creator_needs">
                            <h3 class="heading_a">Judul Campaign</h3>
                            <input type="text" name="title" class="md-input" placeholder="give the title" required />
                        </div>

                        <div class="uk-width-medium-5-5 m-bot20">
                            <h3 class="heading_a">Pilih Creator</h3>
                            <select id="selec_adv_1nn" name="creator[]" multiple>
                                <?php
								echo $option;
								?>
                            </select>
                        </div>

                        <div class="uk-width-medium-5-5 creator_needs">
                            <h3 class="heading_a">Kebutuhan Campaign Anda</h3>
                            <textarea name="message" cols="30" rows="4" class="md-input" placeholder="Describe your own description" required></textarea>
                        </div>
                        <div class="uk-width-medium-5-5 m-bot20">
                            <h3 class="heading_a">Upload File</h3>
                            <div class="uk-form-file md-btn md-btn-primary">
                                Select
                                <input id="form-file" name="upload_file" type="file">
                            </div>
                        </div>
                        <div class="uk-width-medium-5-5 m-bot20">
                            <h3 class="heading_a">Deadline Campaign</h3>
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
                            </div>
                        </div>
                        <div class="uk-width-medium-5-5">
                            <input type="submit" name="submit" class="md-btn">
                        </div>


                    </div>
                </div>
            </form>
            
         


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
    <!-- ionrangeslider -->
    <script src="<?php echo base_url()?>bower_components/ion.rangeslider/js/ion.rangeSlider.min.js"></script>
    <!-- htmleditor (codeMirror) -->
    <script src="<?php echo base_url()?>assets/js/uikit_htmleditor_custom.min.js"></script>
    <!-- inputmask-->
    <script src="<?php echo base_url()?>bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>

    <!--  forms advanced functions -->
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
	
	<script>
        $(function() {
			$('#selec_adv_1nn').selectize({
				plugins: {
					'remove_button': {
						label     : ''
					}
				},
				options: <?php echo $data_option?>,
				maxItems: null,
				valueField: 'id',
				labelField: 'title',
				searchField: 'title',
				create: false,
				render: {
					option: function(data, escape) {
						return  '<div class="option">' +
								'<span class="title">' + escape(data.title) + '</span>' +
								'</div>';
					},
					item: function(data, escape) {
						return '<div class="item"><a href="' + escape(data.url) + '" target="_blank">' + escape(data.title) + '</a></div>';
					}
				},
				onDropdownOpen: function($dropdown) {
					$dropdown
						.hide()
						.velocity('slideDown', {
							begin: function() {
								$dropdown.css({'margin-top':'0'})
							},
							duration: 200,
							easing: easing_swiftOut
						})
				},
				onDropdownClose: function($dropdown) {
					$dropdown
						.show()
						.velocity('slideUp', {
							complete: function() {
								$dropdown.css({'margin-top':''})
							},
							duration: 200,
							easing: easing_swiftOut
						})
				}
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