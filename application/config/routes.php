<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'MainController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['Login-Check'] = 'MainController/Login_Check';
$route['Dashboard'] = 'MainController/Dashboard';
$route['Vehicles'] = 'VehicleController/Vehicles';
$route['Upload-Vehicle'] = 'VehicleController/Upload_Vehicle';
$route['Delete-Vehicle'] = 'VehicleController/Delete_Vehicle';
$route['Edit-Vehicle'] = 'VehicleController/Edit_Vehicle';
$route['Fuel-Filling'] = 'FuelController/Fuel_Filling';
$route['Upload-Fuel'] = 'FuelController/Upload_Fuel';
$route['Search-Report'] = 'MainController/Search_Report';
$route['Logout'] = 'MainController/Logout';

