<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Absent_model extends CI_Model {
	private $tbl_name = 'absent';
	private $tbl_key = 'id';

	function update($data){
		$this->delete();
		if(count($data) > 0)
		$this->db->insert_batch($this->tbl_name,$data);
	}
	function delete(){
		$date_from = format_ymd($this->input->get("date_from"));
		$date_to = format_ymd($this->input->get("date_to"));
		$event = $this->input->get("event");
		$this->db->where('event',$event);
		$this->db->where('tanggal >= ',$date_from);
		$this->db->where('tanggal <= ',$date_to);
		$this->db->delete($this->tbl_name);
	}
	function get_from_field($field,$value){
		$this->db->where($field,$value);
		return $this->db->get($this->tbl_name);	
	}
	function get_shift($user,$event,$tanggal){
		$this->db->where('user',$user);
		$this->db->where('event',$event);
		$this->db->where('tanggal',$tanggal);
		$result = $this->db->get($this->tbl_name);
		if($result->num_rows() > 0){
			return $result->row()->shift;
		}
		return '';
	}	
	function check_exist($user,$event,$tanggal,$shift){
		$this->db->where('user',$user);
		$this->db->where('event',$event);
		$this->db->where('tanggal',$tanggal);
		$this->db->where('shift',$shift);
		$result = $this->db->get($this->tbl_name);
		if($result->num_rows() > 0){
			return 1;
		}
		return 0;
	}	
	function check_exist_month($user,$event,$tanggal){
		$this->db->where('user',$user);
		$this->db->where('event',$event);
		$this->db->where('tanggal',$tanggal);
		$result = $this->db->get($this->tbl_name);
		if($result->num_rows() > 0){
			return 1;
		}
		return 0;
	}	
}