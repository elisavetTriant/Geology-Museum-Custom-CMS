<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Dana Groups', true), array('action'=>'admin_index'));?></li>
	</ul>
</div>

<div class="danas form">
<?php echo $form->create('DanaGroup');?>
	<fieldset>
 		<legend><?php __('Add Dana Group');?></legend>
	<?php
		echo $form->input('name_gr');
		echo $form->input('name_eng');
	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>
