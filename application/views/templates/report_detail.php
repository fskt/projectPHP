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
$data_username 	= $query->username;
$data_fullname 	= $query->full_name;
$data_name	   	= ($data_fullname!=''?$data_fullname:$data_username);
$data_pic  		= ($query->profile_picture!=null?$query->profile_picture:'default');
$data_type	  	= $query->type_content;
$data_like 		= $query->total_like;
$data_view 		= $query->total_view;
$data_comment 	= $query->total_comment;
$data_ig_image 	= ($query->instagram_image!=null?$query->instagram_image:'');
$data_ig_title 	= ($query->instagram_title!=null?$query->instagram_title:'');
$data_yt_id		= $query->id_content;
$data_yt_image 	= ($query->youtube_image!=null?$query->youtube_image:'');
$data_yt_title 	= ($query->youtube_title!=null?$query->youtube_title:'');
$data_yt_demographics 	= ($query->demographics!=null?json_decode($query->demographics,true):'');
$temp_key_yt_demographics = array_keys($data_yt_demographics);
$data_yt_geography 	= ($query->geography!=null?json_decode($query->geography,true):'');
$arr_demographics = array('age13-17','age18-24','age25-34','age35-44','age45-54','age55-64','age65-');

$temp_male = $temp_female = 0;
foreach($arr_demographics as $k => $v){
	$male = 0;
	$female = 0;
	if(in_array($v,$temp_key_yt_demographics)){
		foreach($data_yt_demographics[$v] as $k2 => $v2){
			if($v2['gender']=='female'){
				$female = $v2['views'];
			}
			
			if($v2['gender']=='male'){
				$male = $v2['views'];
			}
		}	
	}
	if($k<4){
		$arr['male'][] = $male;
		$arr['female'][] = $female;
		$join[] = $male+$female;	
	}else{
		$temp_male+=$male;
		$temp_female+=$female;
	}
}
$male = implode(',',$arr['male']).','.$temp_male;
$female = implode(',',$arr['female']).','.$temp_female;
$join	= implode(',',$join).','.($temp_female+$temp_male);

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
            <h3 class="md-card-toolbar-heading-text">Report</h3>
            
            <ul id="breadcrumbs" class="menu_b">
                <li><a href="<?php echo base_url()?>">Home</a></li>
                <li><span>Report</span></li>
            </ul>
            <div class="uk-grid">
                <div class="uk-width-10-10 m-bot20">
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
                            <img src="<?php echo $data_pic?>" alt="<?php echo $data_name?>"/>
                        </div>
                    </div>
                    <div class="user_heading_content uk-grid">
                        
                        <div class="uk-width-4-10 uk-row-first">
                            <h2 class="heading_b"><span class="uk-text-truncate"><?php echo $data_name?></span></h2>
                        </div>

                                                
                    </div>
                    
                </div>
                </div>


                <div class="uk-width-3-10">
                    <?php
					if($data_type=='youtube'){
						echo '
							<!--
							<div class="m-bot20">
								<div class="md-card">
									<div class="md-card-content">
										<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-play fa-2x" aria-hidden="true"></i></div>
										<span class="uk-text-muted uk-text-small">Total Video</span>
										<h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>12456</noscript></span></h2>
									</div>
								</div>
							</div>
							-->	
							<div>
								<div class="md-card no-shadow m-bot20">
									<div class="md-card-head video-youtube">
										<iframe width="100%" height="100%" src="http://www.youtube.com/embed/'.$data_yt_id.'" frameborder="0" allowfullscreen></iframe>
									</div>                            
								</div>
							 </div>

							
							<div class="md-card no-shadow">
								<div class="md-card-content">
									<div id="c3_chart_donut" class="c3chart"></div>
								</div>
							</div>
						';	
					}elseif($data_type=='instagram'){
						echo '
							<!--
							<div class="m-bot20">
								<div class="md-card">
									<div class="md-card-content">
										<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-play fa-2x" aria-hidden="true"></i></div>
										<span class="uk-text-muted uk-text-small">Total Video</span>
										<h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>12456</noscript></span></h2>
									</div>
								</div>
							</div>
							-->	
							<div>
								<div class="md-card no-shadow m-bot20">
									<div class="md-card-head video-youtube">
										<img src="'.$data_ig_image.'" title="'.$data_ig_title.'">
									</div>                            
								</div>
							 </div>

							
							<div class="md-card no-shadow">
								<div class="md-card-content">
									<div id="c3_chart_donut" class="c3chart"></div>
								</div>
							</div>
						';	
					}
					?>
					
                </div>
				
				
                <div class="uk-width-7-10">
                    <?php
					if($data_type=='youtube'){
						echo '
						<div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show m-bot20" data-uk-sortable data-uk-grid-margin>
							<div>
								<div class="md-card">
									<div class="md-card-content">
										<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-comments fa-2x" aria-hidden="true"></i></div>
										<span class="uk-text-muted uk-text-small">Total Comments</span>
										<h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>'.$data_comment.'</noscript></span></h2>
									</div>
								</div>
							</div>
							<div>
								<div class="md-card">
									<div class="md-card-content">
										<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></div>
										<span class="uk-text-muted uk-text-small">Total Views</span>
										<h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>'.$data_view.'</noscript></span></h2>
									</div>
								</div>
							</div>
							<div>
								<div class="md-card">
									<div class="md-card-content">
										<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i></div>
										<span class="uk-text-muted uk-text-small">Total Likes</span>
										<h2 class="uk-margin-remove" id="peity_live_text">'.$data_like.'</h2>
									</div>
								</div>
							</div>
						</div>	
						';
					}elseif($data_type=='instagram'){
						echo '
						<div class="uk-grid uk-grid-width-large-1-2 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show m-bot20" data-uk-sortable data-uk-grid-margin>
							<div>
								<div class="md-card">
									<div class="md-card-content">
										<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-comments fa-2x" aria-hidden="true"></i></div>
										<span class="uk-text-muted uk-text-small">Total Comments</span>
										<h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>'.$data_comment.'</noscript></span></h2>
									</div>
								</div>
							</div>
							<div>
								<div class="md-card">
									<div class="md-card-content">
										<div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i></div>
										<span class="uk-text-muted uk-text-small">Total Likes</span>
										<h2 class="uk-margin-remove" id="peity_live_text">'.$data_like.'</h2>
									</div>
								</div>
							</div>
						</div>	
						';
					}
					?>
                    <div class="uk-width-1-1">
                    <div class="md-card m-bot20">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions">
                                <i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>
                                <i class="md-icon material-icons">&#xE5D5;</i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}">
                                    <i class="md-icon material-icons">&#xE5D4;</i>
                                    <div class="uk-dropdown uk-dropdown-small">
                                        <ul class="uk-nav">
                                            <li><a href="#">Action 1</a></li>
                                            <li><a href="#">Action 2</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <h3 class="md-card-toolbar-heading-text">
                                Chart
                            </h3>
                        </div>
                        <div class="md-card no-shadow">
                            <div class="md-card-content">
                                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                    
                    

           

                </div>
                </div>
                
                <div class="uk-width-1-2">
                     <div class="md-card no-shadow">
                        <div class="md-card-content">
                            <div id="container_area" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-2">
                    <div class="md-card no-shadow">
                        <div class="md-card no-shadow">
                            <div class="md-card-content">
                                 <div id="container_combination" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            </div>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!--
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    -->
	<script type="text/javascript">

    $(function () {
    $('#container_area').highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: 'Historic and Estimated Worldwide Population Growth by Region'
        },
        subtitle: {
            text: 'Source: Wikipedia.org'
        },
        xAxis: {
            categories: ['1750', '1800', '1850', '1900', '1950', '1999', '2050'],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Billions'
            },
            labels: {
                formatter: function () {
                    return this.value / 1000;
                }
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' millions'
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [{
            name: 'Asia',
            data: [502, 635, 809, 947, 1402, 3634, 5268]
        }, {
            name: 'Africa',
            data: [106, 107, 111, 133, 221, 767, 1766]
        }, {
            name: 'Europe',
            data: [163, 203, 276, 408, 547, 729, 628]
        }, {
            name: 'America',
            data: [18, 31, 54, 156, 339, 818, 1201]
        }, {
            name: 'Oceania',
            data: [2, 2, 2, 6, 13, 30, 46]
        }]
    });
});
        $(function () {
    $('#container').highcharts({
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Average Views Videos during one week'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: [
                'age (13-17)',
                'age (18-24)',
                'age (25-34)',
                'age (35-44)',
                'age (45-)'
            ],
            plotBands: [{ // visualize the weekend
                from: 4.5,
                to: 6.5,
                color: 'rgba(68, 170, 213, .2)'
            }]
        },
        yAxis: {
            title: {
                text: 'Total Average Views'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' units'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: 'Male',
            data: [<?php echo $male?>]
        }, {
            name: 'Female',
            data: [<?php echo $female?>]
        }]
    });
});

