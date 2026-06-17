<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller
{
    public function applicants()
    {
        $this->load->view('serviceForApplicants', [
            'pageid'        => 'services',
            'breadcrumb'    => 'services',
            'pagename'      => 'Services For Applicants',
            'sticky_button' => 'sticky',
        ]);
    }

    public function employers()
    {
        $this->load->view('serviceForEmployers', [
            'pageid'        => 'services',
            'breadcrumb'    => 'services',
            'pagename'      => 'Services For Employers',
            'sticky_button' => 'sticky',
        ]);
    }
}
