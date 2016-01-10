<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model {
	private $tbl_name = 'event';
	private $tbl_key = 'id';
	function query(){
		$data[] = $this->db->select(array(
			'event.*',
			'event_tipe.nama as tipe_name',
			'event_status.nama as status_name'
		));
		$data[] = $this->db->join('event_tipe','event.tipe=event_tipe.kode','left');
		$data[] = $this->db->join('event_status','event.status=event_status.kode','left');
		$data[] = $this->search();
		$data[] = $this->where('tipe');
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
			return $this->db->where('(event.nama like "%'.$result.'%"');
		}		
	}
	function where($field){
		$result = $this->input->get($field);
		if($result <> ''){
			return $this->db->where($field,$result);
		}		
	}
	function get_event_name($kode){
		$this->db->where('kode',$kode);
		$result = $this->db->get($this->tbl_name);	
		if($result->num_rows() > 0){
			return $result->row()->nama;
		}
		return '';

	}
}