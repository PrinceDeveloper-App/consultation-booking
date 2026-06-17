<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function index()
    {
        $this->load->view('homepage', [
            'pageid'        => 'home',
            'sticky_button' => 'sticky',
        ]);
    }
}
