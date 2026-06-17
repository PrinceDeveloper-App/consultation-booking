<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends MY_Controller
{
    public function index()
    {
        $this->load->view('aboutUsPage', [
            'pageid'        => 'about',
            'breadcrumb'    => 'about us',
            'pagename'      => 'About IKIC',
            'sticky_button' => 'sticky',
        ]);
    }
}
