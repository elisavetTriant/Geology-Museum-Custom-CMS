<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Countries', true), array('action'=>'index'));?></li>
	</ul>
</div>
<div class="countries form">
<?php echo $form->create('Country');?>
	<fieldset>
 		<legend><?php __('Edit Country');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name_gr');
		echo $form->input('name_eng');

	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>

