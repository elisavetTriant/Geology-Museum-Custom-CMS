<div class="actions">
	<ul>
		<li class="delete"><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Attachment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Attachment.id'))); ?></li>
		<li class="list"><?php echo $html->link(__('List Attachments', true), array('action'=>'index'));?></li>
	</ul>
</div>
<div class="attachments form">
<?php echo $form->create('Attachment', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Edit Attachment');?></legend>
		<?php
            echo $form->hidden('filename');
			echo $form->hidden('id');
			echo $form->hidden('path');
			
			echo '<div class="sample_info">';
			echo __("Current file: ", true).$html->link($this->data['Attachment']['filename'], $this->data['Attachment']['path'].'w600-'.$this->data['Attachment']['filename'], array('rel'=>'lightbox'));
			echo "</div>";
			echo '<br style="clear:both" />';
			
			echo $form->input('file', array('type' => 'file', 'label'=>__('Or upload another file...', true)));
            echo $form->input('date_added',  array('dateFormat' => 'DMY', 'timeFormat'=>24));
            echo $form->hidden('model');
            echo $form->hidden('foreign_key');
            ?>
         <?php if ( isset($sample['Sample']) && is_array($sample['Sample'])):?>
         <fieldset>
            <legend><?php __('Attached To');?></legend>
            <div class="sample_info">
            	<p><strong><?php echo __('Sample ID:', true).'</strong> '.$sample['Sample']['id']?></strong></p>
                <p><strong><?php echo __('Sample name (gr):', true).'</strong> '.$html->link($sample['Sample']['name_gr'], array('controller'=>'samples', 'action'=> 'admin_view/'.$sample['Sample']['id']))?></strong></p>
                <p><strong><?php echo __('Sample name (eng):', true).'</strong> '.$sample['Sample']['name_eng']?></strong></p>
                <p><strong><?php echo __('Sample new_code:', true).'</strong> '.$sample['Sample']['new_code']?></strong></p>   
            </div>
          </fieldset>
          <?php endif;?>   
 
         
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

