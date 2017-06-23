<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List CrystalSystems', true), array('action'=>'admin_index'));?></li>
	</ul>
</div>
<div class="crystalSystems form">
<?php echo $form->create('CrystalSystem');?>
	<fieldset>
 		<legend><?php __('Add CrystalSystem');?></legend>
	<?php
		echo $form->input('name_gr');
		echo $form->input('name_eng');
	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>

