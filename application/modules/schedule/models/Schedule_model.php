<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_model extends CI_Model {
	private $tbl_name = 'schedule';
	private $tbl_key = 'id';
	function query(){
		$data[] = $this->db->select(array(
			'schedule.id as id',
			'schedule.slot as slot',
			'event.nama as event',
			'user.nama as user',
			'shift.nama as shift'
		));
		$data[] = $this->db->join('event','schedule.event=event.kode','left');
		$data[] = $this->db->join('user','schedule.user=user.kode','left');
		$data[] = $this->db->join('shift','schedule.shift=shift.kode','left');
		$data[] = $this->search();
		$data[] = $this->where('event');
		$data[] = $this->where('user');		
		$data[] = $this->where('shift');		
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
			return $this->db->where('(slot = "'.$result.'")');
		}		
	}
	function where($field){
		$result = $this->input->get($field);
		if($result <> ''){
			return $this->db->where($field,$result);
		}		
	}
	function get_schedule($event,$date,$user){
		$date = explode("-",$date);
		$slot = (GregorianToJD($date[1],$date[2],$date[0])%$this->get_length_schedule($event))+1;
		$this->db->where('event',$event);
		$this->db->where('slot',$slot);
		$this->db->where('user',$user);
		$result = $this->db->get($this->tbl_name);
		if($result->num_rows() > 0){
			return $result->row()->shift;
		}
		return '';
	}
	function get_schedule_by_date($event,$date,$shift){
		$date = explode("-",$date);
		$slot = (GregorianToJD($date[1],$date[2],$date[0])%$this->get_length_schedule($event))+1;
		$this->db->select(array(
			'user.nickname as nickname'
		));
		$this->db->where('event',$event);
		$this->db->where('slot',$slot);
		$this->db->where('shift',$shift);
		$this->db->join('user','schedule.user=user.kode','left');
		$this->db->order_by('user','asc');
		$result = $this->db->get($this->tbl_name)->result();
		$data = '';
		foreach($result as $r){
			$data .= '<div>'.$r->nickname.'</div>';
		}
		return $data;
	}
	function get_length_schedule($event){
		$this->db->where('event',$event);
		$this->db->limit(1);
		$this->db->order_by('slot','desc');
		$result = $this->db->get($this->tbl_name);
		if($result->num_rows() > 0){
			return $result->row()->slot;
		}
		return 1;
	}
}