<section class="content-header">
	<h1>
		event
		<small><?php echo $heading?></small>
	</h1>
	<ol class="breadcrumb">
		<li><?php echo anchor('home','<span class="glyphicon glyphicon-home"></span> Home')?></li>
	  <li><?php echo anchor($breadcrumb,'List')?></li>
	  <li class="active"><?php echo $heading?></li>
	</ol>
</section>
<section class="content">
	<?php echo $this->session->flashdata('alert')?>
	<?php echo form_open($action)?>
	<div class="box box-default">
		<div class="box-header owner">
			<?php echo $owner?>
		</div>
		<div class="box-body">
			<div class="form-group form-inline">
				<?php echo form_label('Kode','kode',array('class'=>'control-label'))?>
				<?php echo form_input(array('name'=>'kode','class'=>'form-control input-sm','maxlength'=>'50','autocomplete'=>'off','value'=>set_value('kode',(isset($row->kode)?$row->kode:'')),'required'=>'required','autofocus'=>'autofocus'))?>
				<small><?php echo form_error('kode')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('Event Name','nama',array('class'=>'control-label'))?>
				<?php echo form_input(array('name'=>'nama','class'=>'form-control input-sm','maxlength'=>'50','autocomplete'=>'off','value'=>set_value('nama',(isset($row->nama)?$row->nama:'')),'required'=>'required'))?>
				<small><?php echo form_error('nama')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('Tipe','tipe',array('class'=>'control-label'))?>
				<?php echo form_dropdown('tipe',$this->master_model->dropdown('event_tipe','Tipe'),set_value('tipe',(isset($row->tipe)?$row->tipe:'')),'required=required class="form-control input-sm"')?>
				<small><?php echo form_error('tipe')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('Status','status',array('class'=>'control-label'))?>
				<?php echo form_dropdown('status',$this->master_model->dropdown('event_status','Status'),set_value('status',(isset($row->status)?$row->status:'')),'required=required class="form-control input-sm"')?>
				<small><?php echo form_error('status')?></small>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-success btn-sm" type="submit" onclick="return confirm('Are you sure')"><span class="glyphicon glyphicon-save"></span> Save</button>
			<?php echo anchor($breadcrumb,'<span class="glyphicon glyphicon-repeat"></span> Back',array('class'=>'btn btn-danger btn-sm'))?>
		</div>
	</div>
	<?php echo form_close()?>
</section>
