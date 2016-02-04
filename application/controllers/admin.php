<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *This is the Admin controller that handles functions available to staff members.
 *@author Gideon Gitau <nggitau@gmail.com>
 *@copyright 2015 - 2020 Gideon Gitau
 *@license http://opensource.org/licenses/MIT MIT License
 *@version 1.0.1
 */
class Admin extends CI_Controller{
   function __construct()
	{
	parent::__construct();
        //user must be logged in to access this page	
        $this->is_logged_in();
	}

    /**
     *This method checks if a user is logged in, if not they are redirected to the home page.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */
    function is_logged_in()
    {
            $is_logged_in = $this->session->userdata('is_logged_in');
            if(!isset($is_logged_in) || $is_logged_in!=TRUE)
            {
                redirect('home/login');
            }
    }

    /**
     *This method displays the admin area and populates it with the customer orders.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */        
    function admin_area(){
        
        $this->load->model('orders_model');
        $this->get_orders();
    }

    /**
     *This method displays the admin area and populates it with the customer orders.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function get_orders()
    {
        $this->load->model('orders_model');
        $data['title'] = "Pending Orders";
        $data['orders'] = $this->orders_model->get_orders();
        $data['main_content'] = '/admin/dashboard';
        $this->load->view('admin/admin_includes/template', $data);
    }

    /**
     *This method handles one order at a time and reloads the page.
     *@param int $id The id of the order to be handled.
     *@return void
     *@throws This method does not throw an error.
     */  
    function handle_orders($id)
    { 
        $this->load->model('orders_model');
        $this->orders_model->handle($id);
        $this->get_orders();
    }

    /**
     *This method loads all the handled orders and renders the serviced page.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function get_serviced()
    { 
        $this->load->model('orders_model');
        $data['title'] = "Serviced Orders";
        $data['serviced'] = $this->orders_model->serviced();
           
        //configure the pagination parameters
        $config['base_url'] = base_url().'admin/get_serviced';
        $config['total_rows'] = $this->orders_model->serviced();
        $config['per_page'] = 10; 
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<div id = "pagination1">';
        $config['full_tag_close'] = '</div>';

        //insert the paginations into the pages.
        $this->pagination->initialize($config); 
        $this->db->order_by("id", "desc");
        $data['records'] = $this->db->get_where('orders', array('handled' => '1'), $config['per_page'], $this->uri->segment(3));
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = '/admin/serviced';
        $this->load->view('admin/admin_includes/template', $data);
       
    }

    /**
     *This method gets the admin status.
     *@param none
     *@return boolean true if the the member is an admin, false if normal staff member.
     *@throws This method does not throw an error.
     */  
    function get_admin_status()
    {
        $this->load->model('membership_model');

        return $this->membership_model->admin_status();
    }
    
    /**
     *This method displays all the staff accounts.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function manage_accounts()
    {
        //only admins can manage accounts.
        $this->get_admin_status();
        $this->load->model('membership_model');
        $data['title'] = "Admin Accounts";
        $data['accounts'] = $this->membership_model->get_accounts();
        $data['main_content'] = '/admin/manage_accounts';
        $this->load->view('admin/admin_includes/template', $data);
      
    }

    /**
     *This method displays the form that is filled to create a new account.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function create_account()
    {
        $this->load->model('membership_model');
        $data['title'] = "Create Account";
        $data['main_content'] = '/admin/create_account';
        $this->load->view('admin/admin_includes/template', $data);
    }

    /**
     *This method creates a staff member's account.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function create_member()
    {
        //validate the form
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

		//if form is validated, add member into database.
		else
		{
			$this->load->model('membership_model');

            if($this->membership_model->create_member())
            {
            	//load all the members to ensure that the member has been added.
                redirect('admin/manage_accounts');
            }
            else
            {
            	//if adding member to database fails due to some reason reload the form.
                $this->create_account();
            }
		}

    }

    /**
     *This method deletes a user's account.
     *@param $id The id of the user whose account is to be deleted.
     *@return void
     *@throws This method does not throw an error.
     */  
    function delete_account($id)
    {
        $this->load->model('membership_model');
        $this->membership_model->delete_member($id);
        redirect('admin/manage_accounts');
    }

    /**
     *This method displays all the available items.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function manage_items()
    {
        $this->load->model('products_model');  
        $data['title'] = "Manage Items";
        $data['items'] = $this->products_model->get_all();
        $data['main_content'] = '/admin/manage_items';
        $this->load->view('admin/admin_includes/template', $data);
    }

    /**
     *This method displays the form that is filled in to create a new item.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function add_new_item()
    {
        $data['title'] = "Add New Item";
        $data['main_content'] = '/admin/create_items';
        $this->load->view('admin/admin_includes/template', $data);
    }
    
    /**
     *This method adds a new item to the data.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function add_item()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('item_name', 'Item Name', 'trim|required|xss_clean');
    	$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');
        if($this->form_validation->run() == FALSE) {
            $this->add_new_item();
        }
        else {
                $item_name = $this->input->post('item_name');
                $price = $this->input->post('price');

                //add the product into the database and reload the page.
                if($this->products_model->add_product($item_name, $price)) {
                redirect('admin/manage_items');
             }
        }
    }

    /**
     *This method displays the admin area and populates it with the customer orders.
     *@param $id The id of the item to be removed.
     *@return void
     *@throws This method does not throw an error.
     */  
    function remove_item($id)
    {
        $this->load->model('products_model');
        $this->products_model->remove_item($id);
        redirect('admin/manage_items');
    }

    /**
     *This method logs out a user.
     *@param none
     *@return void
     *@throws This method does not throw an error.
     */  
    function sign_out()
    {
        $this->session->sess_destroy();
        redirect('home/login');
    }
} 