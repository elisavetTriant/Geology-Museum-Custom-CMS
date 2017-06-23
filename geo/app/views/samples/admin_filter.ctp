<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Samples', true), array('action'=>'index')); ?> </li>
	</ul>
</div>
<div class="samples filter">
<h2><?php __('Samples');?></h2>
<?php echo $form->create('Sample', array('url'=>array('controller' => 'samples', 'action'=>'filter')));?>
	<fieldset>
 		<legend><?php __('Search for sample');?></legend>
       <?php echo $form->input('name_gr', array('type'=>'text'))?>
        <?php echo $form->input('name_eng', array('type'=>'text'))?>
       	<?php echo $form->input('dana_code', array('type'=>'text'))?>
	   <?php echo $form->input('variation_id', array('empty'=>true))?>
	   <?php echo $form->input('user_id', array('empty'=>true))?>
       <?php echo $form->input('collection_id', array('empty'=>true))?>
       <?php echo $form->input('country_id', array('empty'=>true))?>

       <?php echo $form->end('Αναζήτηση');?>
    </fieldset>
</div>
<?php if (isset($samples)):?>
<h3><?php __('Result');?> (<?php echo $countSamples.' '.__('Records', true)?>)</h3>
<ul class="gallery display">
            	<?php foreach ($samples as $sample):?>
					<li>
                    <?php 
					if (!empty($sample['Attachment']))
						echo $html->link($html->image($sample['Attachment'][0]['path'].$versionInfo['Thumbnail']['prefix'].$sample['Attachment'][0]['filename'], array('alt'=> $sample['Attachment'][0]['title_'.$lang])), array('controller'=>'samples', 'action'=>'view', $sample['Sample']['id']), array('escape'=>false)); 
					else
						echo $html->link($html->image('/files/samples/missing_image_thumb.gif'), array('controller'=>'samples', 'action'=>'view', $sample['Sample']['id']), array('escape'=>false)); 
						?>                    
                    <p><?php echo $html->link($sample['Sample']['name_gr'],  array('controller'=>'samples', 'action'=>'view', $sample['Sample']['id']));?>
					(<?php echo $sample['Sample']['name_eng']?>)
                    </p>
                    <p>
					<?php if (!empty($sample['Variation']['id'])): ?>
                   <?php echo $sample['Variation']['name_'.$lang]; ?>
                    <?php endif;?>
                    <?php echo $sample['Sample']['new_code']?></p>
                    </li>
				<?php endforeach; ?>
            </ul>
<?php endif;?>
