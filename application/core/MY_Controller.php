<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base controller with shared functionality for all controllers.
 * Handles common loading and provides utility methods.
 */
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $key
     * @param string $default
     * @return string
     */
    protected function post($key, $default = '')
    {
        return trim($this->input->post($key, TRUE)) ?: $default;
    }

    /**
     * @param array $data
     * @param int   $status_code
     */
    protected function json_response($data, $status_code = 200)
    {
        $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    protected function json_success($message = 'Success', $data = [])
    {
        $response = ['status' => 'success', 'message' => $message];
        if (!empty($data)) {
            $response['data'] = $data;
        }
        $this->json_response($response);
    }

    protected function json_error($message = 'Error', $status_code = 400)
    {
        $this->json_response(['status' => 'error', 'message' => $message], $status_code);
    }

    /**
     * Calculates the next working day (skips weekends).
     *
     * @return string Date in Y-m-d format
     */
    protected function get_next_working_day()
    {
        $date = date('Y-m-d', strtotime('+1 day'));
        $day  = date('N', strtotime($date));

        if ($day == 6) {
            $date = date('Y-m-d', strtotime($date . ' +2 days'));
        } elseif ($day == 7) {
            $date = date('Y-m-d', strtotime($date . ' +1 day'));
        }

        return $date;
    }
}

/**
 * Base controller for admin pages that require authentication.
 */
class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_id')) {
            if ($this->input->is_ajax_request()) {
                $this->json_error('Unauthorized', 401);
                exit;
            }
            redirect(base_url('admin/login'));
        }
    }
}
