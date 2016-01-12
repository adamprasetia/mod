<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Absent extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('master/master_model');
		$this->load->model('price/price_model');
		$this->load->model('event/event_model');
		$this->load->model('user_event/user_event_model');
		$this->load->model('schedule/schedule_model');
		$this->load->model('absent_model');
	}
	public function index(){
		$xdata['action'] = 'absent/search'.get_query_string();
		$xdata['action_update'] = 'absent/update'.get_query_string();
		$xdata['clear_btn'] = anchor('absent/delete'.get_query_string(),'<span class="glyphicon glyphicon-trash"></span> Clear',array('class'=>'btn btn-sm btn-danger','onclick'=>"return confirm('Are you sure')"));
		$xdata['auto_btn'] = anchor('absent/update_auto'.get_query_string(),'<span class="glyphicon glyphicon-edit"></span> Auto Absent',array('class'=>'btn btn-sm btn-warning','onclick'=>"return confirm('Are you sure')"));
		$xdata['fee_week_btn'] = anchor('absent/fee_week'.get_query_string(),'<span class="glyphicon glyphicon-print"></span> Fee Weekly',array('class'=>'btn btn-sm btn-default','target'=>'_blank'));
		$xdata['fee_month_btn'] = anchor('absent/fee_month'.get_query_string(),'<span class="glyphicon glyphicon-print"></span> Fee Monthly',array('class'=>'btn btn-sm btn-default','target'=>'_blank'));
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		$event = $this->input->get("event");
		if($date_from <> '' && $date_to <> '' && $event <> ''){
			$this->table->set_template(tbl_tmp());
			$from = date_create(format_ymd($date_from));
			$to = date_create(format_ymd($date_to));
			$head[] = 'No';
			$head[] = 'Moderator';
			while($from <= $to){
				$head[] = get_day(date_format($from,'N')).'<br/>'.date_format($from,'d/m/Y');
				date_add($from, date_interval_create_from_date_string('1 days'));
			}	
			$this->table->set_heading($head);
			
			$result = $this->user_event_model->get_user_all()->result();
			$i=1;
			foreach($result as $r){
				$from = date_create(format_ymd($date_from));
				$to = date_create(format_ymd($date_to));
				$row[] = $i++;
				$row[] = $r->user;
				$j=1;
				while($from <= $to){
					$value = $this->absent_model->get_shift($r->user_kode,$event,date_format($from,'Y-m-d'));
					$row[] = form_dropdown($r->user_kode.'_'.date_format($from,'dmy'),$this->master_model->dropdown('shift',''),$value);
					date_add($from, date_interval_create_from_date_string('1 days'));
					$j++;
				}	
				$this->table->add_row($row);
				unset($row);
			}
		}
		$xdata['table'] = $this->table->generate();	
		$data['content'] = $this->load->view('absent',$xdata,true);
		$this->load->view('template',$data);
	}
	function update(){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		$event = $this->input->get("event");
		if($date_from <> '' && $date_to <> '' && $event <> ''){
			$result = $this->user_event_model->get_user_all()->result();
			$data = array();
			foreach($result as $r){
				$from = date_create(format_ymd($date_from));
				$to = date_create(format_ymd($date_to));
				while($from <= $to){
					$value = $this->input->post($r->user_kode.'_'.date_format($from,'dmy'));
					if($value <> ''){
						$data[] = array(
							'user'=>$r->user_kode,
							'tanggal'=>date_format($from,'Y-m-d'),
							'shift'=>$value,
							'event'=>$event
						);
					}
					date_add($from, date_interval_create_from_date_string('1 days'));
				}	
			}
			$this->absent_model->update($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete!!!</div>');
		}else{
			$this->session->set_flashdata('alert','<div class="alert alert-danger">Date Empty!!!</div>');
		}
		redirect('absent'.get_query_string());		
	}	
	function update_auto(){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		$event = $this->input->get("event");
		if($date_from <> '' && $date_to <> '' && $event <> ''){
			$result = $this->user_event_model->get_user_all()->result();
			$data = array();
			foreach($result as $r){
				$from = date_create(format_ymd($date_from));
				$to = date_create(format_ymd($date_to));
				while($from <= $to){
					$shift = $this->schedule_model->get_schedule($event,date_format($from,'Y-m-d'),$r->user_kode);
					if($shift <> ''){
						$data[] = array(
							'user'=>$r->user_kode,
							'tanggal'=>date_format($from,'Y-m-d'),
							'shift'=>$shift,
							'event'=>$event
						);
					}
					date_add($from, date_interval_create_from_date_string('1 days'));
				}	
			}
			$this->absent_model->update($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete!!!</div>');
		}else{
			$this->session->set_flashdata('alert','<div class="alert alert-danger">Date Empty!!!</div>');
		}
		redirect('absent'.get_query_string());		
	}	
	public function search(){
		$data = array(
			'event'=>$this->input->post('event'),
			'date_from'=>$this->input->post('date_from'),
			'date_to'=>$this->input->post('date_to')
		);
		redirect('absent'.get_query_string($data));
	}
	public function delete(){
		$this->absent_model->delete();
		redirect('absent'.get_query_string());
	}
	public function fee_week(){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		$event = $this->input->get("event");

		require_once "../assets/fpdf/fpdf.php";
		$pdf = new FPDF();

		$pdf->AliasNbPages();
		$pdf->AddPage('L','A4');
		$pdf->SetTitle("Fee Moderasi HM Sampoerna");
		
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(0,10,'Report Fee Moderasi HM Sampoerna',0,0,'C');
		$pdf->Ln(10);		

		$this->_header($pdf);

		$pdf->SetFont('Arial','',8);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetTextColor(0,0,0);				
		$result = $this->user_event_model->get_user_week()->result();
		$total_siang = 0;
		$total_siang_fee = 0;
		$total_malam = 0;
		$total_malam_fee = 0;
		$total_training = 0;
		$total_training_fee = 0;
		$i=1;
		$j=0;
		foreach($result as $r){
			$pdf->Cell(10,7,$i++,1,0,'C');
			$pdf->Cell(40,7,$r->user,1,0,'L');
			$from = date_create(format_ymd($date_from));
			$to = date_create(format_ymd($date_to));
			$j=0;
			$jum_siang = 0;
			$jum_malam = 0;
			$jum_training = 0;
			while($from <= $to){
				$siang = $this->absent_model->check_exist($r->user_kode,$event,date_format($from,'Y-m-d'),'S');
				$pdf->Cell(6,7,number_format($siang),1,0,'C');
				$malam = $this->absent_model->check_exist($r->user_kode,$event,date_format($from,'Y-m-d'),'M');
				$pdf->Cell(6,7,number_format($malam),1,0,'C');
				$training = $this->absent_model->check_exist($r->user_kode,$event,date_format($from,'Y-m-d'),'T');
				$pdf->Cell(6,7,number_format($training),1,0,'C');
				$jum_siang += $siang;
				$jum_malam += $malam;
				$jum_training += $training;
				date_add($from, date_interval_create_from_date_string('1 days'));
				$j++;
			}
			$fee_siang = $this->price_model->get_price($event,'S',$r->user_level);
			$fee_malam = $this->price_model->get_price($event,'M',$r->user_level);
			$fee_training = $this->price_model->get_price($event,'T',$r->user_level);

			$pdf->Cell(7,7,number_format($jum_siang),1,0,'C');
			$pdf->Cell(18,7,number_format($jum_siang*$fee_siang),1,0,'C');
			$pdf->Cell(7,7,number_format($jum_malam),1,0,'C');
			$pdf->Cell(18,7,number_format($jum_malam*$fee_malam),1,0,'C');
			$pdf->Cell(7,7,number_format($jum_training),1,0,'C');
			$pdf->Cell(18,7,number_format($jum_training*$fee_training),1,0,'C');
			$total = $jum_siang+$jum_malam+$jum_training;
			$pdf->Cell(7,7,number_format($total),1,0,'C');
			$pdf->Cell(0,7,number_format(($jum_siang*$fee_siang)+($jum_malam*$fee_malam)+($jum_training*$fee_training)),1,0,'C');
			$pdf->Ln(7);
			$total_siang += $jum_siang;
			$total_siang_fee += $jum_siang*$fee_siang;
			$total_malam += $jum_malam;
			$total_malam_fee += $jum_malam*$fee_malam;
			$total_training += $jum_training;
			$total_training_fee += $jum_training*$fee_training;
		}
		$pdf->SetFillColor(240,240,240);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(50+(18*$j),7,'Total : ',1,0,'R',true);
		$pdf->Cell(7,7,number_format($total_siang),1,0,'C',true);
		$pdf->Cell(18,7,number_format($total_siang_fee),1,0,'C',true);
		$pdf->Cell(7,7,number_format($total_malam),1,0,'C',true);
		$pdf->Cell(18,7,number_format($total_malam_fee),1,0,'C',true);
		$pdf->Cell(7,7,number_format($total_training),1,0,'C',true);
		$pdf->Cell(18,7,number_format($total_training_fee),1,0,'C',true);
		$pdf->Cell(7,7,number_format($total_siang+$total_malam+$total_training),1,0,'C',true);
		$pdf->Cell(0,7,number_format($total_siang_fee+$total_malam_fee+$total_training_fee),1,0,'C',true);

		$this->_footer($pdf);

		$pdf->Output("Fee Moderasi HM Sampoerna","I");

	}
	public function fee_month(){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		$event = $this->input->get("event");
		require_once "../assets/fpdf/fpdf.php";
		$pdf = new FPDF();

		$pdf->AliasNbPages();
		$pdf->AddPage('L','A4');						
		//title
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(0,10,'Report Absensi Moderasi HM Sampoerna',0,0,'C');
		$pdf->Ln(10);			
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0,5,'Periode Tanggal : '.$date_from.' s/d '.$date_to,0,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(0,5,'Event : '.$this->event_model->get_event_name($this->input->get("event")),0,0,'L');
		$pdf->Ln(10);
		
		//header
		$pdf->SetFont('Arial','B',8);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(10,14,'No',1,0,'C');
		$pdf->Cell(40,14,'Moderator',1,0,'C');

		$from = date_create(format_ymd($date_from));
		$to = date_create(format_ymd($date_to));
		$j=0;
		while($from <= $to){
			$pdf->SetXY(60+$j,35);
			$pdf->Cell(6,7,date_format($from,"d"),1,0,'C');
			$pdf->SetXY(60+$j,42);
			$pdf->Cell(6,7,date_format($from,"m"),1,0,'C');
			date_add($from, date_interval_create_from_date_string('1 days'));
			$j+=6;
		}						
		$pdf->SetXY($j+60,35);
		$pdf->Cell(0,14,'Jumlah',1,0,'C');
		$pdf->Ln(14);

		//rows
		$pdf->SetFont('Arial','',8);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetTextColor(0,0,0);				
		$result = $this->user_event_model->get_user_month()->result();
		$total = 0;
		$i=1;
		$j=0;
		foreach($result as $r){
			$pdf->Cell(10,7,$i++,1,0,'C');
			$pdf->Cell(40,7,$r->user,1,0,'L');
			$from = date_create(format_ymd($date_from));
			$to = date_create(format_ymd($date_to));
			$j=0;
			$jum = 0;
			while($from <= $to){
				$jumlah = $this->absent_model->check_exist_month($r->user_kode,$event,date_format($from,'Y-m-d'));
				$pdf->Cell(6,7,number_format($jumlah),1,0,'C');
				$jum += $jumlah;
				date_add($from, date_interval_create_from_date_string('1 days'));
				$j++;
			}
			$pdf->Cell(0,7,number_format($jum),1,0,'C');
			$total += $jum;
			$pdf->Ln(7);
		}
		$pdf->SetFillColor(240,240,240);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(50+(6*$j),7,'Total : ',1,0,'R',true);
		$pdf->Cell(0,7,number_format($total),1,0,'C',true);
		$pdf->SetFont('Arial','',10);			
		$this->_footer($pdf);
					
		$pdf->Output("Fee Moderasi HM Sampoerna","I");		
	}
	public function _header($pdf){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		$event = $this->event_model->get_event_name($this->input->get("event"));
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0,5,'Periode Tanggal : '.$date_from.' s/d '.$date_to,0,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(0,5,'Event : '.$event,0,0,'L');
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B',10);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(10,21,'No',1,0,'C');
		$pdf->Cell(40,21,'Moderator',1,0,'C');
		$from = date_create(format_ymd($date_from));
		$to = date_create(format_ymd($date_to));
		$j=0;
		while($from <= $to){
			$pdf->SetXY(60+$j,35);
			$pdf->Cell(18,7,get_day(date_format($from,"N")),1,0,'C');
			$pdf->SetXY(60+$j,42);
			$pdf->Cell(18,7,date_format($from,"d/m/y"),1,0,'C');
			$pdf->SetXY(60+$j,49);
			$pdf->Cell(6,7,"S",1,0,'C');
			$pdf->Cell(6,7,"M",1,0,'C');				
			$pdf->Cell(6,7,"T",1,0,'C');				
			date_add($from, date_interval_create_from_date_string('1 days'));
			$j+=18;
		}			
		$pdf->SetXY($j+60,35);
		$pdf->Cell(25,21,'Siang',1,0,'C');
		$pdf->Cell(25,21,'Malam',1,0,'C');
		$pdf->Cell(25,21,'Training',1,0,'C');
		$pdf->Cell(0,21,'Total',1,0,'C');
		$pdf->Ln(21);		
	}	
	public function _footer($pdf){
		$pdf->SetFont('Arial','',10);			
		$pdf->Ln(10);
		$pdf->Cell(0,5,'Jakarta, '.date('d M Y'),0,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(70,5,'Dibuat Oleh',1,0,'C');
		$pdf->Cell(135,5,'Diperiksa Oleh',1,0,'C');
		$pdf->Cell(0,5,'Disetujui Oleh',1,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(70,20,'',1,0,'C');
		$pdf->Cell(45,20,'',1,0,'C');
		$pdf->Cell(45,20,'',1,0,'C');
		$pdf->Cell(45,20,'',1,0,'C');
		$pdf->Cell(0,20,'',1,0,'C');
		$pdf->Ln(20);
		$pdf->Cell(70,5,'('.$this->general->get_user_info('nama').')',1,0,'C');
		$pdf->Cell(45,5,'(Teguh Santoso)',1,0,'C');
		$pdf->Cell(45,5,'(HRD)',1,0,'C');
		$pdf->Cell(45,5,'(Farida Ambarwati)',1,0,'C');
		$pdf->Cell(0,5,'(Kannadasen)',1,0,'C');		
	}	
}