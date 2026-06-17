<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employer service pages (LMIA, Work Permit, Francophone, AIP, TFW).
 */
class Employer extends MY_Controller
{
    private function render_service($view, $breadcrumb_sub)
    {
        $this->load->view('Service/Employer/' . $view, [
            'pageid'         => 'services',
            'breadcrumb'     => 'services',
            'breadcrumb_sub' => $breadcrumb_sub,
            'pagename'       => 'Service For Employers',
            'sticky_button'  => 'sticky',
        ]);
    }

    public function lmiaApplication()
    {
        $this->render_service('lmiaApplication', 'LMIA Application');
    }

    public function workPermitServices()
    {
        $this->render_service('workPermitServices', 'Work Permit Services');
    }

    public function francophoneMobility()
    {
        $this->render_service('francophoneMobility', 'Francophone Mobility Work Permit');
    }

    public function aipDesignations()
    {
        $this->render_service('aipDesignations', 'Atlantic Immigration Program (AIP) Designations');
    }

    public function tfwService()
    {
        $this->render_service('tfwService', 'TFW & Workforce Management Service');
    }
}
