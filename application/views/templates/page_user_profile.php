<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/img/favicon-32x32.png" sizes="32x32">

    <title>Altair Admin v2.6.0</title>

	<!-- additional styles for plugins -->
        <link rel="stylesheet" href="<?php echo base_url()?>bower_components/metrics-graphics/dist/metricsgraphics.css">
        
    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url()?>bower_components/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/icons/flags/flags.min.css" media="all">

    <!-- style switcher -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style_switcher.min.css" media="all">
    
    <!-- altair admin -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main.min.css" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/themes/themes_combined.min.css" media="all">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
        <script type="text/javascript" src="<?php echo base_url()?>bower_components/matchMedia/matchMedia.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>bower_components/matchMedia/matchMedia.addListener.js"></script>
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ie.css" media="all">
    <![endif]-->

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
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                                
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                
                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>
                
                    <div id="menu_top_dropdown" class="uk-float-left uk-hidden-small">
                        <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                            <a href="#" class="top_menu_toggle"><i class="material-icons md-24">&#xE8F0;</i></a>
                            <div class="uk-dropdown uk-dropdown-width-3">
                                <div class="uk-grid uk-dropdown-grid">
                                    <div class="uk-width-2-3">
                                        <div class="uk-grid uk-grid-width-medium-1-3 uk-margin-bottom uk-text-center">
                                            <a href="page_mailbox.html" class="uk-margin-top">
                                                <i class="material-icons md-36 md-color-light-green-600">&#xE158;</i>
                                                <span class="uk-text-muted uk-display-block">Mailbox</span>
                                            </a>
                                            <a href="page_invoices.html" class="uk-margin-top">
                                                <i class="material-icons md-36 md-color-purple-600">&#xE53E;</i>
                                                <span class="uk-text-muted uk-display-block">Invoices</span>
                                            </a>
                                            <a href="page_chat.html" class="uk-margin-top">
                                                <i class="material-icons md-36 md-color-cyan-600">&#xE0B9;</i>
                                                <span class="uk-text-muted uk-display-block">Chat</span>
                                            </a>
                                            <a href="page_scrum_board.html" class="uk-margin-top">
                                                <i class="material-icons md-36 md-color-red-600">&#xE85C;</i>
                                                <span class="uk-text-muted uk-display-block">Scrum Board</span>
                                            </a>
                                            <a href="page_snippets.html" class="uk-margin-top">
                                                <i class="material-icons md-36 md-color-blue-600">&#xE86F;</i>
                                                <span class="uk-text-muted uk-display-block">Snippets</span>
                                            </a>
                                            <a href="page_user_profile.html" class="uk-margin-top">
                                                <i class="material-icons md-36 md-color-orange-600">&#xE87C;</i>
                                                <span class="uk-text-muted uk-display-block">User profile</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-3">
                                        <ul class="uk-nav uk-nav-dropdown uk-panel">
                                            <li class="uk-nav-header">Components</li>
                                            <li><a href="components_accordion.html">Accordions</a></li>
                                            <li><a href="components_buttons.html">Buttons</a></li>
                                            <li><a href="components_notifications.html">Notifications</a></li>
                                            <li><a href="components_sortable.html">Sortable</a></li>
                                            <li><a href="components_tabs.html">Tabs</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE5D0;</i></a></li>
                        <li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE7F4;</i><span class="uk-badge">16</span></a>
                            <div class="uk-dropdown uk-dropdown-xlarge">
                                <div class="md-card-content">
                                    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#header_alerts',animation:'slide-horizontal'}">
                                        <li class="uk-width-1-2 uk-active"><a href="#" class="js-uk-prevent uk-text-small">Messages (12)</a></li>
                                        <li class="uk-width-1-2"><a href="#" class="js-uk-prevent uk-text-small">Alerts (4)</a></li>
                                    </ul>
                                    <ul id="header_alerts" class="uk-switcher uk-margin">
                                        <li>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-cyan">yr</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Eveniet sapiente.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Facilis quidem cumque itaque maiores ab voluptatem.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo base_url()?>assets/img/avatars/avatar_07_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Saepe laboriosam quibusdam.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Aut qui voluptas esse accusamus in ducimus cupiditate rerum eligendi enim.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-light-green">ry</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Ut nobis est.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Et delectus et repellat voluptatibus impedit veniam occaecati qui laborum sequi.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo base_url()?>assets/img/avatars/avatar_02_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Qui hic sequi.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Tempora nostrum neque quae et velit corrupti perspiciatis debitis at est.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo base_url()?>assets/img/avatars/avatar_09_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Modi eaque.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Minima et ut dolores ipsam repellendus odit.</span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="uk-text-center uk-margin-top uk-margin-small-bottom">
                                                <a href="page_mailbox.html" class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent">Show All</a>
                                            </div>
                                        </li>
                                        <li>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Esse ipsam et.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Molestias quo et odit.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-success">&#xE88F;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Qui eos laudantium.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Velit non in veritatis maxime quo illo.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-danger">&#xE001;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Saepe nobis.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Excepturi mollitia rerum et provident ex velit error aut.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-primary">&#xE8FD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Optio sit.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Voluptatibus fugit dolore et nihil cum nemo.</span>
                                                    </div>
                                                </li>
                                            </ul>
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
    </header><!-- main header end -->
    <!-- main sidebar -->
    <aside id="sidebar_main">
        
        <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <a href="index.html" class="sSidebar_hide"><img src="<?php echo base_url()?>assets/img/logo_main.png" alt="" height="15" width="71"/></a>
                <a href="index.html" class="sSidebar_show"><img src="<?php echo base_url()?>assets/img/logo_main_small.png" alt="" height="32" width="32"/></a>
            </div>
            <div class="sidebar_actions">
                <select id="lang_switcher" name="lang_switcher">
                    <option value="gb" selected>English</option>
                </select>
            </div>
        </div>
        
        <div class="menu_section">
            <ul>
                                    <li title="Dashboard">
                        <a href="index.html">
                            <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                            <span class="menu_title">Dashboard</span>
                        </a>
                                            </li>
                                    <li title="Mailbox">
                        <a href="page_mailbox.html">
                            <span class="menu_icon"><i class="material-icons">&#xE158;</i></span>
                            <span class="menu_title">Mailbox</span>
                        </a>
                                            </li>
                                    <li title="Invoices">
                        <a href="page_invoices.html">
                            <span class="menu_icon"><i class="material-icons">&#xE53E;</i></span>
                            <span class="menu_title">Invoices</span>
                        </a>
                                            </li>
                                    <li title="Chat">
                        <a href="page_chat.html">
                            <span class="menu_icon"><i class="material-icons">&#xE0B9;</i></span>
                            <span class="menu_title">Chat</span>
                        </a>
                                            </li>
                                    <li title="Scrum Board">
                        <a href="page_scrum_board.html">
                            <span class="menu_icon"><i class="material-icons">&#xE85C;</i></span>
                            <span class="menu_title">Scrum Board</span>
                        </a>
                                            </li>
                                    <li title="Snippets">
                        <a href="page_snippets.html">
                            <span class="menu_icon"><i class="material-icons">&#xE86F;</i></span>
                            <span class="menu_title">Snippets</span>
                        </a>
                                            </li>
                                    <li class="current_section" title="User Profile">
                        <a href="page_user_profile.html">
                            <span class="menu_icon"><i class="material-icons">&#xE87C;</i></span>
                            <span class="menu_title">User Profile</span>
                        </a>
                                            </li>
                                    <li title="Forms">
                        <a href="#.html">
                            <span class="menu_icon"><i class="material-icons">&#xE8D2;</i></span>
                            <span class="menu_title">Forms</span>
                        </a>
                                                    <ul>
                                                                                                            <li><a href="forms_regular.html">Regular Elements</a></li>
                                                                                                                                                <li><a href="forms_advanced.html">Advanced Elements</a></li>
                                                                                                                                                <li><a href="forms_file_input.html">File Input</a></li>
                                                                                                                                                <li><a href="forms_file_upload.html">File Upload</a></li>
                                                                                                                                                <li><a href="forms_validation.html">Validation</a></li>
                                                                                                                                                <li><a href="forms_wizard.html">Wizard</a></li>
                                                                                                                                                <li class="menu_subtitle">WYSIWYG Editors</li>
                                                                                    <li><a href="forms_wysiwyg_ckeditor.html">CKeditor</a></li>
                                                                                    <li><a href="forms_wysiwyg_tinymce.html">TinyMCE</a></li>
                                                                                    <li><a href="forms_wysiwyg_inline.html">TinyMCE</a></li>
                                                                                                                                        </ul>
                                            </li>
                                    <li title="Layout">
                        <a href="#.html">
                            <span class="menu_icon"><i class="material-icons">&#xE8F1;</i></span>
                            <span class="menu_title">Layout</span>
                        </a>
                                                    <ul>
                                                                                                            <li><a href="layout_top_menu.html">Top Menu</a></li>
                                                                                                                                                <li><a href="layout_header_full.html">Full Header</a></li>
                                                                                                </ul>
                                            </li>
                                    <li title="Kendo UI Widgets">
                        <a href="#.html">
                            <span class="menu_icon"><i class="material-icons">&#xE1BD;</i></span>
                            <span class="menu_title">Kendo UI Widgets</span>
                        </a>
                                                    <ul>
                                                                                                            <li><a href="kendoui_autocomplete.html">Autocomplete</a></li>
                                                                                                                                                <li><a href="kendoui_calendar.html">Calendar</a></li>
                                                                                                                                                <li><a href="kendoui_colorpicker.html">ColorPicker</a></li>
                                                                                                                                                <li><a href="kendoui_combobox.html">ComboBox</a></li>
                                                                                                                                                <li><a href="kendoui_datepicker.html">DatePicker</a></li>
                                                                                                                                                <li><a href="kendoui_datetimepicker.html">DateTimePicker</a></li>
                                                                                                                                                <li><a href="kendoui_dropdown_list.html">DropDownList</a></li>
                                                                                                                                                <li><a href="kendoui_masked_input.html">Masked Input</a></li>
                                                                                                                                                <li><a href="kendoui_menu.html">Menu</a></li>
                                                                                                                                                <li><a href="kendoui_multiselect.html">MultiSelect</a></li>
                                                                                                                                                <li><a href="kendoui_numeric_textbox.html">Numeric TextBox</a></li>
                                                                                                                                                <li><a href="kendoui_panelbar.html">PanelBar</a></li>
                                                                                                                                                <li><a href="kendoui_timepicker.html">TimePicker</a></li>
                                                                                                                                                <li><a href="kendoui_toolbar.html">Toolbar</a></li>
                                                                                                                                                <li><a href="kendoui_window.html">Window</a></li>
                                                                                                </ul>
                                            </li>
                                    <li title="Components">
                        <a href="#.html">
                            <span class="menu_icon"><i class="material-icons">&#xE87B;</i></span>
                            <span class="menu_title">Components</span>
                        </a>
                                                    <ul>
                                                                                                            <li><a href="components_accordion.html">Accordions</a></li>
                                                                                                                                                <li><a href="components_autocomplete.html">Autocomplete</a></li>
                                                                                                                                                <li><a href="components_breadcrumbs.html">Breadcrumbs</a></li>
                                                                                                                                                <li><a href="components_buttons.html">Buttons</a></li>
                                                                                                                                                <li><a href="components_fab.html">Buttons: FAB</a></li>
                                                                                                                                                <li><a href="components_cards.html">Cards</a></li>
                                                                                                                                                <li><a href="components_colors.html">Colors</a></li>
                                                                                                                                                <li><a href="components_common.html">Common</a></li>
                                                                                                                                                <li><a href="components_dropdowns.html">Dropdowns</a></li>
                                                                                                                                                <li><a href="components_dynamic_grid.html">Dynamic Grid</a></li>
                                                                                                                                                <li><a href="components_footer.html">Footer</a></li>
                                                                                                                                                <li><a href="components_grid.html">Grid</a></li>
                                                                                                                                                <li><a href="components_icons.html">Icons</a></li>
                                                                                                                                                <li><a href="components_modal.html">Lightbox/Modal</a></li>
                                                                                                                                                <li><a href="components_lists.html">Lists</a></li>
                                                                                                                                                <li><a href="components_nestable.html">Nestable</a></li>
                                                                                                                                                <li><a href="components_notifications.html">Notifications</a></li>
                                                                                                                                                <li><a href="components_panels.html">Panels</a></li>
                                                                                                                                                <li><a href="components_preloaders.html">Preloaders</a></li>
                                                                                                                                                <li><a href="components_slideshow.html">Slideshow</a></li>
                                                                                                                                                <li><a href="components_sortable.html">Sortable</a></li>
                                                                                                                                                <li><a href="components_switcher.html">Switcher</a></li>
                                                                                                                                                <li><a href="components_tables.html">Tables</a></li>
                                                                                                                                                <li><a href="components_tables_examples.html">Tables Examples</a></li>
                                                                                                                                                <li><a href="components_tabs.html">Tabs</a></li>
                                                                                                                                                <li><a href="components_tooltips.html">Tooltips</a></li>
                                                                                                                                                <li><a href="components_typography.html">Typography</a></li>
                                                                                                </ul>
                                            </li>
                                    <li title="E-commerce">
                        <a href="#.html">
                            <span class="menu_icon"><i class="material-icons">&#xE8CB;</i></span>
                            <span class="menu_title">E-commerce</span>
                        </a>
                                                    <ul>
                                                                                                            <li><a href="ecommerce_product_details.html">Product Details</a></li>
                                                                                                                                                <li><a href="ecommerce_product_edit.html">Product Edit</a></li>
                                                                                                                                                <li><a href="ecommerce_products_grid.html">Products Grid</a></li>
                                                                                                                                                <li><a href="ecommerce_products_list.html">Products List</a></li>
                                                                                                </ul>
                                            </li>
                                    <li title="Plugins">
                        <a href="#.html">
                            <span class="menu_icon"><i class="material-icons">&#xE8C0;</i></span>
                            <span class="menu_title">Plugins</span>
                        </a>
                                                    <ul>
                                                                                                            <li><a href="plugins_calendar.html">Calendar</a></li>
                                                                                                                                                <li><a href="plugins_charts.html">Charts</a></li>
                                                                                                                                                <li><a href="plugins_code_editor.html">Code Editor</a></li>
                                                                                                                                                <li><a href="plugins_crud_table.html">CRUD Table</a></li>
                                                                                                                                                <li><a href="plugins_datatables.html">Datatables</a></li>
                                                                                                                                                <li><a href="plugins_diff.html">Diff View</a></li>
                                                                                                                                                <li><a href="plugins_gantt_chart.html">Gantt Chart</a></li>
                                                                                                                                                <li><a href="plugins_google_maps.html">Google Maps</a></li>
                                                                                                                                                <li><a href="plugins_idle_timeout.html">Idle Timeout</a></li>
                                                                                                                                                <li><a href="plugins_tablesorter.html">Tablesorter</a></li>
                                                                                                                                                <li><a href="plugins_tree.html">Tree</a></li>
                                                                                                                                                <li><a href="plugins_vector_maps.html">Vector Maps</a></li>
                                                                                                </ul>
                                            </li>
                                    <li title="Pages">
                        <a href="#.html">
                            <span class="menu_icon"><i class="material-icons">&#xE24D;</i></span>
                            <span class="menu_title">Pages</span>
                        </a>
                                                    <ul>
                                                                                                            <li><a href="page_blank.html">Blank</a></li>
                                                                                                                                                <li><a href="page_contact_list.html">Contact List</a></li>
                                                                                                                                                <li><a href="page_gallery.html">Gallery</a></li>
                                                                                                                                                <li><a href="page_help.html">Help/Faq</a></li>
                                                                                                                                                <li><a href="login.html">Login Page</a></li>
                                                                                                                                                <li><a href="page_notes.html">Notes</a></li>
                                                                                                                                                <li><a href="page_pricing_tables.html">Pricing Tables</a></li>
                                                                                                                                                <li><a href="page_search_results.html">Search Results</a></li>
                                                                                                                                                <li><a href="page_settings.html">Settings</a></li>
                                                                                                                                                <li><a href="page_todo.html">Todo</a></li>
                                                                                                                                                <li><a href="page_user_edit.html">User edit</a></li>
                                                                                                                                                <li class="menu_subtitle">Issue Tracker</li>
                                                                                    <li><a href="page_issues_list.html">List View</a></li>
                                                                                    <li><a href="page_issue_details.html">Issue Details</a></li>
                                                                                                                                                                                        <li class="menu_subtitle">Blog</li>
                                                                                    <li><a href="page_blog_list.html">Blog List</a></li>
                                                                                    <li><a href="page_blog_article.html">Blog Article</a></li>
                                                                                                                                                                                        <li class="menu_subtitle">Errors</li>
                                                                                    <li><a href="error_404.html">Error 404</a></li>
                                                                                    <li><a href="error_500.html">Error 500</a></li>
                                                                                                                                        </ul>
                                            </li>
                                <li>
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE241;</i></span>
                        <span class="menu_title">Multi level</span>
                    </a>
                    <ul>
                        <li>
                            <a href="#">First level</a>
                            <ul>
                                <li>
                                    <a href="#">Second Level</a>
                                    <ul>
                                        <li>
                                            <a href="#">Third level</a>
                                        </li>
                                        <li>
                                            <a href="#">Third level</a>
                                        </li>
                                        <li>
                                            <a href="#">Third level</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Long title to test</a>
                                    <ul>
                                        <li>
                                            <a href="#">Third level</a>
                                        </li>
                                        <li>
                                            <a href="#">Third level</a>
                                        </li>
                                        <li>
                                            <a href="#">Third level</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Even longer title multi line</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside><!-- main sidebar end -->

    <div id="page_content">
        <div id="page_content_inner">
			<div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
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
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo ($query['data_user'][0]['full_name']!=''?$query['data_user'][0]['full_name']:$query['data_user'][0]['username'])?></span><span class="sub-heading"><?php echo $query['data_user'][0]['bio']?></span></h2>
                                <ul class="user_stats">
                                    <li>
                                        <h4 class="heading_a"><?php echo $query['data_user'][0]['followed_by']?> <span class="sub-heading">Followers Instagram</span></h4>
                                    </li>
									<!--
                                    <li>
                                        <h4 class="heading_a">120 <span class="sub-heading">Photos</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">284 <span class="sub-heading">Following</span></h4>
                                    </li>
									-->
                                </ul>
                            </div>
                            <a class="md-fab md-fab-small md-fab-accent" href="page_user_edit.html">
                                <i class="material-icons">&#xE150;</i>
                            </a>
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
                                    Et eum magni non sed ut iusto quas provident beatae magni tempore necessitatibus quo ipsa dolores voluptas autem reiciendis possimus harum rem recusandae pariatur aut magnam ullam dolor velit nam minus velit expedita voluptatum rerum molestiae sed autem fuga distinctio iusto aut maiores minima odio explicabo quo qui quae sint accusamus natus molestiae ut accusamus enim nihil optio ipsa non dicta ut velit saepe expedita molestiae aut aut assumenda quis et et omnis corporis nihil minus aspernatur quisquam cumque sunt maiores qui minima natus voluptatem saepe vitae non dignissimos maxime quae consequatur rerum non quod eaque debitis omnis id nihil voluptas iste dolore dolorem atque consequatur ea et laudantium quo aspernatur rerum vero illo non nihil rerum blanditiis possimus architecto quas voluptatem aut laudantium rem nostrum numquam fuga sit unde rerum nihil nemo nesciunt magni consequatur sed quasi sapiente vero consequuntur alias vel maiores sunt occaecati et necessitatibus dolores quaerat id et qui error nobis nisi omnis explicabo est in provident accusamus sunt rem hic sunt est.                                    <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">Contact Info</h4>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">uschoen@gmail.com</span>
                                                        <span class="uk-text-small uk-text-muted">Email</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">(811)050-3792</span>
                                                        <span class="uk-text-small uk-text-muted">Phone</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">facebook.com/envato</span>
                                                        <span class="uk-text-small uk-text-muted">Facebook</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">twitter.com/envato</span>
                                                        <span class="uk-text-small uk-text-muted">Twitter</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">My groups</h4>
                                            <ul class="md-list">
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Cloud Computing</a></span>
                                                        <span class="uk-text-small uk-text-muted">125 Members</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Account Manager Group</a></span>
                                                        <span class="uk-text-small uk-text-muted">277 Members</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Digital Marketing</a></span>
                                                        <span class="uk-text-small uk-text-muted">179 Members</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">HR Professionals Association - Human Resources</a></span>
                                                        <span class="uk-text-small uk-text-muted">165 Members</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h4 class="heading_c uk-margin-bottom">Timeline</h4>
                                    <div class="timeline">
                                        <div class="timeline_item">
                                            <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE85D;</i></div>
                                            <div class="timeline_date">
                                                09 <span>May</span>
                                            </div>
                                            <div class="timeline_content">Created ticket <a href="#"><strong>#3289</strong></a></div>
                                        </div>
                                        <div class="timeline_item">
                                            <div class="timeline_icon timeline_icon_danger"><i class="material-icons">&#xE5CD;</i></div>
                                            <div class="timeline_date">
                                                15 <span>May</span>
                                            </div>
                                            <div class="timeline_content">Deleted post <a href="#"><strong>Qui et suscipit quod iure consequuntur voluptatibus sint.</strong></a></div>
                                        </div>
                                        <div class="timeline_item">
                                            <div class="timeline_icon"><i class="material-icons">&#xE410;</i></div>
                                            <div class="timeline_date">
                                                19 <span>May</span>
                                            </div>
                                            <div class="timeline_content">
                                                Added photo
                                                <div class="timeline_content_addon">
                                                    <img src="<?php echo base_url()?>assets/img/gallery/Image16.jpg" alt=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline_item">
                                            <div class="timeline_icon timeline_icon_primary"><i class="material-icons">&#xE0B9;</i></div>
                                            <div class="timeline_date">
                                                21 <span>May</span>
                                            </div>
                                            <div class="timeline_content">
                                                New comment on post <a href="#"><strong>Hic est non error maxime.</strong></a>
                                                <div class="timeline_content_addon">
                                                    <blockquote>
                                                        Excepturi officiis a placeat deleniti distinctio dolorem aut excepturi omnis debitis vel corrupti consequatur numquam soluta molestiae.&hellip;
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline_item">
                                            <div class="timeline_icon timeline_icon_warning"><i class="material-icons">&#xE7FE;</i></div>
                                            <div class="timeline_date">
                                                29 <span>May</span>
                                            </div>
                                            <div class="timeline_content">
                                                Added to Friends
                                                <div class="timeline_content_addon">
                                                    <ul class="md-list md-list-addon">
                                                        <li>
                                                            <div class="md-list-addon-element">
                                                                <img class="md-user-image md-list-addon-avatar" src="<?php echo base_url()?>assets/img/avatars/avatar_02_tn.png" alt=""/>
                                                            </div>
                                                            <div class="md-list-content">
                                                                <span class="md-list-heading">Rubye Abbott</span>
                                                                <span class="uk-text-small uk-text-muted">Nostrum impedit est dolores.</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
									
									<!-- statistics (small charts) -->
									<div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
										<div>
											<div class="md-card">
												<div class="md-card-content">
													<div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_visitors peity_data">5,3,9,6,5,9,7</span></div>
													<span class="uk-text-muted uk-text-small">Total Foto</span>
													<h2 class="uk-margin-remove"><span class="countUpMe"><?php echo count(@$arr['image'])?></span></h2>
												</div>
											</div>
										</div>
										<div>
											<div class="md-card">
												<div class="md-card-content">
													<div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span></div>
													<span class="uk-text-muted uk-text-small">Total Video</span>
													<h2 class="uk-margin-remove"><span class="countUpMe"><?php echo count(@$arr['video'])?></span></h2>
													
												</div>
											</div>
										</div>
										<div>
											<div class="md-card">
												<div class="md-card-content">
													<div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">64/100</span></div>
													<span class="uk-text-muted uk-text-small">Total Likes</span>
													<h2 class="uk-margin-remove"><span class="countUpMe"><?php echo $count_like?></span></h2>
												</div>
											</div>
										</div>
										<div>
											<div class="md-card">
												<div class="md-card-content">
													<div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_visitors peity_data">5,3,9,6,5,9,7</span></div>
													<span class="uk-text-muted uk-text-small">Total Comments</span>
													<h2 class="uk-margin-remove"><span class="countUpMe"><?php echo $count_comment?></span></h2>
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
                                    
									
									<div class="uk-grid">
										<div class="uk-width-1-1">
											<div class="md-card">
												<div class="md-card-toolbar">
													<div class="md-card-toolbar-actions">
														<i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>
														<i class="md-icon material-icons">&#xE5D5;</i>
														<div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}">
															<i class="md-icon material-icons">&#xE5D4;</i>
															<div class="uk-dropdown uk-dropdown-small">
																<ul class="uk-nav">
																	<li><a href="#" class="action_graph" id="action1">Action 1</a></li>
																	<li><a href="#" class="action_graph" id="action2">Action 2</a></li>
																</ul>
															</div>
														</div>
													</div>
													<h3 class="md-card-toolbar-heading-text">
														Chart
													</h3>
												</div>
												<div class="md-card-content">
													<div class="mGraph-wrapper">
														<div id="mGraph_sale" class="mGraph" data-uk-check-display></div>
													</div>
													<div class="md-card-fullscreen-content">
														<div class="uk-overflow-container">
															<table class="uk-table uk-table-no-border uk-text-nowrap">
															<thead>
																<tr>
																	<th>Date</th>
																	<th>Best Seller</th>
																	<th>Total Sale</th>
																	<th>Change</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>January 2014</td>
																	<td>Accusamus aut ipsa.</td>
																	<td>$3 234 162</td>
																	<td>0</td>
																</tr>
																<tr>
																	<td>February 2014</td>
																	<td>Eligendi rerum voluptatem voluptate.</td>
																	<td>$3 771 083</td>
																	<td class="uk-text-success">+2.5%</td>
																</tr>
																<tr>
																	<td>March 2014</td>
																	<td>Quo dolor dolore vitae.</td>
																	<td>$2 429 352</td>
																	<td class="uk-text-danger">-4.6%</td>
																</tr>
																<tr>
																	<td>April 2014</td>
																	<td>Sunt perferendis ea labore.</td>
																	<td>$4 844 169</td>
																	<td class="uk-text-success">+7%</td>
																</tr>
																<tr>
																	<td>May 2014</td>
																	<td>Corrupti iure iure.</td>
																	<td>$5 284 318</td>
																	<td class="uk-text-success">+3.2%</td>
																</tr>
																<tr>
																	<td>June 2014</td>
																	<td>Non impedit est deleniti.</td>
																	<td>$4 688 183</td>
																	<td class="uk-text-danger">-6%</td>
																</tr>
																<tr>
																	<td>July 2014</td>
																	<td>Minima praesentium similique.</td>
																	<td>$4 353 427</td>
																	<td class="uk-text-success">-5.3%</td>
																</tr>
															</tbody>
														</table>
														</div>
														<p class="uk-margin-large-top uk-margin-small-bottom heading_list uk-text-success">Some Info:</p>
														<p class="uk-margin-top-remove">Sunt accusantium sed esse quas alias et facilis et fugiat reiciendis eius explicabo rerum sunt ut adipisci officia beatae est sint eaque repudiandae et atque et nobis sequi optio voluptatum et nam non pariatur cupiditate voluptatem recusandae omnis quia doloribus esse nobis ad dolorum qui suscipit magnam ut facere consequatur aspernatur et eum omnis aliquam eligendi temporibus assumenda eaque ullam eligendi necessitatibus explicabo voluptatibus consequuntur voluptatem accusamus quis illum consequatur dolorum et molestiae earum deserunt aut blanditiis quis eveniet ut quisquam voluptatem praesentium quae fuga culpa nulla rerum delectus cupiditate cumque occaecati quod possimus dolor quo voluptatem ut distinctio porro molestiae sed facere blanditiis rem ratione voluptatem dignissimos et culpa veritatis.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
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
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">A assumenda in repellendus tenetur.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">24 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">8</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">374</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Id distinctio molestiae et eaque ut in.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">20 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">6</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">207</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Sit error doloremque nihil deserunt numquam.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">16 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">15</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">162</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Delectus est numquam error ut quasi excepturi quasi.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">28 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">2</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">608</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Omnis aut voluptatem ex ut molestiae sit asperiores.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">12 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">27</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">233</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Doloribus sequi accusamus nam eum nobis magnam quisquam praesentium.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">26 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">8</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">777</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Eos qui fugiat dolores id omnis quo qui ut.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">24 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">2</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">213</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Voluptates accusamus repellendus accusamus sit.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">13 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">3</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">617</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Aut id voluptatem nihil optio officiis nobis quos.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">12 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">23</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">754</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Quo assumenda debitis et fugiat quaerat.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">05 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">2</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">125</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Molestias fuga placeat minus explicabo inventore beatae.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">24 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">24</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">373</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Fugiat qui omnis natus accusamus.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">04 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">14</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">561</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Voluptate modi dolorem quod dolore amet odio.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">08 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">1</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">133</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Autem corrupti nihil dolor modi cumque maxime.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">09 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">28</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">167</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Deleniti tempore qui magnam distinctio velit quod voluptatum.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">25 May 2016</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">10</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">128</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
								<li>
								<span>Facebook</span>
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
        
        <script>
		
		$(function() {
					altair_dashboard.init();
				});
				altair_dashboard = {
					init: function () {
						'use strict';
						altair_dashboard.metrics_charts();
					},
					metrics_charts: function () {
						var mGraph_sale = '#mGraph_sale';
						if ($(mGraph_sale).length) {
							var $thisEl_height = 0;
							function buildGraph_sale() {
								
								if($thisEl_height == 0) {
									var $thisEl_height = $(mGraph_sale).height();
								}

								var $thisEl_width = $(mGraph_sale).width();
								var data_reload = <?php echo $data_reload;?>;	
								
								//d3.json("http://localhost/instagram/comment_graph.html", function (data) {
									
									data = [data_reload];
								
									for (var i = 0; i < data.length; i++) {
										data[i] = MG.convert.date(data[i], 'date');
									}
									/*
									var markers = [
										{
											'date': new Date('2016-02-26T00:00:00.000Z'),
											'label': 'Winter Sale'
										},
										{
											'date': new Date('2016-06-02T00:00:00.000Z'),
											'label': 'Spring Sale'
										}
									];
									*/
									// add a chart that has a log scale
									MG.data_graphic({
										data: data,
										y_scale_type: 'log',
										width: $thisEl_width,
										height: $thisEl_height,
										right: 20,
										target: mGraph_sale,
										//markers: markers,
										x_accessor: 'date',
										y_accessor: 'value'
									});
								//});

							}

							buildGraph_sale();

							$window.on('debouncedresize', function () {
								buildGraph_sale();
							});

							$("#mGraph_sale").on('display.uk.check', function(){
								buildGraph_sale();
							});

						}
					}
				};
		
	   </script>
	   
	   
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
				ChangeUrl('replace', id, split[3]);	
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