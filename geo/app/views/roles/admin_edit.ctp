<div class="actions">
	<ul>
		<li class="delete"><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Role.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Role.id'))); ?></li>
		<li class="list"><?php echo $html->link(__('List Roles', true), array('action'=>'index'));?></li>
	</ul>
</div>
<div class="Roles form">
<?php echo $form->create('Role');?>
	<fieldset>
 		<legend><?php __('Edit Role');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo '<br style="clear:both" />';
		echo $form->input('Permission', array('multiple' => 'checkbox'));

	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>

