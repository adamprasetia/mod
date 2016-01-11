<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('master/master_model');
		$this->load->model('user_model');
	}
	public function index(){
		$offset = $this->general->get_offset();
		$limit = $this->general->get_limit();
		$total = $this->user_model->count_all();

		$xdata['action'] = 'user/search'.get_query_string();
		$xdata['action_delete'] = 'user/delete'.get_query_string();
		$xdata['add_btn'] = anchor('user/add','<span class="glyphicon glyphicon-plus"></span> Tambah',array('class'=>'btn btn-success btn-sm'));
		$xdata['delete_btn'] = '<button id="delete-btn" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete Checked</button>';

		$this->table->set_template(tbl_tmp());
		$head_data = array(
			'kode'=>'Kode'
			,'nama'=>'Fullname'
			,'level_nama'=>'Level'
			,'ip_login'=>'IP'
			,'user_agent'=>'User Agent'
			,'date_login'=>'Date'
			,'status_nama'=>'Status'
		);
		$heading[] = form_checkbox(array('id'=>'selectAll','value'=>1));
		$heading[] = '#';
		foreach($head_data as $r => $value){
			$heading[] = anchor('user'.get_query_string(array('order_column'=>"$r",'order_type'=>$this->general->order_type($r))),"$value ".$this->general->order_icon("$r"));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->user_model->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				array('data'=>form_checkbox(array('name'=>'check[]','value'=>$r->id)),'width'=>'10px'),
				$i++,
				anchor('user/edit/'.$r->id.get_query_string(),$r->kode),
				array('data'=>img(array('src'=>get_user_photo($r->photo),'class'=>'img-circle img-table')).' '.$r->nama,'width'=>'200'),
				$r->level_nama,
				$r->ip_login,
				$r->user_agent,
				$r->date_login,			
				'<label class="label label-'.($r->status_kode=='ON'?'success':'danger').'">'.$r->status_nama.'</label>',
				anchor('user/edit/'.$r->id.get_query_string(),'Edit')
				."&nbsp;|&nbsp;".anchor('user/delete/'.$r->id.get_query_string(),'Delete',array('onclick'=>"return confirm('you sure')"))
				."&nbsp;|&nbsp;".anchor('user_event?user='.$r->kode,'Event')
			);
		}
		$xdata['table'] = $this->table->generate();
		$xdata['total'] = page_total($offset,$limit,$total);
		
		$config = pag_tmp();
		$config['base_url'] = "user".get_query_string(null,'offset');
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config); 
		$xdata['pagination'] = $this->pagination->create_links();

		$data['content'] = $this->load->view('user_list',$xdata,true);
		$this->load->view('template',$data);
	}
	public function search(){
		$data = array(
			'search'=>$this->input->post('search'),
			'limit'=>$this->input->post('limit'),
			'level'=>$this->input->post('level'),
			'status'=>$this->input->post('status')
		);
		redirect('user'.get_query_string($data));		
	}
	private function _field(){
		$data = array(
			'kode'=>$this->input->post('kode'),
			'nama'=>$this->input->post('nama'),
			'nickname'=>$this->input->post('nickname'),
			'username'=>$this->input->post('username'),
			'password'=>$this->input->post('password'),
			'level'=>$this->input->post('level'),
			'status'=>$this->input->post('status')
		);
		return $data;		
	}
	private function _set_rules(){
		$this->form_validation->set_rules('kode','Kode','required|trim');
		$this->form_validation->set_rules('nama','Fullname','required|trim');
		$this->form_validation->set_rules('nickname','Nickname','required|trim');
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');
	}
	public function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$xdata['action'] = 'user/add'.get_query_string();
			$xdata['breadcrumb'] = 'user'.get_query_string();
			$xdata['heading'] = 'New';
			$xdata['owner'] = '';
			$data['content'] = $this->load->view('user_form',$xdata,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$result = $this->_upload_image();
			if($result <> false){
				$data['user_create'] = $this->session->userdata('user_login');
				$data['date_create'] = date('Y-m-d H:i:s');
				$data['photo'] = isset($result['file_name'])?$result['file_name']:'';
			}
			$this->user_model->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Tambah Data Sukses</div>');
			redirect('user/add'.get_query_string());
		}
	}
	public function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$xdata['row'] = $this->user_model->get_from_field('id',$id)->row();
			$xdata['action'] = 'user/edit/'.$id.get_query_string();
			$xdata['breadcrumb'] = 'user'.get_query_string();
			$xdata['heading'] = 'Update';
			$xdata['owner'] = owner($xdata['row']);
			$data['content'] = $this->load->view('user_form',$xdata,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$result = $this->_upload_image();
			if($result <> false){
				$data['user_update'] = $this->session->userdata('user_login');
				$data['date_update'] = date('Y-m-d H:i:s');
				$data['photo'] = isset($result['file_name'])?$result['file_name']:'';
			}
			$this->user_model->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Edit Data Sukses</div>');				
			redirect('user/edit/'.$id.get_query_string());
		}
	}
	public function delete($id=''){
		if($id<>''){
			$this->user_model->delete($id);
		}
		$check = $this->input->post('check');
		if($check<>''){
			foreach($check as $c){
				$this->user_model->delete($c);
			}
		}
		$this->session->set_flashdata('alert','<div class="alert alert-success">Delete Data Sukses</div>');
		redirect('user'.get_query_string());
	}
	private function _upload_image(){
		if (!empty($_FILES['userfile']['name'])){
			$config['upload_path'] = './assets/img/user/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite'] = true;
			$config['encrypt_name'] = true;
			$config['max_size']	= '2000';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload()){
				$this->session->set_flashdata('alert','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				return false;
			}else{
				return $this->upload->data();
			}
		}
		return true;
	}
}