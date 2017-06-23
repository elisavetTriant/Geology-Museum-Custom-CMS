
<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Roles', true), array('action'=>'index'));?></li>
	</ul>
</div>
<div class="Roles form">
<?php echo $form->create('Role');?>
	<fieldset>
 		<legend><?php __('Add Role');?></legend>
	<?php
		echo $form->input('name');
		echo '<br style="clear:both" />';
		echo $form->input('Permission', array('multiple' => 'checkbox'));

	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>

