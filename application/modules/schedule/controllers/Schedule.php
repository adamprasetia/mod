<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('master/master_model');
		$this->load->model('schedule_model');
	}
	public function index(){
		$offset = $this->general->get_offset();
		$limit = $this->general->get_limit();
		$total = $this->schedule_model->count_all();

		$xdata['action'] = 'schedule/search'.get_query_string();
		$xdata['action_delete'] = 'schedule/delete'.get_query_string();
		$xdata['add_btn'] = anchor('schedule/add','<span class="glyphicon glyphicon-plus"></span> Tambah',array('class'=>'btn btn-success btn-sm'));
		$xdata['delete_btn'] = '<button id="delete-btn" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete Checked</button>';

		$this->table->set_template(tbl_tmp());
		$head_data = array(
			'event'=>'Event',
			'slot'=>'Slot',
			'user'=>'User',
			'shift'=>'Shift'
		);
		$heading[] = form_checkbox(array('id'=>'selectAll','value'=>1));
		$heading[] = '#';
		foreach($head_data as $r => $value){
			$heading[] = anchor('schedule'.get_query_string(array('order_column'=>"$r",'order_type'=>$this->general->order_type($r))),"$value ".$this->general->order_icon("$r"));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->schedule_model->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				array('data'=>form_checkbox(array('name'=>'check[]','value'=>$r->id)),'width'=>'10px'),
				$i++,
				$r->event,
				$r->slot,
				$r->user,
				$r->shift,
				anchor('schedule/edit/'.$r->id.get_query_string(),'Edit')
				."&nbsp;|&nbsp;".anchor('schedule/delete/'.$r->id.get_query_string(),'Delete',array('onclick'=>"return confirm('you sure')"))
			);
		}
		$xdata['table'] = $this->table->generate();
		$xdata['total'] = page_total($offset,$limit,$total);
		
		$config = pag_tmp();
		$config['base_url'] = "schedule".get_query_string(null,'offset');
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config); 
		$xdata['pagination'] = $this->pagination->create_links();

		$xdata['schedule_this_month'] = $this->get_schedule_this_month();
		$xdata['schedule_last_month'] = $this->get_schedule_last_month();
		$xdata['schedule_next_month'] = $this->get_schedule_next_month();

		$data['content'] = $this->load->view('schedule_list',$xdata,true);
		$this->load->view('template',$data);
	}
	public function search(){
		$data = array(
			'search'=>$this->input->post('search'),
			'limit'=>$this->input->post('limit'),
			'event'=>$this->input->post('event'),
			'user'=>$this->input->post('user'),
			'shift'=>$this->input->post('shift')
		);
		redirect('schedule'.get_query_string($data));
	}
	private function _field(){
		$data = array(
			'event'=>$this->input->post('event'),
			'slot'=>$this->input->post('slot'),
			'user'=>$this->input->post('user'),
			'shift'=>$this->input->post('shift')
		);
		return $data;		
	}
	private function _set_rules(){
		$this->form_validation->set_rules('event','Event','required|trim');
		$this->form_validation->set_rules('slot','Slot','required|trim');
		$this->form_validation->set_rules('user','User','required|trim');
		$this->form_validation->set_rules('shift','Shift','required|trim');
	}
	public function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$xdata['action'] = 'schedule/add'.get_query_string();
			$xdata['breadcrumb'] = 'schedule'.get_query_string();
			$xdata['heading'] = 'New';
			$xdata['owner'] = '';
			$data['content'] = $this->load->view('schedule_form',$xdata,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_create'] = $this->session->userdata('user_login');
			$data['date_create'] = date('Y-m-d H:i:s');
			$this->schedule_model->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Tambah Data Sukses</div>');
			redirect('schedule/add'.get_query_string());
		}
	}
	public function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$xdata['row'] = $this->schedule_model->get_from_field('id',$id)->row();
			$xdata['action'] = 'schedule/edit/'.$id.get_query_string();
			$xdata['breadcrumb'] = 'schedule'.get_query_string();
			$xdata['heading'] = 'Update';
			$xdata['owner'] = owner($xdata['row']);
			$data['content'] = $this->load->view('schedule_form',$xdata,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_update'] = $this->session->userdata('user_login');
			$data['date_update'] = date('Y-m-d H:i:s');
			$this->schedule_model->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Edit Data Sukses</div>');				
			redirect('schedule/edit/'.$id.get_query_string());
		}
	}
	public function delete($id=''){
		if($id<>''){
			$this->schedule_model->delete($id);
		}
		$check = $this->input->post('check');
		if($check<>''){
			foreach($check as $c){
				$this->schedule_model->delete($c);
			}
		}
		$this->session->set_flashdata('alert','<div class="alert alert-success">Delete Data Sukses</div>');
		redirect('schedule'.get_query_string());
	}
	public function get_schedule_this_month(){
		$event = $this->input->get('event');
		if ($event <> '') {
			$total_hari = date('d',strtotime('last day of this month'));
			$heading[] = array('data'=>'SHIFT');
			for($i=1;$i<=$total_hari;$i++){
				$heading[] = (date_format(date_create(date('Y-m-').$i),"N")==6 || date_format(date_create(date('Y-m-').$i),"N")==7?"<span style='color:red'>".get_day_kode(date_format(date_create(date('Y-m-').$i),"N"))."</span>":get_day_kode(date_format(date_create(date('Y-m-').$i),"N")))."<br/>".$i;
			}
			$this->table->set_heading($heading);
			unset($heading);

			$row[] = array('data'=>"<b>SIANG</b>");
			for($i=1;$i<=$total_hari;$i++){
				$date = date_format(date_create(date('Y-m-').$i),"Y-m-d");				
				$result = $this->schedule_model->get_schedule_by_date($event,$date,'S');
				$row[] = array('data'=>$result);	
			}
			$this->table->add_row($row);
			unset($row);

			$row[] = array('data'=>"<b>MALAM</b>");
			for($i=1;$i<=$total_hari;$i++){
				$date = date_format(date_create(date('Y-m-').$i),"Y-m-d");				
				$result = $this->schedule_model->get_schedule_by_date($event,$date,'M');
				$row[] = array('data'=>$result);	
			}
			$this->table->add_row($row);
			unset($row);
		}

		return $this->table->generate();
	}
	public function get_schedule_last_month(){
		$event = $this->input->get('event');
		if ($event <> '') {
			$total_hari = date('d',strtotime('last day of next month'));
			$heading[] = array('data'=>'SHIFT');
			for($i=1;$i<=$total_hari;$i++){
				$heading[] = (date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")==6 || date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")==7?"<span style='color:red'>".get_day_kode(date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N"))."</span>":get_day_kode(date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")))."<br/>".$i;
			}
			$this->table->set_heading($heading);
			unset($heading);

			$row[] = array('data'=>"<b>SIANG</b>");
			for($i=1;$i<=$total_hari;$i++){
				$date = date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"Y-m-d");				
				$result = $this->schedule_model->get_schedule_by_date($event,$date,'S');
				$row[] = array('data'=>$result);	
			}
			$this->table->add_row($row);
			unset($row);

			$row[] = array('data'=>"<b>MALAM</b>");
			for($i=1;$i<=$total_hari;$i++){
				$date = date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"Y-m-d");				
				$result = $this->schedule_model->get_schedule_by_date($event,$date,'M');
				$row[] = array('data'=>$result);	
			}
			$this->table->add_row($row);
			unset($row);
		}

		return $this->table->generate();
	}
	public function get_schedule_next_month(){
		$event = $this->input->get('event');
		if ($event <> '') {
			$total_hari = date('d',strtotime('last day of next month'));
			$heading[] = array('data'=>'SHIFT');
			for($i=1;$i<=$total_hari;$i++){
				$heading[] = (date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")==6 || date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")==7?"<span style='color:red'>".get_day_kode(date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N"))."</span>":get_day_kode(date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")))."<br/>".$i;
			}
			$this->table->set_heading($heading);
			unset($heading);

			$row[] = array('data'=>"<b>SIANG</b>");
			for($i=1;$i<=$total_hari;$i++){
				$date = date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"Y-m-d");				
				$result = $this->schedule_model->get_schedule_by_date($event,$date,'S');
				$row[] = array('data'=>$result);	
			}
			$this->table->add_row($row);
			unset($row);

			$row[] = array('data'=>"<b>MALAM</b>");
			for($i=1;$i<=$total_hari;$i++){
				$date = date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"Y-m-d");				
				$result = $this->schedule_model->get_schedule_by_date($event,$date,'M');
				$row[] = array('data'=>$result);	
			}
			$this->table->add_row($row);
			unset($row);
		}

		return $this->table->generate();
	}	
}