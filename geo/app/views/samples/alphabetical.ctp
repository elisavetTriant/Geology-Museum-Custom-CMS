<h2><?php __('Alphabetical index of mineral samples')?></h2>
<p class="alphabet"><?php foreach ($samples as $letter => $info) echo $html->link($letter, '#'.$letter);?></p>
<?php 
	$i = 0;
	foreach ($samples as $key => $samples): 
		if ($i++ % 8 == 0) echo '<div class="float_column">';
?>
	<h2 id="<?php echo $key?>"><?php echo $key?></h2>
    <p>
		<?php foreach ($samples as $sample):?>
    		<?php echo $html->link($sample['Sample']['name_'.$lang], array('action'=>'display', $sample['Sample']['id'])); echo '<br />';?>
        <?php endforeach;?>
    </p>
    
   <?php if ($i % 8 == 0 || $i==26) echo '</div>';?>
    
<?php endforeach;?>