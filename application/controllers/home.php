<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
    
    /*Function index() uses the function get_all() from the products models 
     to display all available food items in the database and their prices
     on the side bar for the customer to choose and buy them */
    
    public function index()
    {
        $this->load->helper('file');
        $this->load->model('products_model');
	$data['products'] = $this->products_model->get_all();
        $data['main_content'] = '/public/home';
        $data['title'] = 'Place Order';
        $this->load->view('includes/template', $data);
    }
    
    /* function login() displays the login form in the view folder.
       This allows the shop managers to get into the back end where
     * they can see all incoming orders and service them     */
    
    function login(){
        $data['title'] = 'Login';
        $data['main_content'] = '/public/login_form';
        $this->load->view('includes/template', $data);
    }
    
    /*function validate_credentials confirms that the person trying
       to login is authorized to do so. It checks the entered username 
     * and password against the ones stored in the database. It also gives 
     * sessions to logged in users using rheir usernames.   */
    
    function validate_credentials(){
        $this->load->model('membership_model');
        
        $query = $this->membership_model->validate();
        if($query){
            $data = array(
              'username' => $this->input->post('username'),
              'is_logged_in' => TRUE  
            );
            
            $this->session->set_userdata($data);
            redirect('admin/admin_area');
        }
        else{
            $this->login();
        }
    }
    
    /*function add() takes the users' choices of foods and adds them to
     * the cart. it first fetches the product details from the database 
     * eg. price using the get() method in the products_model
     */
    function add($id)
    {
       
        $id = $this->input->post('id');
        if(isset($id) && !empty($id)){
        $this->load->model('products_model');
        $product = $this->products_model->get($id);
        $insert =  array(
                'id' => $id,
                'qty' => 1,
                'price' => $product->price,
                'name' => $product->item_name 
                );
        $this->cart->insert($insert);
        redirect('home');
        }
    }
               
    
    /*function remove() removes items from the customer's cart*/
    
    function remove($id)
    {
        $this->cart->update(array(
            'rowid' => $id,
            'qty' => 0
        ));
        redirect('home');
    }
    /*updates the quantity in the shopping cart*/
    function update()
    {
        $cart = $this->cart->contents();
        $ids[] = $this->input->post('id');
        foreach ($cart as $item) {
            foreach ($ids as $id){
                if( $id == $item['rowid']){
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
    function buy()
    {
        $data['title'] = 'Buy';
        $data['main_content'] = '/public/location_details';
        $this->load->view('includes/template', $data);
        
        
    }
    
    /* function add_to_orders() adds orders from the customers' carts to the orders table
        in the database and customer location details to the 
     * location table    */
    function add_to_orders()
    {
        /* setting rules on input fields   */ 
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
	$this->form_validation->set_rules('block', 'Block/Building name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('room', 'Room Number', 'trim|required|xss_clean');
        /*Only after the customer correctly fills out their details does the order
       get placed */ 
        if($this->form_validation->run() == FALSE){
            $this->buy();
        }
        else{
                $block = $this->input->post('block');
                $room = $this->input->post('room');
                $cust_name = $this->input->post('name');
        }
        if($cart = $this->cart->contents()){
            foreach ($cart as $item)
            {
            $data = array(    
                'item_name' => $item['name'],
                'quantity' => $item['qty'],
                );
                $od[] = implode('', $data);
                $total = $this->cart->total();
                    
            }
        $ods = implode(',', $od);
    if(isset($block) &&isset($cust_name) && isset($room) &&isset($ods) && !empty($block) && !empty($cust_name) && !empty($room) && !empty($ods)){  
            $this->load->model('orders_model');
            $this->orders_model->add_new_order($block, $room, $cust_name, $ods, $total);
                $this->cart->destroy();
                $data['main_content'] = '/public/order_success';
                $data['title'] = "Successful";
                $this->load->view('includes/template', $data);
             
    }
   }
 }
}