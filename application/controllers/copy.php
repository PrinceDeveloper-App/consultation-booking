
<?php
 $planname = "consultation";
				 $amount = 86.62;
				 $charge = $this->stripe_lib->createCharge($customer->id, $planname, $amount);
				 <?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Bookconsultation extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('email');
		$this->load->library('calendar');
		$this->load->library('stripe_lib');
		//$this->load->library('encrypt'); 
		$this->load->helper(array('cookie', 'url'));
		$this->load->model('Consultation_model');
		$this->load->model('Invoice_model');
		//$this->load->library('user_agent');
		$this->load->database();
	}

	public function index()
	{

		$data['pageid'] = "booking";
		$data['breadcrumb'] = "Booking";
		$data['pagename'] = "Book Your Consultation";
		//$data['calendar'] = $this->calendar->generate();
		$current_date = date('Y-m-d');
		$data['schedules'] = $this->Consultation_model->getSchedules($current_date);
		$this->load->view('bookconsultation', $data);
	}

	function purchase()
	{

		//\Stripe\Stripe::setApiKey("sk_test_51SPt1WHz56QdCFhGDFDPRQJKoTJPtDTWEORXDCXjLUIVAEvtUSfxZZbGVhsBDwVmRVO5cy9vLWpXRMCm2L5RHhyd00bSR00OZI");

		$data = $this->input->post();
		//$amount = 1000; // ₹10.00 → 1000 paise (Stripe uses smallest currency unit)
		$payment_method = $data['payment_method'];
		//$data = array();
		//$data = $this->input->post();
		//$first_name = $data['first_name'];
		//$stripeToken = $data['stripeToken'];
		// If payment form is submitted with token 
		if ($payment_method) {
			// Retrieve stripe token and user info from the posted form data 
			$postData = $this->input->post();
			//$token  = $postData['stripeToken'];
			//$first_name = $postData['first_name'];
			//echo $payment_method;
			// $postData['product'] = $product; 
			//// Make payment 
			//$first_name = $postData['first_name'];
			$paymentID = $this->payment($postData);
			// // If payment successful 
			if ($paymentID) {

				echo "success";
			} else {
				echo "fail";
			}
		}
	}

	public function payment()
	{
		$postData = $this->input->post();
		$payment_method = $postData['payment_method'];
		// If post data is not empty 
		if ($payment_method) {
			$token  = $postData['payment_method'];
			$country_of_residence = $postData['country_of_residence'];
			$program_of_interest = $postData['program_of_interest'];
			$first_name = $postData['first_name'];
			$last_name = $postData['last_name'];
			$email = $postData['email'];
			$phone = $postData['phone'];
			$additional_notes = $postData['additional_notes'];
			$booking_date = $postData['booking_date'];
			$booking_time = $postData['booking_time'];
			\Stripe\Stripe::setApiKey("sk_test_51SPt1WHz56QdCFhGDFDPRQJKoTJPtDTWEORXDCXjLUIVAEvtUSfxZZbGVhsBDwVmRVO5cy9vLWpXRMCm2L5RHhyd00bSR00OZI");

			$customer = \Stripe\Customer::create([
				'email' => $email,
				//'payment_method' => $payment_method,
			]);
			//$customer = $this->stripe_lib->addCustomer($email, $token);
			if ($customer) {

				\Stripe\Stripe::setApiKey("sk_test_51SPt1WHz56QdCFhGDFDPRQJKoTJPtDTWEORXDCXjLUIVAEvtUSfxZZbGVhsBDwVmRVO5cy9vLWpXRMCm2L5RHhyd00bSR00OZI");
				//$amount = 100;
				$amount = 86.62 * 100; // 1000
				//$itemPriceCents = ($amount * 100);
				try {

					// // 1. Attach payment method to customer
					// \Stripe\PaymentMethod::attach(
					// 	$payment_method,
					// 	['customer' => $customer->id]
					// );

					// // 2. Set as default payment method
					// \Stripe\Customer::update($customer->id, [
					// 	'invoice_settings' => [
					// 		'default_payment_method' => $payment_method,
					// 	],
					// ]);

					// 3. Create PaymentIntent
					$paymentIntent = \Stripe\PaymentIntent::create([
						'amount' => $amount,
						'currency' => 'cad',
						'customer' => $customer->id,
						'payment_method' => $payment_method,
						'confirm' => true,
						// IMPORTANT FIX
						'automatic_payment_methods' => [
							'enabled' => true,
							'allow_redirects' => 'never'
						]
					]);
					if ($paymentIntent) {
						//Check whether the paymentIntent is successful 
						if ($paymentIntent['amount_refunded'] == 0 && empty($paymentIntent['failure_code']) && $paymentIntent['paid'] == 1 && $paymentIntent['captured'] == 1) {
							// Transaction details  
							$transactionID = $paymentIntent['balance_transaction'];
							$paidAmount = $paymentIntent['amount'];
							$paidAmount = ($paidAmount / 100);
							$paidCurrency = $paymentIntent['currency'];
							$description = $paymentIntent['description'];
							$payment_status = $paymentIntent['status'];
							$paydate = date('d-m-Y');
							$invoice_no = $this->Invoice_model->get_next_invoice_number();
							// Insert tansaction data into the database 
							$orderData = array(
								'customer_name' => $first_name,
								'customer_email' => $email,
								'amount' => $paidAmount,
								'currency' => $paidCurrency,
								'invoice_id' => $transactionID,
								'payment_status' => $payment_status,
								'description' => $description,
								'invoice_number' => $invoice_no,
								'craeted_at' => $paydate

							);
							$orderID = $this->Consultation_model->insertOrder($orderData);
							$appointment_status = "active";
							$appointmentData = array(
								'payment_id' => $orderID,
								'country_of_residence' => $country_of_residence,
								'program_of_interest' => $program_of_interest,
								'client_first_name' => $first_name,
								'client_last_name' => $last_name,
								'client_email' => $email,
								'client_phone' => $phone,
								'additional_notes' => $additional_notes,
								'appointment_status' => $appointment_status

							);
							$applicant_id = $this->Consultation_model->insertAppointmentData($appointmentData);

							$bookingData = array(
								'appointment_id' => $applicant_id,
								'appointment_date' => $booking_date,
								'appointment_time' => $booking_time,
								'active_status' => "active"
							);
							$this->Consultation_model->insertbookingData($bookingData);

							$datetime = DateTime::createFromFormat('d-m-Y', $booking_date);
							$new_date = $datetime->format('Y-m-d');  //Output: 2025-11-13
							$this->delete_slot($booking_time, $new_date);
							$this->send_email($email, $booking_time, $new_date, $first_name, $last_name, $invoice_no);
							
						} 
					}
					echo "success";
				} catch (\Exception $e) {
					echo "fail";
				}
			} 
		}
		//return false;
	}
	public function send_email($email, $booking_time, $new_date, $first_name, $last_name, $invoice_no)
	{

		//$invoice_no = $this->Invoice_model->get_next_invoice_number();

		// 2️⃣ Prepare invoice data
		$invoiceData = [
			'invoice_no' => $invoice_no,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'date' => date('d-m-Y')
		];

		// 3️⃣ Generate HTML for invoice
		$html = $this->load->view('invoice_template', $invoiceData, TRUE);

		// 4️⃣ Generate PDF using Dompdf
		require_once APPPATH . 'third_party/dompdf/autoload.inc.php';
		$options = new Options();
		$options->set('isRemoteEnabled', TRUE);
		$dompdf = new Dompdf($options);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		// Save PDF to a temporary location
		$pdf_path = FCPATH . 'uploads/invoice_' . time() . '.pdf';
		file_put_contents($pdf_path, $dompdf->output());

		// Email configuration

		$config = array(
			'protocol' => "smtp",
			'smtp_crypto' => "ssl",
			'email_smtp_crypto' => "ssl",
			'newline' 	=> "\r\n",
			'priority' 	=> 1,
			'smtp_host' => "mail.ikic.ca",
			'smtp_port' => 465,
			'smtp_user' => "isha@ikic.ca",
			'smtp_pass' => "Ik@139619",
			'mailtype'  => "html",
			'charset'   => "iso-8859-1"
		);
		$this->load->library('email', $config);
		$this->email->from('isha@ikic.ca', 'Isha Kapoor Immigration Consulting Inc.');
		$this->email->set_mailtype("html");
		$this->email->to($email);
		$this->email->subject('Confirmation email for IKIC consultation booking');
		//$message = file_get_contents(FCPATH . 'email_templates/consultation_confirm.html');
		$message = $this->confirmation_email_message($booking_time, $new_date);
		$this->email->message($message);
		$this->email->attach($pdf_path);
		// Send email
		if ($this->email->send()) {
			echo 'Email sent successfully!';
		} else {
			// Show debugging info if something goes wrong
			echo $this->email->print_debugger();
		}
	}

	public function confirmation_email_message($booking_time, $new_date)
	{

		$year = date('Y');

		$message = '
		<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Consultation Booking Confirmation</title>
    <style>
      body {
        font-family: "Arial", sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }
      .email-container {
        max-width: 600px;
        margin: 30px auto;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
      }
      .header {
        background-color: #000;
        color: #ffffff;
        text-align: center;
        padding: 20px;
        font-size: 22px;
        font-weight: bold;
      }
      .content {
        padding: 25px;
        color: #333333;
        line-height: 1.6;
        font-size: 16px;
      }
      .content h3 {
        color: #0d6efd;
        margin-bottom: 10px;
      }
      .details {
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        padding: 15px;
        border-radius: 5px;
        margin-top: 10px;
      }
      .details p {
        margin: 5px 0;
      }
      .note {
        font-size: 14px;
        color: #666666;
        margin-top: 15px;
        border-left: 3px solid #000;
        padding-left: 10px;
      }
      .footer {
        text-align: center;
        font-size: 14px;
        color: #999999;
        padding: 15px;
        border-top: 1px solid #eeeeee;
      }
    </style>
  </head>
  <body>
    <div class="email-container">
      <div class="header">Consultation Confirmed</div>

      <div class="content">
        <p>Thank you — your <strong>free consultation</strong> is booked.</p>
        <p>Your booking details are as follows:</p>

        <div class="details">
          <p><strong>Consultation Date:</strong> ' . $new_date . '</p>
          <p><strong>Consultation Time:</strong> ' . $booking_time . '</p>
        </div>

        <div class="note">
          <p>
            <strong>Note:</strong> The appointment date and time are based on
            <strong>Mountain Time (MT) – Alberta, Canada</strong>. Please be
            available for the consultation according to your local time zone.
          </p>
        </div>
      </div>

      <div class="footer">
        © <span id="year">' . $year . '</span> <a href="https://ikic.ca/">IKIC</a>. All
        rights reserved.
      </div>
    </div>
  </body>
</html>';

		return $message;
	}

	public function delete_slot($booking_time, $booking_date)
	{


		// Get the current slots
		$record = $this->db->get_where('slots', ['date' => $booking_date])->row();

		if ($record) {
			// Clean braces and convert to array
			$slots = str_replace(['{', '}'], '', $record->slot_times);
			$slot_array = array_map('trim', explode(',', $slots));
			$slot_count = $record->slot_count;
			$new_slot_count = $slot_count - 1;
			// Remove the selected slot
			$slot_array = array_diff($slot_array, [$booking_time]);

			// Rebuild and update the string
			$updated_slots = '{' . implode(',', $slot_array) . '}';
			$this->db->set('slot_times', $updated_slots);
			$this->db->set('slot_count', $new_slot_count);
			$this->db->where('date', $booking_date);
			$this->db->update('slots');
			//$this->db->update('slots', ['slot_times' => $updated_slots]);

			echo 'Slot deleted successfully';
		} else {
			echo 'Record not found';
		}
	}
	public function success_message()
	{
		$data['success_message'] = "success";
		$this->load->view('paymentSuccess', $data);
	}
	public function fail_message()
	{
		$data['fail_message'] = "fail";
		$this->load->view('paymentFail', $data);
	}
	public function getSchedules()
	{

		$data['pageid'] = "schedule";
		$data['breadcrumb'] = "Schedulling";
		$current_date = $this->input->post('date');
		$data = $this->Consultation_model->getSchedules($current_date);
		// Return JSON response
		echo json_encode($data);
		//$this->load->view('admin/schedullingPage', $data);

	}
	public function get_slots()
	{
		$this->load->database();
		$query = $this->db->get('slots');
		$result = $query->result_array();
		echo json_encode($result);
	}
}
