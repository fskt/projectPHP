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
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <h3 class="heading_b uk-margin-bottom">Report</h3>
                    <div class="uk-grid uk-margin-bottom">
                        <div class="uk-width-1-4">
                            <div>
                                <a href="<?php echo base_url()?>report_youtube.html"><div class="md-card md-card-style <?php echo $active['active_youtube']?>">
                                    <div class="md-card-content">
                                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                                            <i class="fa fa-youtube-square fa-3x"></i></div>
                                        <span class="uk-text-muted uk-text-small">Report</span>
                                        <h2 class="uk-margin-remove"><span>Youtube</span></h2>
                                    </div>
                                </div></a>
                            </div>
                        </div>
                        <div class="uk-width-1-4">
                            <div>
                                <a href="<?php echo base_url()?>report_instagram.html"><div class="md-card md-card-style <?php echo $active['active_instagram']?>">
                                    <div class="md-card-content">
                                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                                            <i class="fa fa-instagram fa-3x"></i></div>
                                        <span class="uk-text-muted uk-text-small">Report</span>
                                        <h2 class="uk-margin-remove"><span>Instagram</span></h2>
                                    </div>
                                </div></a>
                            </div>
                        </div>
                        <div class="uk-width-1-4">
                            <div>
                                <a href="<?php echo base_url()?>report_facebook.html"><div class="md-card md-card-style <?php echo $active['active_facebook']?>">
                                    <div class="md-card-content">
                                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                                            <i class="fa fa-facebook-square fa-3x"></i></div>
                                        <span class="uk-text-muted uk-text-small">Report</span>
                                        <h2 class="uk-margin-remove"><span>Facebook</span></h2>
                                    </div>
                                </div></a>
                            </div>
                        </div>
                        <div class="uk-width-1-4">
                            <div>
                                <a href="<?php echo base_url()?>report_twitter.html"><div class="md-card md-card-style <?php echo $active['active_twitter']?>">
                                    <div class="md-card-content">
                                        <div class="uk-float-right uk-margin-top uk-margin-small-right">
                                            <i class="fa fa-twitter-square fa-3x"></i></div>
                                        <span class="uk-text-muted uk-text-small">Report</span>
                                        <h2 class="uk-margin-remove"><span>Twitter</span></h2>
                                    </div>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="uk-overflow-container">
                                <table class="uk-table uk-table-hover uk-table-nowrap">                             
                                    <tbody>
                                        <?php
										$results = '<tr><td> Data masih kosong</td></tr>';
										if($query!=null){
											$results = '';
											foreach($query as $v){
												$id = $v->id;
												$id_content = $v->id_content;
												$username = $v->username;
												$fullname = $v->full_name;
												$name	  = ($fullname!=''?$fullname:$username);
												$picture  = ($v->profile_picture!=null?$v->profile_picture:'default');
												$type	  = $v->type_content;
												$date_created = $v->date_created;
												$date_range	= explode('[SPLIT]',$v->date_range);
												$date1 = date('d M Y',strtotime($date_range[0]));
												$date2 = date('d M Y',strtotime($date_range[1]));
												$total_like = $v->total_like;
												$total_view = ($v->total_view==0?'-':$v->total_view);
												$total_comment = $v->total_comment;
												$status = ((strtotime($date_range[1]) - strtotime(date('Y-m-d')))>=0?'Open':'Closed');
												$results.='
													<tr>
														<td>
														<a href="'.base_url().'report_detail/'.$id.'.html">
															<div class="uk-grid" data-uk-grid-margin>
																<div class="uk-width-2-5 uk-width-small-1-5 uk-text-center">
																	<img class="md-user-image-large" src="'.$picture.'" alt=""/>
																</div>
																<div class="uk-width-2-5 uk-width-small-3-5">
																	<h4 class="heading_a uk-margin-small-bottom">'.$name.'</h4>
																	<p class="uk-margin-remove"><span class="uk-text-muted"><i class="fa fa-eye" aria-hidden="true"></i></span> '.$total_like.' likes</p>
																	<p class="uk-margin-remove"><span class="uk-text-muted"><i class="fa fa-eye" aria-hidden="true"></i></span> '.$total_comment.' comments</p>
																	'.($type=='youtube'?'<p class="uk-margin-remove"><span class="uk-text-muted"><i class="fa fa-eye" aria-hidden="true"></i></span> '.$total_view.' views</p><p class="uk-margin-remove"><span class="uk-text-muted"><i class="fa fa-link" aria-hidden="true"></i> Links:</span>https://youtu.be/'.$id_content.'</p>':'').'
																	<p class="uk-margin-remove"><span class="uk-text-muted"><i class="fa fa-eye" aria-hidden="true"></i></span> Date Created : '.date('d M Y',strtotime($date_created)).'</p>
																	<p class="uk-margin-remove"><span class="uk-text-muted"><i class="fa fa-eye" aria-hidden="true"></i></span> '.$date1.' until '.$date2.' ('.$status.')</p>
																</div>
																<div class="uk-width-1-5 uk-width-small-1-5 ">
																	<span class="uk-badge uk-badge-success">Accepted</span>
																	
																</div>
															</div>
														</a>
														</td>
													</tr>
												';
											}											
										}
										echo $results;
										?>
										
                                    </tbody>
                                </table>
                            </div>
                            <?php echo $paging?>
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
      <!-- datatables -->
    <script src="<?php echo base_url()?>bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <!-- datatables colVis-->
    <script src="<?php echo base_url()?>bower_components/datatables-colvis/js/dataTables.colVis.js"></script>
    <!-- datatables tableTools-->
    <script src="<?php echo base_url()?>bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>
    <!-- datatables custom integration -->
    <script src="<?php echo base_url()?>assets/js/custom/datatables_uikit.min.js"></script>

    <!--  datatables functions -->
    <script src="<?php echo base_url()?>assets/js/pages/plugins_datatables.min.js"></script>ssss
    
    
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