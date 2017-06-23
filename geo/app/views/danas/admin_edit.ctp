<div class="danas form">
<?php echo $form->create('Dana');?>
	<fieldset>
 		<legend><?php __('Edit Dana');?></legend>
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
		<li><?php echo $html->link(__('List Danas', true), array('action'=>'index'));?></li>
	</ul>
</div>
