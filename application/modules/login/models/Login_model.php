<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	private $tabel_name = 'user';
	private $tabel_key = 'id';
	function get_user_detail($username){
		$this->db->select(array('password','status'));
		$this->db->where('username',$username);
		return $this->db->get($this->tabel_name);
	}
	function set_date_login($id){
		$browser = get_browsers();
		$data = array(
			'ip_login'=>$_SERVER['REMOTE_ADDR']
			,'user_agent'=>$browser['platform']."(".$browser['name']." ".$browser['version'].")"
			,'date_login'=>date('Y-m-d H:i:s')
		);
		$this->db->where($this->tabel_key,$id);
		$this->db->update($this->tabel_name,$data);
	}	
}