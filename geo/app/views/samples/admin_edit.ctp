<div class="actions">
	<ul>	
    	<li class="add_image"><?php echo $html->link(__('Add Image', true), array('controller'=>'attachments','action'=>'add', 'samples', $this->data['Sample']['id'])); ?> </li>
        
        <li class="add"><?php echo $html->link(__('New Country', true), array('controller'=> 'countries', 'action'=>'admin_add')); ?> </li>
		
		<li class="add"><?php echo $html->link(__('New Mineral', true), array('controller'=> 'minerals', 'action'=>'admin_add')); ?> </li>
		
		<li class="add"><?php echo $html->link(__('New Collection', true), array('controller'=> 'collections', 'action'=>'admin_add')); ?> </li>
        
        <li class="list"><?php echo $html->link(__('List Samples', true), array('action'=>'admin_index')); ?> </li>
	</ul>
</div>

<div class="samples form">
<?php echo $form->create('Sample');?>
    
    <fieldset>
 		<legend><?php __('Edit Sample');?></legend>
	<?php
		echo $form->hidden('id');
	?>
	<fieldset>
 		<legend><?php __('Sample Attributes');?></legend>
         <?php	
			echo '<div class="input"><label for="minerals">'.__('Mineral', true).'</label>';
			echo $form->select('mineral_id', $minerals, null, array('id' => 'minerals'), false);
			echo '</div>';
			?>
        <?php	
			echo '<div class="input"><label for="variations">'.__('Variation', true).'</label>';
			
			echo $form->select('variation_id', $variations, null, array('id' =>'variations'), __('Select Variation', true));
			echo '</div>';
        ?>
		<?php   $options = array('url' => '/admin/variations/update_select','update' => 'variations');
				echo $ajax->observeField('minerals',$options);?>
        
		<fieldset style="margin:10px">
            <legend><?php __('Associates/Paragenesis');?></legend>
            <div class="checkboxContainer">
            <?php echo $form->input('AssociateMineral', array('label'=> '', 'multiple' =>'checkbox'));?>
            </div>
        </fieldset>
		<?php
		echo $form->input('rock');
		?>
	</fieldset>
     <fieldset>
 		<legend><?php __('Sample Origin');?></legend>	
		<?php
        echo $form->input('origin');
		echo $form->input('country_id', array('empty'=>true));
		?>
     </fieldset>
	<fieldset>
 		<legend><?php __('Sample Acquisition Data');?></legend>
        <?php
		echo $form->input('donation');
		echo $form->input('collection_id');
		echo $form->input('acquisition_date', array('dateFormat'=>'DMY'));
		?>
     </fieldset>
	 <fieldset>
 		<legend><?php __('Sample Dimensions');?></legend>
		<?php
		echo $form->input('length');
		echo $form->input('width');
		echo $form->input('height');
	?>
	</fieldset>
    <fieldset>
 		<legend><?php __('Sample ID History');?></legend>
        <?php	
		for($i = 0; $i < 3; $i++):
			echo $form->hidden("IdHistory.{$i}.id");
			echo $form->hidden("IdHistory.{$i}.sample_id");
			echo $form->input("IdHistory.{$i}.old_code", array('label' => __('Old Code', true).' '.($i+1))); 
		endfor; 
		?>
	</fieldset>
    <fieldset>
 		<legend><?php __('Sample Comments');?></legend>
    <?php
		echo $form->input('comment_gr');
		echo $form->input('comment_eng');
	?>
    </fieldset>
     
    <fieldset>
 		<legend><?php __('Sample Extra Information');?></legend>
    <?php
		echo $form->input('storage_place');
		echo $form->input('estimation_id',  array('empty'=>true));
		echo $form->input('exhibition');
		echo $form->input('active');
		
		echo $form->hidden('user_id');
	?>
    </fieldset>
</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>