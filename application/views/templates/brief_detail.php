<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->

<head>
    
	<?php 
	include '/../head_tag.php';
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/redactor.css">
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
						<?php echo $message?>
						<form method="post" action="<?php echo base_url().'brief_detail/'.$id_ref.'.html'?>">
						<textarea id="content_brief_textarea" name="message"></textarea>
						<input type="submit" name="submit" value="submit">
						</form>
					</div>
					
					
					<div class="timeline">
						<?php
						if($query!=null){
							if($query['counts']>0){
								foreach($query['results'] as $k => $v){
									preg_match_all('%(https?:\/\/\S+\.(?:jpg|png|gif))%i', $v->description , $result);
									$m = 0;
									if(count($result[0])>0){
										$m = 1;
									}
									$id_user = $v->user_id;
									$id_admin = $v->admin_id;
									$id = ($id_admin==""?$id_user:$id_admin);
									if($m==0){
										echo '
											<div class="timeline_item">
												<div class="timeline_icon timeline_icon_success"><i>'.$id.'</i></div>
												<div class="timeline_date">
													'.date('d M Y',strtotime($v->date_created)).'
													<span>'.date('H:i:s',strtotime($v->date_created)).'</span>
												</div>
												<div class="timeline_content">'.stripcslashes($v->description).'</div>
											</div>
										';
									}else{
										echo '
										<div class="timeline_item">
											<div class="timeline_icon timeline_icon_success"><i>'.$id.'</i></div>
											<div class="timeline_date">
												'.date('d M Y',strtotime($v->date_created)).'
													<span>'.date('H:i:s',strtotime($v->date_created)).'</span>
											</div>
											<div class="timeline_content">
												<div class="timeline_content_addon">
													'.stripcslashes($v->description).'
												</div>
											</div>
										</div>
										';
									}
								}
							}else{
								echo '<tr><td>List Brief masih kosong</td></tr>';	
							}
						}else{
							echo '<tr><td>List Brief masih kosong</td></tr>';
						}
						?>
						
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
    <script src="<?php echo base_url()?>assets/js/redactor.js"></script>
    
    <script>
        $(function() {
            $('#content_brief_textarea').redactor({
				imageUpload: '<?php echo base_url()?>content_brief_textarea_area',
			});
			if(isHighDensity) {
                // enable hires images
                altair_helpers.retina_images();
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
			
			$('.action_notif').click(function(){
				$.ajax({
				   type: "GET",
				   url: "<?php echo base_url()?>action_notif",
				   success: function(msge){
					 var msg = msge.trim();
					 if(msg!='no'){
						$('.icon_notif').hide();	
					 }
				   }
				});
			});
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>
</body>
</html>