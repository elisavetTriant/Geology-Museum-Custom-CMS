<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Collections', true), array('action'=>'index'));?></li>
	</ul>
</div>
<div class="collections form">
<?php echo $form->create('Collection');?>
	<fieldset>
 		<legend><?php __('Edit Collection');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>
