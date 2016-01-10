<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Price_model extends CI_Model {
	private $tbl_name = 'price';
	private $tbl_key = 'id';
	function query(){
		$data[] = $this->db->select(array(
			'price.id as id',
			'price.jumlah as jumlah',
			'event.nama as event',
			'shift.nama as shift',
			'user_level.nama as level'
		));
		$data[] = $this->db->join('event','price.event=event.kode','left');
		$data[] = $this->db->join('shift','price.shift=shift.kode','left');
		$data[] = $this->db->join('user_level','price.level=user_level.kode','left');
		$data[] = $this->search();
		$data[] = $this->where('event');
		$data[] = $this->where('shift');		
		$data[] = $this->where('level');		
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
			return $this->db->where('(jumlah like "%'.$result.'%")');
		}		
	}
	function where($field){
		$result = $this->input->get($field);
		if($result <> ''){
			return $this->db->where($field,$result);
		}		
	}
	function get_price($event,$shift,$level){
		$this->db->where('event',$event);
		$this->db->where('shift',$shift);
		$this->db->where('level',$level);
		$result = $this->db->get($this->tbl_name);
		if($result->num_rows() > 0){
			return $result->row()->jumlah;
		}
		return 0;
	}	
}