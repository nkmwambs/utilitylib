<?php
/**
 * THIS LIBRARY WAS DEVELOPED TO BE USED TO CREATE FORMS IN THE FLY
 * IT IS CAPABLE OF CREATING 2 TYPE OF FORMS THATS IS SINGLE COLUMNED AND
 * MULTI COLUMNED FORM.
 *
 * IN ORDER TO RUN WELL BOOSTRAP 3 AND JQUERY 2.X SHOULD HAV BEEN INSTALLED
 * IN THE APPLICATION INTENDED TO BE USED.
 *
 * THIS IS A CODEIGNITER LIBRARY BUILT WITH CODEIGNITER 3.6
 *
 *
 * 	@author Nicodemus Karisa Mwambire
 * 	@copyright Compassion Internation Kenya (c) 2019
 *	@package Toolkit
 * 	@version 2019.01.01
 * 	@license https://www.compassion-africa.org/software/license/utility_forms.txt
 *
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Utility_forms {

	/**
	 * Form Fields
	 *
	 *
	 * A collection of array elements representing each field in a form group for
	 * single columned forms on a the first row and headers for multi columed
	 * form
	 *
	 * @var Array
	 *
	 */
	private $fields = array();

	/**
	 *
	 * Form Action
	 *
	 *This is the value of the action property of the form.
	 *
	 * @var String
	 *
	 */

	private $form_action = "";

	/**
	 *
	 * Form ID
	 *
	 * This holds the form's id property. If not provided it is defaulted
	 * to frm
	 *
	 * @var String
	 *
	 */

	private $form_id = "frm";

	/**
	 *
	 * Form Output String
	 *
	 * The whole form is assigned to this variable as plain string.
	 * When echoed the form gets created.
	 *
	 * @var String
	 *
	 */

	private $form_output_string = "";

	/**
	 *
	 * Multi Column Table ID
	 *
	 * This is the id ot the multi columned form. It hold the rows of the form.
	 * If not prodived it defaults to tbl_multi_column
	 *
	 * @var String
	 *
	 */

	private $multi_column_table_id = 'tbl_multi_column';

	/**
	 *
	 * Initial Row Count
	 *
	 * This property when set atomatically creates rows equal to the value assigned.
	 * By default it has a value of 1, so only one row will be created.
	 *
	 * @var Integer
	 *
	 */

	private $initial_row_count = 1;

	/**
	 *
	 * Form Tag
	 *
	 * The form tag property help in setting whether the fields ought to be encapsulated
	 * in a form tag of not. By default it is set to true to mean that the form elements
	 * are within a form tag otherwise the value should be false to strip off the form
	 * form elements from the form tag
	 *
	 * @var Boolean
	 *
	 */

	private $use_form_tag = true;

	private $go_back_on_post = true;

	private $CI;

	private $use_panel = true;

	private $panel_title = "";

	private $panel_color_theme = 'info';
	//success,info,danger,default

	private $debug_mode = 0;

	private $db_table = "";

	private $selected_list_fields = array();

	private $use_datatable = true;

	private $data_limit = array();

	function __construct() {
		$this -> CI = &get_instance();

		$this -> CI -> load -> database();

		$this -> CI -> load -> helper('url');

		$this -> CI -> load -> helper('url');
		$this -> CI -> load -> helper('form');

		$this -> CI -> load -> helper('multi_language');

		$this -> CI -> load -> library('session');
	}

	/**
	 *
	 * Set Form Action
	 *
	 * @param String form_action
	 *
	 * This method set the form' action property.
	 *
	 * @return Void
	 *
	 */

	public function set_form_action($form_action = "") {
		$this -> form_action = $form_action;
	}

	/**
	 *Get Form Action
	 *
	 * The method returns the action of the form
	 *
	 * @return String
	 */

	private function get_form_action() {
		return $this -> form_action;
	}

	/**
	 * Set Form ID
	 *
	 * @param String form_id
	 *
	 * Sets the ID of the form
	 *
	 * @return Void
	 */

	public function set_form_id($form_id = "") {
		$this -> form_id = $form_id;
	}

	/**
	 * Get form ID
	 *
	 * Returns the ID of the form
	 *
	 * @return String
	 */

	private function get_form_id() {
		return $this -> form_id;
	}

	/**
	 * Set form tag
	 *
	 * @param String use_form_tag
	 *
	 * Set to true if tag is to be used to false
	 *
	 * @return Void
	 */

	public function set_use_form_tag($use_form_tag = "") {
		$this -> use_form_tag = $use_form_tag;
	}

	/**
	 * Get Form Tag
	 *
	 * Return true if form tags is to be used to false if not
	 *
	 * @return Boolean
	 */

	private function get_use_form_tag() {
		return $this -> use_form_tag;
	}

	/**
	 * Set Initial Row Count
	 *
	 * Set the number of default rows in a multi columned form.
	 *
	 * @return Void
	 */

	function set_initial_row_count($row_count = "") {
		$this -> initial_row_count = $row_count;
	}

	/**
	 * Get Initial Row Count
	 *
	 * This method returns the number of default rows in a multi columned
	 * form. The default value of initial row count is 1.
	 *
	 * @return Integer
	 */

	private function get_initial_row_count() {
		return $this -> initial_row_count;
	}

	/**
	 * Form Open Tag
	 *
	 * This method form_output_string to form opening tag. It uses the codeigniter
	 * form_open tag. The form is set to allow multi form data.
	 *
	 * @return String
	 */

	function set_go_back_on_post($go_back_on_post = true) {
		$this -> go_back_on_post = $go_back_on_post;
	}

	private function get_go_back_on_post() {
		return $this -> go_back_on_post;
	}

	private function form_open_tag() {

		$this -> get_use_form_tag();

		$return_string = "";

		if ($this -> use_form_tag == true) {
			$return_string .= form_open($this -> form_action, array('id' => $this -> form_id, 'class' => 'form-horizontal 
			form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
		}

		return $return_string;
	}

	private function open_panel() {

		$this -> get_use_panel();

		$return_string = "";

		if ($this -> use_panel == true) {
			$title = $this -> panel_title == "" ? get_phrase($this -> db_table) . ' ' . get_phrase('list') : $this -> panel_title;
			$return_string .= '
					<div class="panel panel-' . $this -> get_panel_color_theme() . '">
										
						<div class="panel-heading">
							<div class="panel-title">' . $title . '</div>						
						</div>
												
						<div class="panel-body">
				';
		}
		


		return $return_string;
	}

	private function close_panel() {

		$this -> get_use_panel();

		$return_string = "";

		if ($this -> use_panel == true) {
			$return_string .= '</div>
				</div>';
		}
		return $return_string;
	}

	function set_use_panel($use_panel = "") {
		$this -> use_panel = $use_panel;
	}

	private function get_use_panel() {
		return $this -> use_panel;
	}

	function set_panel_color_theme($panel_color_theme = "") {
		$this -> panel_color_theme = $panel_color_theme;
	}

	function get_panel_color_theme() {
		return $this -> panel_color_theme;
	}

	//private $hide_save_button;

	//public function set_hide_save_button($bool_state){
	//$this->hide_save_button = $bool_state;
	//}

	//private function get_hide_save_button(){
	//return $this->hide_save_button;
	//}

	/**
	 * Form Close Tag
	 *
	 * Returns the form close tag
	 *
	 * @return String
	 */

	private function form_close_tag() {

		$this -> get_use_form_tag();

		$return_string = "";

		if ($this -> use_form_tag == true) {

			$return_string .= form_close();

			//added
			if ($this -> view_or_edit_mode != 'view') {
				$return_string .= "<div class='form-group'>
				    <div class='col-xs-12'>
					<button type='submit' class='btn btn-default' id='btnCreate'><i class='fa fa-send'></i> " . get_phrase('save') . "</button>
				   </div>";
			}
			$return_string .= "</div>";
		}

		return $return_string;
	}

	/**
	 * Create Select Field
	 *
	 * Renders a select form element
	 *
	 * @return String
	 */

	private function create_select_field($fields = array(), $cnt = 0) {
		//print_r($fields);
		/**
		 * Additonal classes are other classes to the element other
		 * than the hard coded form-control class. The are part of the properties element
		 * of the fields array.
		 *
		 * For example 'properties'=>array('class'=>'resettable mandatory')
		 *
		 * If the properties element has class key in it then it's value will be assigned
		 * to the additional_classes local variable. This variable is appended to the existing
		 * class.
		 */

		$output_string = "";

		$additional_classes = "";

		if (isset($fields['properties'])) {
			if (array_key_exists('class', $fields['properties'])) {
				$additional_classes = " " . $fields['properties']['class'];
			}
		}

		$output_string .= "<select class='form-control " . $additional_classes . "' ";

		/**
		 * This part of the code allows for a non key-value paired elements of the properties element.
		 * If such elemeents are found inside properties since they have a numeric key the values will
		 * be used as the key.
		 */
		if (isset($fields['properties'])) {
			foreach ($fields['properties'] as $property => $value) {
				if (is_numeric($property)) {
					$output_string .= " " . $value . " = '" . $value . "' ";
				} else {
					$output_string .= " " . $property . " = '" . $value . "' ";
				}
			}
		}

		$output_string .= ">
		<option value=''>" . get_phrase('select') . "....</option>";
		/**
		 * Builds the options html in a select element
		 */
		if (array_key_exists('options', $fields)) {
			foreach ($fields['options'] as $option_value => $option) {

				$output_string .= "<option value='" . $option_value . "' ";

				/**
				 * Sets the selected option in a select element. It uses the key of the values
				 * element of the fields array.
				 */

				// if(isset($fields['values'][0]) && $option_value == $fields['values'][$cnt]){
				// $output_string .= " selected = 'selected' ";
				// }

				if (array_key_exists('selected', $option) && $option['selected'] == 'selected') {
					$output_string .= " selected = 'selected' ";
				}

				//
				if (array_key_exists('properties', $fields['options'][$option_value])) {
					foreach ($fields['options'][$option_value]['properties'] as $property => $value) {

						if (isset($fields['values']) && $value == 'selected')
							continue;

						if (is_numeric($property)) {
							//For property array that is not associative
							$output_string .= " " . $value . " = '" . $value . "' ";
						} else {
							//For associative property array
							$output_string .= " " . $property . " = '" . $value . "' ";
						}
					}
				}

				$output_string .= " '>" . $option['option'] . "</option>";
			}
		}

		$output_string .= "</select>";

		return $output_string;
	}

	private function create_input_field($fields = array(), $cnt = 0) {

		$output_string = "";

		$additional_classes = "";

		if (isset($fields['properties'])) {
			if (array_key_exists('class', $fields['properties'])) {
				$additional_classes = " " . $fields['properties']['class'];
			}
		}

		$output_string .= "<input class='form-control" . $additional_classes . "' ";

		if (isset($fields['properties'])) {
			if (!array_key_exists('type', $fields['properties'])) {
				$output_string .= "type='text'";
			}
		} else {
			$output_string .= "type='text'";
		}

		if (isset($fields['values'])) {
			$output_string .= " value = '" . $fields['values'][$cnt] . "' ";
		}

		if (isset($fields['properties'])) {
			foreach ($fields['properties'] as $property => $value) {

				if (is_numeric($property)) {
					$output_string .= " " . $value . " = '" . $value . "' ";
				} else {
					$output_string .= " " . $property . " = '" . $value . "' ";
				}

			}
		}

		$output_string .= " />";

		return $output_string;
	}

	private function create_closed_html_tag($fields = array(), $cnt = 0) {

		$output_string = "";

		$output_string .= "<" . $fields['element'];

		if (isset($fields['properties'])) {
			foreach ($fields['properties'] as $property => $value) {

				if ($property == 'innerHTML')
					continue;

				if (is_numeric($property)) {
					$output_string .= " " . $value . " = '" . $value . "' ";
				} else {
					$output_string .= " " . $property . " = '" . $value . "' ";
				}

			}
		}

		$output_string .= ">";

		$output_string .= $fields['properties']['innerHTML'];

		$output_string .= "</" . $fields['element'] . ">";

		return $output_string;
	}

	private function _get_primary_table_fields() {
		return array_column($this -> CI -> db -> field_data($this -> db_table), 'name');
	}

	private function create_single_column_add_form() {
		if ($this -> form_output_string !== "")
			$this -> form_output_string = "";

		$this -> view_or_edit_mode = 'add';

		$this -> fields = $this -> _get_fields_names_from_table_result();

		$this -> panel_title = $this -> panel_title == "" ? get_phrase($this -> db_table) . ' ' . get_phrase('add') : $this -> panel_title;

		$output_string = $this -> open_panel();

		$output_string .= $this -> form_open_tag();

		$output_string .= "<div class='row'><div class='col-xs-12'><ul class='nav nav-pills'>
							<li>
								<a id='btnBack' onclick='go_back();' class='btn btn-default'><i class='fa fa-arrow-left'></i> " . get_phrase('back') . "</a>		
							</li>
										
						</ul></div></div>";

		foreach ($this->fields as $fields) {

			$output_string .= "<div class='form-group'>
				<label class='control-label col-xs-4'>" . get_phrase($fields) . " <i style='cursor:pointer;' title='" . get_tooltip($fields) . "' class='fa fa-question-circle'></i></label>
				<div class='col-xs-8'>";

			$output_string .= "<div class='col-xs-8'>";

			$output_string .= $this -> _get_add_field_input_type($fields);

			$output_string .= "</div>";

			$output_string .= "</div>
			</div>";
		}

		$output_string .= $this -> form_close_tag();

		$output_string .= $this -> close_panel();

		//$this->set_internal_debug($this->db_results());

		if ($this -> debug_mode != 0) {
			$output_string .= $this -> show_debug_mode();
		}
		
		$output_string .= $this -> jquery_script();

		$output_string .= $this -> style_script();

		return $this -> form_output_string = $output_string;
	}

	private function _get_add_field_input_type($fields, $value = "") {

		$change_name_on_multi_form = $fields;

		if ($this -> form_type == 'multi_column') {
			$change_name_on_multi_form = $fields . '[]';
		}

		$element = array('label' => $fields, 'element' => 'input', 'properties' => array('class' => '', 'name' => $change_name_on_multi_form, 'value' => $value));

		$output_string_input = $this -> create_input_field($element);

		if (!in_array($fields, $this -> _get_primary_table_fields())) {

			//Find what is the table that has the field $fields amongst the joined tables and the primary key field

			$joined_table = "";
			$primary_key_field = "";

			foreach ($this->join as $join_table => $join_keys) {
				$fields_for_joined_table = array_column($this -> CI -> db -> field_data($join_table), 'name');

				if (in_array($fields, $fields_for_joined_table)) {
					$joined_table = $join_table;
					$primary_key_field = $this -> _get_primary_key_field($join_table);
					
					$change_name_on_multi_form = $primary_key_field;
					
					if ($this -> form_type == 'multi_column') {
						$change_name_on_multi_form = $primary_key_field . '[]';
					}
				}
			}

			$this -> set_dropdown_from_table(array($joined_table, $primary_key_field, $fields, $primary_key_field));

			$element = array('label' => $fields, 'element' => 'select', 'properties' => array('class' => '', 'name' => $change_name_on_multi_form), 'options' => $this -> dropdown_element_type[1]);

			$output_string_input = $this -> create_select_field($element);
		}
		return $output_string_input;
	}

	private function create_multi_column_add_form() {

		if ($this -> form_output_string !== "")
			$this -> form_output_string = "";

		$list_array = $this -> assign_primary_key_as_row_keys_for_db_results();

		$this -> fields = $this -> _get_fields_names_from_table_result();

		$this -> view_or_edit_mode = 'add';

		$this -> panel_title = $this -> panel_title == "" ? get_phrase($this -> db_table) . ' ' . get_phrase('add') : $this -> panel_title;

		$output_string = $this -> open_panel();

		$output_string .= $this -> form_open_tag();

		$output_string .= '<ul class="nav nav-pills">
										<li>
											<a id="add_row" class="btn btn-default"><i class="fa fa-plus"></i>  ' . get_phrase('add_row') . '</a>	
										</li>
										<li>
											<a id="btnDelRow" class="btn btn-default hidden"><i class="fa fa-minus"></i> ' . get_phrase('remove_row') . '</a>	
										</li>
										<li>
											<a id="resetBtn" class="btn btn-default"><i class="fa fa-refresh"></i> ' . get_phrase('reset') . '</a>	
										</li>
										<li>
											<a id="btnBack" onclick="go_back();" class="btn btn-default"><i class="fa fa-arrow-left"></i> ' . get_phrase('back') . '</a>	
										</li>
									</ul><hr />';

		$output_string .= "
				<div class='row'>
						<div class='col-xs-12'>
							<table class='table table-striped' id='" . $this -> multi_column_table_id . "'>
								<thead><tr>";

		$output_string .= "<th>Action</th>";

		foreach ($this->_get_fields_names_from_table_result() as $value) {

			if (!empty($this -> display_as)) {
				if (array_key_exists($value, $this -> display_as)) {
					$value = $this -> display_as[$value];
				}
			}

			$output_string .= "<th>" . get_phrase($value) . " <i style='cursor:pointer;' title='" . get_tooltip($value) . "' class='fa fa-question-circle'></i></th>";

		}
		$output_string .= "</tr></thead><tbody><tr class='tr_clone'>";
		$output_string .= "<td><input type='checkbox' id='' class='check' /></td>";

		foreach ($this->_get_fields_names_from_table_result() as $fields) {
			$output_string .= "<td>";

			$output_string .= $this -> _get_add_field_input_type($fields);

			$output_string .= "</td>";
		}
		$output_string .= "</tr></tbody></table>
						</div>
				</div>				
		";

		$output_string .= $this -> form_close_tag();

		$output_string .= $this -> close_panel();

		if ($this -> debug_mode != 0) {
			$output_string .= $this -> show_debug_mode();
		}

		$output_string .= $this -> jquery_script();

		$output_string .= $this -> style_script();

		return $this -> form_output_string = $output_string;
	}

	private function jquery_script() {

		$output_string = '<script>
		       
			   setTimeout(function(){
			   		$("#save_message").css("display","none");
			   },1500);
			  
				function go_back(){
					window.history.back();
				}
				
				$("#add_row").on("click",function(){
					clone_last_body_row("' . $this -> multi_column_table_id . '","tr_clone");
				});
				
				$(document).on("click",".check",function(){
					show_hide_delete_button_on_check("check","btnDelRow");
				});
				
				$("#btnDelRow").click(function(){
					remove_selected_rows("' . $this -> multi_column_table_id . '","btnDelRow","check");
				});
				
				
				$("#resetBtn").on("click",function(){
					remove_all_rows("' . $this -> multi_column_table_id . '");
					$(".resetable").val(null);
				});
				
				function clone_last_body_row(table_id,row_class){
					//alert($("#"+table_id+" tbody tr:last").html());
					var $tr    = $("#"+table_id+" tbody tr:last").closest("."+row_class);
					var $clone = $tr.clone();
					$clone.find(":checkbox").removeAttr("disabled");
					$clone.find("input[readonly!=readonly]:text").val(null);
					$tr.after($clone);
				}
	
				
				function remove_all_rows(tbl_id,td_hosting_checkbox_postion){
					if (td_hosting_checkbox_postion === undefined) {
				        td_hosting_checkbox_postion = 0;
				    }
					 $("#"+tbl_id+" tbody").find("tr:gt(0)").remove();
					 
					 var elem = $("select,input");
					 
					 //Clear values elements that are not readonly or disabled
					 $.each(elem,function(){
					 	if($(this).is("[readonly]") == false && $(this).is("[disabled]")== false)
					    {
					      $(this).val(null);
					    }
					 });
					
					 //Uncheck the check box of the first row
					 $("#"+tbl_id+" tbody").find("tr:eq(0) td:eq("+td_hosting_checkbox_postion+")").children().prop("checked",false);		 
				}
				
				function show_hide_delete_button_on_check(checkbox_class,delete_button_id){
					var checked = $("."+checkbox_class+":checked").length;
					if(checked>0){
						$("#"+delete_button_id).removeClass("hidden");	
					}else{
						$("#"+delete_button_id).addClass("hidden");
					}
				}
				
				function remove_selected_rows(tbl_id,action_btn_id,checkbox_class){
					var elem = $("#"+tbl_id+" tbody");
					
					$("."+checkbox_class).each(function(){
						if($(this).is(":checked")){
							if(elem.children().length > 1){
								$(this).closest("tr").remove();//Replaced .parent().parent() to .closest()
							}else{
								alert("You need atleast one row in the table");
								
								//Uncheck the check box of the first row
								$("#"+tbl_id+" tbody").find("tr:eq(0) td:eq("+td_hosting_checkbox_postion+")").children().prop("checked",false);
							}
						}
						
						var checked = $(".check:checked").length;
						if(checked>0){
							$("#"+action_btn_id).removeClass("hidden");	
						}else{
							$("#"+action_btn_id).addClass("hidden");
						}
					});		
				}
					//Remove the red color on required field input fields
					$("[required=required],.required").on("change",function(ev){
						if($.trim($(this).val()).length>0)
						{
						 $(this).css("border","1px solid gray");	
						}
					
					});
									
					$("#btnCreate").on("click",function(ev){
						
						var required_fields=$("[required=required],.required");
						
						if(required_fields.length>0){
							var counter=0;
							required_fields.each(function(index,element)
							{
								if($(element).val().length==0)
								{
								 
								 $(element).css("border","1px solid red");
								 counter++;
								 	
								}
															
							});
							if(counter>0) return false;
							
						}
						
						
						var go_back_on_post = true;
						var go_back_after_post = "' . $this -> get_go_back_on_post() . '";
						
						if(go_back_after_post !== "1"){
							go_back_on_post = false;
						}
								
						var url = $("#' . $this -> form_id . '").attr("action");
						var data = $("#' . $this -> form_id . '").serializeArray();

						$.ajax({
							url:url,
							data:data,
							type:"POST",
							beforeSend:function(){
								$("#overlay").css("display","block");
							},
							success:function(resp){
								//alert(resp);
								
								if(go_back_on_post && resp){
									go_back();
								}
								if((go_back_on_post && !resp)||(!go_back_on_post && !resp)){
									$("#overlay").css("display","none");
									alert("Data was not saved");
								}
								if(!go_back_on_post && resp){
									$("#overlay").css("display","none");
									alert("Data saved successfully");
								}
								
								
								
								
							},
							error:function(){
								alert("Error Occurred");
							}
						});
						
						ev.preventDefault();
					});
				
		</script>';

		return $output_string;
	}

	private function style_script() {
		$output_string = '<style>
				#overlay {
				    position: fixed; /* Sit on top of the page content */
				    display: none; /* Hidden by default */
				    width: 100%; /* Full width (cover the whole page) */
				    height: 100%; /* Full height (cover the whole page) */
				    top: 0; 
				    left: 0;
				    right: 0;
				    bottom: 0;
				    background-color: rgba(0,0,0,0.5); /* Black background with opacity */
				    z-index: 2; /* Specify a stack order in case you\'re using a different order for other elements */
				    cursor: pointer; /* Add a pointer on hover */
				}
				
				#overlay img{
					display: block;
					margin-top:25%;
					margin-left: auto;
				    margin-right: auto;
				} 
				</style>';

		$output_string .= '<div id="overlay"><img src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif"/></div>';

		return $output_string;
	}

	function set_debug_mode($debug_mode = "") {
		//If 1, debug =source_page and 2 means debug database_results
		$this -> debug_mode = $debug_mode;
	}

	private function get_debug_mode() {
		return $this -> debug_mode;
	}

	private $internal_debug = '';

	public function set_internal_debug($internal_debug) {
		$this -> internal_debug = $internal_debug;
	}

	private function internal_debug() {
		return json_encode($this -> internal_debug);
	}

	function show_debug_mode() {

		$this -> get_debug_mode();

		$return_string = "<pre><u>Database Debug:</u><br/>";

		if ($this -> debug_mode == 1) {
			$return_string .= htmlentities($this -> form_output_string);
		} elseif ($this -> debug_mode == 2) {
			$return_string .= json_encode($this -> db_results());
		}
		if ($this -> internal_debug != '') {
			$return_string .= '<br/><br/><u>Internal Debug:</u><br>';
			$return_string .= $this -> internal_debug();
		}
		$return_string .= "</pre>";

		return $return_string;
	}

	function set_panel_title($panel_title) {
		$this -> panel_title = $panel_title;
	}

	function set_db_table($db_table = "") {
		$this -> db_table = $db_table;
	}

	function set_data_limit($offset, $count) {
		$this -> data_limit = array('offset' => $offset, 'count' => $count);
	}

	private $where = array();

	private $add_url = "#";
	private $view_url = "#";
	private $edit_url = "#";
	private $delete_url = "#";

	private $list_action = array();

	function set_list_action($action) {
		$this -> list_action = $action;
	}

	private function get_list_action() {
		return $this -> list_action;
	}

	function set_where_clause($where) {
		$this -> where = array_merge($this -> where, $where);
	}

	private function get_where_clause() {
		return $this -> where;
	}

	private $join = array();

	public function set_table_join($join_array) {
		$this -> join = $join_array;
	}

	private function get_table_join() {
		return $this -> join;
	}

	private $fields_to_show = array();
	//Show on listing table

	private $fields_to_show_on_view = array();
	//Show on View form

	private $fields_to_show_on_edit = array();
	// Show on Edit form

	private $fields_to_show_on_add = array();
	//Show on Add form

	public function set_fields_to_show($fields_to_show) {
		$this -> fields_to_show = $fields_to_show;
	}

	public function set_fields_to_show_on_add($fields_to_show_on_add) {
		$this -> fields_to_show_on_add = $fields_to_show_on_add;
	}

	public function set_fields_to_show_on_edit($fields_to_show_on_edit) {
		$this -> fields_to_show_on_edit = $fields_to_show_on_edit;
	}

	public function set_fields_to_show_on_view($fields_to_show_on_view) {
		$this -> fields_to_show_on_view = $fields_to_show_on_view;
	}

	private $display_as = array();

	public function set_display_as($display_as) {
		$this -> display_as = $display_as;
	}

	private function db_results() {

		$to_show = 'fields_to_show';

		if ($this -> CI -> uri -> segment(3)) {
			$to_show = $to_show . '_on_' . $this -> CI -> uri -> segment(3);
		}

		if (!empty($this -> $to_show)) {

			//Used to bring the primary key field

			if (!in_array($this -> _get_primary_key_field(), $this -> $to_show)) {
				$this -> CI -> db -> select($this -> _get_primary_key_field());
			}

			$this -> CI -> db -> select($this -> $to_show);
		}

		if ($this -> CI -> uri -> segment(4)) {
			$this -> set_where_clause(array($this -> _get_primary_key_field() => $this -> CI -> uri -> segment(4)));
		}

		if (is_array($this -> where) && !empty($this -> where)) {
			$this -> CI -> db -> where($this -> where);
		}

		if (is_array($this -> join) && !empty($this -> join)) {

			foreach ($this->join as $secondary_table => $join_keys) {
				if (substr_count($join_keys[1], '.') > 0 && substr_count($join_keys[0], '.') > 0) {
					$this -> CI -> db -> join($secondary_table, $join_keys[1] . "=" . $join_keys[0]);
				} elseif (substr_count($join_keys[1], '.') == 0 && substr_count($join_keys[0], '.') == 0) {
					$this -> CI -> db -> join($secondary_table, $secondary_table . '.' . $join_keys[1] . "=" . $this -> db_table . '.' . $join_keys[0]);
				}

			}
		}

		if (!empty($this -> data_limit)) {
			$this -> CI -> db -> limit($this -> data_limit['offset'], $this -> data_limit['count']);
		}

		$results = $this -> CI -> db -> get($this -> db_table) -> result_array();

		return $results;
	}

	private function assign_primary_key_as_row_keys_for_db_results() {
		$db_result = $this -> db_results();

		$rows_with_primary_key_as_key = array();

		foreach ($db_result as $row) {
			$primary_key = $row['user_id'];
			unset($row['user_id']);
			$rows_with_primary_key_as_key[$primary_key] = $row;
		}

		return $rows_with_primary_key_as_key;
	}

	private $dropdown_element_type = array();

	public function set_dropdown_element_type($dropdown_element_type = array()) {
		$this -> dropdown_element_type[] = $dropdown_element_type;
	}

	public function set_dropdown_yes_no($field_name) {

		$yes_nos = array('No', 'Yes');

		$yes_no_options = array();

		foreach ($yes_nos as $key => $yes_no) {
			$yes_no_options[$key]['option'] = $yes_no;
		}

		$dropdown_element_type = array($field_name, $yes_no_options);

		$this -> dropdown_element_type = $dropdown_element_type;
	}

	public function set_dropdown_from_range($field_name_and_range_array) {

		$range = range(0, $field_name_and_range_array[1]);

		if (isset($field_name_and_range_array[2])) {
			$range = range($field_name_and_range_array[2], $field_name_and_range_array[1]);
		}

		$range_options = array();

		foreach ($range as $key => $value) {
			$range_options[$key]['option'] = $value;
		}

		$dropdown_element_type = array($field_name_and_range_array[0], $range_options);

		$this -> dropdown_element_type[] = $dropdown_element_type;
	}

	public function set_dropdown_from_table($table_details = array()) {

		$db_result = $this -> db_results();

		$record = $db_result[0];

		/*
		 $table_details has 3 aurguments: table name key 0; field holding key of key=1;
		 fields with option text key =2 ; select field_name which key=3*/

		$table_name = $table_details[0];
		$option_field_key = $table_details[1];
		$option_field_text = $table_details[2];
		$select_field_name = $table_details[3];

		$options_from_table = $this -> CI -> db -> get($table_name) -> result_object();

		$options_array = array();

		foreach ($options_from_table as $option) {
			$options_array[$option -> $option_field_key] = array('option' => $option -> $option_field_text);

			if ($option -> $option_field_text == $record[$option_field_text]) {
				$options_array[$option -> $option_field_key]['properties'] = array('selected' => 'selected');
			}
		}

		$dropdown_element_type = array($select_field_name, $options_array);

		$this -> dropdown_element_type = $dropdown_element_type;

	}

	public function get_dropdown_element_type() {
		return $this -> dropdown_element_type;
	}

	private function create_single_column_view_form() {
		if ($this -> form_output_string !== "")
			$this -> form_output_string = "";

		$this -> view_or_edit_mode = 'view';

		//$this->set_where_clause(array($this->_get_primary_key_field()=>$this->CI->uri->segment(4)));

		$db_result = $this -> db_results();

		$this -> fields = $this -> _get_fields_names_from_table_result();

		$this -> panel_title = $this -> panel_title == "" ? get_phrase($this -> db_table) . ' ' . get_phrase('add') : $this -> panel_title;

		$output_string = $this -> open_panel();

		$output_string .= $this -> form_open_tag();

		$output_string .= "<div class='row'><div class='col-xs-12'><ul class='nav nav-pills'>
							<li>
								<a id='btnBack' onclick='go_back();' class='btn btn-default'><i class='fa fa-arrow-left'></i> " . get_phrase('back') . "</a>		
							</li>
										
						</ul></div></div>";

		foreach ($this->fields as $fields) {

			$output_string .= "<div class='form-group'>
				<label class='control-label col-xs-4'>" . get_phrase($fields) . " <i style='cursor:pointer;' title='" . get_tooltip($fields) . "' class='fa fa-question-circle'></i></label>
				<div class='col-xs-8'>";

			$output_string .= "<div class='col-xs-8'>";

			//$output_string .= $this->_get_add_field_input_type($fields);

			$element = array('label' => $fields, 'element' => 'div', 'properties' => array('class' => '', 'name' => $fields, 'innerHTML' => $db_result[0][$fields]));

			$output_string .= $this -> create_closed_html_tag($element);

			$output_string .= "</div>";

			$output_string .= "</div>
			</div>";
		}

		$output_string .= $this -> form_close_tag();

		$output_string .= $this -> close_panel();

		//$this->set_internal_debug($this->db_results());

		if ($this -> debug_mode != 0) {
			$output_string .= $this -> show_debug_mode();
		}

		return $this -> form_output_string = $output_string;
	}

	private function create_single_column_edit_form() {
		if ($this -> form_output_string !== "")
			$this -> form_output_string = "";

		$this -> view_or_edit_mode = 'edit';

		//$this->set_where_clause(array($this->_get_primary_key_field()=>$this->CI->uri->segment(4)));

		$db_result = $this -> db_results();

		$this -> fields = $this -> _get_fields_names_from_table_result();

		$this -> panel_title = $this -> panel_title == "" ? get_phrase($this -> db_table) . ' ' . get_phrase('edit') : $this -> panel_title;

		$output_string = $this -> open_panel();

		$output_string .= $this -> form_open_tag();

		$output_string .= "<div class='row'><div class='col-xs-12'><ul class='nav nav-pills'>
							<li>
								<a id='btnBack' onclick='go_back();' class='btn btn-default'><i class='fa fa-arrow-left'></i> " . get_phrase('back') . "</a>		
							</li>
										
						</ul></div></div>";

		foreach ($this->fields as $fields) {

			$output_string .= "<div class='form-group'>
				<label class='control-label col-xs-4'>" . get_phrase($fields) . " <i style='cursor:pointer;' title='" . get_tooltip($fields) . "' class='fa fa-question-circle'></i></label>
				<div class='col-xs-8'>";

			$output_string .= "<div class='col-xs-8'>";

			$output_string .= $this -> _get_add_field_input_type($fields, $db_result[0][$fields]);

			$output_string .= "</div>";

			$output_string .= "</div>
			</div>";
		}

		$output_string .= $this -> form_close_tag();

		$output_string .= $this -> close_panel();

		//$this->set_internal_debug($this->db_results());

		if ($this -> debug_mode != 0) {
			$output_string .= $this -> show_debug_mode();
		}
		
		$output_string .= $this -> jquery_script();

		$output_string .= $this -> style_script();

		return $this -> form_output_string = $output_string;
	}

	private $extra_list_action = array();

	function set_extra_list_action($extra_action) {
		$this -> extra_list_action = $extra_action;
	}

	private function get_extra_list_action() {
		$this -> extra_list_action;
	}

	private function additional_list_action($primary_key) {
		$this -> get_extra_list_action();

		$output = "";

		if (!empty($this -> extra_list_action)) {
			foreach ($this->extra_list_action as $row) {
				$output .= "
					<li>
						<a href='" . base_url() . "index.php/" . $row['href'] . '/' . $primary_key . '/' . "'>
							<i class='fa fa-" . $row['icon'] . "'></i>
								" . $row['label'] . "
						</a>
					</li>
					<li class='divider'></li>
				";
			}
		}

		return $output;
	}

	private $add_form = true;

	function unset_add_button() {
		$this -> add_form = false;
	}

	private $view_or_edit_mode = 'view';

	public function set_view_or_edit_mode($view_or_edit_mode) {
		$this -> view_or_edit_mode = $view_or_edit_mode;
	}

	private function get_view_or_edit_mode() {
		return $this -> view_or_edit_mode;
	}

	private $hidden_fields = array();

	function set_hidden_fields($hidden_fields) {
		$this -> hidden_fields = $hidden_fields;
	}

	private function get_hidden_fields() {
		return $this -> hidden_fields;
	}

	private $hide_delete_button = false;

	function set_hide_delete_button($hide_delete_button) {
		$this -> hide_delete_button = $hide_delete_button;
	}

	private function get_hide_delete_button() {
		return $this -> hide_delete_button;
	}

	private function _get_primary_key_field($table_name = "") {

		if ($table_name == "") {
			$table_name = $this -> db_table;
		}

		$field_data = $this -> CI -> db -> field_data($table_name);

		$fields = array_column($field_data, 'name');
		$primary_key_field = array_column($field_data, 'primary_key');

		$primary_key_field_name = array_combine($primary_key_field, $fields);

		return $primary_key_field_name[1];
	}

	function _get_fields_names_from_table_result() {

		$this -> set_data_limit(1, 0);
		$db_result = $this -> db_results();

		$fields = $db_result[0];

		unset($fields[$this -> _get_primary_key_field()]);

		return array_keys($fields);
	}

	private $form_type = 'single_column';

	public function set_add_form_type($form_type) {
		$this -> form_type = $form_type;
	}

	private function get_add_form_type() {
		return $this -> form_type;
	}
	
	private $db_transaction_message = "";
	
	private $db_transaction_success_flag = false;
	
	function save_form_data(){
		
		$this->CI->db->trans_start();
		
		$this->CI->db->insert($this->db_table,$this->CI->input->post());
		
		if ($this->CI->db->trans_status() === FALSE)
		{
			        $this->CI->db->trans_rollback();
					
					$this->db_transaction_message = "Error Occurred";
					
					$this->db_transaction_success_flag = false;
		}
		else
		{
			        $this->CI->db->trans_commit();
					
					$this->db_transaction_message = "Data inserted successful";
					
					$this->db_transaction_success_flag = true;
		}
			
	}
	
	private function edit_form_data(){
		$this->CI->db->trans_start();
		
		$this->CI->db->where(array($this->_get_primary_key_field()=>$this->CI->uri->segment(4)));
		
		$this->CI->db->update($this->db_table,$this->CI->input->post());
		
		if ($this->CI->db->trans_status() === FALSE)
		{
			        $this->CI->db->trans_rollback();
					
					$this->db_transaction_message = "Error Occurred";
					
					$this->db_transaction_success_flag = false;
		}
		else
		{
			        $this->CI->db->trans_commit();
					
					$this->db_transaction_message = "Data inserted successful";
					
					$this->db_transaction_success_flag = true;
		}	
	}
	
	private function delete_record_data(){
		$this->CI->db->where(array($this->_get_primary_key_field()=>$this->CI->uri->segment(4)));
		$this->CI->db->delete($this->db_table);
	}
	
	// private function _get_db_transaction_flag(){
		// return $this->db_transaction_success_flag;
	// }
