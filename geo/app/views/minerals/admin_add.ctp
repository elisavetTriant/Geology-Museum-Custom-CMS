

<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Minerals', true), array('action'=>'index'));?></li>
        <li class="search"><?php echo $html->link(__('Search Minerals', true), array('action'=>'filter'));?></li>
		<li class="add"><?php echo $html->link(__('New Crystal System', true), array('controller'=> 'crystal_systems', 'action'=>'add')); ?> </li>
		<li class="add"><?php echo $html->link(__('New Dana', true), array('controller'=> 'dana_groups', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="minerals form">
<?php echo $form->create('Mineral');?>
	<fieldset>
 		<legend><?php __('Add Mineral');?></legend>
	<?php
		echo $form->input('name_gr');
		echo $form->input('name_eng');
		echo $form->input('chem_formula');
		echo $form->input('dana_code');
		echo $form->input('crystal_system_id');
		echo '<br style="clear:both" />';
		echo $form->input('dana_group_id');
		echo '<br style="clear:both" />';
		echo $form->input('active');
	?>
	</fieldset>
     <fieldset>
 		<legend><?php __('Variations');?></legend>		
		<?php	
		for($i = 0; $i < 15; $i++):
			echo $form->input("Variation.{$i}.name_gr", array('label' => __('Variation name gr', true).' '.($i+1))); 
			echo $form->input("Variation.{$i}.name_eng", array('label' => __('Variation name eng', true).' '.($i+1))); 
		endfor; 
		?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>

