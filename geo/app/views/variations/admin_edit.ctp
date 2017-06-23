<div class="actions">
	<ul>
		<li class="delete"><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Variation.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Variation.id'))); ?></li>
		<li class="list"><?php echo $html->link(__('List Variations', true), array('action'=>'index'));?></li>		
	</ul>
</div>

<div class="variations form">
<?php echo $form->create('Variation');?>
	<fieldset>
 		<legend><?php __('Edit Variation');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('mineral_id');
		echo $form->input('name_gr');
		echo $form->input('name_eng');
	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>