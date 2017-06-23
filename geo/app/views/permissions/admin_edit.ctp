<div class="actions">
	<ul>
		<li class="delete"><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Permission.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Permission.id'))); ?></li>
		<li class="list"><?php echo $html->link(__('List Permissions', true), array('action'=>'index'));?></li>
		<li class="list"><?php echo $html->link(__('List Roles', true), array('controller'=> 'roles', 'action'=>'index')); ?> </li>
		<li class="add"><?php echo $html->link(__('New Role', true), array('controller'=> 'roles', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="permissions form">
<?php echo $form->create('Permission');?>
	<fieldset>
 		<legend><?php __('Edit Permission');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('desc');
		echo '<div  class="notice">'.__('*Format for the name: controller name:action', true).'</div>';
		echo $form->input('Role', array('multiple' => 'checkbox'));
	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>

