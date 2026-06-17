<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin user authentication model with bcrypt password hashing.
 */
class User_model extends CI_Model
{
    /**
     * Authenticates an admin user by username and password.
     *
     * @param string $username
     * @param string $password Plain-text password to verify
     * @return object|null User row on success, null on failure
     */
    public function get_user($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        $user  = $query->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return null;
    }

    /**
     * Hashes a plain-text password using bcrypt.
     *
     * @param string $password
     * @return string Hashed password
     */
    public function hash_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Updates a user's password (stores the bcrypt hash).
     *
     * @param int    $user_id
     * @param string $new_password Plain-text password
     * @return bool
     */
    public function update_password($user_id, $new_password)
    {
        $this->db->set('password', $this->hash_password($new_password));
        $this->db->where('id', $user_id);
        return $this->db->update('users');
    }
}
