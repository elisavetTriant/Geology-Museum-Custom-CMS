<div class="notes form">
<?php echo $form->create('Note');?>
	<fieldset>
 		<legend><?php __('Add Note');?></legend>
	<?php
		echo $form->input('sample_id');
		echo $form->input('comment_gr');
		echo $form->input('comment_eng');
		echo $form->input('deleted');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Notes', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Samples', true), array('controller'=> 'samples', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Sample', true), array('controller'=> 'samples', 'action'=>'add')); ?> </li>
	</ul>
</div>
