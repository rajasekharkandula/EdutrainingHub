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

$route['admin'] = 'admin';
$route['admin/'] = 'admin/';
$route['admin/(:any)'] = 'admin/$1';
$route['admin/(:any)/(:any)'] = 'admin/$1/$2';

$route['admin_course'] = 'admin_course';
$route['admin_course/'] = 'admin_course/';
$route['admin_course/(:any)'] = 'admin_course/$1';
$route['admin_course/(:any)/(:any)'] = 'admin_course/$1/$2';

$route['cart'] = 'cart';
$route['cart/'] = 'cart/';
$route['cart/(:any)'] = 'cart/$1';
$route['cart/(:any)/(:any)'] = 'cart/$1/$2';

$route['home'] = 'home';
$route['home/'] = 'home/';
$route['home/(:any)'] = 'home/$1';
$route['home/(:any)/(:any)'] = 'home/$1/$2';

$route['(:any)'] = 'home/index/$1';
$route['(:any)/(:any)'] = 'home/index/$1/$2';
$route['(:any)/(:any)/(:any)'] = 'home/index/$1/$2/$3';
$route['default_controller'] = "home";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */