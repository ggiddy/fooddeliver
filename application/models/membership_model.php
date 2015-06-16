<?php
class Membership_model extends CI_Model{
    function validate()
    {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('admins');
        
        if($query->num_rows == 1){
            return true;
        }
    }
    function get_accounts()
    {
        $results = $this->db->query("SELECT * FROM admins")->result();
        return $results;
    }
    function create_member()
    {
        $status = $this->input->post('status');
        if($status){
            $super = 1;
        }
        else{
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
    function delete_member($id)
    {
       $this->db->query("DELETE FROM admins WHERE id = '$id'");        
    }
    function admin_status(){
        $username = $this->session->userdata('username');
        $query = $this->db->query("SELECT * FROM admins WHERE username = '$username' AND status = '1'");
        if($query->num_rows() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

}