<?php
class Invoice_model extends CI_Model {

    public function get_next_invoice_number()
    {
        // Get the last invoice number
        $this->db->select('invoice_number');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('stripe_payments');

        if ($query->num_rows() > 0) {
            $last_invoice = $query->row()->invoice_number; // e.g., INV-00123
            // Extract the numeric part (00123)
            $last_number = (int) substr($last_invoice, 4);
            $next_number = $last_number + 1;
        } else {
            $next_number = 1; // First invoice
        }

        // Format to INV-XXXXX (5 digits)
        $new_invoice = 'INV-' . str_pad($next_number, 5, '0', STR_PAD_LEFT);

        return $new_invoice;
    }
}
