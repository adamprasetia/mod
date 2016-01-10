<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_event_model extends CI_Model {
	private $tbl_name = 'user_event';
	private $tbl_key = 'id';
	function query(){
		$data[] = $this->db->select(array(
			'user_event.id as id',
			'user.kode as user_kode',
			'user.nama as user',
			'user.level as user_level',
			'event.nama as event'
		));
		$data[] = $this->db->join('user','user_event.user=user.kode','left');
		$data[] = $this->db->join('event','user_event.event=event.kode','left');
		$data[] = $this->search();
		$data[] = $this->where('user');
		$data[] = $this->where('event');		
		$data[] = $this->db->order_by($this->general->get_order_column(),$this->general->get_order_type());
		$data[] = $this->db->offset($this->general->get_offset());
		return $data;
	}
	function get(){
		$this->query();
		$this->db->limit($this->general->get_limit());
		return $this->db->get($this->tbl_name);
	}
	function get_user_all(){
		$this->query();
		return $this->db->get($this->tbl_name);
	}
	function get_user_month(){
		$this->query();
		$this->db->where('user.level','MS');
		return $this->db->get($this->tbl_name);
	}
	function get_user_week(){
		$this->query();
		$this->db->where('user.level','MJ');
		return $this->db->get($this->tbl_name);
	}
	function get_from_field($field,$value){
		$this->db->where($field,$value);
		return $this->db->get($this->tbl_name);	
	}
	function add($data){
		$this->db->insert($this->tbl_name,$data);
	}
	function edit($id,$data){
		$this->db->where($this->tbl_key,$id);
		$this->db->update($this->tbl_name,$data);
	}
	function delete($id){
		$this->db->where($this->tbl_key,$id);
		$this->db->delete($this->tbl_name);
	}
	function count_all(){
		$this->query();
		return $this->db->get($this->tbl_name)->num_rows();
	}
	function search(){
		$result = $this->input->get('search');
		if($result <> ''){
			return $this->db->where('(user.nama like "%'.$result.'%" or event.nama like "%'.$result.'%")');
		}		
	}
	function where($field){
		$result = $this->input->get($field);
		if($result <> ''){
			return $this->db->where($field,$result);
		}		
	}
}