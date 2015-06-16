<?php
class Orders_model extends CI_Controller{
    function get_orders()
    {
       $results = $this->db->query("SELECT * FROM orders WHERE handled = '0'")->result();
       return $results;
        
    }
    function handle($id)
    {
     $this->db->query("UPDATE orders SET handled = '1' WHERE id = '$id'");
    }
    function serviced()
    {
        $results = $this->db->query("SELECT * FROM orders WHERE handled = '1'")->num_rows();
        return $results;
    }
    function add_new_order($block, $room, $cust_name, $ods, $total)
    {
        if($this->db->query("INSERT INTO orders (block, room, cust_name, customer_orders, total) VALUES "
                    . "('$block', '$room', '$cust_name', '$ods', '$total')")){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }        
}