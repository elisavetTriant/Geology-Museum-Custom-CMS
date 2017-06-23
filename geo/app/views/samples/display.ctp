<div id="sample">
    <div id="photographs">
 	   <h2><?php echo $sample['Sample']['name_'.$lang]; ?></h2>
	   
    	<?php if (!empty($sample['Attachment'])):?>
        <ul class="gallery">
            	<?php foreach ($sample['Attachment'] as $attachment):?>
					<li>
                    <?php 
					echo $html->link($html->image($attachment['path'].$versionInfo['Medium']['prefix'].$attachment['filename'], array('alt'=> $attachment['title_'.$lang], 'width' =>'350')), $attachment['path'].$attachment['filename'],  array('escape'=>false));						
					?>
                    <p><?php echo nl2br($attachment['description_'.$lang]);?></p>
                    </li>
				<?php endforeach; ?>
            </ul>
          <?php else:?>
            <ul class="gallery">
            	<li><?php echo $html->image('/files/samples/missing_image.gif', array('width' =>'350')); ?></li>
            </ul>
          <?php endif;?>
    </div>
    <div id="information">
        <dl>
			<dt><?php __('Code'); ?></dt><dd><?php echo $sample['Sample']['new_code']; ?>&nbsp;</dd>
            <dt><?php __('Mineral'); ?></dt><dd><?php echo $sample['Mineral']['name_'.$lang]; ?>&nbsp;</dd>
            <?php if (!empty($sample['AssociateMineral'])):?>
                <dt><?php __('Associates'); ?></dt>
            	<?php foreach ($sample['AssociateMineral'] as $associateMineral):?>
                	<dd><?php echo $associateMineral['name_'.$lang]?>&nbsp;</dd>
				<?php endforeach; ?>
			<?php endif;?>
            <?php if (!empty($sample['Variation']['id'])): ?>
            <dt><?php __('Variation'); ?></dt><dd><?php echo $sample['Variation']['name_'.$lang]; ?>&nbsp;</dd>
            <?php endif;?>
             <?php if (!empty($sample['Collection']['id'])): ?>
            <dt><?php __('Collection'); ?></dt><dd><?php echo $html->link($sample['Collection']['name'], array('action'=>'perCollection',$sample['Collection']['id'] )); ?>&nbsp;</dd>
            <?php endif;?>
			<?php if (!empty($sample['Country']['id'])): ?>
            <dt><?php __('Country of Origin'); ?></dt><dd><?php echo $html->link($sample['Country']['name_'.$lang], array('action'=>'perCountry',$sample['Country']['id'] )); ?>&nbsp;</dd>
            <?php endif;?>
            <dt><?php __('Dimensions'); ?></dt><dd><?php echo $sample['Sample']['length'].' x '.$sample['Sample']['width']; ?>
            <?php if ($sample['Sample']['height']!='0.00') echo ' x '.$sample['Sample']['height'];?>
            <?php echo ' '.__('cm');?>&nbsp;</dd>
    	</dl>
        <?php if (!empty($sample['Sample']['comment_'.$lang])): ?>
            <p><?php echo nl2br($sample['Sample']['comment_'.$lang]); ?>&nbsp;</p>
        <?php endif;?>
        
        <h4><?php __('Chemistry')?></h4>
        <dl>
            <dt><?php __('Chem. Formula')?></dt>
            <dd><?php echo $sample['Mineral']['chem_formula']?></dd>
            <dt><?php __('Crystal System')?></dt>
            <dd><?php echo $html->link($crystalSystem['name_'.$lang], array('controller'=>'crystalSystems', 'action'=>'index#'.$crystalSystem['name_'.$lang] ))?></dd>
        </dl>
        
    </div>
</div>
<?php if (!empty($relatedSamples)):?>
<div id="related" style="clear:both">
		<h3><?php __('Related Samples')?></h3>
    	<ul class="gallery display">
            	<?php foreach ($relatedSamples as $sample):?>
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
<?php endif;?>
