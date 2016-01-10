<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Price extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('master/master_model');
		$this->load->model('price_model');
	}
	public function index(){
		$offset = $this->general->get_offset();
		$limit = $this->general->get_limit();
		$total = $this->price_model->count_all();

		$xdata['action'] = 'price/search'.get_query_string();
		$xdata['action_delete'] = 'price/delete'.get_query_string();
		$xdata['add_btn'] = anchor('price/add','<span class="glyphicon glyphicon-plus"></span> Tambah',array('class'=>'btn btn-success btn-sm'));
		$xdata['delete_btn'] = '<button id="delete-btn" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete Checked</button>';

		$this->table->set_template(tbl_tmp());
		$head_data = array(
			'event'=>'Event',
			'shift'=>'Shift',
			'level'=>'Level',
			'jumlah'=>'Jumlah'
		);
		$heading[] = form_checkbox(array('id'=>'selectAll','value'=>1));
		$heading[] = '#';
		foreach($head_data as $r => $value){
			$heading[] = anchor('price'.get_query_string(array('order_column'=>"$r",'order_type'=>$this->general->order_type($r))),"$value ".$this->general->order_icon("$r"));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->price_model->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				array('data'=>form_checkbox(array('name'=>'check[]','value'=>$r->id)),'width'=>'10px'),
				$i++,
				$r->event,
				$r->shift,
				$r->level,
				number_format($r->jumlah),
				anchor('price/edit/'.$r->id.get_query_string(),'Edit')
				."&nbsp;|&nbsp;".anchor('price/delete/'.$r->id.get_query_string(),'Delete',array('onclick'=>"return confirm('you sure')"))
			);
		}
		$xdata['table'] = $this->table->generate();
		$xdata['total'] = page_total($offset,$limit,$total);
		
		$config = pag_tmp();
		$config['base_url'] = "price".get_query_string(null,'offset');
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config); 
		$xdata['pagination'] = $this->pagination->create_links();

		$data['content'] = $this->load->view('price_list',$xdata,true);
		$this->load->view('template',$data);
	}
	public function search(){
		$data = array(
			'search'=>$this->input->post('search'),
			'limit'=>$this->input->post('limit'),
			'event'=>$this->input->post('event'),
			'shift'=>$this->input->post('shift'),
			'level'=>$this->input->post('level')
		);
		redirect('price'.get_query_string($data));
	}
	private function _field(){
		$data = array(
			'event'=>$this->input->post('event'),
			'shift'=>$this->input->post('shift'),
			'level'=>$this->input->post('level'),
			'jumlah'=>str_replace(',', '', $this->input->post('jumlah'))
		);
		return $data;		
	}
	private function _set_rules(){
		$this->form_validation->set_rules('event','Event','required|trim');
		$this->form_validation->set_rules('shift','Shift','required|trim');
		$this->form_validation->set_rules('level','Level','required|trim');
		$this->form_validation->set_rules('jumlah','Jumlah','required|trim');
	}
	public function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$xdata['action'] = 'price/add'.get_query_string();
			$xdata['breadcrumb'] = 'price'.get_query_string();
			$xdata['heading'] = 'New';
			$xdata['owner'] = '';
			$data['content'] = $this->load->view('price_form',$xdata,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_create'] = $this->session->userdata('user_login');
			$data['date_create'] = date('Y-m-d H:i:s');
			$this->price_model->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Tambah Data Sukses</div>');
			redirect('price/add'.get_query_string());
		}
	}
	public function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$xdata['row'] = $this->price_model->get_from_field('id',$id)->row();
			$xdata['action'] = 'price/edit/'.$id.get_query_string();
			$xdata['breadcrumb'] = 'price'.get_query_string();
			$xdata['heading'] = 'Update';
			$xdata['owner'] = owner($xdata['row']);
			$data['content'] = $this->load->view('price_form',$xdata,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_update'] = $this->session->userdata('user_login');
			$data['date_update'] = date('Y-m-d H:i:s');
			$this->price_model->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Edit Data Sukses</div>');				
			redirect('price/edit/'.$id.get_query_string());
		}
	}
	public function delete($id=''){
		if($id<>''){
			$this->price_model->delete($id);
		}
		$check = $this->input->post('check');
		if($check<>''){
			foreach($check as $c){
				$this->price_model->delete($c);
			}
		}
		$this->session->set_flashdata('alert','<div class="alert alert-success">Delete Data Sukses</div>');
		redirect('price'.get_query_string());
	}
}