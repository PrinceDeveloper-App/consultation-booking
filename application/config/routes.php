<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
|--------------------------------------------------------------------------
| Booking Routes
|--------------------------------------------------------------------------
*/
$route['book-consultation/applicant']          = 'Bookconsultation/index';
$route['book-consultation/employer']           = 'Employerbooking/index';
$route['book-consultation/select-booking-type'] = 'Bookconsultation/bookingType';

/*
|--------------------------------------------------------------------------
| Applicant Service Routes (SEO-friendly slugs)
|--------------------------------------------------------------------------
*/
$route['service/applicant/temporary-Foreign-Worker-programs']  = 'Service/Applicant/tfwProgrammes';
$route['service/applicant/visitor-visa-temporary-resident-visa'] = 'Service/Applicant/visitorVisa';
$route['service/applicant/study-in-canada']                    = 'Service/Applicant/studentVisa';
$route['service/applicant/permanent-residency']                = 'Service/Applicant/permanentResidency';
$route['service/applicant/family-sponsorship-programs']        = 'Service/Applicant/familySponsorship';

/*
|--------------------------------------------------------------------------
| Employer Service Routes (SEO-friendly slugs)
|--------------------------------------------------------------------------
*/
$route['service/employer/lmia-application']                        = 'Service/Employer/lmiaApplication';
$route['service/employer/work-permit-services']                    = 'Service/Employer/workPermitServices';
$route['service/employer/francophone-mobility-work-permit']        = 'Service/Employer/francophoneMobility';
$route['service/employer/atlantic-immigration-program-designations'] = 'Service/Employer/aipDesignations';
$route['service/employer/tfw-workforce-management-service']        = 'Service/Employer/tfwService';

/*
|--------------------------------------------------------------------------
| Admin Routes (grouped under admin/)
|--------------------------------------------------------------------------
*/
$route['admin']                             = 'Administrator/Dashboard';
$route['admin/login']                       = 'Administrator/Auth/index';
$route['admin/login/submit']                = 'Administrator/Auth/login';
$route['admin/logout']                      = 'Administrator/Auth/logout';
$route['admin/schedule']                    = 'Administrator/Schedule/create';
$route['admin/schedule/get']                = 'Administrator/Schedule/getSchedules';
$route['admin/schedule/save']               = 'Administrator/Schedule/timeSave';
$route['admin/schedule/delete']             = 'Administrator/Schedule/delete_slot';
$route['admin/schedule/slots']              = 'Administrator/Schedule/get_slots';

$route['admin/applicant/appointments']       = 'Administrator/Applicant/Appointments';
$route['admin/applicant/appointments/update'] = 'Administrator/Applicant/Appointments/update_status';
$route['admin/applicant/schedule']           = 'Administrator/Applicant/Schedule/create';
$route['admin/applicant/schedule/get']       = 'Administrator/Applicant/Schedule/getSchedules';
$route['admin/applicant/schedule/save']      = 'Administrator/Applicant/Schedule/timeSave';
$route['admin/applicant/schedule/delete']    = 'Administrator/Applicant/Schedule/delete_slot';
$route['admin/applicant/schedule/slots']     = 'Administrator/Applicant/Schedule/get_slots';

$route['admin/employer/appointments']        = 'Administrator/Employer/Appointments';
$route['admin/employer/appointments/update']  = 'Administrator/Employer/Appointments/update_status';
$route['admin/employer/schedule']            = 'Administrator/Employer/Schedule/create';
$route['admin/employer/schedule/get']        = 'Administrator/Employer/Schedule/getSchedules';
$route['admin/employer/schedule/save']       = 'Administrator/Employer/Schedule/timeSave';
$route['admin/employer/schedule/delete']     = 'Administrator/Employer/Schedule/delete_slot';
$route['admin/employer/schedule/slots']      = 'Administrator/Employer/Schedule/get_slots';

/*
|--------------------------------------------------------------------------
| API Routes (AJAX endpoints)
|--------------------------------------------------------------------------
*/
$route['api/applicant/schedules']  = 'Bookconsultation/getSchedules';
$route['api/applicant/slots']      = 'Bookconsultation/get_slots';
$route['api/applicant/payment']    = 'Bookconsultation/payment';
$route['api/employer/schedules']   = 'Employerbooking/getSchedules';
$route['api/employer/slots']       = 'Employerbooking/get_slots';
$route['api/employer/save']        = 'Employerbooking/save';
$route['api/contact']              = 'Contactus/send_mail';
$route['api/timezone/slots']       = 'Appointment/get_slots';

/*
|--------------------------------------------------------------------------
| Cron Routes (protected by auth token)
|--------------------------------------------------------------------------
*/
$route['cron/cleanup-applicant']    = 'Cron/cleanup_applicant_slots';
$route['cron/cleanup-employer']     = 'Cron/cleanup_employer_slots';
$route['cron/delete-applicant']     = 'Cron/delete_expired_applicant';
$route['cron/delete-employer']      = 'Cron/delete_expired_employer';
$route['cron/run-all']              = 'Cron/run_all';
