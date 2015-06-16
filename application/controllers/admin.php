<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{
   function __construct()
	{
	parent::__construct();	
        $this->is_logged_in();
	}

    function is_logged_in()
    {
            $is_logged_in = $this->session->userdata('is_logged_in');
            if(!isset($is_logged_in) || $is_logged_in!=TRUE)
            {
                redirect('home/login');
            }
    }
    function paginations_services()
    {
        
    }
            
    function admin_area(){
        
        $this->load->model('orders_model');
        $this->get_orders();
    }
    function get_orders()
    {
        $this->load->model('orders_model');
        $data['title'] = "Pending Orders";
        $data['orders'] = $this->orders_model->get_orders();
        $data['main_content'] = '/admin/dashboard';
        $this->load->view('admin/admin_includes/template', $data);
    }
    function handle_orders($id)
    { 
        $this->load->model('orders_model');
        $this->orders_model->handle($id);
        $this->get_orders();
    }
    function get_serviced()
    { 
       $this->load->model('orders_model');
       $data['title'] = "Serviced Orders";
       $data['serviced'] = $this->orders_model->serviced();
       
  
        $config['base_url'] = base_url().'admin/get_serviced';
        $config['total_rows'] = $this->orders_model->serviced();
        $config['per_page'] = 10; 
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<div id = "pagination1">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config); 
        $this->db->order_by("id", "desc");
        $data['records'] = $this->db->get_where('orders', array('handled' => '1'), $config['per_page'], $this->uri->segment(3));
        $data['pagination'] = $this->pagination->create_links();
       $data['main_content'] = '/admin/serviced';
       $this->load->view('admin/admin_includes/template', $data);
       
    }
    /*function get_admin_status() fetches the access level of an admin
    to determine what parts of the admin panel they can access.     */
    function get_admin_status()
    {
        $this->load->model('membership_model');
        if($this->membership_model->admin_status()){
            return TRUE;
        }
        else{
            redirect('admin/admin_area');
        }
    }
    
    function manage_accounts()
    {
        $this->get_admin_status();
        $this->load->model('membership_model');
        $data['title'] = "Admin Accounts";
        $data['accounts'] = $this->membership_model->get_accounts();
        $data['main_content'] = '/admin/manage_accounts';
        $this->load->view('admin/admin_includes/template', $data);
      
    }
    /* function create account just loads the form for creating accounts*/
    function create_account()
    {
        $this->load->model('membership_model');
        $data['title'] = "Create Account";
        $data['main_content'] = '/admin/create_account';
        $this->load->view('admin/admin_includes/template', $data);
    }
    /*function crete member creates a new admin*/
    function create_member()
    {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email|xss_clean');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_lenghth[4]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_lenghth[4]|max_lenghth[32]|xss_clean');
		$this->form_validation->set_rules('password2', 'Password Confirm', 'trim|required|matches[password]|xss_clean');
                $this->form_validation->set_rules('status', 'Status', 'xss_clean');
                
		if($this->form_validation->run() == FALSE)
		{
			
			$this->create_account();
		}
		else
		{
			$this->load->model('membership_model');
                                if($this->membership_model->create_member())
                                {
                                    redirect('admin/manage_accounts');
                                }
                                else
                                {
                                    $this->create_account();
                                }
		}

    }
    function delete_account($id)
    {
        $this->load->model('membership_model');
        $this->membership_model->delete_member($id);
        redirect('admin/manage_accounts');
        
    }
    /*function manage_items displays all the vailable items in the shop
        along with options of adding more items, removing out-of-stock
     items and changing prices   */
    function manage_items()
    {
        $this->load->model('products_model');  
        $data['title'] = "Manage Items";
        $data['items'] = $this->products_model->get_all();
        $data['main_content'] = '/admin/manage_items';
        $this->load->view('admin/admin_includes/template', $data);
    }
    /*function add_new_item() displays the form that allows the user 
     * to create a new item      */
    function add_new_item()
    {
        $data['title'] = "Add New Item";
        $data['main_content'] = '/admin/create_items';
        $this->load->view('admin/admin_includes/template', $data);
    }
    /*function add_item() enables an admit to add a new item to the database*/
    function add_item()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('item_name', 'Item Name', 'trim|required|xss_clean');
	$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');
        if($this->form_validation->run() == FALSE){
            $this->add_new_item();
        }
        else{
            $this->load->model('products_model');
            if($this->products_model->add_product()){
                redirect('admin/manage_items');
            }
            
        }
    }
    function remove_item($id)
    {
        $this->load->model('products_model');
        $this->products_model->remove_item($id);
            redirect('admin/manage_items');
        
    }
    function sign_out()
    {
        $this->session->sess_destroy();
        redirect('home/login');
    }
} 