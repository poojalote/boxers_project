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
$route['default_controller'] = 'LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['inlineTableTest'] = 'LoginController/inlineTableTest';
$route['LoginFromRMT/(:any)'] = 'LoginController/LoginFromRMT/$1';
$route['AddFocusView'] = 'FocusViewController/AddFocusView';
$route['GetFocusData'] = 'FocusViewController/GetFocusData';
$route['GetFocusChildData'] = 'FocusViewController/GetFocusChildData';

$route['DeleteFocusView'] = 'FocusViewController/DeleteFocusView';
$route['UpdateFocusView'] = 'FocusViewController/UpdateFocusView';
$route['CompleteFocusView'] = 'FocusViewController/CompleteFocusView';


$route['AddFocusComment'] = 'FocusViewController/AddFocusComment';
$route['getFocusComment'] = 'FocusViewController/getFocusComment';

$route['addTodaysActivity'] = 'FocusViewController/addTodaysActivity';
$route['GetActivityData'] = 'FocusViewController/GetActivityData';
$route['DeleteTodaysActivity'] = 'FocusViewController/DeleteTodaysActivity';
$route['updateTodayActivityView'] = 'FocusViewController/updateTodayActivityView';
$route['AddActivityComment'] = 'FocusViewController/AddActivityComment';
$route['getActivityComment'] = 'FocusViewController/getActivityComment';

$route['getEmployeeUnderSenior'] = 'FocusViewController/getEmployeeUnderSenior';
$route['GetFocusassigntoemployee'] = 'FocusViewController/GetFocusassigntoemployee';

$route['AddTaskAssignByU'] = 'FocusViewController/addTask';
$route['updateTaskAssignByUView'] = 'FocusViewController/updateTaskAssignByUView';

$route['deleteTaskAssignByUView'] = 'FocusViewController/deletetask';

$route['AddTaskToComment'] = 'FocusViewController/AddTaskToComment';
$route['getTaskToComment'] = 'FocusViewController/getTaskToComment';
$route['CompleteTaskView'] = 'FocusViewController/CompleteTaskView';

$route['getTaskAssignToEmployee'] = 'FocusViewController/getTaskAssignToEmployee';
$route['getTaskAssignBYEmployee'] = 'FocusViewController/getTaskAssignBYEmployee';




// $route['AddTaskAssignByU'] = 'FocusViewController/AddTaskAssignByU';
/* Login */
$route['login'] = 'LoginController/loginUser';
$route['logout'] = 'LoginController/logout';


/* Dashboard View */

$route['dashboard'] = 'Dist/index';
$route['sample'] = 'Dist/sample';

//Payroll Controller
$route['GetLeaveTypes'] = 'PayrollController/getLeaveTypes';
$route['create_leave_req'] = 'PayrollController/add_leave_request';
$route['AddMissingPunch'] = 'PayrollController/AddMissingPunch';
$route['GetCalendarData'] = 'PayrollController/GetCalendarData';
$route['emp_login_mbl'] = 'PayrollController/emp_login_mbl';
$route['GetLoginDetails'] = 'PayrollController/GetLoginDetails';
$route['AddEventPayroll'] = 'PayrollController/AddEventPayroll';
$route['getPermissionUser'] = 'PayrollController/getPermissionUser';


//Sticky note
$route['CreateNewSticky'] = 'StickyController/CreateNewSticky';
$route['UpdateSticky'] = 'StickyController/UpdateSticky';
$route['getAllSticky'] = 'StickyController/getAllSticky';
$route['createNotes'] = 'StickyController/createNotes';
$route['GetEventByid'] = 'PayrollController/GetEventByid';
$route['AddEventDetailsNotes'] = 'PayrollController/AddEventDetailsNotes';
$route['deleteEventFun'] = 'PayrollController/deleteEventFun';
