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

$route['default_controller'] = "home";
$route['404_override'] = 'errors/error_404';
$route['admin'] = 'admin/admin';
$route['admin/login'] = 'admin/login';
$route['admin/login/(:any)'] = 'admin/login/$1';
$route["admin/channels"] = 'admin/channels';
$route["admin/channels/(:any)"] = 'admin/channels/$1';
$route["admin/whats"] = 'admin/whats';
$route["admin/whats/(:any)"] = 'admin/whats/$1';
$route["admin/users"] = 'admin/users';
$route["admin/users/(:any)"] = 'admin/users/$1';
$route["admin/sponsors"] = 'admin/sponsors';
$route["admin/sponsors/(:any)"] = 'admin/sponsors/$1';
$route["admin/sms"] = 'admin/sms';
$route["admin/sms/(:any)"] = 'admin/sms/$1';
$route["admin/email"] = 'admin/email';
$route["admin/email/(:any)"] = 'admin/email/$1';
$route["admin/products"] = 'admin/products';
$route["admin/products/(:any)"] = 'admin/products/$1';
$route["admin/pages"] = 'admin/pages';
$route["admin/pages/(:any)"] = 'admin/pages/$1';
$route["admin/offers"] = 'admin/offers';
$route["admin/offers/(:any)"] = 'admin/offers/$1';
$route["admin/news"] = 'admin/news';
$route["admin/news/(:any)"] = 'admin/news/$1';
$route["admin/nav"] = 'admin/nav';
$route["admin/nav/(:any)"] = 'admin/nav/$1';
$route["admin/gallery"] = 'admin/gallery';
$route["admin/gallery/(:any)"] = 'admin/gallery/$1';
$route["admin/langs"] = 'admin/langs';
$route["admin/langs/(:any)"] = 'admin/langs/$1';
$route["admin/videos"] = 'admin/videos';
$route["admin/videos/(:any)"] = 'admin/videos/$1';
$route["admin/links"] = 'admin/links';
$route["admin/links/(:any)"] = 'admin/links/$1';
$route["admin/slider"] = 'admin/slider';
$route["admin/slider/(:any)"] = 'admin/slider/$1';
$route["admin/footer"] = 'admin/footer';
$route["admin/footer/(:any)"] = 'admin/footer/$1';
$route["admin/contacts"] = 'admin/contacts';
$route["admin/contacts/(:any)"] = 'admin/contacts/$1';
$route["admin/guests"] = 'admin/guests';
$route["admin/guests/(:any)"] = 'admin/guests/$1';
$route["admin/groups"] = 'admin/groups';
$route["admin/groups/(:any)"] = 'admin/groups/$1';
$route["admin/notify"] = 'admin/notify';
$route["admin/notify/(:any)"] = 'admin/notify/$1';
$route["admin/reports"] = 'admin/reports';
$route["admin/reports/(:any)"] = 'admin/reports/$1';
$route["admin/banners"] = 'admin/banners';
$route["admin/banners/(:any)"] = 'admin/banners/$1';
$route['admin/(:any)'] = 'admin/admin/$1';

$route["(:any)/user/(:any)"] = "site/user/$2";
$route["(:any)/cp/(:any)"] = "usercp/$2";
$route["(:any)/cp/(:any)/(:any)"] = "usercp/$2/$3";
$route["operator.ssl/(:any)"] = "ajax/operatorajax/$1";
$route["chat.ssl/(:any)"] = "ajax/chatajax/$1";
$route["(:any)/(:any)"] = "home/$2";
$route["(:any)"] = "home";


/* End of file routes.php */
/* Location: ./application/config/routes.php */