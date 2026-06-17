<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Generates PDF invoices using Dompdf.
 */
class Invoice_service
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';
    }

    /**
     * Generates a PDF invoice and returns the file path.
     *
     * @param array $data Invoice data (invoice_no, first_name, last_name, email, date)
     * @return string Absolute path to the generated PDF
     */
    public function generate($data)
    {
        $html = $this->CI->load->view('invoice_template', $data, TRUE);

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdf_path = FCPATH . 'uploads/invoice_' . time() . '_' . mt_rand(1000, 9999) . '.pdf';
        file_put_contents($pdf_path, $dompdf->output());

        log_message('info', 'Invoice generated: ' . $data['invoice_no'] . ' at ' . $pdf_path);

        return $pdf_path;
    }
}
