<h2><?php __('Minerals per Dana Classification')?></h2>
<ul style="margin-bottom:20px">
<?php foreach ($dana_groups AS $dana_group):?>
<li>
	<?php 
	echo $html->link($dana_group['DanaGroup']['name_'.$lang], '#'.$dana_group['DanaGroup']['id']);
	echo ' ('.$dana_group[0]['samplesCount'].' '.__('Samples', true).')';
	?>
</li>
<?php endforeach;?>
</ul>
<?php foreach ($dana_groups AS $dana_group):?>
<h3 id="<?php echo $dana_group['DanaGroup']['id']?>"><?php echo $dana_group['DanaGroup']['name_'.$lang]?></h3>
	 <ul>
	<?php 
	foreach ($dana_group['Minerals'] AS $minerals):?>
   
    <li><?php 
	echo $html->link($minerals['Sample']['name_'.$lang], array('controller'=>'samples', 'action'=> 'display', $minerals['Sample']['id'] ));
	echo' ('.$minerals[0]['count'].')';?></li>
    
    <?php endforeach;?>
	</ul>
<?php endforeach;?>