// 	
	// private function _get_db_transaction_message(){
		// return $this->db_transaction_message;
	// }

	function render() {
		
		//$this->_get_db_transaction_flag();
		//$this->_get_db_transaction_message();
		
		//$this -> set_internal_debug($this->db_transaction_message);
		
		$output = "";
		
		if ($this -> form_output_string !== "")
			$this -> form_output_string = "";

		if ($this -> CI -> uri -> segment(3) && !$this->CI->input->post() && $this -> CI -> uri -> segment(3) != 'delete') {
			
				if ($this -> CI -> uri -> segment(3) == 'view' || $this -> CI -> uri -> segment(3) == 'edit') {
				$this -> form_type = 'single_column';
				}
	
				$form = "create_" . $this -> form_type . "_" . $this -> CI -> uri -> segment(3) . "_form";
	
				return $this -> $form();
			
		} elseif($this->CI->input->post() && $this -> CI -> uri -> segment(3) == 'add'){
				
			$this->save_form_data();
			
			redirect(base_url() . 'index.php/'.$this->CI->router-> fetch_class().'/'.$this->CI->router-> fetch_method());		
						
		}elseif($this->CI->input->post() && $this -> CI -> uri -> segment(3) == 'edit'){
				
			$this->edit_form_data();
			
			redirect(base_url() . 'index.php/'.$this->CI->router-> fetch_class().'/'.$this->CI->router-> fetch_method());		
		
		}elseif($this -> CI -> uri -> segment(3) == 'delete'){
				
			$this->delete_record_data();
			
			redirect(base_url() . 'index.php/'.$this->CI->router-> fetch_class().'/'.$this->CI->router-> fetch_method());		
		}

		$list_array = $this -> assign_primary_key_as_row_keys_for_db_results();

		$output .= $this -> open_panel();
		if ($this -> add_form) {
			$output .= "
						<div class='row'>
							<div class='col-xs-12'>									
									<ul class='nav nav-pills'>
										<li>
											<a href='" . base_url() . "index.php/" . $this -> CI -> router -> fetch_class() . "/" . $this -> CI -> router -> fetch_method() . "/add' class='btn btn-default'> " . get_phrase('add_new_record') . " 
												<i class='fa fa-plus'></i></a>
										</li>
										<li>
											<a id='btnBack' onclick='go_back();' class='btn btn-default'><i class='fa fa-arrow-left'></i> " . get_phrase('back') . "</a>		
										</li>
										
									</ul>
							</div>	
						</div>	
					<hr/>	
			";
		}
		
		if($this->db_transaction_success_flag){
			$output .= "<div class='row' id='save_message'><div class='col-xs-12' style='text-align:center;color:red;'>".$this->db_transaction_message."<hr/></div></div>";
		}
		
		$output .= "
				<div class='row'>
						<div class='col-xs-12'>
							<table class='table datatable'>
								<thead><tr><th class=''>" . get_phrase('action') . "</th>";

		foreach ($this->_get_fields_names_from_table_result() as $value) {

			if (!empty($this -> display_as)) {
				if (array_key_exists($value, $this -> display_as)) {
					$value = $this -> display_as[$value];
				}
			}

			$output .= "<th>" . get_phrase($value) . " <i style='cursor:pointer;' title='" . get_tooltip($value) . "' class='fa fa-question-circle'></i></th>";

		}
		$output .= "</tr></thead><tbody>";
		foreach ($list_array as $primary_key => $row) {

			$output .= "<tr>";
			$output .= "<td>
										
						<div class='btn-group left-dropdown'>
											
												<a class='btn btn-default' href='#'>Action</a>
												
												<button type='button' class='btn btn-default dropdown-toggle' 
												data-toggle='dropdown'>
													<span class='caret'></span>
												</button>
												
												<ul class='dropdown-menu' role='menu'>
													
													<li>
														<a href='" . base_url() . "index.php/" . $this -> CI -> router -> fetch_class() . "/" . $this -> CI -> router -> fetch_method() . "/view/" . $primary_key . "'> <i class='fa fa-eye'></i> " . get_phrase('view') . " 
															
														</a>
													</li>
													<li class='divider'></li>
													
													<li>
														<a href='" . base_url() . "index.php/" . $this -> CI -> router -> fetch_class() . "/" . $this -> CI -> router -> fetch_method() . "/edit/" . $primary_key . "'> <i class='fa fa-pencil'></i> " . get_phrase('edit') . " 
															
														</a>
													</li>
													<li class='divider'></li>";
			if (!$this -> hide_delete_button) {

				$output .= "<li>
													
														<a href='" . base_url() . "index.php/" . $this -> CI -> router -> fetch_class() . "/" . $this -> CI -> router -> fetch_method() . "/delete/" . $primary_key . "'> <i class='fa fa-times'></i> " . get_phrase('delete') . " 
															
														</a>
													</li>
													<li class='divider'></li>";
			}
			$output .= $this -> additional_list_action($primary_key);
			$output .= "</ul>
											</div>		
								
						</td>";

			foreach ($row as $key => $td_value) {

				$output .= "<td>" . $td_value . "</td>";

			}
			$output .= "</tr>";
		}
		$output .= "</tbody>
							</table>
						</div>
				</div>				
		";
		$output .= $this -> close_panel();

		$output .= $this -> use_datatable();

		if ($this -> debug_mode != 0) {
			$output .= $this -> show_debug_mode();
		}

		$output .= $this -> jquery_script();

		$output .= $this -> style_script();

		return $this -> form_output_string = $output;
	}

	function set_use_datatable($use_datatable) {
		$this -> use_datatable = $use_datatable;
	}

	private function get_use_datatable() {
		return $this -> use_datatable;
	}

	private function use_datatable() {
		$this -> get_use_datatable();

		$output = "";

		if ($this -> use_datatable) {
			$output .= "
				<script>
					$(document).ready(function(){
						$('.datatable').DataTable(
								{
									dom: 'Bfrtip',
									buttons: [
						            	'copy', 'csv', 'excel', 'pdf', 'print'
						        	],
									'ordering': true,
								    'stateSave': true,
								    'scrollX': false
								 }
						);
					});
					
				</script>		
			";
		}

		return $output;
	}

}
