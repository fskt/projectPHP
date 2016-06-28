<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';
$route['dashboard'] = 'welcome/dashboard';
$route['comment_graph'] = 'welcome/commentGraph';
$route['user'] = 'welcome/user';
$route['user/(:any)'] = 'welcome/user/$1';
$route['brief'] = 'welcome/brief';
$route['brief_detail/(:any)'] = 'welcome/brief_detail/$1';
$route['content_brief_textarea_area'] = 'welcome/uploadTemp';
$route['create_brief'] = 'welcome/create_brief';
$route['login'] = 'welcome/login';
$route['logout'] = 'welcome/logout';
$route['report'] = 'welcome/report/youtube';
$route['report_youtube'] = 'welcome/report/youtube';
$route['report_instagram'] = 'welcome/report/instagram';
$route['report_facebook'] = 'welcome/report/facebook';
$route['report_twitter'] = 'welcome/report/twitter';
$route['report_youtube/(:any)'] = 'welcome/report/youtube/$1';
$route['report_instagram/(:any)'] = 'welcome/report/instagram/$1';
$route['report_facebook/(:any)'] = 'welcome/report/facebook/$1';
$route['report_twitter/(:any)'] = 'welcome/report/twitter/$1';
$route['report_detail/(:any)'] = 'welcome/report_detail/$1';
$route['signup'] = 'welcome/signup';
$route['forgot_password'] = 'welcome/forgot_pass';
$route['verified'] = 'welcome/verified';
$route['verified_password'] = 'welcome/verified_password';
$route['edit_profile'] = 'welcome/edit_profile';
$route['edit_profile/(:any)'] = 'welcome/edit_profile/$1';
$route['oauth2callback'] = 'welcome/youtube_access_token';
$route['action_notif'] = 'welcome/action_notif';
$route['instagram_recent'] = 'welcome/media_recent/instagram';
$route['youtube_recent'] = 'welcome/media_recent/youtube';
$route['instagram_recent_log'] = 'welcome/media_recent_log/instagram';
$route['youtube_recent_log'] = 'welcome/media_recent_log/youtube';
$route['post_instagram'] = 'instagramCls';
$route['post_youtube'] = 'youtubeCls';

/* End of file routes.php */
/* Location: ./application/config/routes.php */