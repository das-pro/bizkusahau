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
  |	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'bizhuru';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route_structure = array(
    'bizhuru' => array('index','site_front','gettingstarted','accountverification','account_activation',
                        'timeline'),
    'auth' => array('login','logout'),
    'admin' => array('admin'),
    'AjaxUpload' => array('ajax_uploadProfilePic','ajax_uploadCoverPhoto','ajax_saveCoverPhotoPosition','ajax_verifychangeemail',
                      'ajax_resendemailverification','ajax_educationform','ajax_saveeducationinfo',
                       'ajax_workform','ajax_saveworkinfo','ajax_is_session_active','ajax_is_online',
                     'ajax_postimg_upload','ajax_remove_timelinephoto','ajax_awardform','ajax_saveawardinfo'),
    'Wall'=>array('wall_sendpost','ajax_imgpopup','ajax_postcomment','ajax_morecomment','ajax_commentvote'),
    'Suggestion' => array('pages'),
    'Fields' => array('userinfo','userinfocontact','rmcontact'),
     'Cv' =>array('create_cv','view_cv','filter_cv','ajax_filter_cv','preview_cv'),
    'Shopping_cart'=>array('addto_cart','cart_checkout','cart_item_remove','cart_purchase'),
    'Payment'=>array('credit_package'),
    'Mystore'=>array('mystore'),
    'Jobpost'=>array('jobpost','popup_benefit','popup_benefitadd','view_jobpost','apply_job','jobpost_list','pull_jobpost')
);

foreach ($route_structure as $controller => $functions) {
    foreach ($functions as $key => $func) {
        $route[$func] = $controller . "/" . $func;
        $route[$func . '/(:any)'] = $controller . "/" . $func . '/$1';
    }
}
