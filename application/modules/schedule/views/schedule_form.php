<section class="content-header">
	<h1>
		Schedule
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
				<?php echo form_label('Event','event',array('class'=>'control-label'))?>
				<?php echo form_dropdown('event',$this->master_model->dropdown('event','Event'),set_value('event',(isset($row->event)?$row->event:'')),'required=required class="form-control input-sm"')?>
				<small><?php echo form_error('event')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('Slot','slot',array('class'=>'control-label'))?>
				<?php echo form_input(array('name'=>'slot','class'=>'form-control input-sm','maxlength'=>'3','autocomplete'=>'off','value'=>set_value('slot',(isset($row->slot)?$row->slot:'')),'required'=>'required'))?>
				<small><?php echo form_error('slot')?></small>
			</div>			
			<div class="form-group form-inline">
				<?php echo form_label('User','user',array('class'=>'control-label'))?>
				<?php echo form_dropdown('user',$this->master_model->dropdown('user','User'),set_value('user',(isset($row->user)?$row->user:'')),'required=required class="form-control input-sm"')?>
				<small><?php echo form_error('user')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('Shift','shift',array('class'=>'control-label'))?>
				<?php echo form_dropdown('shift',$this->master_model->dropdown('shift','Shift'),set_value('shift',(isset($row->shift)?$row->shift:'')),'required=required class="form-control input-sm"')?>
				<small><?php echo form_error('shift')?></small>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-success btn-sm" type="submit" onclick="return confirm('Are you sure')"><span class="glyphicon glyphicon-save"></span> Save</button>
			<?php echo anchor($breadcrumb,'<span class="glyphicon glyphicon-repeat"></span> Back',array('class'=>'btn btn-danger btn-sm'))?>
		</div>
	</div>
	<?php echo form_close()?>
</section>
