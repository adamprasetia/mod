<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_event extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('master/master_model');
		$this->load->model('user_event_model');
	}
	public function index(){
		$offset = $this->general->get_offset();
		$limit = $this->general->get_limit();
		$total = $this->user_event_model->count_all();

		$xdata['action'] = 'user_event/search'.get_query_string();
		$xdata['action_delete'] = 'user_event/delete'.get_query_string();
		$xdata['add_btn'] = anchor('user_event/add','<span class="glyphicon glyphicon-plus"></span> Tambah',array('class'=>'btn btn-success btn-sm'));
		$xdata['delete_btn'] = '<button id="delete-btn" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete Checked</button>';

		$this->table->set_template(tbl_tmp());
		$head_data = array(
			'user'=>'User',
			'event'=>'Event'
		);
		$heading[] = form_checkbox(array('id'=>'selectAll','value'=>1));
		$heading[] = '#';
		foreach($head_data as $r => $value){
			$heading[] = anchor('user_event'.get_query_string(array('order_column'=>"$r",'order_type'=>$this->general->order_type($r))),"$value ".$this->general->order_icon("$r"));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->user_event_model->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				array('data'=>form_checkbox(array('name'=>'check[]','value'=>$r->id)),'width'=>'10px'),
				$i++,
				$r->user,
				$r->event,
				anchor('user_event/edit/'.$r->id.get_query_string(),'Edit')
				."&nbsp;|&nbsp;".anchor('user_event/delete/'.$r->id.get_query_string(),'Delete',array('onclick'=>"return confirm('you sure')"))
			);
		}
		$xdata['table'] = $this->table->generate();
		$xdata['total'] = page_total($offset,$limit,$total);
		
		$config = pag_tmp();
		$config['base_url'] = "user_event".get_query_string(null,'offset');
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config); 
		$xdata['pagination'] = $this->pagination->create_links();

		$data['content'] = $this->load->view('user_event_list',$xdata,true);
		$this->load->view('template',$data);
	}
	public function search(){
		$data = array(
			'search'=>$this->input->post('search'),
			'limit'=>$this->input->post('limit'),
			'user'=>$this->input->post('user'),
			'event'=>$this->input->post('event')
		);
		redirect('user_event'.get_query_string($data));
	}
	private function _field(){
		$data = array(
			'user'=>$this->input->post('user'),
			'event'=>$this->input->post('event'),
		);
		return $data;		
	}
	private function _set_rules(){
		$this->form_validation->set_rules('user','User','required|trim');
		$this->form_validation->set_rules('event','Event','required|trim');
	}
	public function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$xdata['action'] = 'user_event/add'.get_query_string();
			$xdata['breadcrumb'] = 'user_event'.get_query_string();
			$xdata['heading'] = 'New';
			$xdata['owner'] = '';
			$data['content'] = $this->load->view('user_event_form',$xdata,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_create'] = $this->session->userdata('user_login');
			$data['date_create'] = date('Y-m-d H:i:s');
			$this->user_event_model->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Tambah Data Sukses</div>');
			redirect('user_event/add'.get_query_string());
		}
	}
	public function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$xdata['row'] = $this->user_event_model->get_from_field('id',$id)->row();
			$xdata['action'] = 'user_event/edit/'.$id.get_query_string();
			$xdata['breadcrumb'] = 'user_event'.get_query_string();
			$xdata['heading'] = 'Update';
			$xdata['owner'] = owner($xdata['row']);
			$data['content'] = $this->load->view('user_event_form',$xdata,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_update'] = $this->session->userdata('user_login');
			$data['date_update'] = date('Y-m-d H:i:s');
			$this->user_event_model->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Edit Data Sukses</div>');				
			redirect('user_event/edit/'.$id.get_query_string());
		}
	}
	public function delete($id=''){
		if($id<>''){
			$this->user_event_model->delete($id);
		}
		$check = $this->input->post('check');
		if($check<>''){
			foreach($check as $c){
				$this->user_event_model->delete($c);
			}
		}
		$this->session->set_flashdata('alert','<div class="alert alert-success">Delete Data Sukses</div>');
		redirect('user_event'.get_query_string());
	}
}