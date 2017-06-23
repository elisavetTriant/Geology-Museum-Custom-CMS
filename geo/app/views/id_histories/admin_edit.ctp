<div class="idHistories form">
<?php echo $form->create('IdHistory');?>
	<fieldset>
 		<legend><?php __('Edit IdHistory');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('sample_id');
		echo $form->input('old_code');
		echo $form->input('deleted');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('IdHistory.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('IdHistory.id'))); ?></li>
		<li><?php echo $html->link(__('List IdHistories', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Samples', true), array('controller'=> 'samples', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Sample', true), array('controller'=> 'samples', 'action'=>'add')); ?> </li>
	</ul>
</div>
