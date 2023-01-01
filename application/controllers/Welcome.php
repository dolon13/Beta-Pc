<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->helper('url');
	}

	//Home Page Controller
	public function index()
	{
		$data['baseurl'] = $this->config->item('base_url');
		$data['header'] = $this->load->view('header', $data, TRUE);
		$data['footer'] = $this->load->view('footer', $data, TRUE);
		$this->load->view('home',$data);
	}

	//Login Page Contoller
	public function logSign()
	{
		$data['baseurl'] = $this->config->item('base_url');
		 $data['header'] = $this->load->view('login/header', $data, TRUE);
		$data['footer'] = $this->load->view('login/footer', $data, TRUE);
		$this->load->view('login/login',$data);
	}



	//Register Page Controlll

	public function regi()
	{
		$data['baseurl'] = $this->config->item('base_url');
		$data['header'] = $this->load->view('login/header', $data, TRUE);
		$data['footer'] = $this->load->view('login/footer', $data, TRUE);
		$this->load->helper(array('form'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[30]');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[30]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == FALSE)
		{

			$this->load->view('login/signup',$data);
			
		}
		else
		{
		    
		    $this->data = array(    //$data is a global variable
			'user_name' => md5($_POST['email']),
			'first_name' => $_POST['fname'],
			'last_name' => $_POST['lname'],
			'email' => $_POST['email'],
			'password' => md5($_POST['password'])
			);
			$this->User_model->insert_record($this->data);
			redirect(base_url().'welcome/regi');
		    
		}
		
	}

	//Logout and flush session data....
	public function ses_clear(){
		$this->session->sess_destroy();
		redirect(base_url());
	}


	//Login Authentication Controller....

	public function auth(){

		$log = array(
			'email' => $this->input->POST('email'),
			'pass' => $this->input->POST('pass')
		);

		$data = $this->User_model->getData('users');

		foreach ($data as $user) {
			if($user->email == $log['email']){
				if($user->password == md5($log['pass'])){
					//Session push
					$newdata = array(
						'user' => $user->user_name,
						'name'  => $user->last_name,
						'email'     => $user->email,
						'logged_in' => TRUE,
						'role' => $user->role,
						'isverified' => $user->is_verified,
						'build_table' => ''
					);
					 $this->session->set_userdata($newdata);
					 
					if($user->role == 1){
						redirect(base_url() . 'ad');
					}else{
						if($user->is_verified==0){
							$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Please!! Verify your account ...</div>');
						}
						redirect(base_url());
					}
				}
				else{
				}
			}else{
			}
		}
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Wrong Username/Password Please Try Again!!!</div>');
		redirect(base_url().'logSign','refresh');
	}

	public function product($str)
	{
		$data['baseurl'] = $this->config->item('base_url');
		
		$data['products'] = $this->User_model->getproduct($str);
		$data['pagename'] = $str;
		$data['header'] = $this->load->view('header', $data, TRUE);
		$data['footer'] = $this->load->view('footer', $data, TRUE);
		$this->load->view('product',$data);
	}

	//Product page single product
	public function product_page($str,$id){
		$data['baseurl'] = $this->config->item('base_url');
		
		$data['products'] = $this->User_model->getproductsingle($str,$id);
		$data['pagename'] = $str;
		$data['header'] = $this->load->view('header', $data, TRUE);
		$data['footer'] = $this->load->view('footer', $data, TRUE);
		$this->load->view('product_page',$data);

	}

	// Revieww Parttt
	public function review($id,$type){
		$data['baseurl'] = $this->config->item('base_url');
		$data['reviews'] = '';
		$data['product'] = $this->User_model->getproductsingle($type,$id);
		$data['pagename'] = $type;
		$data['header'] = $this->load->view('header', $data, TRUE);
		$data['footer'] = $this->load->view('footer', $data, TRUE);
		$this->load->view('review',$data);
	}

	public function addReview($id,$type){
		$body = $this->input->post('review');
		$rating = $this->input->post('rating');
		if($this->session->userdata('logged_in')==true){
			$this->User_model->addReview($id,$type,$body,$rating);
		}

		redirect(base_url().'review/'.$id.'/'.$type,'refresh');

	}


	//Pc builder page

	public function pcbuilder(){

		if($this->session->userdata('build_table')!=''){
			$data['baseurl'] = $this->config->item('base_url');
			$data['pagename'] = "Build PC";
			$data['header'] = $this->load->view('pc_builder/header', $data, TRUE);
			$data['footer'] = $this->load->view('pc_builder/footer', $data, TRUE);

			$data['build'] = $this->User_model->getTable();
			$temp = $this->User_model->getTable();

			foreach($temp as $t){

				$data['cpu'] = $this->User_model->getproductsingle('cpu',$t->cpu);
				$data['gpu'] = $this->User_model->getproductsingle('gpu',$t->gpu);
				$data['ram'] = $this->User_model->getproductsingle('ram',$t->ram);
				$data['psu'] = $this->User_model->getproductsingle('psu',$t->psu);
				$data['ssd'] = $this->User_model->getproductsingle('ssd',$t->ssd);
				$data['hdd'] = $this->User_model->getproductsingle('hdd',$t->hdd);
				$data['motherboard'] = $this->User_model->getproductsingle('motherboard',$t->motherboard);
				$data['casing'] = $this->User_model->getproductsingle('casing',$t->casing);

			}

			$this->load->view('pc_builder/builder',$data);
		}else{
			redirect(base_url()."pc_build","refresh");
		}

	}


	//Pc Builder intiating***---****
	public function pc_built(){
		$session = $this->session->userdata('logged_in');
	    
	    if($session)
			{
				If($this->session->userdata('build_table')==''){
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = 'Table_';
				for ($i = 0; $i < 7; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				$this->session->set_userdata('build_table',$randomString);
				$this->User_model->createTable();
				redirect(base_url()."pcbuilder","refresh");
				}else{
					redirect(base_url()."pcbuilder","refresh");
				}
				
			}else{
			$this->session->set_userdata('build_table','');
			redirect(base_url()."logSign","refresh");
		    }
	}

	public function updateTable($id,$str){
		
		$this->User_model->updateTable($id,$str);
		redirect(base_url()."pcbuilder","refresh");

	}

	public function select($str){
		$data['baseurl'] = $this->config->item('base_url');
		$this->session->set_flashdata('edit',true);
		$data['products'] = $this->User_model->getproduct($str);
		$data['pagename'] = $str;
		$data['header'] = $this->load->view('pc_builder/header', $data, TRUE);
		$data['footer'] = $this->load->view('pc_builder/footer', $data, TRUE);
		$this->load->view('pc_builder/select',$data);
	}

	public function delete($str){

		$this->User_model->delete($str);

		redirect(base_url()."pcbuilder","refresh");

	}


	// community
	public function community_page(){
	      
		if ($this->session->userdata('logged_in')){
			$data['baseurl'] = $this->config->item('base_url');
			$data['header'] = $this->load->view('community/header', $data, TRUE);
			$data['footer'] = $this->load->view('community/footer', $data, TRUE);
			$data['posts'] = $this->User_model->getData('post');
			
			$this->load->view('community/community', $data);
		}else{
			redirect(base_url()."logSign","refresh");
		}
	}

	public function create_community_post(){
	      
		$data['baseurl'] = $this->config->item('base_url');
		$data['pagename'] = 'post_create';
        $data['header'] = $this->load->view('add/header', $data, TRUE);
        $data['footer'] = $this->load->view('add/footer', $data, TRUE);
        
        $this->load->view('community/create_post', $data);
	}

	public function post_insert(){
	      
		$data['title'] = $this->input->post('title');
		$data['content'] = $this->input->post('content');
		$data['user'] = $this->session->userdata('name');
		$test = $this->User_model->post_in($data);
		if($test){
			$this->session->set_flashdata('response',"Post Created");
			redirect(base_url()."welcome/create_community_post",'refresh');
		}else{
			$this->session->set_flashdata('response',"Something goes wrong please try again");
			redirect(base_url()."welcome/create_community_post",'refresh');
		}
	}



	// Add items
	public function add_item(){
	      
		$data['baseurl'] = $this->config->item('base_url');
        $data['header'] = $this->load->view('add/header', $data, TRUE);
        $data['footer'] = $this->load->view('add/footer', $data, TRUE);
        
        $this->load->view('add/add_item', $data);
	}

	public function ad_cpu(){
	      
		$data['baseurl'] = $this->config->item('base_url');
        $data['header'] = $this->load->view('add/header', $data, TRUE);
        $data['footer'] = $this->load->view('add/footer', $data, TRUE);
        
        $this->load->view('add/cpu', $data);
	    
	}

	public function cpu_insert(){
	      
		$data['name'] = $this->input->post('name');
		$data['gen'] = $this->input->post('gen');
		$data['socket'] = $this->input->post('socket');
		$data['brand'] = $this->input->post('brand');
		$data['price'] = $this->input->post('price');
		$data['quantity'] = $this->input->post('quantity');
		$data['performance'] = $this->input->post('performance');
		$data['details'] = $this->input->post('details');


		$config['upload_path']   = './uploads/cpu/'; 
		$config['allowed_types'] = 'gif|jpg|png'; 
		$config['max_size']      = 1000; 
		$config['max_width']     = 4096; 
		$config['max_height']    = 4096;  
		$this->load->library('upload',$config, 'cpu');
		$this->cpu->initialize($config);	
		if ( ! $this->cpu->do_upload('path')) {
			$error = array('error' => $this->cpu->display_errors()); 
		}
		else { 
			$upload = array('upload_data' => $this->cpu->data());
		} 

		$data['path'] = $upload['upload_data']['file_name'];
		$test = $this->User_model->cpu_in($data);
		

		if($test){
			$this->session->set_flashdata('response',"Data Inserted Successfully");
			redirect(base_url()."welcome/ad_cpu",'refresh');
		}

	}


	public function ad_gpu(){
	      
		$data['baseurl'] = $this->config->item('base_url');
        $data['header'] = $this->load->view('add/header', $data, TRUE);
        $data['footer'] = $this->load->view('add/footer', $data, TRUE);
        
        $this->load->view('add/gpu', $data);
	}


	public function gpu_insert(){

	      
		$data['name'] = $this->input->post('name');
		$data['ddr'] = $this->input->post('ddr');
		$data['pci_slot'] = $this->input->post('pci_slot');
		$data['brand'] = $this->input->post('brand');
		$data['price'] = $this->input->post('price');
		$data['quantity'] = $this->input->post('quantity');
		$data['performance'] = $this->input->post('performance');
		$data['details'] = $this->input->post('details');


		$config = array();
		$config['upload_path']   = './uploads/gpu/'; 
		$config['allowed_types'] = 'gif|jpg|png'; 
		$config['max_size']      = 1000; 
		$config['max_width']     = 4096; 
		$config['max_height']    = 4096;  
		$this->load->library('upload',$config, 'gpu');
		$this->gpu->initialize($config);
		if ( ! $this->gpu->do_upload('path')) {
			$error = array('error' => $this->gpu->display_errors()); 
		}
			
		else { 
			$upload = array('upload_data' => $this->gpu->data());
		} 

		$data['path'] = $upload['upload_data']['file_name'];
		
		$test = $this->User_model->gpu_in($data);
		

		if($test){
			$this->session->set_flashdata('response',"Data Inserted Successfully");
			redirect(base_url()."welcome/ad_gpu",'refresh');
		}

	}

	public function ad_psu(){
		$data['baseurl'] = $this->config->item('base_url');
        $data['header'] = $this->load->view('add/header', $data, TRUE);
        $data['footer'] = $this->load->view('add/footer', $data, TRUE);
        
        //$data['project'] = $this->User_model->getProject($data['session']['username']);
        //$data['proDetails'] = $this->User_model->getProjectDetails($data['session']['username']);
        //$data['Team'] = $this->User_model->getTeamMembers($data['session']['username']);
        
        $this->load->view('add/psu', $data);
	}


	public function psu_insert(){
	      
			$data['name'] = $this->input->post('name');
			$data['power'] = $this->input->post('power');
			//$data['socket'] = $this->input->post('socket');
			$data['brand'] = $this->input->post('brand');
			$data['price'] = $this->input->post('price');
			$data['quantity'] = $this->input->post('quantity');
			//$data['performance'] = $this->input->post('performance');
			$data['details'] = $this->input->post('details');


			$config['upload_path']   = './uploads/psu/'; 
			$config['allowed_types'] = 'gif|jpg|png'; 
			$config['max_size']      = 1000; 
			$config['max_width']     = 4096; 
			$config['max_height']    = 4096;  
			$this->load->library('upload',$config, 'psu');
			$this->psu->initialize($config);	
			if ( ! $this->psu->do_upload('path')) {
				$error = array('error' => $this->psu->display_errors()); 
				// foreach($error as $e){
				// 	echo $e;
				// }
				//$this->load->view('upload_form', $error); 
			}
				
			else { 
				$upload = array('upload_data' => $this->psu->data());
				 
				//$this->load->view('upload_success', $data); 
			} 

			$data['path'] = $upload['upload_data']['file_name'];

			
			if($this->session->userdata('p_id')){
				if(isset($_SESSION['edit'])){
					unset($_SESSION['edit']);
				}
				$test = $this->User_model->psu_update($data);
			}else{
				$test = $this->User_model->psu_in($data);
			}

			if($test){
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				redirect(base_url()."add/psu",'refresh');
			}

	}



	public function ad_ram(){
	      
		$data['baseurl'] = $this->config->item('base_url');
        $data['header'] = $this->load->view('add/header', $data, TRUE);
        $data['footer'] = $this->load->view('add/footer', $data, TRUE);
        
        //$data['project'] = $this->User_model->getProject($data['session']['username']);
        //$data['proDetails'] = $this->User_model->getProjectDetails($data['session']['username']);
        //$data['Team'] = $this->User_model->getTeamMembers($data['session']['username']);
        
        $this->load->view('add/ram', $data);
	    
	}


	public function ram_insert(){
	      
			$data['name'] = $this->input->post('name');
			$data['bus'] = $this->input->post('bus');
			$data['storage'] = $this->input->post('storage');
			$data['brand'] = $this->input->post('brand');
			$data['price'] = $this->input->post('price');
			$data['quantity'] = $this->input->post('quantity');
			$data['performance'] = $this->input->post('performance');
			$data['details'] = $this->input->post('details');


			$config['upload_path']   = './uploads/ram/'; 
			$config['allowed_types'] = 'gif|jpg|png'; 
			$config['max_size']      = 1000; 
			$config['max_width']     = 4096; 
			$config['max_height']    = 4096;  
			$this->load->library('upload',$config, 'ram');
			$this->ram->initialize($config);	
			if ( ! $this->ram->do_upload('path')) {
				$error = array('error' => $this->ram->display_errors());
				print_r($error); 
			}
				
			else { 
				$upload = array('upload_data' => $this->ram->data());
			} 

			$data['path'] = $upload['upload_data']['file_name'];
			
			$test = $this->User_model->ram_in($data);

			if($test){
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				redirect(base_url()."add/ram",'refresh');
			}

	}




	public function ad_ssd(){
	      
		$data['baseurl'] = $this->config->item('base_url');
        $data['header'] = $this->load->view('add/header', $data, TRUE);
        $data['footer'] = $this->load->view('add/footer', $data, TRUE);
        
        //$data['project'] = $this->User_model->getProject($data['session']['username']);
        //$data['proDetails'] = $this->User_model->getProjectDetails($data['session']['username']);
        //$data['Team'] = $this->User_model->getTeamMembers($data['session']['username']);
        
        $this->load->view('add/ssd', $data);
	    
	}

	public function ssd_insert(){
			$data['name'] = $this->input->post('name');
			$data['storage'] = $this->input->post('storage');
			$data['tech'] = $this->input->post('tech');
			$data['size'] = $this->input->post('size');
			$data['brand'] = $this->input->post('brand');
			$data['price'] = $this->input->post('price');
			$data['quantity'] = $this->input->post('quantity');
			$data['performance'] = $this->input->post('performance');
			$data['details'] = $this->input->post('details');


			$config['upload_path']   = './uploads/ssd/'; 
			$config['allowed_types'] = 'gif|jpg|png'; 
			$config['max_size']      = 1000; 
			$config['max_width']     = 4096; 
			$config['max_height']    = 4096;  
			$this->load->library('upload',$config, 'ssd');
			$this->ssd->initialize($config);	
			if ( ! $this->ssd->do_upload('path')) {
				$error = array('error' => $this->ssd->display_errors()); 
				// foreach($error as $e){
				// 	echo $e;
				// }
				//$this->load->view('upload_form', $error); 
			}
				
			else { 
				$upload = array('upload_data' => $this->ssd->data());
				 
				//$this->load->view('upload_success', $data); 
			} 

			$data['path'] = $upload['upload_data']['file_name'];
		
			
			if($this->session->userdata('p_id')){
				if(isset($_SESSION['edit'])){
					unset($_SESSION['edit']);
				}
				$test = $this->User_model->ssd_update($data);
			}else{
				$test = $this->User_model->ssd_in($data);
			}

			if($test){
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				redirect(base_url()."add/ssd",'refresh');
			}
	}
	

	public function ad_hdd(){
	      
		$data['baseurl'] = $this->config->item('base_url');
        $data['header'] = $this->load->view('add/header', $data, TRUE);
        $data['footer'] = $this->load->view('add/footer', $data, TRUE);
        
        //$data['project'] = $this->User_model->getProject($data['session']['username']);
        //$data['proDetails'] = $this->User_model->getProjectDetails($data['session']['username']);
        //$data['Team'] = $this->User_model->getTeamMembers($data['session']['username']);
        
        $this->load->view('add/hdd', $data);
	    
	}


	public function hdd_insert(){

			$data['name'] = $this->input->post('name');
			$data['storage'] = $this->input->post('storage');
			//$data['socket'] = $this->input->post('socket');
			$data['brand'] = $this->input->post('brand');
			$data['price'] = $this->input->post('price');
			$data['quantity'] = $this->input->post('quantity');
			$data['performance'] = $this->input->post('performance');
			$data['details'] = $this->input->post('details');


			$config['upload_path']   = './uploads/hdd/'; 
			$config['allowed_types'] = 'gif|jpg|png'; 
			$config['max_size']      = 1000; 
			$config['max_width']     = 4096; 
			$config['max_height']    = 4096;  
			$this->load->library('upload',$config, 'hdd');
			$this->hdd->initialize($config);	
			if ( ! $this->hdd->do_upload('path')) {
				$error = array('error' => $this->hdd->display_errors()); 
				// foreach($error as $e){
				// 	echo $e;
				// }
				//$this->load->view('upload_form', $error); 
			}
				
			else { 
				$upload = array('upload_data' => $this->hdd->data());
				 
				//$this->load->view('upload_success', $data); 
			} 

			$data['path'] = $upload['upload_data']['file_name'];
			

			//echo $data;


			//$data['project'] = $this->User_model->getProject($data['session']['username']);
			//$data['proDetails'] = $this->User_model->getProjectDetails($data['session']['username']);
			//$data['Team'] = $this->User_model->getTeamMembers($data['session']['username']);
			
			if($this->session->userdata('p_id')){
				if(isset($_SESSION['edit'])){
					unset($_SESSION['edit']);
				}
				$test = $this->User_model->hdd_update($data);
			}else{
				$test = $this->User_model->hdd_in($data);
			}

			if($test){
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				redirect(base_url()."add/hdd",'refresh');
			}

	}


	public function ad_mboard(){
	      
		$data['baseurl'] = $this->config->item('base_url');
        $data['header'] = $this->load->view('add/header', $data, TRUE);
        $data['footer'] = $this->load->view('add/footer', $data, TRUE);
        
        //$data['project'] = $this->User_model->getProject($data['session']['username']);
        //$data['proDetails'] = $this->User_model->getProjectDetails($data['session']['username']);
        //$data['Team'] = $this->User_model->getTeamMembers($data['session']['username']);
        
        $this->load->view('add/mboard', $data);
	    
	}

	public function mboard_insert(){

			$data['name'] = $this->input->post('name');
			$data['bus'] = $this->input->post('bus');
			$data['socket'] = $this->input->post('socket');
			$data['min_bus'] = $this->input->post('min_bus');
			$data['form_factor'] = $this->input->post('form_factor');
			$data['pci_slot'] = $this->input->post('pci_slot');
			$data['brand'] = $this->input->post('brand');
			$data['price'] = $this->input->post('price');
			$data['quantity'] = $this->input->post('quantity');
			//$data['performance'] = $this->input->post('performance');
			$data['details'] = $this->input->post('details');


			$config['upload_path']   = './uploads/motherboard/'; 
			$config['allowed_types'] = 'gif|jpg|png'; 
			$config['max_size']      = 1000; 
			$config['max_width']     = 4096; 
			$config['max_height']    = 4096;  
			$this->load->library('upload',$config, 'mboard');
			$this->mboard->initialize($config);
			if ( ! $this->mboard->do_upload('path')) {
				$error = array('error' => $this->mboard->display_errors()); 
				// foreach($error as $e){
				// 	echo $e;
				// }
				//$this->load->view('upload_form', $error); 
			}
				
			else { 
				$upload = array('upload_data' => $this->mboard->data());
				 
				//$this->load->view('upload_success', $data); 
			} 

			$data['path'] = $upload['upload_data']['file_name'];
			

			//echo $data;


			//$data['project'] = $this->User_model->getProject($data['session']['username']);
			//$data['proDetails'] = $this->User_model->getProjectDetails($data['session']['username']);
			//$data['Team'] = $this->User_model->getTeamMembers($data['session']['username']);
			
			if($this->session->userdata('p_id')){
				if(isset($_SESSION['edit'])){
					unset($_SESSION['edit']);
				}
				$test = $this->User_model->mboard_update($data);
			}else{
				$test = $this->User_model->mboard_in($data);
			}

			if($test){
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				redirect(base_url()."add/mboard",'refresh');
			}

	}


	public function ad_casing(){

		$data['baseurl'] = $this->config->item('base_url');
        $data['header'] = $this->load->view('add/header', $data, TRUE);
        $data['footer'] = $this->load->view('add/footer', $data, TRUE);
        
        //$data['project'] = $this->User_model->getProject($data['session']['username']);
        //$data['proDetails'] = $this->User_model->getProjectDetails($data['session']['username']);
        //$data['Team'] = $this->User_model->getTeamMembers($data['session']['username']);
        
        $this->load->view('add/casing', $data);

	}

	public function casing_insert(){

	      
			$data['name'] = $this->input->post('name');
			//$data['form_factor'] = $this->input->post('form_factor');
			//$data['socket'] = $this->input->post('socket');
			//$data['min_bus'] = $this->input->post('min_bus');
			$data['form_factor'] = $this->input->post('form_factor');
			//$data['pci_slot'] = $this->input->post('pci_slot');
			$data['brand'] = $this->input->post('brand');
			$data['price'] = $this->input->post('price');
			$data['quantity'] = $this->input->post('quantity');
			//$data['performance'] = $this->input->post('performance');
			$data['details'] = $this->input->post('details');


			$config['upload_path']   = './uploads/casing/'; 
			$config['allowed_types'] = 'gif|jpg|png'; 
			$config['max_size']      = 1000; 
			$config['max_width']     = 4096; 
			$config['max_height']    = 4096;  
			$this->load->library('upload',$config, 'casing');
			$this->casing->initialize($config);
			if ( ! $this->casing->do_upload('path')) {
				$error = array('error' => $this->casing->display_errors()); 
				// foreach($error as $e){
				// 	echo $e;
				// }
				//$this->load->view('upload_form', $error); 
			}
				
			else { 
				$upload = array('upload_data' => $this->casing->data());
				 
				//$this->load->view('upload_success', $data); 
			} 

			$data['path'] = $upload['upload_data']['file_name'];
			

			//echo $data;


			//$data['project'] = $this->User_model->getProject($data['session']['username']);
			//$data['proDetails'] = $this->User_model->getProjectDetails($data['session']['username']);
			//$data['Team'] = $this->User_model->getTeamMembers($data['session']['username']);
			
			if($this->session->userdata('p_id')){
				if(isset($_SESSION['edit'])){
					unset($_SESSION['edit']);
				}
				$test = $this->User_model->casing_update($data);
			}else{
				$test = $this->User_model->casing_in($data);
			}

			if($test){
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				redirect(base_url()."add/casing",'refresh');
			}

	}


}
?>


	