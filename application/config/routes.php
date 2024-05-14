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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Home/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/auth/profile'] = 'api/User/profile';
$route['api/auth/login'] = 'api/User/login';
$route['api/auth/register'] = 'api/User/register';
$route['api/auth/logout'] = 'api/User/logout';
$route['api/auth/delete_account/(:num)'] = 'api/User/delete/$1';
$route['api/auth/forgot_password'] = 'api/User/forgot_password';
$route['api/auth/reset_password'] ='api/User/reset_password';

$route['api/questions'] = 'api/Questions/questions';
$route['api/question/(:num)'] = 'api/Questions/view_question/$1';
$route['api/question'] = 'api/Questions/submit_question';
$route['api/question/search'] = 'api/Questions/search';

$route['api/answer'] = 'api/Answer/submit';
$route['api/answer/vote/upvote'] = 'api/Answer/vote';
$route['api/answer/vote/downvote'] = 'api/Answer/vote';

$route['api/comment'] = 'api/Comments/submit';