$(function () {
    $('#container_combination').highcharts({
        title: {
            text: 'Combination chart'
        },
        xAxis: {
            categories: ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums']
        },
        labels: {
            items: [{
                html: 'Total fruit consumption',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Jane',
            data: [3, 2, 1, 3, 4]
        }, {
            type: 'column',
            name: 'John',
            data: [2, 3, 5, 7, 6]
        }, {
            type: 'column',
            name: 'Joe',
            data: [4, 3, 3, 9, 0]
        }, {
            type: 'spline',
            name: 'Average',
            data: [3, 2.67, 3, 6.33, 3.33],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, {
            type: 'pie',
            name: 'Total consumption',
            data: [{
                name: 'ID',
                y: <?php echo $data_yt_geography['ID']?>,
                color: Highcharts.getOptions().colors[0] // Jane's color
            }, {
                name: 'JP',
                y: <?php echo $data_yt_geography['JP']?>,
                color: Highcharts.getOptions().colors[1] // John's color
            }, {
                name: 'SG',
                y: <?php echo $data_yt_geography['SG']?>,
                color: Highcharts.getOptions().colors[2] // Joe's color
            }],
            center: [100, 80],
            size: 100,
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }]
    });
});


    </script>
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
    <!--<script src="<?php echo base_url()?>assets/js/pages/plugins_charts.min.js"></script>-->
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
		$(function(){
			var c3chart_donut_id = '#c3_chart_donut';
			if ( $(c3chart_donut_id).length ) {

				var c3chart_donut = c3.generate({
					bindto: c3chart_donut_id,
					data: {
						columns: [
							["ID", <?php echo $data_yt_geography['ID']?>],
							["JP", <?php echo $data_yt_geography['JP']?>],
							["SG", <?php echo $data_yt_geography['SG']?>],
						],
						type : 'donut',
						onclick: function (d, i) { console.log("onclick", d, i); },
						onmouseover: function (d, i) { console.log("onmouseover", d, i); },
						onmouseout: function (d, i) { console.log("onmouseout", d, i); }
					},
					donut: {
						title: "Country",
						width: 40
					},
					color: {
						pattern: ['#1f77b4', '#ff7f0e', '#2ca02c']
					}
				});

				$(c3chart_donut_id).waypoint({
					handler: function() {
						setTimeout(function () {
							c3chart_donut.load({
								columns: [
									["ID", <?php echo $data_yt_geography['ID']?>],
									["JP", <?php echo $data_yt_geography['JP']?>],
									["SG", <?php echo $data_yt_geography['SG']?>],
								]
							});
						}, 1500);

						this.destroy();
					},
					offset: '80%'
				});

				$window.on('debouncedresize', function () {
					c3chart_donut.resize();
				});
			}	
		});
		
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>
</body>
</html>