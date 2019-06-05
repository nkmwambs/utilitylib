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
		
		$lib->set_fields_to_show(array('firstname','lastname','email','profile_name','login_type_name'));
		
		$lib->set_fields_to_show_on_view(array('firstname','lastname','email','profile_name'));
		
		$lib->set_fields_to_show_on_edit(array('firstname','lastname','email','profile_name'));
		
		$lib->set_fields_to_show_on_add(array('firstname','lastname','email','profile_name'));
		
		$lib->set_display_as(array('firstname'=>'User First Name','lastname'=>'User Last Name'));
		
		$lib->set_add_form_type('multi_column');
		
		$lib->set_debug_mode(1);
		
		$page_data['output'] = $lib->render();
		$page_data['page_name'] = 'output_page';
		$page_data['page_title'] = get_phrase('users');
		$this -> load -> view('backend/index', $page_data);
	}
	
	function users() {

	}

}
