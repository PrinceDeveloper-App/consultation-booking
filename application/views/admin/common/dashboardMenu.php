<link rel="stylesheet" href="<?php echo base_url() ?>resources/css/custom/admin.css">
<ul class="list-inline dashboard-menu text-center">
    <li><a class="<?php if(isset($pageid) && $pageid == "dash"){?>active<?php } ?>" href="<?php echo base_url("Administrator/Dashboard") ?>">Dashboard</a></li>
    <li><a class="<?php if(isset($pageid) && $pageid == "applicant"){?>active<?php } ?>" href="<?php echo base_url("Administrator/Applicant/Schedule/create") ?>">Applicant Scheduling</a></li>
    <li><a class="<?php if(isset($pageid) && $pageid == "employer"){?>active<?php } ?>" href="<?php echo base_url("Administrator/Employer/Schedule/create") ?>">Employer Scheddulling</a></li>
    <li><a class="<?php if(isset($pageid) && $pageid == "aapp"){?>active<?php } ?>" href="<?php echo base_url("Administrator/Applicant/Appointments") ?>">Applicant Appointments</a></li>
    <li><a class="<?php if(isset($pageid) && $pageid == "eapp"){?>active<?php } ?>" href="<?php echo base_url("Administrator/Employer/Appointments") ?>">Employer Appointments</a></li>
</ul>