<?php

/**
 *This is the Products_model model that has functions that deal with insertion and 
 *retrieval of user information regarding product information to and from the database.
 *@author Gideon Gitau <nggitau@gmail.com>
 *@copyright 2015 - 2020 Gideon Gitau
 *@license http://opensource.org/licenses/MIT MIT License
 *@version 1.0.1
 */
class Products_model extends CI_Controller{

    /**
     *This method queries the database to get all products.
     *@param none.
     *@return array $results All the products.
     *@throws This method does not throw an error.
     */
    function get_all()
    {
        $results = $this->db->get('food_items')->result();
        return $results;
    }

    /**
     *This method queries the database to get a specific product.
     *@param int $id The id of the product to retrieve.
     *@return array $result The row containing the product.
     *@throws This method does not throw an error.
     */
    function get($id)
    {
        $results = $this->db->get_where('food_items', array('id'=> $id))->result();
        $result = $results[0];
        return $result;
    }

    /**
     *This method adds a new product into the database.
     *@param string $item_name The name of the item to be inserted into the database.
     *@param string $price The price of the item to be inserted into the database.
     *@return array $results All the products.
     *@throws This method does not throw an error.
     */
    function add_product($item_name, $price)
    {
        $new_product = array(
                    'item_name' => $item_name,
                    'price' => $price,
                    );
            $insert_data = $this->db->insert('food_items', $new_product);
            return $insert_data;
    }

    /**
     *This method removes a product from the database.
     *@param int $id The id of the item to be deleted from the database.
     *@return array $results All the products.
     *@throws This method does not throw an error.
     */
    function remove_item($id)
    {
        $this->db->query("DELETE FROM food_items WHERE id = '$id'");
    }
}