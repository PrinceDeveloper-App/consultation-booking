<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin dashboard controller. Requires authentication via Admin_Controller.
 */
class Dashboard extends Admin_Controller
{
    public function index()
    {
        $this->load->view('admin/dashboard', [
            'pageid'     => 'dash',
            'breadcrumb' => 'Dashboard',
        ]);
    }
}
