<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Variations', true), array('action'=>'index'));?></li>
	</ul>
</div>
<div class="variations form">
<?php echo $form->create('Variation');?>
	<fieldset>
 		<legend><?php __('Add Variation');?></legend>
	<?php
		echo $form->input('mineral_id');
		echo $form->input('name_gr');
		echo $form->input('name_eng');
	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?></div>

