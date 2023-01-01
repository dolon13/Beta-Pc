<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logSign'] = 'welcome/logSign';

$route['pc_build'] = 'welcome/pc_built';
$route['pcbuilder'] = 'welcome/pcbuilder';

$route['community'] = 'welcome/community_page';
$route['create_post'] = 'welcome/create_community_post';

$route['add'] = 'welcome/add_item';

$route['add/psu'] = 'welcome/ad_psu';
$route['add/ssd'] = 'welcome/ad_ssd';
$route['add/hdd'] = 'welcome/ad_hdd';
$route['add/casing'] = 'welcome/ad_casing';
$route['add/cpu'] = 'welcome/ad_cpu';
$route['add/mboard'] = 'welcome/ad_mboard';
$route['add/ram'] = 'welcome/ad_ram';
$route['add/gpu'] = 'welcome/ad_gpu';


$route['product/(:any)'] = 'welcome/product/$1';
$route['product-page/(:any)/(:any)'] = 'welcome/product_page/$1/$2';
$route['review/(:any)/(:any)'] = 'welcome/review/$1/$2';
$route['addReview/(:any)/(:any)'] = 'welcome/addReview/$1/$2';