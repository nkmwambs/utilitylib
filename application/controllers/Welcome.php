<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('utility_forms');
	}
	
	function index(){
		
		$lib =  new Utility_forms();
		
		$lib->set_db_table('user');
		
		$lib->set_table_join(array(
		'profile'=>array('profile_id','profile_id'),
		'login_type'=>array('login_type_id','login_type_id')
		));
		
		$lib->set_fields_to_show(array('firstname','lastname','email','email_notify','phone','profile_name','login_type_name'));
		
		$lib->set_fields_to_show_on_view(array('firstname','lastname','email','email_notify','profile_name','comment'));
		
		$lib->set_fields_to_show_on_edit(array('firstname','lastname','email','email_notify','profile_name','phone','comment'));
		
		$lib->set_fields_to_show_on_add(array('firstname','lastname','email','email_notify','phone','profile_name','login_type_name','comment'));
		
		$lib->set_display_as(array('firstname'=>'User First Name','lastname'=>'User Last Name'));
		
		$lib->set_add_form_type('single_column');
		
		$lib->set_debug_mode(1);
		
		$lib->set_required_fields(array('firstname','phone','profile_id'));
		
		$lib->set_change_field_type(array('comment'=>'textarea'));//Still in development
		
		$lib->set_dropdown_yes_no('email_notify');
		
		//$lib->callback_before_insert(array($this,'insert_with_createdby'));
		//$lib->callback_after_insert(array($this,'update_log_history'));
		$lib->callback_insert(array($this,'setting_custom_insert'));
		
		$page_data['output'] = $lib->render();
		$page_data['page_name'] = 'output_page';
		$page_data['page_title'] = get_phrase('users');
		$this -> load -> view('backend/index', $page_data);
	}
	
	function setting_custom_insert(){
		
		$data = $this->input->post();
		
		$data['firstname'] = "Mr. ".$this->input->post('firstname');
		
		$this->db->insert('user',$data);
	}
	
	function insert_with_createdby($post) {
		
		$post['createdby'] = 'Karisa';
		
		return $post;	
	}

	function update_log_history($post,$insert_id){
		$data['data_log'] = json_encode($post);
		$data['action'] = 'Insert';
		$data['record_table'] = 'user';
		$data['record_id'] = $insert_id;
		
		$this->db->insert('log',$data);		
	}

}
