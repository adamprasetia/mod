<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	private $tbl_name = 'user';
	private $tbl_key = 'id';
	function query(){
		$data[] = $this->db->select(array(
			'user.*',
			'user_level.nama as level_nama',
			'user_status.kode as status_kode',
			'user_status.nama as status_nama'
		));
		$data[] = $this->db->join('user_level','user.level=user_level.kode','left');
		$data[] = $this->db->join('user_status','user.status=user_status.kode','left');
		$data[] = $this->search();
		$data[] = $this->where('level');
		$data[] = $this->where('status');		
		$data[] = $this->db->order_by($this->general->get_order_column(),$this->general->get_order_type());
		$data[] = $this->db->offset($this->general->get_offset());
		return $data;
	}
	function get(){
		$this->query();
		$this->db->limit($this->general->get_limit());
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
	function get_from_field($field,$value){
		$this->db->where($field,$value);
		return $this->db->get($this->tbl_name);	
	}
	function count_all(){
		$this->query();
		return $this->db->get($this->tbl_name)->num_rows();
	}
	function search(){
		$result = $this->input->get('search');
		if($result <> ''){
			return $this->db->where('(nama like "%'.$result.'%" or username like "%'.$result.'%")');
		}		
	}
	function where($field){
		$result = $this->input->get($field);
		if($result <> ''){
			return $this->db->where($field,$result);
		}		
	}
	function get_level($username){
		$this->db->select('user_level.nama');
		$this->db->join('user_level','user.level=user_level.kode','left');
		$this->db->where('username',$username);
		return $this->db->get($this->tbl_name);
	}
}