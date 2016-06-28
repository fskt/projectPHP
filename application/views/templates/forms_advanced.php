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
    <!-- htmleditor (codeMirror) -->
    <link rel="stylesheet" href="<?php echo base_url()?>bower_components/codemirror/lib/codemirror.css">
    
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
                                                        <span class="md-user-letters md-bg-cyan">rs</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Soluta praesentium nihil.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Inventore mollitia doloremque totam sunt facere omnis qui ipsum.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo base_url()?>assets/img/avatars/avatar_07_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Cumque temporibus.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Veniam nostrum sed temporibus perspiciatis beatae qui incidunt ratione nostrum.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-light-green">ky</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Cupiditate minima.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Autem vero velit iure voluptatem natus blanditiis repellat.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo base_url()?>assets/img/avatars/avatar_02_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Quo harum deserunt.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Et qui facilis perferendis qui exercitationem a autem qui recusandae quia.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo base_url()?>assets/img/avatars/avatar_09_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">In expedita.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Quisquam rem ratione nam quisquam rerum mollitia.</span>
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
                                                        <span class="md-list-heading">Odio minima.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Ut nulla quisquam vel iure et sint minus.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-success">&#xE88F;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Assumenda aliquam.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Est blanditiis asperiores in eum.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-danger">&#xE001;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Aspernatur quidem.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Reiciendis velit dolorem totam possimus corrupti unde.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-primary">&#xE8FD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Qui amet.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Eveniet eum cupiditate modi quaerat est consectetur non.</span>
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
                                    <li title="User Profile">
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
                                                                                                                                                <li class="act_item"><a href="forms_advanced.html">Advanced Elements</a></li>
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
	<?php echo $message?>
	<form method="post" action="<?php echo base_url()?>brief.html" enctype="multipart/form-data">
    <div id="page_content">
        <div id="page_content_inner">
            <div class="md-card">
				<div class="md-card-content">
					<h3 class="heading_a">Media Sosial</h3>
					<div class="uk-grid" data-uk-grid-margin>
						<div class="uk-width-medium-3-5">
							<span class="icheck-inline">
								<input type="checkbox" name="checkbox_sosmed[]" value="instagram" data-md-icheck />
								<label for="checkbox_demo_inline_1" class="inline-label">Instagram</label>
							</span>
							<span class="icheck-inline">
								<input type="checkbox" name="checkbox_sosmed[]" value="youtube" data-md-icheck />
								<label for="checkbox_demo_inline_2" class="inline-label">Youtube</label>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Pilih Creator</h3>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-1-1">
                            <select id="selec_adv_1nn" name="creator[]" multiple>
                                <?php
								echo $option;
								?>
                            </select>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h3 class="heading_a">Date range</h3>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-large-1-3 uk-width-medium-1-1">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_start">Start Date</label>
                                        <input class="md-input" name="start_date" type="text" id="uk_dp_start">
                                    </div>
                                </div>
                                <div class="uk-width-large-1-3 uk-width-medium-1-1">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_end">End Date</label>
                                        <input class="md-input" name="end_date" type="text" id="uk_dp_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-grid" data-uk-grid-match="{target:'.md-card'}" data-uk-grid-margin>
                <div class="uk-width-medium-1-1">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h3 class="heading_a uk-margin-bottom">Form file</h3>
                            <div class="uk-form-file md-btn md-btn-primary">
                                Select
                                <input id="form-file" name="upload_file" type="file">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a uk-margin-bottom">Html Editor</h3>
                    <textarea name="message" data-uk-htmleditor="{ maxsplitsize:1220, codemirror : { mode: 'text/html' } }"></textarea>
                </div>
            </div>

			<div class="md-card">
                <div class="md-card-content">
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-1-1">
                            <input type="submit" name="submit" value="submit">
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
    <!-- ionrangeslider -->
    <script src="<?php echo base_url()?>bower_components/ion.rangeslider/js/ion.rangeSlider.min.js"></script>
    <!-- htmleditor (codeMirror) -->
    <script src="<?php echo base_url()?>assets/js/uikit_htmleditor_custom.min.js"></script>
    <!-- inputmask-->
    <script src="<?php echo base_url()?>bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>

    <!--  forms advanced functions -->
    <script src="<?php echo base_url()?>assets/js/pages/forms_advanced.js"></script>
    
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