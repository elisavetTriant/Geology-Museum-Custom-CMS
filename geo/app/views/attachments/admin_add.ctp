<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Attachments', true), array('action'=>'index'));?></li>
	</ul>
</div>
<div class="attachments form">
<?php echo $form->create('Attachment', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Add Attachment');?></legend>
	<?php
		echo $form->input('filename', array('type' => 'file'));
		echo $form->input('date_added',  array('dateFormat' => 'DMY', 'timeFormat'=>24));
		
	?>
    <fieldset>
 		<legend><?php __('Attach To');?></legend>
		
		<?php
        echo $form->input('model');
		echo $form->input('foreign_key');
		?>
        <?php if ( isset($sample) && is_array($sample['Sample'])):?>
        <div class="sample_info">
            <p><strong><?php echo __('Sample name (gr):', true).'</strong> '.$sample['Sample']['name_gr']?></strong></p>
            <p><strong><?php echo __('Sample name (eng):', true).'</strong> '.$sample['Sample']['name_eng']?></strong></p>
            <p><strong><?php echo __('Sample new_code:', true).'</strong> '.$sample['Sample']['new_code']?></strong></p>   
        </div>
		<?php endif;?>   
     </fieldset>
     <fieldset><legend><?php __('Extra image information');?></legend>
     <?php
		
		echo $form->input('title_gr');
		echo $form->input('title_eng');
		echo $form->input('description_gr');
		echo $form->input('description_eng');
	?>
	</fieldset>
</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>