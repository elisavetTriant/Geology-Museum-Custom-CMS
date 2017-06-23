<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Estimations', true), array('action'=>'admin_index'));?></li>
	</ul>
</div>

<div class="estimations form">
<?php echo $form->create('Estimation');?>
	<fieldset>
 		<legend><?php __('Add Estimation');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>

