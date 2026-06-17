<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Initial schema migration documenting the existing database structure.
 * This captures the baseline schema so all future changes are versioned.
 */
class Migration_Create_initial_schema extends CI_Migration
{
    public function up()
    {
        // Users table (admin authentication)
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'username' => ['type' => 'VARCHAR', 'constraint' => 255],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('username');
        $this->dbforge->create_table('users', TRUE);

        // Applicant slots
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'date' => ['type' => 'DATE'],
            'slot_times' => ['type' => 'TEXT'],
            'slot_count' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('date');
        $this->dbforge->create_table('slots', TRUE);

        // Applicant appointment data
        $this->dbforge->add_field([
            'appointment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'country_of_residence' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'program_of_interest' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'client_first_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'client_last_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'client_email' => ['type' => 'VARCHAR', 'constraint' => 255],
            'client_phone' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => TRUE],
            'additional_notes' => ['type' => 'TEXT', 'null' => TRUE],
            'appointment_status' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'active'],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->dbforge->add_key('appointment_id', TRUE);
        $this->dbforge->add_key('appointment_status');
        $this->dbforge->create_table('appointment_data', TRUE);

        // Applicant appointment slots (booking)
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'appointment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'appointment_date' => ['type' => 'VARCHAR', 'constraint' => 20],
            'appointment_time' => ['type' => 'VARCHAR', 'constraint' => 20],
            'active_status' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'active'],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('appointment_id');
        $this->dbforge->add_key('appointment_date');
        $this->dbforge->create_table('appointment_slotes', TRUE);

        // Stripe payments
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'invoice_number' => ['type' => 'VARCHAR', 'constraint' => 20],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('stripe_payments', TRUE);

        // Employer slots
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'date' => ['type' => 'DATE'],
            'slot_times' => ['type' => 'TEXT'],
            'slot_count' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('date');
        $this->dbforge->create_table('emp_slots', TRUE);

        // Employer appointment data
        $this->dbforge->add_field([
            'appointment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'business_year' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => TRUE],
            'field_of_business' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'other_field' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'first_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'client_last_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'client_email' => ['type' => 'VARCHAR', 'constraint' => 255],
            'client_phone' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => TRUE],
            'additional_notes' => ['type' => 'TEXT', 'null' => TRUE],
            'prefered_meeting_method' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => TRUE],
            'appointment_status' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'active'],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->dbforge->add_key('appointment_id', TRUE);
        $this->dbforge->add_key('appointment_status');
        $this->dbforge->create_table('emp_appointment_data', TRUE);

        // Employer appointment slots (booking)
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'appointment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'appointment_date' => ['type' => 'VARCHAR', 'constraint' => 20],
            'appointment_time' => ['type' => 'VARCHAR', 'constraint' => 20],
            'active_status' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'active'],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('appointment_id');
        $this->dbforge->add_key('appointment_date');
        $this->dbforge->create_table('emp_appointment_slotes', TRUE);

        // Available time options
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'time_value' => ['type' => 'VARCHAR', 'constraint' => 20],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('a_times', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('a_times', TRUE);
        $this->dbforge->drop_table('emp_appointment_slotes', TRUE);
        $this->dbforge->drop_table('emp_appointment_data', TRUE);
        $this->dbforge->drop_table('emp_slots', TRUE);
        $this->dbforge->drop_table('stripe_payments', TRUE);
        $this->dbforge->drop_table('appointment_slotes', TRUE);
        $this->dbforge->drop_table('appointment_data', TRUE);
        $this->dbforge->drop_table('slots', TRUE);
        $this->dbforge->drop_table('users', TRUE);
    }
}
