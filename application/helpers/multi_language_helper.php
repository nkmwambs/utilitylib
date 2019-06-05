<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */


if ( ! function_exists('get_phrase'))
{
	function get_phrase($phrase = '') {
		
		return ucwords(str_replace('_',' ',$phrase));
	}
}

if ( ! function_exists('get_tooltip'))
{
	function get_tooltip($phrase){
		$CI	=&	get_instance();
		$CI->load->database();
		$tooltip_obj=$CI->db->get_where('language',array('phrase'=>$phrase));
		if($tooltip_obj->num_rows()>0)
		{
			return $tooltip_obj->row()->tooltip;
		}
		else{
			return '';
		}
		
	}
}

// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */