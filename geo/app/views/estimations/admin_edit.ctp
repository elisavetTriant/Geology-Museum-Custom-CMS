<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Estimations', true), array('action'=>'index'));?></li>

	</ul>
</div>
<div class="estimations form">
<?php echo $form->create('Estimation');?>
	<fieldset>
 		<legend><?php __('Edit Estimation');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>

