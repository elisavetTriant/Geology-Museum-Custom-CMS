<div class="countries view">
<h2><?php  echo __('Mineral Samples from', true).' '.$country['Country']['name_'.$lang];?></h2>
</div>
<div class="related">
	<?php if (!empty($country['Sample'])):?>
	<ul class="gallery display">
    <?php foreach ($country['Sample'] as $sample):?>
		<li>
        <?php 
			if (!empty($sample['Attachment']))
					echo $html->link($html->image($sample['Attachment'][0]['path'].$versionInfo['Thumbnail']['prefix'].$sample['Attachment'][0]['filename'], array('alt'=> $sample['Attachment'][0]['title_'.$lang])), array('controller'=>'samples', 'action'=>'display', $sample['id']), array('escape'=>false)); 
			else
				   echo $html->link($html->image('/files/samples/missing_image_thumb.gif'), array('controller'=>'samples', 'action'=>'display', $sample['id']), array('escape'=>false)); 
					?>                    
                    <p><?php echo $html->link($sample['name_'.$lang],  array('controller'=>'samples', 'action'=>'display', $sample['id']));?></p>
                    <?php if (!empty($sample['Variation']['id'])): ?>
                    <p><?php echo $sample['Variation']['name_'.$lang]; ?></p>
					<?php endif;?>
                    </li>
	<?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>
