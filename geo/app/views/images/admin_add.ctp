<div class="danas form">
<?php echo $form->create('Image', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Image');?></legend>
	<?php
		echo $form->input('filename', array('type' => 'file'));
		echo $form->input('model');
	?>
	</fieldset>
<?php echo $form->end('Upload');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Images', true), array('action'=>'admin_index'));?></li>
	</ul>
</div>
