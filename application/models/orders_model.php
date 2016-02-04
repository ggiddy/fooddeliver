<?php

/**
 *This is the Orders_model model that has functions that deal with insertion and 
 *retrieval of user information regarding orders to and from the database.
 *@author Gideon Gitau <nggitau@gmail.com>
 *@copyright 2015 - 2020 Gideon Gitau
 *@license http://opensource.org/licenses/MIT MIT License
 *@version 1.0.1
 */
class Orders_model extends CI_Controller {

    /**
     *This method queries the database to get all orders.
     *@param none.
     *@return array $results All the orders.
     *@throws This method does not throw an error.
     */
    function get_orders()
    {
       $results = $this->db->query("SELECT * FROM orders WHERE handled = '0'")->result();
       return $results;   
    }

    /**
     *This method updates the database after an order has been handled.
     *@param none.
     *@return void.
     *@throws This method does not throw an error.
     */
    function handle($id)
    {
     $this->db->query("UPDATE orders SET handled = '1' WHERE id = '$id'");
    }

    /**
     *This method queries the database and returns all orders that have been serviced.
     *@param none.
     *@return array $results All the seviced orders.
     *@throws This method does not throw an error.
     */
    function serviced()
    {
        $results = $this->db->query("SELECT * FROM orders WHERE handled = '1'")->num_rows();
        return $results;
    }

    /**
     *This method adds a new order into the datadbase.
     *@param string $block The block where the customer is located.
     *@param string $room The room where the customer is located.
     *@param string $cust_name The customer's name.
     *@param string $ods The orders made by the customer.
     *@param string $total The total amount payable by the customer.
     *@return boolean True if the order has been inserted, false otherwise.
     *@throws This method does not throw an error.
     */
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