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
                    <div>
						<a href="<?php echo base_url()?>create_brief.html" class="addNew">
							<button class="md-btn md-btn-wave waves-effect waves-button btn-Add">
								<i class="fa fa-plus" aria-hidde="true"></i>&nbsp; Create New Brief</button>
						</a>
					</div>
                    <div class="uk-overflow-container">
                                <table class="uk-table uk-table-hover uk-table-nowrap">                             
                                    <tbody>
                                        <?php
										if($query!=null){
											if($query['counts']>0){
												foreach($query['results'] as $k => $v){
													echo '
														<tr>
															<td>
															<a href="'.base_url().'brief_detail/'.$v->id.'.html">
																<div class="uk-grid" data-uk-grid-margin>
																	<div class="uk-width-2-5 uk-width-small-3-5">
																		<h4 class="heading_a uk-margin-small-bottom" '.($v->status_brand=='open'?'style="font-weight:bold;"':'').'>'.$v->title.'</h4>
																	</div>
																	<div class="uk-width-1-5 uk-width-small-1-5 ">
																		<span class="uk-badge uk-badge-success">'.date('d M Y',strtotime($v->date_created)).'</span>
																		
																	</div>
																</div>
															</a>
															</td>
														</tr>
													';
												}
											}else{
												echo '<tr><td>List Brief masih kosong</td></tr>';	
											}
										}else{
											echo '<tr><td>List Brief masih kosong</td></tr>';
										}
										?>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="uk-pagination uk-margin-medium-top">
                                <li class="uk-disabled"><span><i class="uk-icon-angle-double-left"></i></span></li>
                                <li class="uk-active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><span>…</span></li>
                                <li><a href="#">10</a></li>
                                <li><a href="#"><i class="uk-icon-angle-double-right"></i></a></li>
                            </ul>
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
    <script src="<?php echo base_url()?>assets/js/pages/plugins_datatables.min.js"></script>
    
    
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