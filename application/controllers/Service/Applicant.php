<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Applicant service pages (TFW, Visa, Student, PR, Family Sponsorship).
 */
class Applicant extends MY_Controller
{
    private function render_service($view, $breadcrumb_sub)
    {
        $this->load->view('Service/Applicant/' . $view, [
            'pageid'         => 'services',
            'breadcrumb'     => 'services',
            'breadcrumb_sub' => $breadcrumb_sub,
            'pagename'       => 'Service For Applicants',
            'sticky_button'  => 'sticky',
        ]);
    }

    public function tfwProgrammes()
    {
        $this->render_service('tfwProgrames', 'TFW Programes');
    }

    public function visitorVisa()
    {
        $this->render_service('trvProgrames', 'Visitor Visa & Temporary Resident Visa');
    }

    public function studentVisa()
    {
        $this->render_service('studentVisa', 'Study In Canada');
    }

    public function permanentResidency()
    {
        $this->render_service('permanentResidency', 'PR & PNP');
    }

    public function familySponsorship()
    {
        $this->render_service('familySponsorship', 'Family Sponsorship Programs');
    }
}
