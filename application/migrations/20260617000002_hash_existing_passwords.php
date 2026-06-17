<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hashes all existing plain-text passwords in the users table.
 * Run once after deploying the bcrypt authentication changes.
 */
class Migration_Hash_existing_passwords extends CI_Migration
{
    public function up()
    {
        $users = $this->db->get('users')->result();

        foreach ($users as $user) {
            // Skip if already hashed (bcrypt hashes start with $2y$)
            if (strpos($user->password, '$2y$') === 0) {
                continue;
            }

            $hashed = password_hash($user->password, PASSWORD_BCRYPT);
            $this->db->where('id', $user->id);
            $this->db->update('users', ['password' => $hashed]);
        }
    }

    public function down()
    {
        // Cannot reverse password hashing
    }
}
