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
$route['default_controller'] = 'home';
$route['book-consultation/applicant'] = 'Bookconsultation/index';
$route['book-consultation/employer'] = 'Employerbooking/index';

////Service Applicant
$route['service/applicant/temporary-Foreign-Worker-programs'] = 'Service/Applicant/tfwProgrammes';
$route['service/applicant/visitor-visa-temporary-resident-visa'] = 'Service/Applicant/visitorVisa';
$route['service/applicant/study-in-canada'] = 'Service/Applicant/studentVisa';
$route['service/applicant/permanent-residency'] = 'Service/Applicant/permanentResidency';
//$route['service/applicant/community-regional-immigration-pathways'] = 'Service/Applicant/communityRegional';
$route['service/applicant/family-sponsorship-programs'] = 'Service/Applicant/familySponsorship';

///Service Employer
$route['service/employer/lmia-application'] = 'Service/Employer/lmiaApplication';
$route['service/employer/work-permit-services'] = 'Service/Employer/workPermitServices';
$route['service/employer/francophone-mobility-work-permit'] = 'Service/Employer/francophoneMobility';
$route['service/employer/atlantic-immigration-program-designations'] = 'Service/Employer/aipDesignations';
//$route['service/applicant/community-regional-immigration-pathways'] = 'Service/Applicant/communityRegional';
$route['service/employer/tfw-workforce-management-service'] = 'Service/Employer/tfwService';

/// Booking Type
$route['book-consultation/select-booking-type'] = 'Bookconsultation/bookingType';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
