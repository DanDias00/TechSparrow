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

// Custom routes


$route['questions'] = 'Questions/all_questions';
$route['ask'] = 'Questions/ask_question';
$route['register'] = 'User/register';
//$route['submit_question'] = 'Questions/submit_question';
$route['view_question/(:any)'] = 'Questions/view_question/$1';
$route['search'] = 'Questions/search';
$route['user_questions'] = 'Questions/user_questions';
$route['delete_question/(:any)'] = 'Questions/delete_question/$1';
$route['update_question/(:any)'] = 'Questions/update_question/$1';
#$route['Myprofile'] = 'User/profile';
$route['logout'] = 'User/logout';
$route['edit_profile'] = 'User/edit_profile';
$route['update_profile'] = 'User/update_profile';
$route['submit_comment'] = 'comments/submit_comment';
$route['submit_answer'] = 'answer/submit';

// Custom routes for header links
$route['Home'] = 'Home/view';
$route['contact'] = 'Home/contact';
$route['privacy'] = 'Home/privacy';
$route['terms'] = 'Home/terms';
$route['faq'] = 'Home/faq';



$route['api/questions'] = 'questions_api/questions';
$route['api/questions/(:any)'] = 'questions_api/questions/$1';
$route['answer']  = 'answer/submit';

//for backbone js
$route['profile'] = 'api/User/profile';
$route['login'] = 'api/User/login';
$route['register'] = 'api/User/register';
$route['logout'] = 'api/User/logout';
$route['delete_account/(:num)'] = 'api/User/delete/$1';
$route['forgot_password'] = 'api/User/forgot_password';
$route['reset_password'] ='api/User/reset_password';
$route['answer'] = 'api/Answer/submit';
$route['comment'] = 'api/Comments/submit';
$route['question'] = 'questions_api/submit_question';
$route['answer/vote/upvote'] = 'api/Answer/vote';
$route['answer/vote/downvote'] = 'api/Answer/vote';










