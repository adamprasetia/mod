<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General{
	protected $ci;
	public function __construct(){
		$this->ci = &get_instance();
	}
	public function get_user_info($field){
		$result = $this->ci->general_model->get_from_field('user','kode',$this->ci->session->userdata('user_login'));
		if($result->num_rows() > 0){
			return $result->row()->$field;
		}
		return "";
	}
	public function get_limit(){
		$result = $this->ci->input->get('limit');
		if($result==''){
			$data = 10;
		}else{
			$data = $result;
		}
		return $data;		
	}
	public function get_offset(){
		$result = $this->ci->input->get('offset');
		if($result==''){
			$data = 0;
		}else{
			$data = $result;
		}
		return $data;		
	}
	public function order_type($field){
		$order_column = $this->ci->input->get('order_column');
		$order_type = $this->ci->input->get('order_type');
		if($order_type=='asc' && $order_column==$field){
			return 'desc';	
		}else{
			return 'asc';
		}
	}
	public function order_icon($field){
		$order_column = $this->ci->input->get('order_column');
		$order_type = $this->ci->input->get('order_type');
		if($order_column==$field){
			switch($order_type){
				case 'asc':return '<span class="glyphicon glyphicon-chevron-up"></span>';break;
				case 'desc':return '<span class="glyphicon glyphicon-chevron-down"></span>';break;
				default:return "";break;
			}	
		}		
	}		
	public function get_order_column($field = 'id'){
		$result = $this->ci->input->get('order_column');
		if($result==''){
			$data = $field;
		}else{
			$data = $result;
		}
		return $data;		
	}
	public function get_order_type($id = 'desc'){
		$result = $this->ci->input->get('order_type');
		if($result==''){
			$data = $id;
		}else{
			$data = $result;
		}
		return $data;		
	}	
}
