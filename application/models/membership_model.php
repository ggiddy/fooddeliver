<?php

/**
 *This is the Membership_model model that has functions that deal with insertion and 
 *retrieval of user information regarding user information from the database.
 *@author Gideon Gitau <nggitau@gmail.com>
 *@copyright 2015 - 2020 Gideon Gitau
 *@license http://opensource.org/licenses/MIT MIT License
 *@version 1.0.1
 */
class Membership_model extends CI_Model {

    /**
     *This method determines if a user exists in the database.
     *@param none
     *@return boolean true if user exists false otherwise.
     *@throws This method does not throw an error.
     */
    function validate($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('admins');
        
        if($query->num_rows == 1)
        {
            return TRUE;
        }
    }

    /**
     *This method fetches all the user accounts from the database.
     *@param none
     *@return array $results All the staff members
     *@throws This method does not throw an error.
     */
    function get_accounts()
    {
        $results = $this->db->query("SELECT * FROM admins")->result();
        return $results;
    }

    /**
     *This method inserts a new staff member into the database.
     *@param none
     *@return boolean true if user-account has been created false otherwise.
     *@throws This method does not throw an error.
     */
    function create_member()
    {
        $status = $this->input->post('status');
        if($status) 
        {
            $super = 1;
        }
        else
        {
            $super = 0;
        }
        $new_member_insert_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'email_address' => $this->input->post('email_address'),
                'status'=> $super
                );
        $insert_data = $this->db->insert('admins', $new_member_insert_data);
        return $insert_data;
    }

    /**
     *This method removes a user account from the database.
     *@param int $id The id of the user to be removed.
     *@return boolean true if user-account has been removed false otherwise.
     *@throws This method does not throw an error.
     */
    function delete_member($id)
    {
       $this->db->query("DELETE FROM admins WHERE id = '$id'");        
    }

    /**
     *This method determines if a user is an admin or a normal staff member.
     *@param none
     *@return boolean true if user is admin false otherwise.
     *@throws This method does not throw an error.
     */
    function admin_status(){
        $username = $this->session->userdata('username');
        $query = $this->db->query("SELECT * FROM admins WHERE username = '$username' AND status = '1'");
        if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}