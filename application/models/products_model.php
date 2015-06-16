<?php
class Products_model extends CI_Controller{
    function get_all()
    {
        $results = $this->db->get('food_items')->result();
        return $results;
    }
    function get($id)
    {
        $results = $this->db->get_where('food_items', array('id'=> $id))->result();
        $result = $results[0];
        return $result;
    }
    function add_product()
    {
        $new_product = array(
                    'item_name' => $this->input->post('item_name'),
                    'price' => $this->input->post('price'),
                    );
            $insert_data = $this->db->insert('food_items', $new_product);
            return $insert_data;
    }
    function remove_item($id)
    {
        $this->db->query("DELETE FROM food_items WHERE id = '$id'");
    }
}