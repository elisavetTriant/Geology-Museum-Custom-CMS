<div class="samples index">
<h2><?php __('Full Mineral Collection');?></h2>
<ul class="gallery display">
            	<?php foreach ($samples as $sample):?>
					<li>
                    <?php 
					if (!empty($sample['Attachment']))
						echo $html->link($html->image($sample['Attachment'][0]['path'].$versionInfo['Thumbnail']['prefix'].$sample['Attachment'][0]['filename'], array('alt'=> $sample['Attachment'][0]['title_'.$lang])), array('controller'=>'samples', 'action'=>'display', $sample['Sample']['id']), array('escape'=>false)); 
					else
						echo $html->link($html->image('/files/samples/missing_image_thumb.gif'), array('controller'=>'samples', 'action'=>'display', $sample['Sample']['id']), array('escape'=>false)); 
						?>                    
                    <p><?php echo $html->link($sample['Sample']['name_'.$lang],  array('controller'=>'samples', 'action'=>'display', $sample['Sample']['id']));?></p>
                    <?php if (!empty($sample['Variation']['id'])): ?>
                    <p><?php echo $sample['Variation']['name_'.$lang]; ?></p>
                    <?php endif;?>
                    </li>
				<?php endforeach; ?>
            </ul>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

