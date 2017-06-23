<div class="danas form">
<?php echo $form->create('DanaGroup');?>
	<fieldset>
 		<legend><?php __('Edit Dana Group');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name_gr');
		echo $form->input('name_eng');
	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Dana Groups', true), array('action'=>'admin_index'));?></li>
	</ul>
</div>
