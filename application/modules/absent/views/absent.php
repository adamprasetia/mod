<section class="content-header">
	<h1>
		Absent
		<small>List</small>
	</h1>
	<ol class="breadcrumb pull-right">
		<li><?php echo anchor('home','<span class="glyphicon glyphicon-home"></span> Home')?></li>
		<li class="active">List</li>
	</ol>
</section>
<section class="content">
	<?php echo $this->session->flashdata('alert') ?>
	<div class="box box-default">
		<?php echo form_open($action,array('class'=>'form-inline'))?>
			<div class="box-body">
				<div class="form-group">
					Event : <?php echo form_dropdown('event',$this->master_model->dropdown('event','Event'),$this->input->get('event'),'class="form-control input-sm"')?>
				</div>
				<div class="form-group">
					<?php echo form_input(array('name'=>'date_from','size'=>'10','placeholder'=>'From','class'=>'form-control input-sm input-tanggal','maxlength'=>'50','autocomplete'=>'off','value'=>set_value('date_from',$this->input->get('date_from'))))?>
					<?php echo form_input(array('name'=>'date_to','size'=>'10','placeholder'=>'To','class'=>'form-control input-sm input-tanggal','maxlength'=>'50','autocomplete'=>'off','value'=>set_value('date_to',$this->input->get('date_to'))))?>
				</div>
				<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-filter"></span> Filter</button>			
			</div>
		<?php echo form_close()?>
	</div>
	<div class="box box-default">
		<?php echo form_open($action_update)?>
			<div class="box-body">
				<div class="table-responsive">
					<?php echo $table?>
				</div>
			</div>
			<div class="box-footer">
				<button class="btn btn-primary btn-sm" type="submit" onclick="return confirm('Are you sure')"><span class="glyphicon glyphicon-save"></span> Save</button>			
				<?php echo $auto_btn ?>
				<?php echo $fee_week_btn ?>
				<?php echo $fee_month_btn ?>
				<div class="pull-right">
					<?php echo $clear_btn ?>
				</div>
			</div>		
		<?php echo form_close()?>
	</div>
</section>