<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Consolidated cron controller for all scheduled slot cleanup tasks.
 * Endpoints should be called via server cron jobs with auth token.
 */
class Cron extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('booking_service');
    }

    /**
     * Validates the cron auth token from query string or CLI mode.
     */
    private function authorize()
    {
        if (php_sapi_name() === 'cli') {
            return true;
        }

        $token = $this->input->get('token');
        $expected = env('CRON_AUTH_TOKEN', '');

        if (empty($expected) || $token !== $expected) {
            $this->output
                ->set_status_header(403)
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Unauthorized']));
            return false;
        }

        return true;
    }

    /**
     * Removes past time slots for today (applicants) based on Mountain Time.
     */
    public function cleanup_applicant_slots()
    {
        if (!$this->authorize()) return;

        $this->booking_service->cleanup_past_slots('slots');

        echo json_encode([
            'status'  => 'success',
            'message' => 'Past applicant time slots removed based on Mountain Time.',
        ]);
    }

    /**
     * Removes past time slots for today (employers) based on Mountain Time.
     */
    public function cleanup_employer_slots()
    {
        if (!$this->authorize()) return;

        $this->booking_service->cleanup_past_slots('emp_slots');

        echo json_encode([
            'status'  => 'success',
            'message' => 'Past employer time slots removed based on Mountain Time.',
        ]);
    }

    /**
     * Deletes all expired applicant slot rows for today.
     */
    public function delete_expired_applicant()
    {
        if (!$this->authorize()) return;

        $this->booking_service->delete_expired_rows('slots');
        echo json_encode(['status' => 'success', 'message' => 'Expired applicant slots deleted.']);
    }

    /**
     * Deletes all expired employer slot rows for today.
     */
    public function delete_expired_employer()
    {
        if (!$this->authorize()) return;

        $this->booking_service->delete_expired_rows('emp_slots');
        echo json_encode(['status' => 'success', 'message' => 'Expired employer slots deleted.']);
    }

    /**
     * Runs all cleanup tasks at once (convenience endpoint).
     */
    public function run_all()
    {
        if (!$this->authorize()) return;

        $this->booking_service->cleanup_past_slots('slots');
        $this->booking_service->cleanup_past_slots('emp_slots');

        echo json_encode([
            'status'  => 'success',
            'message' => 'All slot cleanup tasks completed.',
        ]);
    }
}
