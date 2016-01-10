<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('master/master_model');
		$this->load->model('event_model');
	}
	public function index(){
		$offset = $this->general->get_offset();
		$limit = $this->general->get_limit();
		$total = $this->event_model->count_all();

		$xdata['action'] = 'event/search'.get_query_string();
		$xdata['action_delete'] = 'event/delete'.get_query_string();
		$xdata['add_btn'] = anchor('event/add','<span class="glyphicon glyphicon-plus"></span> Tambah',array('class'=>'btn btn-success btn-sm'));
		$xdata['delete_btn'] = '<button id="delete-btn" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete Checked</button>';

		$this->table->set_template(tbl_tmp());
		$head_data = array(
			'kode'=>'Kode',
			'nama'=>'Event Name',
			'tipe_name'=>'Tipe',
			'status_name'=>'Status'
		);
		$heading[] = form_checkbox(array('id'=>'selectAll','value'=>1));
		$heading[] = '#';
		foreach($head_data as $r => $value){
			$heading[] = anchor('event'.get_query_string(array('order_column'=>"$r",'order_type'=>$this->general->order_type($r))),"$value ".$this->general->order_icon("$r"));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->event_model->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				array('data'=>form_checkbox(array('name'=>'check[]','value'=>$r->id)),'width'=>'10px'),
				$i++,
				anchor('event/edit/'.$r->id.get_query_string(),$r->kode),
				$r->nama,
				$r->tipe_name,
				$r->status_name,
				anchor('event/edit/'.$r->id.get_query_string(),'Edit')
				."&nbsp;|&nbsp;".anchor('event/delete/'.$r->id.get_query_string(),'Delete',array('onclick'=>"return confirm('you sure')"))
				."&nbsp;|&nbsp;".anchor('user_event?event='.$r->kode,'User')
			);
		}
		$xdata['table'] = $this->table->generate();
		$xdata['total'] = page_total($offset,$limit,$total);
		
		$config = pag_tmp();
		$config['base_url'] = "event".get_query_string(null,'offset');
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config); 
		$xdata['pagination'] = $this->pagination->create_links();

		$data['content'] = $this->load->view('event_list',$xdata,true);
		$this->load->view('template',$data);
	}
	public function search(){
		$data = array(
			'search'=>$this->input->post('search'),
			'limit'=>$this->input->post('limit'),
			'tipe'=>$this->input->post('tipe'),
			'status'=>$this->input->post('status')
		);
		redirect('event'.get_query_string($data));
	}
	private function _field(){
		$data = array(
			'kode'=>$this->input->post('kode'),
			'nama'=>$this->input->post('nama'),
			'tipe'=>$this->input->post('tipe'),
			'status'=>$this->input->post('status')
		);
		return $data;		
	}
	private function _set_rules(){
		$this->form_validation->set_rules('kode','Kode','required|trim');
		$this->form_validation->set_rules('nama','Event Name','required|trim');
		$this->form_validation->set_rules('tipe','Tipe','required|trim');
		$this->form_validation->set_rules('status','Status','required|trim');
	}
	public function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$xdata['action'] = 'event/add'.get_query_string();
			$xdata['breadcrumb'] = 'event'.get_query_string();
			$xdata['heading'] = 'New';
			$xdata['owner'] = '';
			$data['content'] = $this->load->view('event_form',$xdata,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_create'] = $this->session->userdata('user_login');
			$data['date_create'] = date('Y-m-d H:i:s');
			$this->event_model->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Tambah Data Sukses</div>');
			redirect('event/add'.get_query_string());
		}
	}
	public function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$xdata['row'] = $this->event_model->get_from_field('id',$id)->row();
			$xdata['action'] = 'event/edit/'.$id.get_query_string();
			$xdata['breadcrumb'] = 'event'.get_query_string();
			$xdata['heading'] = 'Update';
			$xdata['owner'] = owner($xdata['row']);
			$data['content'] = $this->load->view('event_form',$xdata,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_update'] = $this->session->userdata('user_login');
			$data['date_update'] = date('Y-m-d H:i:s');
			$this->event_model->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Edit Data Sukses</div>');				
			redirect('event/edit/'.$id.get_query_string());
		}
	}
	public function delete($id=''){
		if($id<>''){
			$this->event_model->delete($id);
		}
		$check = $this->input->post('check');
		if($check<>''){
			foreach($check as $c){
				$this->event_model->delete($c);
			}
		}
		$this->session->set_flashdata('alert','<div class="alert alert-success">Delete Data Sukses</div>');
		redirect('event'.get_query_string());
	}
}