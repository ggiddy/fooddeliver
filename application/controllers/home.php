<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *This is the Home controller that handles functions available to customers.
 *@author Gideon Gitau <nggitau@gmail.com>
 *@copyright 2015 - 2020 Gideon Gitau
 *@license http://opensource.org/licenses/MIT MIT License
 *@version 1.0.1
 */
class Home extends CI_Controller{
    
    /**
     *This method displays the home page and populates it with the available items.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    public function index()
    {
        $this->load->helper('file');
        $this->load->model('products_model');
    	$data['products'] = $this->products_model->get_all();
        $data['main_content'] = '/public/home';
        $data['title'] = 'Place Order';
        $this->load->view('includes/template', $data);
    }
    
    /**
     *This method displays the admin login form.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function login()
    {
        $data['title'] = 'Login';
        $data['main_content'] = '/public/login_form';
        $this->load->view('includes/template', $data);
    }
    
    /**
     *This method assigns a session to a validated user and redirects them to the admin area.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function validate_credentials(){
        $this->load->model('membership_model');

        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        
        if($this->membership_model->validate($username, $password))
        {
            $data = array(
              'username' => $username,
              'is_logged_in' => TRUE  
            );
            
            $this->session->set_userdata($data);
            redirect('admin/admin_area');
        }
        else {
            $this->login();
        }
    }
    
    /**
     *This method adds items to customer's shopping cart.
     *@param $id The id of the item chosen by the user.
     *@return void
     *@throws This method does not throw an error.
     */
    function add($id)
    {
       
        $id = $this->input->post('id');
        if(isset($id) && !empty($id)) {
        $this->load->model('products_model');

        //get product from the database with that id
        $product = $this->products_model->get($id);
        $insert =  array(
                'id' => $id,
                'qty' => 1,
                'price' => $product->price,
                'name' => $product->item_name 
                );

        //insert item with that id into the shopping cart and reload the page.
        $this->cart->insert($insert);
        redirect('home');
        }
    }

    /**
     *This method removes an item from the user's shopping cart.
     *@param $id The id of the item to be removed from the customer's shopping cart.
     *@return void
     *@throws This method does not throw an error.
     */           
    function remove($id)
    {
        $this->cart->update(array(
            'rowid' => $id,
            'qty' => 0
        ));
        redirect('home');
    }

    /**
     *This method updates the quantity of items in a user's shopping cart.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */
    function update()
    {
        $cart = $this->cart->contents();
        $ids[] = $this->input->post('id');
        foreach ($cart as $item) {
            foreach ($ids as $id){
                if( $id == $item['rowid']) {
                    $update_arr = array(
                        'rowid' => $item['rowid'],
                        'qty' => $this->input->post('qty')
                    );
                    $this->cart->update($update_arr);
                }
            }
        }
        redirect('home');
    }

    /**
     *This method loads the form where the customer fills in their details.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */
    function buy()
    {
        $data['title'] = 'Buy';
        $data['main_content'] = '/public/location_details';
        $this->load->view('includes/template', $data);
    }
    
    /**
     *This method adds a user's shopping cart into orders.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */
    function add_to_orders()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
    	$this->form_validation->set_rules('block', 'Block/Building name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('room', 'Room Number', 'trim|required|xss_clean');
         
        if($this->form_validation->run() == FALSE) {
            $this->buy();
        } 
        else 
        {
            $block = $this->input->post('block');
            $room = $this->input->post('room');
            $cust_name = $this->input->post('name');
        }

        if($cart = $this->cart->contents()) {

            //loop through the cart contents to get each item's name and quantity.
            foreach ($cart as $item) {
            $data = array(    
                'item_name' => $item['name'],
                'quantity' => $item['qty'],
                );

            //create a space-separated string of items and their quantities.
                $od[] = implode('', $data);
                $total = $this->cart->total();
                    
            }

            //add commas to the item names and quantities of items.
            $ods = implode(',', $od);

            if(isset($block) && isset($cust_name) && isset($room) &&isset($ods) && !empty($block) && 
                !empty($cust_name) && !empty($room) && !empty($ods)) {

                $this->load->model('orders_model');

                //add cart items to database along with customer details and the total cost and destroy the cart.
                $this->orders_model->add_new_order($block, $room, $cust_name, $ods, $total);
                $this->cart->destroy();

                //load the order success page
                $data['main_content'] = '/public/order_success';
                $data['title'] = "Successful";
                $this->load->view('includes/template', $data);
            }
        }
    }
}